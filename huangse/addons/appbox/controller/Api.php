<?php

namespace addons\appbox\controller;

use addons\appbox\controller\Base;
use addons\appbox\model\FeedBack;
use addons\appbox\model\User;
use addons\appbox\model\UserVip;
use addons\appbox\model\VipCode;
use addons\appbox\model\Agent;
use addons\appbox\model\Ads;
use addons\appbox\model\Apps;
use addons\appbox\model\Crackapp;
use addons\appbox\model\AgentStatistics;
use addons\appbox\model\TryseeTime;
use app\common\model\ScoreLog;
use addons\appbox\model\Promotion;
//use addons\appbox\library\ChannelTrack as ChannelTrackLib;
use think\Config;
use think\Request;
use think\Lang;
use think\Log;
use think\Cache;

class Api extends Base
{
    protected $noNeedLogin = ['test', 'init', 'login', 'register', 'getVideoUrl', 'checkline'];
    protected $noNeedRight = '*';

    protected $config = [];

    public function __construct()
    {
        Lang::load(APPBOX_ADDONS_PATH . "lang/zh-cn/Api.php");

        $this->config = config('appConfig');
        parent::__construct();
    }

    public function test()
    {
        $user = new User();
        $userInfo = $user->get(10);
        return $userInfo;
    }

    //APP首次调用，实现获得APP配置信息、用户信息、TOKEN，自动注册用户
    public function init()
    {
        Log::init([
            'type'  =>  'File',
            'path'  =>  APP_PATH . '../logs/',
            'apart_level'   =>  ['init'],
        ]);


        $deviceId = $this->getParam('deviceId');

        if ($deviceId == "") {
            return $this->error('device is null');
        }
        $config = $this->config;

        $user = new User();

        if ($this->auth->isLogin()) {
            $userinfo = $user->infoData($this->auth->id);
            //修改登录时间
            $user->updateLastLogin($this->auth->id);
        } else {
            //查询设备ID是否注册过，未注册写入渠道统计
            $isAddAgentStatistics = false;
            $agentId = 0;
            $channelCode = $this->getParam('channelCode');

            if (!empty($channelCode)) {
                //获得渠道id
                $agentInfo = Agent::get(['channelCode' => $channelCode]);
                if ($agentInfo) {
                    $agentId = $agentInfo['id'];
                }

                if ($agentId != 0) {
                    //设备是否注册过
                    $userInfo = $user->get(['deviceid' => $deviceId]);
                    if (!$userInfo) {
                        trace('需要创建新用户', 'init');
                        $isAddAgentStatistics = true;
                    }
                }
            }

            //读取旧用户并登录
            $userInfo = $user->getInfoByDeviceId($deviceId);
            if (!$userInfo) {
                trace('创建新用户', 'init');
                //创建新用户并登录
                $res = $this->createRandomUser($deviceId, $agentId);

                if (!$res) {
                    $this->error("创建用户失败,请重新打开APP", null, 401);
                }

                $userinfo = $user->infoData($this->auth->id);
            } else {
                // trace('旧用户直接登录','init');
                // if($deviceId == '8d72e689e821427fa9db2e4b147413bb'){
                //   trace('调试:'.$deviceId,'init');
                // }
                $this->auth->direct($userInfo['id']);
                $userinfo = $user->infoData($userInfo['id']);
            }

            //写入代理安装统计
            if ($isAddAgentStatistics) {
                trace('增加安装数', 'init');
                $agentStatistics = new AgentStatistics();
                $agentStatistics->addInstall($agentInfo['id'], $agentInfo['deduction']);
            }
        }

        //更新当日首次登录时间
        // $tryseeTime = new TryseeTime();
        // $tryseeStartTime = $tryseeTime->setStartTime($deviceId);
        Cache::store('redis')->set('ins_domain','https://4k.uqqv522.com',86400);
        $insDomain = Cache::store('redis')->get('ins_domain');
        if($insDomain){
            $config['appConfig']['insConfig']['insBaseUrl'] = $insDomain;
        }
        $result = [
            'appConfig' => $config['appConfig'],
            'goods'=>$config['goods'],
            'pipes'=>$config['vip_pipes'],
            'userinfo' => $this->bulidUserInfo($userinfo),
            // 'trysee_start_time' => $tryseeStartTime,
            'token' => $this->auth->getToken()
        ];

        $ads = new Ads();
        $adsConfig = $ads->getConfig($this->auth->id);
        $result['adConfig'] = $adsConfig;
        $this->success('ok', $result);
    }

    //获得配置中的apps中的app id
    protected function getAppsIndex($arr, $id)
    {
        if (!is_array($arr)) {
            return -1;
        }

        for ($i = 0; $i < count($arr); $i++) {
            if ($arr[$i]['id'] == $id) {
                return $i;
            }
        }

        return -1;
    }

    //获得配置中的apps中的app url
    protected function getCrackAppsIndex($arr, $url)
    {
        if (!is_array($arr)) {
            return -1;
        }

        for ($i = 0; $i < count($arr); $i++) {
            if ($arr[$i]['url'] == $url) {
                return $i;
            }
        }

        return -1;
    }

    //获得幻灯片指定广告地址的index
    protected function getSlideIndex($arr, $url)
    {
        for ($i = 0; $i < count($arr); $i++) {
            if ($arr[$i]['url'] == $url) {
                return $i;
            }
        }

        return -1;
    }

    public function checkline()
    {
        $this->success('ok', ['code' => 200]);
    }

    public function userinfo()
    {
        //$info = $this->auth->getUserinfo();

        $info = Model('addons\appbox\model\User')->infoData($this->auth->id);

        $result = $this->bulidUserInfo($info);
        $this->success('ok', $result);
    }

    public function share()
    {
        $channelCode = $this->getParam('channelCode');

        $config = $this->config['share'];

        $shareUrl = $config['baseUrl'];

        $query = [];
        if ($this->auth->isLogin()) {
            $query['p'] = $this->auth->id;
        }

        $query['channelCode'] = $config['defaultChannel'];
        if ($channelCode != '' && $config['channelInherit']) {
            $query['channelCode'] = $channelCode;
        }

        $result = [
            'ruleText' => $config['ruleText'],
            'shareUrl' => $shareUrl . '?' . http_build_query($query)
        ];

        return $this->success('ok', $result);
    }

    public function invite()
    {
        $uid = $this->getParam('id');
        $deviceId = $this->getParam('deviceId');

        //获取IP，兼容cf
        $ip =  isset($_SERVER['HTTP_CF_CONNECTING_IP']) ? $_SERVER['HTTP_CF_CONNECTING_IP'] : $_SERVER['REMOTE_ADDR'];

        $promotion = new Promotion();
        $result = $promotion->invite($uid, $deviceId, $ip);

        if ($result['code'] == 0) {
            return $this->success('ok');
        } else {
            return $this->error($result['msg']);
        }
    }

    public function login()
    {
        $account = $this->getParam('account');
        $password = $this->getParam('password');

        if (!$account) {
            return $this->error("帐号不能为空！");
        }
        if (!$password) {
            return $this->error("密码不能为空！");
        }

        $res = $this->auth->login($account, $password);
        if ($res) {
            $token = $this->auth->getToken();

            $info = Model('addons\appbox\model\User')->infoData($this->auth->id);
            $info = $this->bulidUserInfo($info);
            return $this->success('ok', [
                'token' => $token,
                'userinfo' => $info
            ]);
        } else {
            $msg = $this->auth->getError();
            return $this->error(__($msg));
        }
    }

    public function register()
    {
        $username = $this->getParam('username');
        $password = $this->getParam('password');
        $deviceid = $this->getParam('deviceId');
        //$email = $request['email'];

        if (!$username) {
            return $this->error("用户名不能为空！");
        }
        if (!$password) {
            return $this->error("密码不能为空！");
        }
        // if(!$email){
        //     return $this->error("邮箱不能为空！");
        // }

        if (User::getByUsername($username)) {
            return $this->error("用户名已经存在！");
        }
        // if (User::getByEmail($email)) {
        //     return $this->error("邮箱已经存在！");
        // }

        $res = $this->auth->register($username, $password, '', '', ['deviceid' => $deviceid]);


        if (!$res) {
            //$errMsg = $this->auth->getError();
            return $this->error("注册失败！");
        } else {
            $token = $this->auth->getToken();
            return $this->success('ok', $token);
        }
    }

    public function autoRegister()
    {
        $deviceid = $this->getParam('deviceId');
        $parentId = $this->getParam('parent');

        $username = '游客' . base_convert(millisecondWay() . '', 10, 36);
        $password = "123456";
        //获取IP，兼容cf
        $ip =  isset($_SERVER['HTTP_CF_CONNECTING_IP']) ? $_SERVER['HTTP_CF_CONNECTING_IP'] : $_SERVER['REMOTE_ADDR'];

        $res = $this->auth->register($username, $password, '', '', ['deviceid' => $deviceid]);
        if (!$res) {
            //$errMsg = $this->auth->getError();
            return $this->error("注册失败！");
        } else {
            $token = $this->auth->getToken();
            $userInfo = Model('addons\appbox\model\User')->infoData($this->auth->id);
            $result = [
                'token' => $token,
                'userinfo' => $this->bulidUserInfo($userInfo)
            ];

            if ($parentId != "") {
                //推广相关
                $res = (new Promotion())->invite($parentId, $deviceid, $ip);
                if ($result['code'] == 0) {
                    //todo:加积分
                }
            }

            return $this->success('ok', $result);
        }
    }

    public function modifyPassword()
    {
        $oldPassword = $this->getParam('oldPassword');
        $newPassword = $this->getParam('newPassword');

        if (!$oldPassword || !$newPassword) {
            return $this->error("修改错误");
        }

        $res = $this->auth->changepwd($newPassword, $oldPassword);
        if ($res) {
            return $this->success('ok');
        } else {
            $msg = $this->auth->getError();
            return $this->error(__($msg));
        }
    }

    public function bind()
    {
        $username = $this->getParam('username');
        $password = $this->getParam('password');
        $inviteCode = $this->getParam('inviteCode');

        if (!$username || !$password) {
            return $this->error("绑定错误");
        }

        if ($username == $inviteCode) {
            return $this->error("邀请码不能和用户名一致！");
        }

        if (!$inviteCode) {
            $inviteCode = "";
        }
        $user = new User();
        $userInfo = $user->get(['username' => $username]);
        if ($userInfo) {
            return $this->error("账号名已被别人注册,请更换");
        }

        if ($inviteCode) {
            $me = $user->get(['id' => $this->auth->id]);
            if ($me['inviteCode']) {
                return $this->error("你之前已经绑定过邀请码了");
            }
        }

        $res = $this->auth->bind($username, $password, $inviteCode);
        if ($res) {
            return $this->success('ok');
        } else {
            $msg = $this->auth->getError();
            return $this->error(__($msg));
        }
    }

    public function modifyUsername()
    {
        $username = $this->getParam('username');
        if ($username == "") {
            return $this->error('用户名不能为空');
        }



        $user = new User();
        $userinfo = $user->infoData($this->auth->id);
        if ($userinfo['group_id'] == 2) {
            return $this->error('此用户不允许修改用户名');
        }

        //return $this->success('ok',$username);

        $res = $user->modifyUsername($this->auth->id, $username);
        if (!$res) {
            return $this->error('修改失败');
        } else {
            $userinfo = $user->infoData($this->auth->id);
            $userinfo = $this->bulidUserInfo($userinfo);

            return $this->success('ok', $userinfo);
        }
    }

    public function vip()
    {
        //return $this->error('支付中心暂时关闭');

        $userinfo = Model('addons\appbox\model\User')->infoData($this->auth->id);
        $userinfo = $this->bulidUserInfo($userinfo);

        $pipes = config('appConfig')['vip_pipes'];

        $goods = [
            'vip' => [],
            'score' => []
        ];

        foreach ($this->config['goods'] as $v) {
            if ($v['type'] == 'vip') {
                array_push($goods['vip'], $v);
            } else if ($v['type'] == 'score') {
                array_push($goods['score'], $v);
            }
        }

        $result = [
            'userinfo' => $userinfo,
            'pipes' => $pipes,
            'goods' => $goods
        ];

        return $this->success('ok', $result);
    }

    public function scoreConsumeList()
    {
        $page = (int)$this->getParam('page');

        $scoreLog = new ScoreLog();
        $list = $scoreLog->where([
            'user_id' => $this->auth->id,
            'score' => ['<', 0]
        ])
            ->limit(20)->page($page)->order("createtime desc")->select();
        return $this->success('ok', $list);
    }

    public function feedback()
    {
        $content = $this->getParam('content');

        if (!$content) {
            return $this->error('请输入反馈内容！');
        } else {
            $feedBack = new FeedBack();
            $feedBack->insert([
                'uid' => $this->auth->id,
                'content' => $content
            ]);

            return $this->success('提交成功！');
        }
    }

    public function useVipCode()
    {
        $key = $this->getParam('key');

        $vipCode = new VipCode();
        $info = $vipCode->get(['key' => $key]);
        if (!$info) {
            return $this->error('兑换码不存在！');
        }

        if ($info['status'] == 1) {
            return $this->error('兑换码已使用！');
        }

        if ($info['expiryTime'] < time()) {
            return $this->error('兑换码已过期！');
        }

        $vipCode->setUseStatus($key, $this->auth->id);

        $userVip = new UserVip();
        $userVip->renew($this->auth->id, $info['value']);

        $user = new User();
        $userinfo = $user->infoData($this->auth->id);
        $userinfo = $this->bulidUserInfo($userinfo);

        return $this->success('兑换成功', $userinfo);
    }

    public function liveList2()
    {
        // 接口地址
        $apiUrl = htmlspecialchars_decode($this->getParam('url'));

        $cacheStr = Cache::store('redis')->get('rzList:' . md5($apiUrl));
        if ($cacheStr) {
            return $this->success("shabi", json_decode($cacheStr));
        }
        // 发起 GET 请求
        $response = file_get_contents("http://api.hclyz.com:81/mf/" . $apiUrl);

        if ($response !== false) {
            // 解析返回的 JSON 数据
            $data = json_decode($response, true);

            if ($data !== null) {
                $resData = [];
                $resData["zhubo"] = $data["zhubo"];
                $str = json_encode($resData);

                Cache::store('redis')->set('rzList:' . md5($apiUrl), $str, 600);
                return $this->success("ok", $resData);
                // return $this->success("ok",json_decode(Cache::store('redis')->get('vodList:6f35a8838437b9762c696d4321944c6f')));
            } else {
                return $this->success("ok", []);
            }
        } else {
            return $this->success("ok", []);
        }
    }

    public function liveList()
    {
        // 接口地址
        $apiUrl = "http://api.hclyz.com:81/mf/jsonmihu.txt";

        $cacheStr = Cache::store('redis')->get('sbList2:' . md5($apiUrl));
        if ($cacheStr) {
            return $this->success("ok", json_decode($cacheStr));
        }
        // 发起 GET 请求
        $response = file_get_contents($apiUrl);
        // return $this->success("ok",$response);
        if ($response !== false) {
            Cache::store('redis')->set('sbList2:' . md5($apiUrl), $response, 600);
            return $this->success("ok", $response);
        } else {
            return $this->success("ok", []);
        }
    }

    /*************************************游戏相关 ************************************************/
    //获取游戏链接
    /*
    layerId	string	是	玩家账号
    platType	string	是	游戏平台，参考“游戏平台”附录
    currency	string	是	游戏货币，参考“游戏平台”附录
    gameType	string	是	游戏类型，参考“游戏平台”附录
    ingress	string	是	终端类型，device1:电脑网页版、device2:手机网页版，其他特定终端请参考“游戏平台”附录

    gameCode	string	否	游戏代码，参考“游戏代码”接口，默认游戏大厅
    ingress	string	是	终端类型，device1:电脑网页版、device2:手机网页版，其他特定终端请参考“游戏平台”附录
    */
    const GATEWAY_URL = "https://ap.api-bet.net";
    const SN = 'ei6';
    const SECRETKEY = 'Ob67w560MYIT83U507j6jnRy8FArkwZ0';
    public function gameUrl()
    {
        $apiUrl = "/api/server/gameUrl";
        $platType = $this->getParam('platType');
        $gameType = $this->getParam('gameType');
        $gameCode = $this->getParam('gameCode');

        if (!$platType || !$gameType) {
            return $this->success('fail');
        }

        $data = [
            'playerId' => $this->auth->id,
            'platType' => $platType,
            "currency" => "CNY",
            "gameType" => $gameType,
            "ingress" => "device2"
        ];
        if ($gameCode) {
            $data["gameCode"] = $gameCode;
        }

        $res = $this->api_post(self::GATEWAY_URL . $apiUrl, $data);
        var_dump($res);
        if ($res) {
            return $this->success('ok', $res);
        } else {
            return $this->error('error');
        }
    }

    /**
     * 创建玩家
     * playerId	string	是	玩家账号，长度限制 5-11 位 小写字母 + 数字组合
        platType	string	是	游戏平台，参考“游戏平台”附录
        currency	string	是	游戏货币，参考“游戏平台”附录
     */
    public function gameCreate()
    {
        $apiUrl = "/api/server/create";
        $platType = $this->getParam('platType');

        if (!$platType) {
            return $this->error('error');
        }

        $data = [
            'playerId' => $this->auth->id,
            'platType' => $platType,
            "currency" => "CNY",
        ];

        $res = $this->api_post(self::GATEWAY_URL . $apiUrl, $data);

        if ($res) {
            // 转换为关联数组
            $array = json_decode($res, true);

            // 检查是否转换成功
            if (json_last_error() === JSON_ERROR_NONE && $array["code"] == 10000) {
                return $this->success('ok');
            } else {
                return $this->error('error');
            }
        } else {
            return $this->error('error');
        }
    }

    /**
     * 一键回收
     *playerId	string	是	玩家账号
     *currency	string	是	游戏货币，参考“游戏平台”附录
     *每个玩家每分钟内请求不能超过 2 次
     *请求超时时间必须设置大于 60 秒
     *部分游戏平台在游戏中无法转换额度
     */
    public function gameTransferAll()
    {
        $apiUrl = "/api/server/transferAll";

        $data = [
            'playerId' => $this->auth->id,
            'currency' => 'CNY',
        ];

        $res = $this->api_post(self::GATEWAY_URL . $apiUrl, $data);
        if ($res) {
            // 转换为关联数组
            $array = json_decode($res, true);

            // 检查是否转换成功
            if (json_last_error() === JSON_ERROR_NONE && $array["code"] == 10000) {
                return $this->success('ok', ["balanceAll" => $array["data"]["balanceAll"]]);
            } else {
                return $this->error('error');
            }
        }
        return $this->error('error');
    }

    private function generateRandomString($length = 16)
    {
        $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
        $charactersLength = strlen($characters);
        $randomString = '';
        for ($i = 0; $i < $length; $i++) {
            $randomString .= $characters[random_int(0, $charactersLength - 1)];
        }
        return $randomString;
    }

    private function api_post($url, $data)
    {
        $oCurl = curl_init();
        if (stripos($url, "https://") !== FALSE) {
            curl_setopt($oCurl, CURLOPT_SSL_VERIFYPEER, FALSE);
            curl_setopt($oCurl, CURLOPT_SSL_VERIFYHOST, FALSE);
        }

        curl_setopt($oCurl, CURLOPT_POST, 1);
        curl_setopt($oCurl, CURLOPT_URL, $url);
        curl_setopt($oCurl, CURLOPT_POSTFIELDS, json_encode($data));
        curl_setopt($oCurl, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($oCurl, CURLOPT_TIMEOUT, 60);          //单位 秒
        $ran = $this->generateRandomString();
        $headers = [
            'sn: ei6',
            'Content-Type: application/json',
            'random: ' . $ran,
            'sign: ' . md5($ran . self::SN . self::SECRETKEY)
        ];
        curl_setopt($oCurl, CURLOPT_HTTPHEADER, $headers);
        $sContent = curl_exec($oCurl);
        $aStatus = curl_getinfo($oCurl);
        $err = curl_error($oCurl);
        curl_close($oCurl);

        switch (intval($aStatus["http_code"])) {
            case 200:
            case 400:
                return $sContent;
            default:
                return $err;
        }
    }


    public function vodList()
    {
        // 接口地址
        $apiUrl = htmlspecialchars_decode($this->getParam('url'));

        $cacheStr = Cache::store('redis')->get('sbList:' . md5($apiUrl));
        if ($cacheStr) {
            return $this->success("shabi", json_decode($cacheStr));
        }
        // 发起 GET 请求
        $response = file_get_contents($apiUrl);

        if ($response !== false) {
            // 解析返回的 JSON 数据
            $data = json_decode($response, true);

            if ($data !== null) {
                $resData = [];
                $resData["pagecount"] = $data["pagecount"];
                $resData["list"] = [];
                foreach ($data["list"] as $value) {
                    array_push($resData["list"], [
                        "type_id" => $value["type_id"],
                        "vod_name" => $value["vod_name"],
                        "vod_pic" => $value["vod_pic"],
                        "vod_play_url" => $value["vod_play_url"]
                    ]);
                }
                $str = json_encode($resData);

                Cache::store('redis')->set('sbList:' . md5($apiUrl), $str, 86400);
                return $this->success("ok", $resData);
                // return $this->success("ok",json_decode(Cache::store('redis')->get('vodList:6f35a8838437b9762c696d4321944c6f')));
            } else {
                return $this->success("ok", []);
            }
        } else {
            return $this->success("ok", []);
        }
    }

    public function app_report()
    {
        $title = $this->getParam('title');
        $type = $this->getParam('type');
        if ($title == "") {
            return $this->error('title error');
        }

        $todayDate = date("Y-m-d");

        try {
            $dateInfo = db('appbox_app_hit_statistics')->where([
                'title' => $title,
                'type' => $type,
                'createDate' => $todayDate
            ])->find();

            if (!$dateInfo) {
                db('appbox_app_hit_statistics')->insert(
                    [
                        'title' => $title,
                        'createDate' => $todayDate,
                        'type' => $type,
                        'hits' => 1
                    ]
                );
            } else {
                db('appbox_app_hit_statistics')->where([
                    'title' => $title,
                    'type' => $type,
                    'createDate' => $todayDate
                ])->setInc('hits');
            }
        } catch (\Exception $e) {
            return $this->error('error');
        }

        return $this->success('ok');
    }

    public function ad_report()
    {
        $id = intval($this->getParam('id'));
        if ($id == -1) {
            return $this->error('id error');
        }

        $adinfo = db('appbox_ad_list')->where(['id' => $id])->find();
        if (!$adinfo) {
            return $this->error('读取地址失败');
        } else {
            $todayDate = date("Y-m-d");

            try {
                $dateInfo = db('appbox_ad_hit_statistics')->where([
                    'adId' => $adinfo['id'],
                    'createDate' => $todayDate
                ])->find();

                if (!$dateInfo) {
                    db('appbox_ad_hit_statistics')->insert(
                        [
                            'adId' => $adinfo['id'],
                            'createDate' => $todayDate,
                            'hits' => 1
                        ]
                    );
                } else {
                    db('appbox_ad_hit_statistics')->where([
                        'adId' => $adinfo['id'],
                        'createDate' => $todayDate
                    ])->setInc('hits');
                }

                // if($this->auth->agentid=='1065'){
                db('appbox_agent_statistics')->where([
                    'agentId' => $this->auth->agentid,
                    'date' => $todayDate
                ])->setInc('hits');
                // }
            } catch (\Exception $e) {
            }

            return $this->success('ok');
        }
    }

    protected function bulidUserInfo($userInfo)
    {
        $isvip = time() < (int)$userInfo['vip_end_time'];
        $vip_expiry_time = $userInfo['vip_end_time'];

        // $username = $userInfo['username'];
        $password = $userInfo['password'];
        // if(is_numeric($username)){
        //     $username = $userInfo['id'];
        // }

        return  [
            'uid' => $userInfo['id'],
            'username' => $userInfo['username'],
            'mobile' => $userInfo['mobile'],
            'password' => $password,
            'invite' => $userInfo['invite'],
            'deviceid'=> $userInfo['deviceid'],
            // 'avatar' => $avatar,
            'score' => $userInfo['score'],
            'vip' => $isvip,
            'vip_expiry_time' => $vip_expiry_time  // $userInfo['vip_end_time']
        ];
    }

    //增加金币
    public function addScore()
    {
        $num = intval($this->getParam('num'));
        if ($num > 10 || $num <= 0) {
            return $this->error('num error');
        }
        \app\common\model\User::score($num, $this->auth->id, '做任务领取金币');

        return $this->success('领取成功', null);
    }

    //获取VIP视频连接
    public function getVideoUrl()
    {
        $vid = $this->getParam('vid');
        $site = $this->getParam('site');
        if (!$vid) {
            return $this->error('id error');
            // $vid = '123122';
        }
        if (!$site) {
            $site = '1';
        }

        $url = Cache::store('redis')->get('videoUrl:' . $vid);
        // $url = "https://ut.lnh7.com/ms/sym/0b57599322198680d4cc93037e__508285/hls/1/index.m3u8?wsSecret=504fdc9a801f2f691b6f6d6a861c2b1b&wsTime=1745895222";
        if ($url) {
            // 使用正则表达式匹配字符串末尾的数字
            preg_match('/\d+$/', $url, $matches);
            $wsTime = $matches[0];
            if (intval($wsTime) > time()) {
                $this->success("ok", ['url' => $url]);
            }
        }

        $url = $this->insGetUrl($vid,$site);
        if (!$url) {
            return $this->error("获取视频链接失败！");
        }
        // 使用正则表达式匹配字符串末尾的数字
        preg_match('/\d+$/', $url, $matches);
        $wsTime = $matches[0];
        $expireTime = new \DateTime('@'.$wsTime);
        Cache::store('redis')->set('videoUrl:' . $vid,$url,$expireTime);
        $this->success("ok", ['url' => $url]);
    }

    private function insGetUrl($vid,$site)
    {
        $insKEY = "0XxdjmI55ZjjqQLO3nI7gGqrBP0Vz9jS";
        $insIV = "RWf23muavY";
        $insSuffix = "NWSdef";
        $time = time() * 1000;
        // $encode_sign = md5("device=1&password=" . $password . "&site=1&timestamp=" . $time . "&username=" . $username . "&NRkw0g3iJLDvw5tJ5PuVt5276z0SOuyL");
        $postData = [
            "device" => 1,
            "site" => $site,
            "token" => Cache::store('redis')->get('INS_TOKEN'),
            "vid" => $vid,
            "timestamp" => $time
        ];
        ksort($postData);
        reset($postData);
        $str = http_build_query($postData);
        $postData['encode_sign'] = md5($str . "&NRkw0g3iJLDvw5tJ5PuVt5276z0SOuyL");

        $d = $postData;
        $d = openssl_encrypt(json_encode($postData), 'AES-256-CBC', $insKEY, OPENSSL_RAW_DATA, $insIV . $insSuffix);
        $d = base64_encode($d);
        // $postData = base64_encode(openssl_encrypt(json_encode($postData), 'AES-256-CBC', $insKEY, OPENSSL_RAW_DATA, $insIV));

        $url = "https://insav.tv/api/video/getVideoUrl";

        $oCurl = curl_init();
        if (stripos($url, "https://") !== FALSE) {
            curl_setopt($oCurl, CURLOPT_SSL_VERIFYPEER, FALSE);
            curl_setopt($oCurl, CURLOPT_SSL_VERIFYHOST, FALSE);
        }

        $data = [
            "post-data" => $d
        ];
        curl_setopt($oCurl, CURLOPT_POST, 1);
        curl_setopt($oCurl, CURLOPT_URL, $url);
        curl_setopt($oCurl, CURLOPT_POSTFIELDS, json_encode($data));
        curl_setopt($oCurl, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($oCurl, CURLOPT_TIMEOUT, 60);          //单位 秒
        $headers = [
            'Suffix: NWSdef',
            'Content-Type: application/json',
        ];
        curl_setopt($oCurl, CURLOPT_HTTPHEADER, $headers);
        $sContent = curl_exec($oCurl);
        $aStatus = curl_getinfo($oCurl);
        $err = curl_error($oCurl);
        curl_close($oCurl);

        switch (intval($aStatus["http_code"])) {
            case 200:
            case 400:
                $resData = json_decode($sContent, true);
                $insData = openssl_decrypt(base64_decode($resData['data']), 'AES-256-CBC', $insKEY, OPENSSL_RAW_DATA, $insIV . $resData['suffix']);
                $insData = json_decode($insData, true);
                if ($insData['code'] == 1) {
                    return $insData['data'];
                } else {
                    return "";
                }
                break;
            default:
                return "";
        }
    }
}
