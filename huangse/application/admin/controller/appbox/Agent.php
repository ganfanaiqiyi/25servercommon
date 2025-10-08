<?php

namespace app\admin\controller\appbox;

use app\common\controller\Backend;
use think\Validate;
use think\Db;


class Agent extends Backend
{
    public function _initialize()
    {
        parent::_initialize();
        $this->op = model('addons\appbox\library\Openinstall');
        $this->model = model('addons\appbox\model\Agent');

        $this->view->assign("statusList", ['1'=>'启用','0' => '禁用']);
    }

    public function index()
    {
        $this->request->filter(['strip_tags', 'trim']);
        
        $beginToday=mktime(0,0,0,date('m'),date('d'),date('Y')); 
        $endToday=mktime(0,0,0,date('m'),date('d')+1,date('Y'))-1; 
            
        if ($this->request->isAjax()) {
            //如果发送的来源是Selectpage，则转发到Selectpage
            if ($this->request->request('keyField')) {
                return $this->selectpage();
            }
            list($where, $sort, $order, $offset, $limit) = $this->buildparams();
            $list = $this->model
                ->where($where)
                ->order($sort, $order)
                ->paginate($limit);
                
             $rows = $list->items();
            
            

            for($i=0;$i<count($rows);$i++){
                //总充值
                // $total_pay_amount = Db::view('fa_appbox_order','*')
                // ->view('fa_user','agentId','fa_user.id=fa_appbox_order.uid')
                // ->where(['agentId' => $rows[$i]['id'],'fa_appbox_order.status'=>1])
                // ->sum('amount');
                // $rows[$i]['total_pay_amount'] = $total_pay_amount;
                
                $today_newUser = db('user')
                    ->where(['agentid' => $rows[$i]['id']])
                    ->where('createtime','between time',[$beginToday,$endToday])
                    ->count();
                $rows[$i]['today_newUser'] = $today_newUser;

                

                $today_pay_amount = Db::view('fa_appbox_order','*')
                ->view('fa_user','agentId','fa_user.id=fa_appbox_order.uid')
                ->where(['agentId' => $rows[$i]['id'],'fa_appbox_order.status'=>1,'fa_appbox_order.createTime' => ['between',$beginToday . ',' . $endToday]])
                ->sum('amount');

                $rows[$i]['today_pay_amount'] = $today_pay_amount;
            }

            $result = array("total" => $list->total(), "rows" => $rows);

            return json($result);
        }
        
        $today_newUser = db('user')
                    ->where('agentid','<>',0)
                    ->where(['createtime' => ['between',$beginToday . ',' . $endToday]])
                    ->count();
                // echo db('user')->getLastSql();
                // exit();
        $today_pay_amount = db('appbox_order')
                    ->where(['status'=>1,'createTime' => ['between',$beginToday . ',' . $endToday]])
                    ->sum('amount');

        $this->assign("today_newUser", $today_newUser);
        $this->assign("today_pay_amount", $today_pay_amount);
        return $this->view->fetch();
    }

    public function add()
    {
        if ($this->request->isPost()) {
            $this->token();

            

            $params = $this->request->post("row/a");
            if ($params) {
                

                // $channelInfo = $this->op->channelGet($params['channelCode']);
                // if($channelInfo->code == 0 && $channelInfo->body !=null){
                //     return $this->error("渠道已经存在");
                // }

                //先添加OP渠道
                // $channelAdd = $this->op->channelAdd($params['channelCode'],$params['username']);
                
                // if($channelAdd->code != '0'){
                //     return $this->error("渠道创建失败");
                // }

                //$params['password'] = md5($params['password']);
                $params['deduction'] = (int)$params['deduction'] / 100;
                $params['createTime'] = time();
                $result = $this->model->validate('addons\appbox\validate\Agent.add')->save($params);
                if ($result === false) {
                    return $this->error($this->model->getError());
                }else{
                    return $this->success();
                }
            }
        }
        //$nodeList = \app\admin\model\UserRule::getTreeList();
        //$this->assign("nodeList", $nodeList);
        return parent::add();
    }

    public function edit($ids = null)
    {
        if ($this->request->isPost()) {
            $this->token();
        }
        
        $row = $this->model->get($ids);
        if (!$row) {
            $this->error(__('No Results were found'));
        }

        $params = $this->request->post("row/a");
            if ($params) {

                
                //unset($params['channelCode']);
                //unset($params['username']);

                $params['deduction'] = (int)$params['deduction'] / 100;
                //$params['id'] = $row['id'];

                $result = $row->validate('addons\appbox\validate\Agent.edit')->save($params);
                if ($result === false) {
                    return $this->error($this->model->getError());
                }else{
                    return $this->success();
                }
            }

        //$this->assign("info", $row);
        $this->assign("info", $row);
        return parent::edit($ids);
    }
    
    public function stat($ids,$date=null)
    {
        if($date == null){
            $date = date('Y-m-d',strtotime(date('Y-m-d') . ' -1 week')) . ' 00:00:00 - ' . date('Y-m-d') . ' 23:59:59';
        }
        
        $daterange = $date;

        $date = explode(' - ',$date);
        $begintime = $date[0];
        $endtime = $date[1];

        
        $agentStatistics = model('addons\appbox\model\AgentStatistics');

        $this->request->filter(['strip_tags', 'trim']);
        if ($this->request->isAjax()) {
            //如果发送的来源是Selectpage，则转发到Selectpage
            if ($this->request->request('keyField')) {
                return $this->selectpage();
            }
            list($where, $sort, $order, $offset, $limit) = $this->buildparams();
            $list = $agentStatistics
                ->where(['agentId' => $ids])
                ->where('date','between time',[$begintime,$endtime])
                ->where($where)
                ->order($sort, $order)
                ->paginate($limit);

                // echo $agentStatistics->getLastSql();
                // exit();

            //二次处理
            $rows = $list->items();
            
            for($i=0;$i<count($rows);$i++){
                $begintime = $rows[$i]['date'];
                $endtime = date("Y-m-d",strtotime("+1 day",strtotime($begintime)));
                //从用户表获取统计数据
                $count = db('user')->where(['agentid'=>$ids])
                ->where('createtime','between time',[$begintime,$endtime])
                ->count();
                // echo db('user')->getLastSql();
                // exit();

                $rows[$i]['count'] = $count;
                
                //日充值
                $today_pay_amount = Db::view('fa_appbox_order','*')
                ->view('fa_user','agentId','fa_user.id=fa_appbox_order.uid')
                ->where(['agentId' => $ids,'fa_appbox_order.status'=>1])
                ->where('fa_appbox_order.createTime','between time',[$begintime,$endtime])
                ->sum('amount');
                // echo Db::view('fa_appbox_order','*')->getLastSql();
                // exit();

                $rows[$i]['today_pay_amount'] = $today_pay_amount;
            }

            $result = array("total" => $list->total(), "rows" => $rows);

            return json($result);
        }


        // $today = date("Y/m/d");
        // $totalData = $agentStatistics->getTotal($ids);
        // $todayData = $agentStatistics->getDateInfo($ids,$today);

        // //总点击率
        // $totalRatio = 0;
        // if($totalData['visit'] != 0|| $totalData['download'] != 0){
        //     $totalRatio = $totalData['download'] / $totalData['visit'];
        // }
        // $this->assign("totalRatio", $totalRatio);

        $this->assign("ids", $ids);
        $this->assign("daterange",$daterange);
        //$this->assign("totalData", $totalData);

        //$this->assign("todayData", $todayData);
        return $this->view->fetch();
    }

    public function shabi($date=null)
    {
        $liucun1=0;
        $liucun3=0;
        $liucun7=0;
        if($date == null){
            $date = date('Y-m-d');
        }
        $today = date("Y-m-d",strtotime("+0 day",strtotime($date)));
        $todaytime = strtotime($today);
        $zongliucun = 0;
        $zongliucun = db('user')
            ->where('createtime','< time',$todaytime)
            ->where('logintime','> time',$todaytime)
            ->count();
        if ($this->request->isAjax()) {
            $value1_1 = 0;
            $value1_3 = 0;
            $value1_7 = 0;
            $value2_1 = 0;
            $value2_3 = 0;
            $value2_7 = 0;
            
            

            
            for($i=0;$i<10;$i++){
                $beginToday = date("Y-m-d",strtotime("-".$i." day",strtotime($date)));
                $endToday = date("Y-m-d",strtotime("+1 day",strtotime($beginToday)));
                $begintime = strtotime($beginToday);
                $endtime = strtotime($endToday);
                $count = db('user')
                ->where('createtime','between time',[$begintime,$endtime])
                ->where('logintime','> time',$todaytime)
                ->count();
                if($i==1){
                    $value1_1 = $count;
                }else if($i==3){
                    $value1_3 = $count;
                }else if($i==7){
                    $value1_7 = $count;
                }
                $count2 = db('user')
                ->where('createtime','between time',[$begintime,$endtime])
                ->count();
                if($i==1){
                    $value2_1 = $count2;
                }else if($i==3){
                    $value2_3 = $count2;
                }else if($i==7){
                    $value2_7 = $count2;
                }
                $liucun =number_format(intval($count)/intval($count2), 4);
                $rows[$i]['time']=$beginToday;
                $rows[$i]['count']=$count;
                $rows[$i]['count2']=$count2;
                $rows[$i]['liucun']=$liucun;
            }
            if(intval($value2_1)!=0){
                $liucun1 =intval($value1_1)/intval($value2_1);
            }else{
                $liucun1 = 0;
            }
            if(intval($value2_3)!=0){
                $liucun3 =number_format(intval($value1_3)/intval($value2_3), 4);
            }else{
                $liucun3 = 0;
            }
            if(intval($value2_7)!=0){
                $liucun7 =number_format(intval($value1_7)/intval($value2_7), 4);
            }else{
                $liucun7 = 0;
            }
            $result = array("total" => "10","rows" => $rows,"todaytime"=>$todaytime,"zongliucun"=>$zongliucun);

            return json($result);
        }
        $this->assign('liucun1',$liucun1);
        $this->assign('liucun3',$liucun3);
        $this->assign('liucun7',$liucun7);
        $this->assign("date", $date);
        $this->assign("zongliucun", $zongliucun);

        return $this->view->fetch();
    }

    public function ruozhi()
    {
        $date = date('Y-m-d');
        $arrayTime = array();

        $arrayNewUserCount = array();
        $arrayOldUserCount = array();

        $arrayPreUserCount = array();
        $arrayPreNewUserCount = array();

        $arrayPreUserCount7 = array();
        $arrayPreNewUserCount7 = array();

        $arrayLiucun = array();
        $arrayLiucun7 = array();

        $totalUserCount = array();
        for($i=29;$i>=0;$i--){
            $beginToday = date("Y-m-d",strtotime("-".$i." day",strtotime($date)));
            $beginToday1 = date("Y-m-d",strtotime("-1 day",strtotime($beginToday)));
            $endToday = date("Y-m-d",strtotime("+1 day",strtotime($beginToday)));

            $beginToday7 = date("Y-m-d",strtotime("-7 day",strtotime($beginToday)));
            $beginToday6 = date("Y-m-d",strtotime("-6 day",strtotime($beginToday)));

            $begintime = strtotime($beginToday);
            $begintime1 = strtotime($beginToday1);
            $begintime7 = strtotime($beginToday7);
            $begintime6 = strtotime($beginToday6);
            $endtime = strtotime($endToday);
            //之前所有老用户登录数
            $oldUserCount = db('user')
            ->where('createtime','< time',$begintime)
            ->where('logintime','> time',$begintime)
            ->count();
            //所有老用户登录数
            $preUserCount = db('user')
            ->where('createtime','between time',[$begintime1,$begintime])
            ->where('logintime','> time',$begintime)
            ->count();

            //前一天注册用户总数
            $preNewUserCount = db('user')
            ->where('createtime','between time',[$begintime1,$begintime])
            ->count();
            //留存率
            $liucunCount = $preUserCount/$preNewUserCount;

            //七日前当天老用户登录数
            $preUserCount7 = db('user')
            ->where('createtime','between time',[$begintime7,$begintime6])
            ->where('logintime','> time',$begintime)
            ->count();
            //七日前当天注册用户总数
            $preNewUserCount7 = db('user')
            ->where('createtime','between time',[$begintime7,$begintime6])
            ->count();
            //留存率
            $liucunCount = $preUserCount/$preNewUserCount;
            $liucunCount7 = $preUserCount7/$preNewUserCount7;

            //当天新增用户总数
            $newUserCount = db('user')
            ->where('createtime','between time',[$begintime,$endtime])
            ->count();

           
            array_push($arrayTime,$beginToday);
            array_push($arrayNewUserCount,$newUserCount);
            array_push($arrayOldUserCount,$oldUserCount);

            array_push($arrayPreUserCount,$preUserCount);
            array_push($arrayPreNewUserCount,$preNewUserCount);
            array_push($arrayLiucun,$liucunCount);

            array_push($arrayPreUserCount7,$preUserCount7);
            array_push($arrayPreNewUserCount7,$preNewUserCount7);
            array_push($arrayLiucun7,$liucunCount7);

            array_push($totalUserCount,$newUserCount+$oldUserCount);
        }
        
        $this->assignconfig('arrayTime', $arrayTime);
        $this->assignconfig('arrayNewUserCount', $arrayNewUserCount);
        $this->assignconfig('arrayOldUserCount', $arrayOldUserCount);
        $this->assignconfig('arrayPreUserCount', $arrayPreUserCount);
        $this->assignconfig('arrayPreNewUserCount', $arrayPreNewUserCount);
        $this->assignconfig('arrayLiucun', $arrayLiucun);

        $this->assignconfig('arrayPreUserCount7', $arrayPreUserCount7);
        $this->assignconfig('arrayPreNewUserCount7', $arrayPreNewUserCount7);
        $this->assignconfig('arrayLiucun7', $arrayLiucun7);

        $this->assignconfig('totalUserCount', $totalUserCount);

        return $this->view->fetch();
    }
    
    //日报表
    public function daystat($date=null)
    {
        if($date == null){
            $date = date('Y-m-d');
        }

        $this->request->filter(['strip_tags', 'trim']);
        
        $beginToday=$date;
        $endToday=date("Y-m-d",strtotime("+1 day",strtotime($date)));
        
        $begintime = strtotime($beginToday);
        $endtime = strtotime($endToday);

        if ($this->request->isAjax()) {
            //如果发送的来源是Selectpage，则转发到Selectpage
            if ($this->request->request('keyField')) {
                return $this->selectpage();
            }
            list($where, $sort, $order, $offset, $limit) = $this->buildparams();
            
            // echo json_encode($where);
            // var_dump($where);
            //  exit();
            $list = $this->model
                //->where($where)
                ->where(['status' => 1])
                ->order($sort, $order)
                ->paginate($limit);

                //echo db('appbox_agent')->getLastSql();
                //exit();
            
            $rows = $list->items();

            $op = new \addons\appbox\library\Openinstall();
            $opData = $op->all_data($date,$date);
            //var_dump($opData);exit();
            
            

            for($i=0;$i<count($rows);$i++){
                //日期
                $rows[$i]['date'] = $date;

                //op数据
                $rows[$i]['op_install'] = '-';
                if($opData && isset($opData[$rows[$i]['channelCode']])){
                    $rows[$i]['op_install'] = $opData[$rows[$i]['channelCode']]['_i'];
                }
                

                //总充值
                // $total_pay_amount = Db::view('fa_appbox_order','*')
                // ->view('fa_user','agentId','fa_user.id=fa_appbox_order.uid')
                // ->where(['agentId' => $rows[$i]['id'],'fa_appbox_order.status'=>1])
                // ->sum('amount');
                // $rows[$i]['total_pay_amount'] = $total_pay_amount;

                //代理扣量后的数据
                $agentDateStat = db('appbox_agent_statistics')
                    ->where(['agentid' => $rows[$i]['id'], 'date' => $date])
                    ->find();

                if(!$agentDateStat){
                    $rows[$i]['install'] = 0;
                    $rows[$i]['installReal'] = 0;
                    $rows[$i]['hits'] = 0;
                }else{
                    $rows[$i]['install'] = $agentDateStat['install'];
                    $rows[$i]['installReal'] = $agentDateStat['installReal'];
                    $rows[$i]['hits'] = $agentDateStat['hits'];
                }

                

                
                //真实日新增

                $today_newUser = db('user')
                    ->where(['agentid' => $rows[$i]['id']])
                    ->where('createtime','between time',[$begintime,$endtime])
                    ->count();
                $rows[$i]['today_newUser'] = $today_newUser;

                // $today_newUser_only = db('user')
                //     ->where(['agentid' => $rows[$i]['id']])
                //     ->where('createtime','between time',[$beginToday,$endToday])
                //     ->group('deviceid')
                //     ->count('deviceid');
                // $rows[$i]['today_newUser_only'] = $today_newUser_only;

                //日充值
                // $today_pay_amount = Db::view('fa_appbox_order','*')
                // ->view('fa_user','agentId','fa_user.id=fa_appbox_order.uid')
                // ->where(['agentId' => $rows[$i]['id'],'fa_appbox_order.status'=>1])
                // ->where('fa_appbox_order.createTime','between time',[$begintime,$endtime])
                // ->sum('amount');

                if($rows[$i]['id'] == 1){
                    $today_pay_amount = Db::view('fa_appbox_order','*')
                    ->view('fa_user','agentId','fa_user.id=fa_appbox_order.uid')
                    ->where('agentId','in',[0,1])
                    ->where(['fa_appbox_order.status'=>1])
                    ->where('fa_appbox_order.createTime','between time',[$begintime,$endtime])
                    ->sum('amount');
                }else{
                    $today_pay_amount = Db::view('fa_appbox_order','*')
                    ->view('fa_user','agentId','fa_user.id=fa_appbox_order.uid')
                    ->where(['agentId' => $rows[$i]['id'],'fa_appbox_order.status'=>1])
                    ->where('fa_appbox_order.createTime','between time',[$begintime,$endtime])
                    ->sum('amount');
                }

                
                
                // $today_pay_amount = Db::view('fa_appbox_order','*')
                // ->view('fa_user','agentId','fa_user.id=fa_appbox_order.uid')
                // ->where(['agentId' => $rows[$i]['id'],'fa_appbox_order.status'=>1,'fa_appbox_order.createTime' => ['between',$beginToday . ',' . $endToday]])
                // ->sum('amount');

                //$agentStatistics

                $rows[$i]['today_pay_amount'] = $today_pay_amount;
            }
            
            $today_newUser = db('user')
                ->where('createtime','between time',[$begintime,$endtime])
                ->count();
                
            $today_pay_amount = db('appbox_order')
                    ->where(['status'=>1])
                    ->where('createtime','between time',[$begintime,$endtime])
                    ->sum('amount');

            $result = array("total" => $list->total(), "rows" => $rows,'today_newUser' => $today_newUser,'today_pay_amount' => $today_pay_amount);

            

            return json($result);
        }

        // $today_newUser = db('user')
        //             ->where(['createtime' => ['between',$beginToday . ',' . $endToday]])
        //             ->count();
        // $today_pay_amount = db('appbox_order')
        //             ->where(['status'=>1,'createTime' => ['between',$beginToday . ',' . $endToday]])
        //             ->sum('amount');

        //$this->assign("today_newUser", $today_newUser);
        //$this->assign("today_pay_amount", $today_pay_amount);

        $this->assign("date", $date);
        return $this->view->fetch();
    }
}