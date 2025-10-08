<?php

namespace addons\agent\controller;


use addons\appbox\model\Agent as AgentModel;
use addons\appbox\model\AgentStatistics;
use think\Config;
use think\Db;

class Api extends Base
{
    protected $config = [];

    public function __construct()
    {
        // header("Access-Control-Allow-Origin:*");
        // header("Access-Control-Allow-Credentials:true");
        // header("Access-Control-Allow-Methods: POST");
        // header('Access-Control-Allow-Headers:token');
        // echo 'test';exit();

        parent::__construct();

        $this->config = config('appConfig');
    }

    public function login()
    {
        $data = $this->request->post();
        if (!isset($data['username']) || !isset($data['password'])) $this->error('参数有误');

        $user = AgentModel::get(['channelCode' => $data['username']]);
        if (!$user) {
            return $this->err('代理用户不存在');
        }
        
        //echo $user->password . '<br>' . md5($data['password']);
        //echo $this->getEncryptPassword($data['password']);
        //exit();

        // if ($user->password != md5($data['password'])) {
        //     return $this->err('密码不正确');
        // }
        if ($user->password != $data['password']) {
            return $this->err('密码不正确');
        }

        return $this->ok([
            'user_id' => $user['id'],
            'token' => $user['password']
        ]);
    }

    public function userinfo()
    {
        $this->checkLogin();

        $uid = input('server.HTTP_USERID');

        $agentInfo = AgentModel::get(['id' => $uid]);

        if (!$agentInfo) {
            return $this->err('代理不存在');
        } else {
            return $this->ok($this->bulidUserInfo($agentInfo));
        }
    }

    public function list()
    {
        $this->checkLogin();

        $uid = (int)input('server.HTTP_USERID');

        $startTime = $this->request->param('start_time', strtotime(date('Y-m-d', strtotime('0 day'))));
        $endTime = $this->request->param('end_time', time());

        // $begintimes = $startTime;
        // $endtimes = $endTime;


        $startTime = date("Y/m/d",$startTime);
        
        $endTime = date("Y/m/d",$endTime);
        
        $statistics = new AgentStatistics();

        $data = $statistics->list($uid,$startTime,$endTime);

        if(in_array($uid,[234,352])){
            foreach($data as $k=>$v){
                $begintimes = strtotime($v['date']);
                $endtimes = $begintimes+86400;

                //日充值
                $today_pay_amount = Db::view('fa_appbox_order','*')
                ->view('fa_user','agentId','fa_user.id=fa_appbox_order.uid')
                ->where(['agentId' => $uid,'fa_appbox_order.status'=>1])
                ->where('fa_appbox_order.createTime','between time',[$begintimes,$endtimes])
                ->sum('amount');

                $data[$k]['amount'] = $today_pay_amount;
            }
        }

        $this->ok($data);
    }

    

    protected function bulidUserInfo($userInfo)
    {
        
        return  [
            'userid' => $userInfo['id'],
            'username' => $userInfo['channelCode'],
            'url'=>''
            // 'url' => $this->config['agent']['share_base_url'] . '?channelCode=' . $userInfo['channelCode']
        ];
    }
}
