<?php

namespace app\admin\controller\appbox;

use app\common\controller\Backend;
use addons\appbox\model\UserVip;

class Task extends Backend
{
    public function _initialize()
    {
        parent::_initialize();
        $this->model = model('addons\appbox\model\Task');
    }

    public function index()
    {
        if ($this->request->isAjax()) {
            $list = db('appbox_task_list')
                ->order('sort desc')
                ->select();

            

            $result = array("total" => count($list), "rows" => $list);

            return json($result);
        }

        //$this->view->assign("list",$list);
        return $this->view->fetch();
    }

    public function examine()
    {
        //设置过滤方法
        $this->request->filter(['strip_tags', 'trim']);
        if ($this->request->isAjax()) {
            //如果发送的来源是Selectpage，则转发到Selectpage
            if ($this->request->request('keyField')) {
                return $this->selectpage();
            }
            list($where, $sort, $order, $offset, $limit) = $this->buildparams();

            

            $list = db('appbox_task_submit')
                ->alias('a')
                ->join('appbox_task_list b','a.taskId=b.id','LEFT')
                ->field('a.*,b.icon,b.title,b.rewardDuration')
                ->where($where)
                ->order($sort, $order)
                ->paginate($limit);
            $result = array("total" => $list->total(), "rows" => $list->items());

            return json($result);
        }
        return $this->view->fetch();
    }

    public function setStatus($ids = null,$status)
    {
        if(!in_array($status,[0,1,2])){
            return $this->error('状态错误');
        }

        $info = db('appbox_task_submit')->where('id','=',$ids)->find();
        if(!$info){
            return $this->error('数据不存在');
        }

        $taskinfo = db('appbox_task_list')->where('id','=',$info['taskId'])->find();
        if(!$taskinfo){
            return $this->error('任务不存在');
        }

        if($status == $info['status']){
            $this->success('设置成功');
        }

        db('appbox_task_submit')->where('id','=',$ids)->update([
            'status' => $status
        ]);

        if($status == 1){
            $userVip = new UserVip();
            $userVip->renew($info['uid'],$taskinfo['rewardDuration']);

            $userVip->vipLog($info['uid'], $taskinfo['rewardDuration'], '完成任务奖励VIP', $this->auth->username);
        }

        $this->success('设置成功');
    }

    // public function add()
    // {

    // }
}