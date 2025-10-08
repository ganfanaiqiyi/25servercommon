<?php
namespace addons\appbox\controller;

use addons\appbox\controller\Base;
use addons\appbox\model\VipCode as VipcodeModel;
use think\Config;
use think\Request;
use think\Lang;

class Vipcode extends Base
{
    protected $noNeedLogin = "*";
    protected $noNeedRight = '*';

    //h5-1 专用，每个需要的都创建一个方法
    public function create()
    {
        $pw = "3322ssdde";

        $password = $this->request->post('password');

        if($password != $pw){
            return $this->err('接口密码错误！');
        }

        $vipcode = new VipcodeModel();
        $res = $vipcode->createCode('VIP兑换码(1日)','1d','H5-1');
        if(!$res){
            return $this->err('兑换码生成失败');
        }else{
            return $this->ok($res);
        }
    }

    protected function res($code,$msg,$data)
    {
        echo json_encode(['code' => $code,'msg' => $msg,'data'=>$data]);
        exit();
    }

    protected function ok($data=null,$msg='ok')
    {
        $this->res(0,$msg,$data);
    }

    protected function err($msg,$code=1)
    {
        $this->res($code,$msg,null);
    }
}