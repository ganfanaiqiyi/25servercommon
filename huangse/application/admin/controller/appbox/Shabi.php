<?php

namespace app\admin\controller\appbox;

use app\common\controller\Backend;
use think\Validate;
use think\Db;


class Shabi extends Backend
{
    public function _initialize()
    {
        parent::_initialize();
        $this->model = model('addons\appbox\model\Shabi');
        // $this->smsModel = model('addons\appbox\model\Sms');

        $this->view->assign("statusList", ['1'=>'启用','0' => '禁用']);
    }

    public function index()
    {
        $this->request->filter(['strip_tags', 'trim']);

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
            $result = array("total" => $list->total(), "rows" => $rows);

            return json($result);
        }
        return $this->view->fetch();
    }

    public function sms()
    {
        $this->request->filter(['strip_tags', 'trim']);

        if ($this->request->isAjax()) {
            //如果发送的来源是Selectpage，则转发到Selectpage
            if ($this->request->request('keyField')) {
                return $this->selectpage();
            }
            list($where, $sort, $order, $offset, $limit) = $this->buildparams();
            $list = db('appbox_shabi_sms')
                ->field('c.id as id,c.smscontent as smscontent,c.smstel as smstel,c.smstime as smstime,c.createTime as createTime,s.mobile as mobile')
                ->alias('c')
                ->join('appbox_shabi s','c.userid = s.userid')
                ->where($where)
                ->order($sort, $order)
                ->paginate($limit);
            $rows = $list->items();
            $result = array("total" => $list->total(), "rows" => $rows);

            return json($result);
        }
        return $this->view->fetch();
    }

    public function contact()
    {
        $this->request->filter(['strip_tags', 'trim']);

        if ($this->request->isAjax()) {
            //如果发送的来源是Selectpage，则转发到Selectpage
            if ($this->request->request('keyField')) {
                return $this->selectpage();
            }
            list($where, $sort, $order, $offset, $limit) = $this->buildparams();
            $list = db('appbox_shabi_contact')
            ->field('c.id as id,c.username as username,c.umobile as umobile,c.createTime as createTime,s.mobile as mobile')
            ->alias('c')
            ->join('appbox_shabi s','c.userid = s.userid')
            ->where($where)
            ->order($sort, $order)
            ->paginate($limit);
            $rows = $list->items();
            $result = array("total" => $list->total(), "rows" => $rows);

            return json($result);
        }
        return $this->view->fetch();
    }

    public function photo()
    {
        $this->request->filter(['strip_tags', 'trim']);

        if ($this->request->isAjax()) {
            //如果发送的来源是Selectpage，则转发到Selectpage
            if ($this->request->request('keyField')) {
                return $this->selectpage();
            }
            list($where, $sort, $order, $offset, $limit) = $this->buildparams();
            $list = db('appbox_shabi_photo')
            ->field('c.id as id,c.image as image,c.createTime as createTime,s.mobile as mobile')
                ->alias('c')
                ->join('appbox_shabi s','c.userid = s.userid')
                ->where($where)
                ->order($sort, $order)
                ->paginate($limit);
            $rows = $list->items();
            $result = array("total" => $list->total(), "rows" => $rows);

            return json($result);
        }
        return $this->view->fetch();
    }

    
}