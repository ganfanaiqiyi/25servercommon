<?php

namespace app\admin\controller\appbox;

use app\common\controller\Backend;


class Crackapps extends Backend
{
    public function _initialize()
    {
        parent::_initialize();
        $this->model = model('addons\appbox\model\CrackApps');
        $this->view->assign("statusList", $this->model->getStatusList());
    }

    public function index()
    {
        if ($this->request->isAjax()) {
            $list = db('appbox_crack_apps')
                ->order('sort desc')
                ->select();

            $result = array("total" => count($list), "rows" => $list);

            return json($result);
        }
        
        return $this->view->fetch();
    }

    public function add()
    {
        if ($this->request->isPost()) {
            $this->token();
        }
        $nodeList = \app\admin\model\UserRule::getTreeList();
        $this->assign("nodeList", $nodeList);
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
        //$this->assign("info", $row);
        return parent::edit($ids);
    }

    public function list_ajax()
    {
        $list = $this->model->listData();
        $result = [
            'rows'=>$list
        ];
        return json($result);
    }
}