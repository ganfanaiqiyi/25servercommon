<?php

namespace app\admin\controller\appbox;

use app\common\controller\Backend;


class Tongji extends Backend
{
    protected $noNeedLogin = '*';
    protected $noNeedRight = '*';

    protected $model = null;

    public function _initialize()
    {
        parent::_initialize();
        $this->model = model('User');
    }
    
    public function index($date=null)
    {
        $liucun1=0;
        $liucun3=0;
        $liucun7=0;
        if($date == null){
            $date = date('Y-m-d');
        }
        if ($this->request->isAjax()) {
            $value1_1 = 0;
            $value1_3 = 0;
            $value1_7 = 0;
            $value2_1 = 0;
            $value2_3 = 0;
            $value2_7 = 0;

            

            $today = date("Y-m-d",strtotime("+0 day",strtotime($date)));
            $today2 = date("Y-m-d",strtotime("+1 day",strtotime($date)));
            $todaytime = strtotime($today);
            $todaytime2 = strtotime($today2);
            for($i=0;$i<8;$i++){
                $beginToday = date("Y-m-d",strtotime("-".$i." day",strtotime($date)));
                $endToday = date("Y-m-d",strtotime("+1 day",strtotime($beginToday)));
                $begintime = strtotime($beginToday);
                $endtime = strtotime($endToday);
                $count = $this->model
                ->where('createtime','between time',[$begintime,$endtime])
                ->where('logintime','between time',[$todaytime,$todaytime2])
                ->count();
                if($i==1){
                    $value1_1 = $count;
                }else if($i==3){
                    $value1_3 = $count;
                }else if($i==7){
                    $value1_7 = $count;
                }
                $count2 = $this->model
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
            $result = array("total" => $rows->total(),"rows" => $rows);
            return json($result);
        }
        $this->assign('liucun1',$liucun1);
        $this->assign('liucun3',$liucun3);
        $this->assign('liucun7',$liucun7);
        $this->assign("date", $date);
        return $this->view->fetch();
    }
}