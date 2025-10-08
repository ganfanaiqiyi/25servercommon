<?php

namespace app\admin\controller\appbox;

use app\common\controller\Backend;


class Ads extends Backend
{
    protected $relationSearch = true;
    public function _initialize()
    {
        parent::_initialize();
        $this->model = model('addons\appbox\model\Ads');
        $this->assignconfig("AdPosition", $this->model->getAdPosition());
    }
    public function index()
    {
        if ($this->request->isAjax()) {
            list($where, $sort, $order, $offset, $limit) = $this->buildparams();
//            print_r($where);die;

            $list = db('appbox_ad_list')->alias('ads')
                ->join('fa_appbox_ad_position b','ads.positionId=b.id','LEFT')
                ->field('b.name,ads.*')
                ->where($where)
                ->order('b.sort desc,b.id,ads.sort desc')
                ->select();
            //echo db('appbox_ad_list')->getLastSql();
            //exit();

            $todayDate = date("Y-m-d");
            $yesterday = date("Y-m-d", strtotime(date("Y-m-d"))-86400);

            $lastCate = '';
            for($i=0;$i<count($list);$i++){
                //这里控制前端分类只显示第一条
                if($list[$i]['name'] == $lastCate){
                    $list[$i]['name'] = '';
                }else{
                    $lastCate = $list[$i]['name'];
                }

                //统计今日点击数
                $todayCount = db('appbox_ad_hit_statistics')->where([
                    'adId' => $list[$i]['id'],
                    'createDate' => $todayDate
                ])->sum('hits');
                $list[$i]['todayHits'] =  $todayCount;

                //统计昨日点击数
                $yesterdayCount = db('appbox_ad_hit_statistics')->where([
                    'adId' => $list[$i]['id'],
                    'createDate' => $yesterday
                ])->sum('hits');
                $list[$i]['yesterdayHits'] =  $yesterdayCount;
            }

            $result = array("total" => count($list), "rows" => $list);

            return json($result);
        }

        //$this->view->assign("list",$list);
        return $this->view->fetch();
    }

    public function add()
    {
        // if ($this->request->isPost()) {
        //     $this->token();



        //     $params = $this->request->post("row/a");
        //     if ($params) {

        //         // $positionId = $params['positionId'];
        //         // $pInfo = db('appbox_ad_position')->where(['id' => $positionId])->find();
        //         // if($pInfo['type'] == 'single'){
        //         //     $info = db('appbox_ad_list')->where(['positionId' => $positionId])->find();
        //         //     if($info){
        //         //         return $this->error('此广告位只允许一个广告');
        //         //     }
        //         // }

                
                
        //         $result = db('appbox_ad_list')->insert($params);
        //         if ($result === false) {
        //             return $this->error($this->model->getError());
        //         }else{
        //             return $this->success();
        //         }
        //     }
        // }

        //广告位
        $ad_position_list = db('appbox_ad_position')->order('sort desc')->select();
        $kv = [];
        foreach ($ad_position_list as $v) {
            $kv[$v['id']] = $v['name'];
        }

        $this->assign("ad_position_list", $kv);

        return parent::add();
    }

    public function change($ids){
        if ($this->request->isAjax()) {
            if (isset($_POST['newUrl']) && !empty($_POST['newUrl'])) {
                $res = db('appbox_ad_list')->where('url',$_POST['oldUrl'])
                    ->update(['url'=>$_POST['newUrl']]);
                $this->success('修改成功，共'.$res.'个');
            } else {
                return $this->success('新链接不能为空！');
            }
        } 
        
		  $list = db('appbox_ad_list')->where('id',$ids)
                ->find();
           $this->assign("row",$list);
          return $this->view->fetch();
    }

    public function changeicon($ids){
        if ($this->request->isAjax()) {
            if (isset($_POST['newUrl']) && !empty($_POST['newUrl'])) {
                $res = db('appbox_ad_list')->where('image',$_POST['oldUrl'])
                    ->update(['image'=>$_POST['newUrl']]);
                $this->success('修改成功，共'.$res.'个');
            } else {
                return $this->success('新图标不能为空！');
            }
        } 
        
		  $list = db('appbox_ad_list')->where('id',$ids)
                ->find();
           $this->assign("row",$list);
          return $this->view->fetch();
    }

    public function enableAll($ids){
         $list = db('appbox_ad_list')->where('id',$ids)
                ->find();
        $res = db('appbox_ad_list')->where('url',$list['url'])
               ->update(['status'=>'normal']);
        $this->success('修改成功，共'.$res.'个');
    }

    public function disableAll($ids){
         $list = db('appbox_ad_list')->where('id',$ids)
                ->find();
        $res = db('appbox_ad_list')->where('url',$list['url'])
                ->update(['status'=>'hidden']);
        $this->success('修改成功，共'.$res.'个');
    }

    // public function add()
    // {
    //     if ($this->request->isPost()) {
    //         $this->token();

    //         $params = $this->request->post("row/a");
    //         if ($params) {
                

                
    //             $result = db('appbox_ad_list')->insert($params);
    //             if ($result === false) {
    //                 return $this->error($this->model->getError());
    //             }else{
    //                 return $this->success();
    //             }
    //         }
    //     }
        
    //     $ad_position_list = db('appbox_ad_position')->order('sort desc')->select();
    //     $kv = [];
    //     foreach ($ad_position_list as $v) {
    //         $kv[$v['id']] = $v['name'];
    //     }

    //     $this->assign("ad_position_list", $kv);
    //     return parent::add();
    // }

    public function removeCache()
    {
        cache('ad_config',NULL);
        $this->success('ok');
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