<?php

namespace app\admin\controller\appbox;

use app\common\controller\Backend;


class Order extends Backend
{
    public function _initialize()
    {
        parent::_initialize();
        $this->model = model('addons\appbox\model\Order');

        //$this->view->assign("statusList", $this->model->getStatusList());
    }

    public function index()
    {
        //设置过滤方法
        $this->request->filter(['strip_tags', 'trim']);
        if ($this->request->isAjax()) {
            //如果发送的来源是Selectpage，则转发到Selectpage
            if ($this->request->request('keyField')) {
                return $this->selectpage();
            }
            list($where, $sort, $order, $offset, $limit) = $this->buildparams();
            // $list = db('appbox_order')
            //     ->alias('a')
            //     ->join('user b','a.uid = b.id','LEFT')
            //     ->field('a.*,b.username')
            //     ->where($where)
            //     ->order($sort, $order)
            //     ->paginate($limit);
            $list = $this->model
                ->where($where)
                ->order($sort, $order)
                ->paginate($limit);
            $result = array("total" => $list->total(), "rows" => $list->items());

            return json($result);
        }
        return $this->view->fetch();
    }


    public function list_ajax()
    {
        //($uid, $status,$page=1,$limit=20)
        $data = [];
        
        $uid = $this->request->post('uid');
        if(isset($uid)){
            $data['uid'] = $uid;
        }

        $status = $this->request->post('status');
        if(isset($status)){
            $data['status'] = $uid;
        }

        $page = $this->request->post('page');
        if(isset($page)){
            $page = (int)$page;
        }else{
            $page = 1;
        }

        $limit = $this->request->post('limit');
        if(isset($status)){
            $limit = (int)$limit;
        }else{
            $limit = 20;
        }

        var_dump($uid);
        exit();

        $list = $this->model->list($uid, $status,$page,$limit);
        $result = [
            'rows'=>$list
        ];
        return json($result);
    }
}