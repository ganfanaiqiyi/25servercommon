<?php

namespace app\index\controller;

use addons\appbox\model\Ads;
use addons\appbox\model\Agent;
use addons\appbox\model\AgentStatistics;
use app\common\controller\Frontend;
use think\Config;

class Index extends Frontend
{
    protected $noNeedLogin = '*';
    protected $noNeedRight = '*';
    protected $layout = '';

    const DEFAULT_CHANNEL = 'c_1';
    const DEFAULT2_CHANNEL = 'c_1'; //apk直链默认渠道

    private $config = [];

    public function __construct()
    {
        parent::__construct();

        $domain = $_SERVER['HTTP_HOST'];

        //$domains = config('cdnDomains')['lvjuren'];
        $sites = config('cdnDomains');

        //$static_domain = str_replace('/goa','', config('appConfig')['ad_jump_url']);
        // $static_domain = config('appConfig')['home_static_domain'];

        //设置前端模板路径
        // $this->view->config('view_path', TEMPLATE_PATH . 'ssw3/html/');
        // $this->view->assign('tpl_path', $static_domain .  '/template/ssw3/');
        // if (in_array($domain, $sites['ailun'])) {
        //     //设置前端模板路径
        //     $this->view->config('view_path', TEMPLATE_PATH . 'sesewu/html/');
        //     $this->view->assign('tpl_path', $static_domain . '/template/sesewu/');
        // } else {
        //     $this->view->config('view_path', TEMPLATE_PATH . 'ssw3/html/');
        //     $this->view->assign('tpl_path', $static_domain . '/template/ssw3/');
        // }
        // $this->view->config('view_path', TEMPLATE_PATH . 'sesewu/html/');
        // $this->view->assign('tpl_path', $static_domain . '/template/sesewu/');

        
        // else if(in_array($domain,$sites['ssw'])){
        //     //设置前端模板路径
        //     $this->view->config('view_path', TEMPLATE_PATH . 'ssw2/html/');
        //     $this->view->assign('tpl_path', $static_domain .  '/template/ssw2/');
        // }
        // // else if(in_array($domain,$sites['dongpiandi'])){
        // //     //设置前端模板路径
        // //     $this->view->config('view_path', TEMPLATE_PATH . 'dpd/html/');
        // //     $this->view->assign('tpl_path', $static_domain .  '/template/dpd/');
        // // }
        // else{
        //     //设置前端模板路径
        //     $this->view->config('view_path', TEMPLATE_PATH . 'style2/html/');
        //     $this->view->assign('tpl_path', $static_domain .  '/template/style2/');
        // }

        // //设置前端模板路径
        // $this->view->config('view_path', TEMPLATE_PATH . 'style3/html/');
        // $this->view->assign('tpl_path', '/template/style3/');

    }

    public function test()
    {
        $ads = new Ads();
        $adsConfig = $ads->getConfig($this->auth->id);
        var_dump($adsConfig);
        // $domain = $_SERVER['HTTP_HOST'];
        //echo $domain;exit();
        // echo config('site.home_popup');exit();
    }

    //落地页
    public function index($channelCode='',$c='')
    {
        return 'ok';
        // $channelCode = $this->request->param('channelCode/d');

        $host = $_SERVER['HTTP_HOST'];

        $tmp = substr($host, 0, 2);
        if ($tmp == 'ap' || $tmp == 'a.') {
            echo '1';
            exit();
        }
        //echo $_SERVER['HTTP_HOST'];
        $channel = $channelCode;
        if (empty($channel)&&!empty($c)){
            $channel = $c;
        }

        if (empty($channel) && $host != 'www.sheshewu.com' && $host != 'www.wbha96.xyz' && $host != 'www.wbpa49.xyz') {
            exit();
            $channel = self::DEFAULT_CHANNEL;
        }

        $agent = model('addons\appbox\model\Agent');
        $channelInfo = $agent->getInfo($channel);
        if (!$channelInfo) {
            $channelInfo = $agent->getInfo(self::DEFAULT_CHANNEL);
        }

        //var_dump($channelInfo);exit();

        // if ($channelInfo['status'] == 0) {
        //     $channel = self::DEFAULT_CHANNEL;
        // } else {
        //     $deduction = $channelInfo['deduction'];
        //     //扣量按随机
        //     if ($deduction < 1 && $deduction > 0) {
        //         $rnd = mt_rand(1, 100);
        //         if ($rnd <= $deduction * 100) {
        //             $channel = self::DEFAULT_CHANNEL;
        //         }
        //     }
        // }
        
        if ($channelInfo['status'] == 0) {
            $channel = self::DEFAULT_CHANNEL;
        }

        //$this->view->assign('static_domain', config('appConfig')['ad_jump_url']);

        $_apk_domain = config('site.apk_domain');
        $apk_domain = implode(",", $_apk_domain);
        

        $this->view->assign('app_version', config('site.app_version'));
        $this->view->assign('apk_domain', $apk_domain);

        $this->view->assign('channel', $channel);
        $this->view->assign('ios_url', config('appConfig')['ios_down_url']);
        
        header('Cache-Control:no-cache');
        return $this->view->fetch();
    }

    public function doc()
    {
        return $this->view->fetch();
    }

    //APK直链
    public function apk($channel = '')
    {
        if (empty($channel)) {
            $channel = self::DEFAULT2_CHANNEL;
        }

        $agent = model('addons\appbox\model\Agent');
        $channelInfo = $agent->getInfo($channel);
        if (!$channelInfo) {
            $channelInfo = $agent->getInfo(self::DEFAULT2_CHANNEL);
        }

        if ($channelInfo['status'] == 0) {
            $channel = self::DEFAULT2_CHANNEL;
        } else {
            // $deduction = $channelInfo['deduction'];
            // //扣量按随机
            // if($deduction < 1 && $deduction > 0){
            //     $rnd = mt_rand(1,100);
            //     if($rnd <= $deduction * 100){
            //         $channel = self::DEFAULT2_CHANNEL;
            //         $channelInfo = $agent->getInfo($channel);
            //     }
            // }
        }

        //$channelInfo = model('app\app\model\Channel')->getInfo($channel);
        if (empty($channelInfo['apkUrl'])) {
            $domain = config('appConfig')['home_domain'];
            header('Location:' . $domain . '?channelCode=' . $channel);
            //echo $domain . '?channelCode=' . $channel;
            exit();
        } else {
            header('Location:' . $channelInfo['apkUrl']);
            //echo $channelInfo['apk_url'];
            exit();
        }

    }

    //跳到广告url
    public function goAdUrl()
    {
        $id = (int) $this->request->param('id');

        $adinfo = db('appbox_ad_list')->where(['id' => $id])->find();
        if (!$adinfo) {
            echo '读取地址失败';
            exit();
        } else {
            $todayDate = date("Y-m-d");

            try {
                $dateInfo = db('appbox_ad_hit_statistics')->where([
                    'adId' => $adinfo['id'],
                    'createDate' => $todayDate,
                ])->find();

                if (!$dateInfo) {
                    db('appbox_ad_hit_statistics')->insert(
                        [
                            'adId' => $adinfo['id'],
                            'createDate' => $todayDate,
                            'hits' => 1,
                        ]
                    );
                } else {

                    db('appbox_ad_hit_statistics')->where([
                        'adId' => $adinfo['id'],
                        'createDate' => $todayDate,
                    ])->update([
                        'hits' => $dateInfo['hits'] + 1,
                    ]);

                    // echo $dateInfo['hits'];
                    // $dateInfo = db('appbox_ad_hit_statistics')->where([
                    //     'adId' => $adinfo['id'],
                    //     'createDate' => $todayDate
                    // ])->find();
                    // echo $dateInfo['hits'];
                    // exit();
                }
            } catch (\Exception $e) {

            }

            header('Location:' . $adinfo['url']);
        }

    }

    public function downloadApk()
    {
        //真实IP
        $ip = request()->ip();
        if (isset($_SERVER['HTTP_X_REAL_IP'])) {
            $ip = $_SERVER['HTTP_X_REAL_IP'];
        }

        $this->config = config('appConfig');

        $channelCode = $this->request->param('channelCode');
        // echo $channelCode;
        // exit();

        if ($this->isIos()) {
            $downUrl = $this->config['ios_down_url'] . '?channelCode=' . $channelCode;
            if ($channelCode == 'c53') {
                $downUrl = $this->config['apk_down_url'];
            }
        } else {
            $downUrl = $this->config['apk_down_url'];
        }

        if (!isset($channelCode)) {
            header('Location:' . $downUrl);
            exit();
        } else {
            $agent = new Agent();
            $agentInfo = $agent->get(['channelCode' => $channelCode]);
            if (!$agentInfo) {
                header('Location:' . $downUrl);
                exit();
            }
        }

        // Log::init([
        //     'type'  =>  'File',
        //     'path'  =>  APP_PATH . '../logs/',
        //     'apart_level'   =>  ['channelTrack'],
        // ]);

        // trace('ip:' . $ip . ';channelCode:' . $channelCode,'channelTrack');

        //更新点击数
        $agentStatistics = new AgentStatistics();
        $agentStatistics->addHits($agentInfo['id']);

        // $channelTrack = new ChannelTrack();
        // $res = $channelTrack->setItem($ip,$channelCode);
        // if(!$res){
        //     trace('写入缓存错误','channelTrack');
        // }

        // //测试
        // $res = $channelTrack->getItem($ip);
        // if(!$res){
        //     trace('读取缓存错误1','channelTrack');
        // }else{
        //     trace('读取缓存成功:' . $res,'channelTrack');
        // }

        if ($channelCode == 'c69') {
            header('Location:' . 'https://www.18mo8.info/?channelCode=c69');
            return;
        }

        //['c34','c39','c40','c41','c42','c43','c46','c47','c48','c49','c51','c52','c53','c54','c55','c56','c57','c58','c59','c60','c61','c62','c63','c64','c65','c72','c75','c76','c77','c78','c79','c80','c81','c82','c83','c84','c85','c86','c87','c88','c89','c90','c91','c92','c93','c94','c95','c96','c97','c98','c99','c100','c101','c102','c103','c104','c105','c106','c107','c108','c109','c110','c111','c112','c113','c114','c115','c116','c117','c118','c119','c120','c121','c122','c123','c124','c125','c126','c127']
        //['c34','c39','c40','c41','c42','c43','c46','c47','c48','c49','c51','c52','c53','c54','c55','c56','c57','c58','c59','c60','c61','c62','c63','c64','c65','c72','c75','c76','c77','c78','c79','c80','c81','c82','c83','c84','c85','c86','c87','c88','c89','c90','c91','c92','c93','c94','c95','c96','c97','c98','c99','c100','c101','c102','c103','c104','c105','c106','c107']
        if (in_array($channelCode, ['c34', 'c39', 'c40', 'c41', 'c42', 'c43', 'c44', 'c46', 'c47', 'c48', 'c49', 'c51', 'c52', 'c53', 'c54', 'c55', 'c56', 'c57', 'c58', 'c59', 'c60', 'c61', 'c62', 'c63', 'c64', 'c65', 'c72', 'c75', 'c76', 'c77', 'c78', 'c79', 'c80', 'c81', 'c82', 'c83', 'c84', 'c85', 'c86', 'c87', 'c88', 'c89', 'c90', 'c91', 'c92', 'c93', 'c94', 'c95', 'c96', 'c97', 'c98', 'c99', 'c100', 'c101', 'c102', 'c103', 'c104', 'c105', 'c106', 'c107', 'c108', 'c109', 'c110', 'c111', 'c112', 'c113', 'c114', 'c115', 'c116', 'c117', 'c118', 'c119', 'c120', 'c121', 'c122', 'c123', 'c124', 'c125', 'c126', 'c127', 'c128', 'c129', 'c130', 'c131', 'c132', 'c133', 'c134', 'c135', 'c136', 'c137', 'c138', 'c139', 'c140', 'c141', 'c142', 'c143', 'c144', 'c145', 'c146', 'c147', 'c148', 'c149', 'c150', 'c151', 'c152', 'c153', 'c154', 'c155', 'c156', 'c157'])) {
            $downUrl = str_replace('c_1.apk', $channelCode . '.apk', $downUrl);
        }

        // switch($channelCode){
        //     case 'c42':
        //     case 'c43':
        //     case 'c46':
        //     case 'c49':
        //     case 'c51':
        //     case 'c53':
        //         $downUrl = str_replace('18mo114.apk',$channelCode . '.apk',$downUrl);
        //         break;
        // }

        header('Location:' . $downUrl);
    }

    protected function isIos()
    {
        $agent = strtolower($_SERVER['HTTP_USER_AGENT']);
        //分别进行判断
        if (strpos($agent, 'iphone') || strpos($agent, 'ipad')) {
            return true;
        } else {
            return false;
        }
    }

    public function adsList()
    {
        $iosUrl = '';
        $adinfo = db('appbox_ad_list')->where(['id' => 889])->find();
        if ($adinfo) {
            $iosUrl = $adinfo['url'];
        }

        //获得公告中链接
        $home_popup = config('site.home_popup');
        //preg_match_all('http(.*)/i',$home_popup,$urls);
        preg_match_all('/(http[s]?:\/\/[^\s]*)[\'\"]/i', $home_popup, $matchs);
        $tmpUrls = '';
        //var_dump($matchs);exit();
        foreach ($matchs[1] as $url) {
            $tmpUrls .= $url . "<br>";
        }

        $list = db('appbox_ad_list')->alias('a')
            ->join('fa_appbox_ad_position b', 'a.positionId=b.id', 'LEFT')
            ->field('b.name,a.*')
            ->order('b.sort desc,b.id,a.sort desc')
            ->where('status=1')
            ->select();
        //echo db('appbox_ad_list')->getLastSql();
        //exit();

        //    $result = array("total" => count($list), "rows" => $list);

        echo '落地页IOS跳转----' . $iosUrl . ' <br><br>'; //config('appConfig')['ios_down_url']
        echo '公告中的链接----' . $tmpUrls . '<br><br>'; //http://b8jym67.vip(约炮) https://335p.tv/1.html?channelCode=ys335p 直播<br><br>'; //config('site.home_popup')

        $lastPositionName = '';
        foreach ($list as $v) {
            if ($v['name'] != $lastPositionName) {
                echo $v['name'] . '<br>';
            }
            $lastPositionName = $v['name'];

            echo '&nbsp;&nbsp;&nbsp;&nbsp;' . $v['title'] . '----' . $v['url'] . '<br>';
        }

        echo '<br><br>开启的支付：<br>';
        foreach (config('appConfig')['vip_pipes'] as $pipe) {
            $pipeCode = $this->getPipeInfo($pipe['name']);
            if (!$pipeCode) {
                $pipeCode = '';
            } else {
                $pipeCode = $pipeCode['params']['payTypeId'];
            }

            echo $this->getPayName($pipe['name']) . ' [编码：' . $pipeCode . ']<br>';
        }

        $todayDate = date("Y-m-d");
        $yesterday = date("Y-m-d", strtotime("-1 day"));
        $oldday = date("Y-m-d", strtotime("-2 day"));

        // echo '<br><br>老用户登录统计：<br>';
        // echo '今天：<br>';
        // $sbInfoLogin = db('appbox_app_hit_statistics')->where([
        //     'createDate' => $todayDate,
        //     'title' => '老用户登录',
        //     'type' => 'login'
        // ])->select();
        // foreach($sbInfoLogin as $v){
        //     echo '&nbsp;&nbsp;&nbsp;&nbsp;' . $v['title'] . '----' . $v['hits'] . '<br>';
        // }

        // echo '昨天：<br>';
        // $sbInfoLogin2 = db('appbox_app_hit_statistics')->where([
        //     'createDate' => $yesterday,
        //     'title' => '老用户登录',
        //     'type' => 'login'
        // ])->select();
        // foreach($sbInfoLogin2 as $v){
        //     echo '&nbsp;&nbsp;&nbsp;&nbsp;' . $v['title'] . '----' . $v['hits'] . '<br>';
        // }

        $sbInfo1 = db('appbox_ad_hit_statistics')->alias('a')
        ->join('fa_appbox_ad_list b','a.adId=b.id','LEFT')
        ->field('b.title,a.hits,a.createDate')
        ->where([
            'createDate' => $todayDate
        ])->select();

        $sbInfo2 = db('appbox_ad_hit_statistics')->alias('a')
        ->join('fa_appbox_ad_list b','a.adId=b.id','LEFT')
        ->field('b.title,a.hits')
        ->where([
            'createDate' => $yesterday
        ])->select();

        $sbInfo3 = db('appbox_ad_hit_statistics')->alias('a')
        ->join('fa_appbox_ad_list b','a.adId=b.id','LEFT')
        ->field('b.title,a.hits,a.createDate')
        ->where([
            'createDate' => $oldday
        ])->select();
       
        echo '<br><br>所有广告点击统计：<br>';
        echo '今天：<br>';
        $num1 = 0;
        $num2 = 0;
        $num3 = 0;
        foreach($sbInfo1 as $v){
            echo '&nbsp;&nbsp;&nbsp;&nbsp;' . $v['title'] . '----' . $v['hits'] . '<br>';
            $num1 +=$v['hits'];
        }
        echo '总计&nbsp;&nbsp;' . $num1 . '<br>';
        echo '昨天：<br>';
        foreach($sbInfo2 as $v){
            echo '&nbsp;&nbsp;&nbsp;&nbsp;' . $v['title'] . '----' . $v['hits'] . '<br>';
            $num2 +=$v['hits'];
        }
        echo '总计&nbsp;&nbsp;' . $num2 . '<br>';
        echo '前天：<br>';
        foreach($sbInfo3 as $v){
            echo '&nbsp;&nbsp;&nbsp;&nbsp;' . $v['title'] . '----' . $v['hits'] . '<br>';
            $num3 +=$v['hits'];
        }
        echo '总计&nbsp;&nbsp;' . $num3 . '<br>';


        $aNum1=0;
        $bNum1=0;
        $cNum1=0;
        $dNum1=0;
        $aNum2=0;
        $bNum2=0;
        $cNum2=0;
        $dNum2=0;

        $aTotal1=0;
        $aTotal2=0;

        $sbInfo1 = db('appbox_agent_statistics')->alias('a')
        ->join('appbox_agent b','a.agentId=b.id','LEFT')
        ->field('b.channelCode,b.price,a.install,a.installReal,a.date')
        ->order('a.agentId desc')
        ->where([
            'date' => $todayDate
        ])->select();
        echo '<br><br>所有渠道统计：<br>';
        echo '今天'.$todayDate.'：<br>';
        echo '&nbsp;&nbsp;&nbsp;&nbsp;' . '渠道代码' . '----' . '扣量安装数'. '----' . '真实安装数'. '----' . '单价'. '----'. '总成本'. '----'. '单个成本' .'<br>';
        foreach($sbInfo1 as $v){
            if($v['install']>0&$v['price']>1){
                
                echo '&nbsp;&nbsp;&nbsp;&nbsp;' . $v['channelCode'] . '----' . $v['install']. '----' . $v['installReal']. '----' . $v['price']. '----'. $v['price']*$v['install']. '----'. round($v['price']*$v['install']/$v['installReal'],2).'<br>';
                $aTotal1 +=$v['price']*$v['install'];
                $aNum1 +=$v['install'];
                 $bNum1 +=$v['installReal'];
            }else{
                $cNum1 +=$v['install'];
                 $dNum1 +=$v['installReal'];
            }
            

        }
        
        echo 'cpa总计扣量安装数&nbsp;&nbsp;' . $aNum1 . '<br>';
        echo 'cpa总计真实安装数&nbsp;&nbsp;' . $bNum1 . '<br>';
        echo 'cpc总计扣量安装数&nbsp;&nbsp;' . $cNum1 . '<br>';
        echo 'cpc总计真实安装数&nbsp;&nbsp;' . $dNum1 . '<br>';
        echo 'cpa总计花费&nbsp;&nbsp;' . $aTotal1 . '<br>';
         echo 'cpc预计总计花费(以三个点击一个安装和cpc价格0.33算)&nbsp;&nbsp;' . $dNum1*3*0.35 . '<br>';
         echo 'cpa+cpc预计总计花费&nbsp;&nbsp;' . ($aTotal1+$dNum1*3*0.35) . '<br>';

        $sbInfo2 = db('appbox_agent_statistics')->alias('a')
        ->join('appbox_agent b','a.agentId=b.id','LEFT')
        ->field('b.channelCode,b.price,a.install,a.installReal,a.date')
        ->order('a.agentId desc')
        ->where([
            'date' => $yesterday
        ])->select();
        echo '<br><br>所有渠道统计：<br>';
        echo '昨天'.$yesterday.'：<br>';
        echo '&nbsp;&nbsp;&nbsp;&nbsp;' . '渠道代码' . '----' . '扣量安装数'. '----' . '真实安装数'. '----' . '单价'. '----'. '总成本'. '----'. '单个成本' .'<br>';
        foreach($sbInfo2 as $v){
            if($v['install']>0&$v['price']>1){
                
                echo '&nbsp;&nbsp;&nbsp;&nbsp;' . $v['channelCode'] . '----' . $v['install']. '----' . $v['installReal']. '----' . $v['price']. '----'. $v['price']*$v['install']. '----'. round($v['price']*$v['install']/$v['installReal'],2).'<br>';
               $aTotal2 +=$v['price']*$v['install'];
               $aNum2 +=$v['install'];
                $bNum2 +=$v['installReal'];
            }else{
                $cNum2 +=$v['install'];
                $dNum2 +=$v['installReal'];
            }
            

        }
         
       echo 'cpa总计扣安装数&nbsp;&nbsp;' . $bNum2 . '<br>';
        echo 'cpa总计真实安装数&nbsp;&nbsp;' . $bNum2 . '<br>';
        echo 'cpc总计扣量安装数&nbsp;&nbsp;' . $cNum2 . '<br>';
        echo 'cpc总计真实安装数&nbsp;&nbsp;' . $dNum2 . '<br>';
         echo 'cpa总计扣量安装数&nbsp;&nbsp;' . $aNum2 . '<br>';
         echo 'cpa总计花费&nbsp;&nbsp;' . $aTotal2 . '<br>';
        echo 'cpc预计总计花费(以三个点击一个安装和cpc价格0.33算)&nbsp;&nbsp;' . $dNum2*3*0.35 . '<br>';
        
        echo 'cpa+cpc预计总计花费&nbsp;&nbsp;' .( $aTotal2+$dNum2*3*0.35) . '<br>';

        // echo '总计扣量安装数&nbsp;&nbsp;' . $aNum2 . '<br>';
        // echo '总计真实安装数&nbsp;&nbsp;' . $bNum2 . '<br>';

        //return json($result);

        //$this->view->assign("list",$list);
        //return $this->view->fetch();
    }

    protected function getPayName($pipeName)
    {
        $pipeName = str_replace('alipay', '支付宝', $pipeName);
        $pipeName = str_replace('wechat', '微信', $pipeName);
        return $pipeName;
    }

    protected function getPipeInfo($pipeName)
    {
        foreach (config('appConfig')['pipes'] as $pipe) {
            if ($pipeName == $pipe['name']) {
                return $pipe;
            }
        }

        return false;
    }
}
