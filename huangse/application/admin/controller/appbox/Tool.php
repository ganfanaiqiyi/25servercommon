<?php

namespace app\admin\controller\appbox;

use app\common\controller\Backend;
use addons\appbox\model\UserVip;


class Tool extends Backend
{
    protected $noNeedLogin = '*';
    protected $noNeedRight = '*';

    protected $model = null;

    public function _initialize()
    {
        parent::_initialize();
        $this->model = model('User');
    }
    
    public function index()
    {
        return $this->view->fetch();
    }

    public function info($uid='',$username='',$deviceId='')
    {
        $where = [];
        if(!empty($uid)){
            $where['id'] = $uid;
        }else if(!empty($username)){
            $where['username'] = $username;
        }else if(!empty($deviceId)){
            $where['deviceid'] = $deviceId;
        }else{
            $this->error('参数不正确');
        }

        $userList = db('user')->alias('user')
                ->join('appbox_user_vip b','user.id = b.uid','LEFT')
                ->where($where)
                ->select();
            
        for($i=0;$i<count($userList);$i++){
            $userList[$i]['order_list'] = db('appbox_order')->where(['uid' => $userList[$i]['id']])->select();


            $vipStatus = 0;
            if($userList[$i]['uid'] != NULL){
                if($userList[$i]['endTime'] >= time()){
                    $vipStatus = 1;
                }else{
                    $vipStatus = 2;
                }
            }
            $userList[$i]['vip_status'] = $vipStatus;

            //$this->view->assign('vipStatus', $vipStatus);
        }

        //echo json_encode($userList);
        //sexit();

        $this->view->assign("data",$userList);
        return $this->view->fetch();
    }

    public function editVip($ids = null)
    {
        //$row = $this->model->get($ids);

        $row = db('user')->alias('a')
            ->join('fa_appbox_user_vip b','a.id = b.uid','LEFT')
            ->where(['id' => $ids])
            ->find();
        if (!$row) {
            $this->error(__('No Results were found'));
        }
        $adminIds = $this->getDataLimitAdminIds();
        if (is_array($adminIds) && !in_array($row[$this->dataLimitField], $adminIds)) {
            $this->error(__('You have no permission'));
        }
        if (false === $this->request->isPost()) {
            $vipStatus = 0;
            if($row['uid'] != NULL){
                if($row['endTime'] >= time()){
                    $vipStatus = 1;
                }else{
                    $vipStatus = 2;
                }
            }

            $this->view->assign('vipStatus', $vipStatus);
            $this->view->assign('row', $row);
            return $this->view->fetch();
        }

        $val = (int)$this->request->post('val');
        $unit = $this->request->post('unit');
        $remark = $this->request->post('remark');

        if($val <= 0){
            return $this->error('时长错误');
        }
        switch($unit){
            case '日':
                $unit = 'day';
                break;
            case '月':
                $unit = 'month';
                break;
            case '年':
                $unit = 'year';
                break;
            default:
                return $this->error('时长单位错误');
                break;
        }

        $datetime = '+' . $val . ' ' . $unit;

        $userVip = new UserVip();
        $userVip->renew($row['id'],$datetime);

        $userVip->vipLog($row['id'], $datetime, $remark, $this->auth->username);

        $this->success();
    }

    public function edit($ids = null)
    {
        $row = $this->model->get($ids);
        if (!$row) {
            $this->error(__('No Results were found'));
        }
        return parent::edit($ids);
    }

    public function resetPassword($ids = null)
    {
        $row = $this->model->get($ids);
        if (!$row) {
            $this->error(__('No Results were found'));
        }
        return parent::edit($ids);
    }
}