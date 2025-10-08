<?php

namespace addons\appbox\controller;

use addons\appbox\controller\Base;
use addons\appbox\library\pipes\Anxin;
use addons\appbox\library\pipes\Dazhou;
use addons\appbox\library\pipes\Dingdang;
use addons\appbox\library\pipes\Shangyun2;
use addons\appbox\model\Order as OrderModel;
use addons\appbox\model\Goods as GoodsModel;
use addons\appbox\model\User;
use addons\appbox\model\UserVip;
use think\Config;
use think\Request;
use think\Lang;

class Order extends Base
{
    protected $noNeedLogin = ['callback','callback2','gx_notify','tianshi_notify','nn_notify','mn_notify','dahe_notify','mayi_notify','shangshun_notify','xianyu_notify','dinghui_notify','kuaigou_notify','kuaigou2_notify','kuaigou3_notify','xinghui_notify','dajiafa_notify','dajiafa2_notify','lanbo_notify','shiguang_notify','yinyi_notify','dawangcai_notify','wangcai_notify','wangcai2_notify','epay_notify','qiansong_notify','yk_notify','lvxiaoer_notify','mayun_notify',"chuangdong_notify",
                                "anxin_notify","shangyun2_notify","dingdang_notify","dazhou_notify","guagua_notify"
                            ];
    protected $noNeedRight = '*';

    protected $config = [];

    public function __construct()
    {
        Lang::load(APPBOX_ADDONS_PATH . "lang/zh-cn.php");

        $this->config = config('appConfig');

        parent::__construct();
    }

    //0失败 1支付成功（金币支付可直接成功）2创建支付订单成功，返回跳转url
    public function create()
    {
        $blacks = [3933817,3934036];
        if(in_array($this->auth->id,$blacks)){
            return $this->error('创建订单失败！');
        }
        //if($this->auth->id == 24933){
            //$this->create4();
            //return;
        //     exit();
        //}

        //if($this->auth->id == ){
            $this->create3();
            return;
        //     exit();
        // }

        $goodsId = $this->getParam('goodsId');
        $pipeName = $this->getParam('pipeName');

        if ($goodsId == "") {
            return $this->error('商品id不能为空！');
        }

        // var_dump($pipeName);
        // exit();

        $goods = $this->config['goods'];
        $goodsInfo = null;
        foreach ($goods as $v) {
            if ($goodsId == $v['id']) {
                $goodsInfo = $v;
                break;
            }
        }
        if ($goodsInfo == null) {
            return $this->error('商品不存在！');
        }

        $pipes = explode(',', $goodsInfo['pipes']);
        if (!in_array($pipeName, $pipes)) {
            return $this->error('此商品不支持选择的支付方式');
        }

        //判断是否金币支付，金币兑换VIP，不需要创建订单
        if ($goodsInfo['unit'] == 'score') {
            //金币购买vip 直接扣金币和加VIP过期时长
            if ($goodsInfo['type'] == 'vip') {
                $userInfo = $this->auth->getUserinfo();
                if($userInfo['score']<$goodsInfo['price']){
                    return $this->error('您金币余额不足');
                }

                //扣积分
                \app\common\model\User::score(-$goodsInfo['price'], $this->auth->id, '金币购买VIP。');

                //加会员时长
                $userVip =  new \addons\appbox\model\UserVip();
                $userVip->renew($this->auth->id, $goodsInfo['value']);

                return $this->success('购买成功', null);
            }
            
            //暂无其它金币购买的商品，如果会到这里就是配置错误
            return $this->error('有问题的商品信息');
        }

        $pipe = Model('addons\appbox\model\Pipe')->infoData($pipeName,$this->config['pipes']);
        if (!$pipe) {
            return $this->error('支付方式不存在');
        }

        $order = new OrderModel();
        $orderInfo = $order->where(['uid' => $this->auth->id])->order('createTime','desc')->find();
        if($orderInfo){
            $span = time() - $orderInfo['createTime'];
            if($span < 10){
                return $this->error((60-$span) . '秒后重试');
            }
        }


        //两次提交需要间隔一分钟


        //创建一个新订单
        
        $orderId = $order->createOrder($this->auth->id, $goodsInfo['id'], '购买会员', $goodsInfo['price'], $pipeName);
        $orderInfo = $order->get(['id' => $orderId]);

        //支付接口
        $nihong =  model('addons\\appbox\\library\\pipes\\Nihong');
        $res = $nihong->createOrder($this->auth->id,$orderId,$goodsInfo['price'],$pipe['params']['payTypeId']);
        if($res['code'] == 0){
            $result = [
                'orderId'=>$orderId,
                'payUrl' => $res['data']
            ];

            return $this->success('ok', $result ,2);
            //return $this->success('ok', $res['data'] ,2);
        }else{
            return $this->error($res['msg']);
        }


        //\think\Loader::import('addons\\appbox\\library\\pipes\\' . $pipe['class_name']);

        //$pipeHandler = model('addons\\appbox\\library\\pipes\\' . $pipe['class_name']);
        // $pipeHandler = model('addons\\appbox\\library\\pipes\\' . $pipe['class_name']);
        // $res = $pipeHandler->bulidUrl($orderInfo);
        // if(!$res){
        //     return $this->error($pipeHandler->getError());
        // }
        // return $this->success('ok', $res ,2);
    }

    public function create2()
    {
        $goodsId = $this->getParam('goodsId');
        $pipeName = $this->getParam('pipeName');

        if ($goodsId == "") {
            return $this->error('商品id不能为空！');
        }

        // var_dump($pipeName);
        // exit();

        $goods = $this->config['goods'];
        $goodsInfo = null;
        foreach ($goods as $v) {
            if ($goodsId == $v['id']) {
                $goodsInfo = $v;
                break;
            }
        }
        if ($goodsInfo == null) {
            return $this->error('商品不存在！');
        }

        $pipes = explode(',', $goodsInfo['pipes']);
        if (!in_array($pipeName, $pipes)) {
            return $this->error('此商品不支持选择的支付方式');
        }

        //判断是否金币支付，金币兑换VIP，不需要创建订单
        if ($goodsInfo['unit'] == 'score') {
            //金币购买vip 直接扣金币和加VIP过期时长
            if ($goodsInfo['type'] == 'vip') {
                $userInfo = $this->auth->getUserinfo();
                if($userInfo['score']<$goodsInfo['price']){
                    return $this->error('您金币余额不足');
                }

                //扣积分
                \app\common\model\User::score(-$goodsInfo['price'], $this->auth->id, '金币购买VIP。');

                //加会员时长
                $userVip =  new \addons\appbox\model\UserVip();
                $userVip->renew($this->auth->id, $goodsInfo['value']);

                return $this->success('购买成功', null);
            }
            
            //暂无其它金币购买的商品，如果会到这里就是配置错误
            return $this->error('有问题的商品信息');
        }

        $pipe = Model('addons\appbox\model\Pipe')->infoData($pipeName,$this->config['pipes']);
        if (!$pipe) {
            return $this->error('支付方式不存在');
        }

        $order = new OrderModel();
        $orderInfo = $order->where(['uid' => $this->auth->id])->order('createTime','desc')->find();
        if($orderInfo){
            $span = time() - $orderInfo['createTime'];
            if($span < 60){
                return $this->error((60-$span) . '秒后重试');
            }
        }


        //两次提交需要间隔一分钟


        //创建一个新订单
        
        $orderId = $order->createOrder($this->auth->id, $goodsInfo['id'], '购买会员', $goodsInfo['price'], $pipeName);
        $orderInfo = $order->get(['id' => $orderId]);

        //支付接口
        $star =  model('addons\\appbox\\library\\pipes\\Star');
        $res = $star->createOrder($this->auth->id,$orderId,$goodsInfo['price'],$pipe['params']['payTypeId']);
        if($res['code'] == 0){
            $result = [
                'orderId'=>$orderId,
                'payUrl' => $res['data']
            ];

            return $this->success('ok', $result ,2);
            //return $this->success('ok', $res['data'] ,2);
        }else{
            return $this->error($res['msg']);
        }


        //\think\Loader::import('addons\\appbox\\library\\pipes\\' . $pipe['class_name']);

        //$pipeHandler = model('addons\\appbox\\library\\pipes\\' . $pipe['class_name']);
        // $pipeHandler = model('addons\\appbox\\library\\pipes\\' . $pipe['class_name']);
        // $res = $pipeHandler->bulidUrl($orderInfo);
        // if(!$res){
        //     return $this->error($pipeHandler->getError());
        // }
        // return $this->success('ok', $res ,2);
    }

    public function create3()
    {
        $goodsId = $this->getParam('goodsId');
        $pipeName = $this->getParam('pipeName');

        if ($goodsId == "") {
            return $this->error('商品id不能为空！');
        }

        // var_dump($pipeName);
        // exit();

        $goods = $this->config['goods'];
        $goodsInfo = null;
        foreach ($goods as $v) {
            if ($goodsId == $v['id']) {
                $goodsInfo = $v;
                break;
            }
        }
        if ($goodsInfo == null) {
            return $this->error('商品不存在！');
        }

        $pipes = explode(',', $goodsInfo['pipes']);
        if (!in_array($pipeName, $pipes)) {
            return $this->error('此商品不支持选择的支付方式');
        }

        //金币通道
        if($pipeName == 'score'){
            return $this->buyVip4Score($goodsInfo);
        }

        // //判断是否金币支付，金币兑换VIP，不需要创建订单
        // if ($goodsInfo['unit'] == 'score') {
        //     //金币购买vip 直接扣金币和加VIP过期时长
        //     if ($goodsInfo['type'] == 'vip') {
        //         $userInfo = $this->auth->getUserinfo();
        //         if($userInfo['score']<$goodsInfo['price']){
        //             return $this->error('您金币余额不足');
        //         }

        //         //扣积分
        //         \app\common\model\User::score(-$goodsInfo['price'], $this->auth->id, '金币购买VIP。');

        //         //加会员时长
        //         $userVip =  new \addons\appbox\model\UserVip();
        //         $userVip->renew($this->auth->id, $goodsInfo['value']);

        //         return $this->success('购买成功', null);
        //     }
            
        //     //暂无其它金币购买的商品，如果会到这里就是配置错误
        //     return $this->error('有问题的商品信息');
        // }

        $pipe = Model('addons\appbox\model\Pipe')->infoData($pipeName,$this->config['pipes']);
        if (!$pipe) {
            return $this->error('支付方式不存在');
        }

        $order = new OrderModel();
        $orderInfo = $order->where(['uid' => $this->auth->id])->order('createTime','desc')->find();
        
        //两次提交需要间隔一分钟
        // if($orderInfo){
        //     $span = time() - $orderInfo['createTime'];
        //     if($span < 60){
        //         return $this->error((60-$span) . '秒后重试');
        //     }
        // }


        


        //创建一个新订单
        $desc = '购买会员';
        if($goodsInfo['type'] == 'score'){
            $desc = '购买金币';
        }
        
        $orderId = $order->createOrder($this->auth->id, $goodsInfo['id'], $desc, $goodsInfo['price'], $pipeName);
        $orderInfo = $order->get(['id' => $orderId]);

        switch($pipeName){
            case 'qiansong_wechat':
            case 'qiansong_alipay':
                $star =  model('addons\\appbox\\library\\pipes\\Qiansong');
                $res = $star->createOrder($this->auth->id,$orderId,$goodsInfo['price'],$pipe['params']['payTypeId']);
                break;
            case 'lvxiaoer_alipay':
                $star =  model('addons\\appbox\\library\\pipes\\Lvxiaoer');
                $res = $star->createOrder($this->auth->id,$orderId,$goodsInfo['price'],$pipe['params']['payTypeId']);
                break;
            case 'mayun_alipay':
            case 'mayun_wechat':
                $star =  model('addons\\appbox\\library\\pipes\\Mayun');
                $res = $star->createOrder($this->auth->id,$orderId,$goodsInfo['price'],$pipe['params']['payTypeId']);
                break;
            case 'yk_alipay':
                $star =  model('addons\\appbox\\library\\pipes\\YkPay');
                $res = $star->createOrder($this->auth->id,$orderId,$goodsInfo['price'],$pipe['params']['payTypeId']);
                break;
            case 'nihong_alipay':
            case 'nihong_alipayH5':
            case 'nihong_wechat':
            case 'nihong_wechatH5':
                $star =  model('addons\\appbox\\library\\pipes\\Nihong');
                $res = $star->createOrder($this->auth->id,$orderId,$goodsInfo['price'],$pipe['params']['payTypeId']);
                break;
            case 'star_alipayH5':
            case 'star_wechat':
                $star =  model('addons\\appbox\\library\\pipes\\Star');
                $res = $star->createOrder($this->auth->id,$orderId,$goodsInfo['price'],$pipe['params']['payTypeId']);
                break;
            case 'gx_alipay':
            case 'gx_wechat':
                $gexing =  model('addons\\appbox\\library\\pipes\\Gexing');
                $res = $gexing->createOrder($this->auth->id,$orderId,$goodsInfo['price'],$pipe['params']['payTypeId']);
                break;
            case 'nn_alipay':
            case 'nn_wechat':
                    $noname =  model('addons\\appbox\\library\\pipes\\Noname');
                    $res = $noname->createOrder($this->auth->id,$orderId,$goodsInfo['price'],$pipe['params']['payTypeId']);
                    break;
            case 'mn_alipay':
            case 'mn_wechat':
                $noname =  model('addons\\appbox\\library\\pipes\\Mengnan');
                $res = $noname->createOrder($this->auth->id,$orderId,$goodsInfo['price'],$pipe['params']['payTypeId']);
                break;
            case 'dahe_alipay':
            case 'dahe_wechat':
                $noname =  model('addons\\appbox\\library\\pipes\\Dahe');
                $res = $noname->createOrder($this->auth->id,$orderId,$goodsInfo['price'],$pipe['params']['payTypeId']);
                break;
            case 'mayi_alipay':
            case 'mayi_wechat':
            case 'mayi_wechat2':
                $noname =  model('addons\\appbox\\library\\pipes\\Mayi');
                $res = $noname->createOrder($this->auth->id,$orderId,$goodsInfo['price'],$pipe['params']['payTypeId']);
                break;
            case 'shangshun_alipay':
            case 'shangshun_wechat':
                    $noname =  model('addons\\appbox\\library\\pipes\\Shangshun');
                    $res = $noname->createOrder($this->auth->id,$orderId,$goodsInfo['price'],$pipe['params']['payTypeId']);
                    break;
            case 'xianyu_alipay':
            case 'xianyu_wechat':
                $noname =  model('addons\\appbox\\library\\pipes\\Xianyu');
                $res = $noname->createOrder($this->auth->id,$orderId,$goodsInfo['price'],$pipe['params']['payTypeId']);
                break;
            case 'dinghui_alipay':
            case 'dinghui_wechat':
                $noname =  model('addons\\appbox\\library\\pipes\\Dinghui');
                $res = $noname->createOrder($this->auth->id,$orderId,$goodsInfo['price'],$pipe['params']['payTypeId']);
                break;
            case 'kuaigou_alipay':
            case 'kuaigou_wechat':
                $noname =  model('addons\\appbox\\library\\pipes\\Kuaigou');
                $res = $noname->createOrder($this->auth->id,$orderId,$goodsInfo['price'],$pipe['params']['payTypeId']);
                break;
            case 'kuaigou2_alipay':
            case 'kuaigou2_wechat':
                $noname =  model('addons\\appbox\\library\\pipes\\Kuaigou2');
                $res = $noname->createOrder($this->auth->id,$orderId,$goodsInfo['price'],$pipe['params']['payTypeId']);
                break;
            case 'kuaigou3_alipay':
            case 'kuaigou3_wechat':
                $noname =  model('addons\\appbox\\library\\pipes\\Kuaigou3');
                $res = $noname->createOrder($this->auth->id,$orderId,$goodsInfo['price'],$pipe['params']['payTypeId']);
                break;
            case 'xinghui_alipay':
            case 'xinghui_wechat':
                $noname =  model('addons\\appbox\\library\\pipes\\Xinghui');
                $res = $noname->createOrder($this->auth->id,$orderId,$goodsInfo['price'],$pipe['params']['payTypeId']);
                break;
            case 'dajiafa_wechat':
                $noname =  model('addons\\appbox\\library\\pipes\\Dajiafa');
                $res = $noname->createOrder($this->auth->id,$orderId,$goodsInfo['price'],$pipe['params']['payTypeId']);
                break;
            case 'dajiafa_alipay':
                $noname =  model('addons\\appbox\\library\\pipes\\Dajiafa2');
                $res = $noname->createOrder($this->auth->id,$orderId,$goodsInfo['price'],$pipe['params']['payTypeId']);
                break;
            case 'lanbo_wechat':
            case 'lanbo_alipay':
                    $noname =  model('addons\\appbox\\library\\pipes\\Lanbo');
                    $res = $noname->createOrder($this->auth->id,$orderId,$goodsInfo['price'],$pipe['params']['payTypeId']);
                    break;
            case 'shiguang_alipay':
                    $noname =  model('addons\\appbox\\library\\pipes\\Shiguang');
                    $res = $noname->createOrder($this->auth->id,$orderId,$goodsInfo['price'],$pipe['params']['payTypeId']);
                    break;
            case 'yinyi_alipay':
                $noname =  model('addons\\appbox\\library\\pipes\\Yinyi');
                $res = $noname->createOrder($this->auth->id,$orderId,$goodsInfo['price'],$pipe['params']['payTypeId']);
                break;
            case 'dawangcai_alipay':
            case 'dawangcai_wechat':
                $noname =  model('addons\\appbox\\library\\pipes\\Dawangcai');
                $res = $noname->createOrder($this->auth->id,$orderId,$goodsInfo['price'],$pipe['params']['payTypeId']);
                break;
            case 'chuangdong_wechat':
            case 'chuangdong_alipay':
                $noname =  model('addons\\appbox\\library\\pipes\\Chuangdong');
                $res = $noname->createOrder($this->auth->id,$orderId,$goodsInfo['price'],$pipe['params']['payTypeId']);
                break;
            case 'wangcai_alipay':
                $noname =  model('addons\\appbox\\library\\pipes\\Wangcai');
                $res = $noname->createOrder($this->auth->id,$orderId,$goodsInfo['price'],$pipe['params']['payTypeId']);
                break;
            case 'wangcai2_wechat':
                $noname =  model('addons\\appbox\\library\\pipes\\Wangcai2');
                $res = $noname->createOrder($this->auth->id,$orderId,$goodsInfo['price'],$pipe['params']['payTypeId']);
                break;
            case 'epay_alipay':
                $noname =  model('addons\\appbox\\library\\pipes\\Epay');
                $res = $noname->createOrder($this->auth->id,$orderId,$goodsInfo['price'],$pipe['params']['payTypeId']);
                break;

            case 'anxin_alipay_630':
            case 'anxin_wechat_626':
            case 'anxin_wechat_633':
                $anxin =  new Anxin();
                $res = $anxin->createOrder($this->auth->id,$orderId,$goodsInfo['price'],$pipe['params']['payTypeId']);
                break;
            case 'shangyun2_alipay_1':
            case 'shangyun2_wechat_28':
            case 'shangyun2_wechat_8002':
                $shangyun2 =  new Shangyun2();
                $res = $shangyun2->createOrder($this->auth->id,$orderId,$goodsInfo['price'],$pipe['params']['payTypeId']);
                break;

            case 'dingdang_alipay_7011':
                $dingdang =  new Dingdang();
                $res = $dingdang->createOrder($this->auth->id,$orderId,$goodsInfo['price'],$pipe['params']['payTypeId']);
                break;
            case 'dazhou_wechat_8002':
                $dazhou =  new Dazhou();
                $res = $dazhou->createOrder($this->auth->id,$orderId,$goodsInfo['price'],$pipe['params']['payTypeId']);
                break;
            case 'guagua_wechat':
            case 'guagua_alipay':
                $noname =  model('addons\\appbox\\library\\pipes\\Guagua');
                $res = $noname->createOrder($this->auth->id,$orderId,$goodsInfo['price'],$pipe['params']['payTypeId']);
                break;
        }

        //支付接口
        
        if($res['code'] == 0){
            $result = [
                'orderId'=>$orderId,
                'payUrl' => $res['data']
            ];

            return $this->success('ok', $result );
            //return $this->success('ok', $res['data'] ,2);
        }else{
            return $this->error($res['msg']);
        }


        //\think\Loader::import('addons\\appbox\\library\\pipes\\' . $pipe['class_name']);

        //$pipeHandler = model('addons\\appbox\\library\\pipes\\' . $pipe['class_name']);
        // $pipeHandler = model('addons\\appbox\\library\\pipes\\' . $pipe['class_name']);
        // $res = $pipeHandler->bulidUrl($orderInfo);
        // if(!$res){
        //     return $this->error($pipeHandler->getError());
        // }
        // return $this->success('ok', $res ,2);
    }

    //非会员直接送一天会员
    public function create4()
    {
        $user = new User();
        $userInfo = $user->infoData($this->auth->id);
        if((int)$userInfo['vip_end_time'] < time()){
            //加会员时长
            $userVip =  new \addons\appbox\model\UserVip();
            $userVip->renew($this->auth->id, '+1 day');

            cache('userinfo_' . $this->auth->id,null);

            //return $this->success('赠送一天会员', null);
        }else{

        }
        
        cache('userinfo_' . $this->auth->id,null);
        

        return $this->success('购买成功，请重新打开APP', null);
    }

    //金币购买VIP
    protected function buyVip4Score($goodsInfo)
    {
        $userInfo = $this->auth->getUserinfo();
        if($userInfo['score']<$goodsInfo['price']){
            return $this->error('您金币余额不足');
        }

        //扣积分
        \app\common\model\User::score(-$goodsInfo['price'], $this->auth->id, '金币购买VIP。');

        //加会员时长
        $userVip =  new \addons\appbox\model\UserVip();
        $userVip->renew($this->auth->id, $goodsInfo['value']);

        cache('userinfo_' . $this->auth->id,null);

        return $this->success('购买成功', null);
    }

    public function list()
    {
        $page = (int)$this->getParam('page');

        $order = new OrderModel();
        $list = $order->list($this->auth->id,1,$page);

        return $this->success('ok',$list);
    }

    //回调成功的业务处理
    protected function successHandle($orderId)
    {

    }

    public function callback()
    {
        $nihong =  model('addons\\appbox\\library\\pipes\\Nihong');
        $res = $nihong->callback();
        if($res['code'] != 0){
            echo $res['msg'];
            exit();
        }

        $data = $res['data'];

        if($data->success != true){
            echo $data['message'];
            exit();
        }

        

        $orderId = $data->data->orderNo;

        $order = new OrderModel();
        $orderInfo = $order ->get(['id' => $orderId]);
        if(!$orderInfo){
            echo '订单不存在';
            exit();
        }

        if($orderInfo['amount'] != $data->data->amount){
            echo '订单金额不相同';
            exit();
        }

        //已结束的订单直接返回ok
        if($orderInfo['status'] == 1){
            echo 'ok';
            exit();
        }

        $goods = new GoodsModel();
        $goodsInfo = $goods->info($orderInfo['goodsId'],$this->config['goods']);
        if(!$goodsInfo){
            echo '商品不存在';
            exit();
        }
        
        //更新订单状态
        $order->setStatus($orderInfo['id'],1);

        if($goodsInfo['type'] == 'score'){
            //加积分
            \app\common\model\User::score(+$goodsInfo['value'], $orderInfo['uid'], '购买金币。');
        }else if($goodsInfo['type'] == 'vip'){
            //获得VIP
            $userVip = new UserVip();
            $userVip->renew($orderInfo['uid'],$goodsInfo['value']);
        }

        cache('userinfo_' . $orderInfo['uid'],null);

        echo 'ok';
        exit();
    }

    public function callback2()
    {
        $star =  model('addons\\appbox\\library\\pipes\\Star');
        $res = $star->callback();
        if($res['code'] != 0){
            echo $res['msg'];
            exit();
        }

        $data = $res['data'];

        if($data['payState'] != 0){
            echo $data['message'];
            exit();
        }

        $order = new OrderModel();
        $orderInfo = $order ->get(['id' => $data['orderNo']]);
        if(!$orderInfo){
            echo '订单不存在';
            exit();
        }

        if($orderInfo['amount'] != $data['money']){
            echo '订单金额不相同';
            exit();
        }

        //已结束的订单直接返回success
        if($orderInfo['status'] == 1){
            echo 'success';
            exit();
        }

        $goods = new GoodsModel();
        $goodsInfo = $goods->info($orderInfo['goodsId'],$this->config['goods']);
        if(!$goodsInfo){
            echo '商品不存在';
            exit();
        }
        
        //更新订单状态
        $order->setStatus($orderInfo['id'],1);

        if($goodsInfo['type'] == 'score'){
            //加积分
            \app\common\model\User::score(+$goodsInfo['value'], $orderInfo['uid'], '购买金币。');
        }else if($goodsInfo['type'] == 'vip'){
            //获得VIP
            $userVip = new UserVip();
            $userVip->renew($orderInfo['uid'],$goodsInfo['value']);
        }

        cache('userinfo_' . $orderInfo['uid'],null);

        echo 'success';
        exit();
    }

    //歌行通道专用回调
    public function gx_notify()
    {
        $gexing =  model('addons\\appbox\\library\\pipes\\Gexing');
        $res = $gexing->callback();
        if($res['code'] != 0){
            echo $res['msg'];
            exit();
        }

        $data = $res['data'];

        if($data['returncode'] != '00'){
            echo $data['message'];
            exit();
        }

        $order = new OrderModel();
        $orderInfo = $order ->get(['id' => $data['orderid']]);
        if(!$orderInfo){
            echo '订单不存在';
            exit();
        }

        if($orderInfo['amount'] != $data['amount']){
            echo '订单金额不相同';
            exit();
        }

        //已结束的订单直接返回success
        if($orderInfo['status'] == 1){
            echo 'OK';
            exit();
        }

        $goods = new GoodsModel();
        $goodsInfo = $goods->info($orderInfo['goodsId'],$this->config['goods']);
        if(!$goodsInfo){
            echo '商品不存在';
            exit();
        }
        
        //更新订单状态
        $order->setStatus($orderInfo['id'],1);

        if($goodsInfo['type'] == 'score'){
            //加积分
            \app\common\model\User::score(+$goodsInfo['value'], $orderInfo['uid'], '购买金币。');
        }else if($goodsInfo['type'] == 'vip'){
            //获得VIP
            $userVip = new UserVip();
            $userVip->renew($orderInfo['uid'],$goodsInfo['value']);
        }

        cache('userinfo_' . $orderInfo['uid'],null);

        echo 'OK';
        exit();
    }

    //noname专用
    public function nn_notify()
    {
        $gexing =  model('addons\\appbox\\library\\pipes\\Noname');
        $res = $gexing->callback();
        if($res['code'] != 0){
            echo $res['msg'];
            exit();
        }

        $data = $res['data'];

        // if(!$data['result']){
        //     echo $data['message'];
        //     exit();
        // }

        $order = new OrderModel();
        $orderInfo = $order ->get(['id' => $data['orderno']]);
        if(!$orderInfo){
            echo '订单不存在';
            exit();
        }

        if($orderInfo['amount']*100 != $data['order_money']){
            echo '订单金额不相同';
            exit();
        }

        //已结束的订单直接返回success
        if($orderInfo['status'] == 1){
            echo 'success';
            exit();
        }

        $goods = new GoodsModel();
        $goodsInfo = $goods->info($orderInfo['goodsId'],$this->config['goods']);
        if(!$goodsInfo){
            echo '商品不存在';
            exit();
        }
        
        //更新订单状态
        $order->setStatus($orderInfo['id'],1);

        if($goodsInfo['type'] == 'score'){
            //加积分
            \app\common\model\User::score(+$goodsInfo['value'], $orderInfo['uid'], '购买金币。');
        }else if($goodsInfo['type'] == 'vip'){
            //获得VIP
            $userVip = new UserVip();
            $userVip->renew($orderInfo['uid'],$goodsInfo['value']);
        }

        cache('userinfo_' . $orderInfo['uid'],null);

        echo 'success';
        exit();
    }

    public function tianshi_notify()
    {
        $gexing =  model('addons\\appbox\\library\\pipes\\Tianshi');
        $res = $gexing->callback();
        if($res['code'] != 0){
            echo $res['msg'];
            exit();
        }

        $data = $res['data'];

        if($data['trade_status'] != 'TRADE_SUCCESS'){
            echo '订单状态不正确';
            exit();
        }

        $order = new OrderModel();
        $orderInfo = $order ->get(['id' => $data['out_trade_no']]);
        if(!$orderInfo){
            echo '订单不存在';
            exit();
        }

        if($orderInfo['amount'] != $data['money']){
            echo '订单金额不相同';
            exit();
        }

        //已结束的订单直接返回success
        if($orderInfo['status'] == 1){
            echo 'OK';
            exit();
        }

        $goods = new GoodsModel();
        $goodsInfo = $goods->info($orderInfo['goodsId'],$this->config['goods']);
        if(!$goodsInfo){
            echo '商品不存在';
            exit();
        }
        
        //更新订单状态
        $order->setStatus($orderInfo['id'],1);

        if($goodsInfo['type'] == 'score'){
            //加积分
            \app\common\model\User::score(+$goodsInfo['value'], $orderInfo['uid'], '购买金币。');
        }else if($goodsInfo['type'] == 'vip'){
            //获得VIP
            $userVip = new UserVip();
            $userVip->renew($orderInfo['uid'],$goodsInfo['value']);
        }

        cache('userinfo_' . $orderInfo['uid'],null);

        echo 'OK';
        exit();
    }

    //mengnan支付
    public function mn_notify()
    {
        $mengnan =  model('addons\\appbox\\library\\pipes\\Mengnan');
        $res = $mengnan->callback();
        if($res['code'] != 0){
            echo $res['msg'];
            exit();
        }

        $data = $res['data'];

        

        $order = new OrderModel();
        $orderInfo = $order ->get(['id' => $data['orderno']]);
        if(!$orderInfo){
            echo '订单不存在';
            exit();
        }

        if($orderInfo['amount'] * 100 != (int)$data['payed_money']){
            echo '订单金额不相同';
            exit();
        }

        //已结束的订单直接返回success
        if($orderInfo['status'] == 1){
            echo 'success';
            exit();
        }

        $goods = new GoodsModel();
        $goodsInfo = $goods->info($orderInfo['goodsId'],$this->config['goods']);
        if(!$goodsInfo){
            echo '商品不存在';
            exit();
        }
        
        //更新订单状态
        $order->setStatus($orderInfo['id'],1);

        if($goodsInfo['type'] == 'score'){
            //加积分
            \app\common\model\User::score(+$goodsInfo['value'], $orderInfo['uid'], '购买金币。');
        }else if($goodsInfo['type'] == 'vip'){
            //获得VIP
            $userVip = new UserVip();
            $userVip->renew($orderInfo['uid'],$goodsInfo['value']);
        }

        cache('userinfo_' . $orderInfo['uid'],null);

        echo 'success';
        exit();
    }

    public function dahe_notify()
    {
        $mengnan =  model('addons\\appbox\\library\\pipes\\Dahe');
        $res = $mengnan->callback();
        if($res['code'] != 0){
            echo $res['msg'];
            exit();
        }

        $data = $res['data'];

        //失败不处理
        if($data['fxstatus'] != 1){
            echo 'success';
            exit();
        }
        

        $order = new OrderModel();
        $orderInfo = $order ->get(['id' => $data['fxddh']]);
        if(!$orderInfo){
            echo '订单不存在';
            exit();
        }

        if($orderInfo['amount']  != (int)$data['fxfee']){
            echo '订单金额不相同';
            exit();
        }

        //已结束的订单直接返回success
        if($orderInfo['status'] == 1){
            echo 'success';
            exit();
        }

        $goods = new GoodsModel();
        $goodsInfo = $goods->info($orderInfo['goodsId'],$this->config['goods']);
        if(!$goodsInfo){
            echo '商品不存在';
            exit();
        }
        
        //更新订单状态
        $order->setStatus($orderInfo['id'],1);

        if($goodsInfo['type'] == 'score'){
            //加积分
            \app\common\model\User::score(+$goodsInfo['value'], $orderInfo['uid'], '购买金币。');
        }else if($goodsInfo['type'] == 'vip'){
            //获得VIP
            $userVip = new UserVip();
            $userVip->renew($orderInfo['uid'],$goodsInfo['value']);
        }

        echo 'success';
        exit();
    }

    //mayi支付
    public function mayi_notify()
    {
        $mayi =  model('addons\\appbox\\library\\pipes\\Mayi');
        $res = $mayi->callback();
        if($res['code'] != 0){
            echo $res['msg'];
            exit();
        }

        $data = $res['data'];

        if($data['status'] != 2 && $data['status'] != 3){
            echo '订单状态不正确';
            exit();
        }

        

        $order = new OrderModel();
        $orderInfo = $order ->get(['id' => $data['mchOrderNo']]);
        if(!$orderInfo){
            echo '订单不存在';
            exit();
        }

        if($orderInfo['amount'] * 100 != (int)$data['amount']){
            echo '订单金额不相同';
            exit();
        }

        //已结束的订单直接返回success
        if($orderInfo['status'] == 1){
            echo 'success';
            exit();
        }

        $goods = new GoodsModel();
        $goodsInfo = $goods->info($orderInfo['goodsId'],$this->config['goods']);
        if(!$goodsInfo){
            echo '商品不存在';
            exit();
        }
        
        //更新订单状态
        $order->setStatus($orderInfo['id'],1);

        if($goodsInfo['type'] == 'score'){
            //加积分
            \app\common\model\User::score(+$goodsInfo['value'], $orderInfo['uid'], '购买金币。');
        }else if($goodsInfo['type'] == 'vip'){
            //获得VIP
            $userVip = new UserVip();
            $userVip->renew($orderInfo['uid'],$goodsInfo['value']);
        }

        //cache('userinfo_' . $orderInfo['uid'],null);

        echo 'success';
        exit();
    }

    public function shangshun_notify()
    {
        $shangshun =  model('addons\\appbox\\library\\pipes\\Shangshun');
        $res = $shangshun->callback();
        if($res['code'] != 0){
            echo $res['msg'];
            exit();
        }

        $data = $res['data'];

        if($data['status'] != 'success'){
            echo '订单状态不正确';
            exit();
        }

        

        $order = new OrderModel();
        $orderInfo = $order ->get(['id' => $data['sh_order']]);
        if(!$orderInfo){
            echo '订单不存在';
            exit();
        }

        if(floatval($orderInfo['amount']) != floatval($data['money'])){
            echo '订单金额不相同';
            exit();
        }

        //已结束的订单直接返回success
        if($orderInfo['status'] == 1){
            echo 'success';
            exit();
        }

        $goods = new GoodsModel();
        $goodsInfo = $goods->info($orderInfo['goodsId'],$this->config['goods']);
        if(!$goodsInfo){
            echo '商品不存在';
            exit();
        }
        
        //更新订单状态
        $order->setStatus($orderInfo['id'],1);

        if($goodsInfo['type'] == 'score'){
            //加积分
            \app\common\model\User::score(+$goodsInfo['value'], $orderInfo['uid'], '购买金币。');
        }else if($goodsInfo['type'] == 'vip'){
            //获得VIP
            $userVip = new UserVip();
            $userVip->renew($orderInfo['uid'],$goodsInfo['value']);
        }

        //cache('userinfo_' . $orderInfo['uid'],null);

        echo 'success';
        exit();
    }

    public function xianyu_notify()
    {
        $xianyu =  model('addons\\appbox\\library\\pipes\\Xianyu');
        $res = $xianyu->callback();
        if($res['code'] != 0){
            echo $res['msg'];
            exit();
        }

        $data = $res['data'];

        if($data['status'] != 2){
            echo '订单状态不正确';
            exit();
        }

        

        $order = new OrderModel();
        $orderInfo = $order ->get(['id' => $data['mchOrderNo']]);
        if(!$orderInfo){
            echo '订单不存在';
            exit();
        }

        if(floatval($orderInfo['amount'] * 100) != floatval($data['amount'])){
            echo '订单金额不相同';
            exit();
        }

        //已结束的订单直接返回success
        if($orderInfo['status'] == 1){
            echo 'success';
            exit();
        }

        $goods = new GoodsModel();
        $goodsInfo = $goods->info($orderInfo['goodsId'],$this->config['goods']);
        if(!$goodsInfo){
            echo '商品不存在';
            exit();
        }
        
        //更新订单状态
        $order->setStatus($orderInfo['id'],1);

        if($goodsInfo['type'] == 'score'){
            //加积分
            \app\common\model\User::score(+$goodsInfo['value'], $orderInfo['uid'], '购买金币。');
        }else if($goodsInfo['type'] == 'vip'){
            //获得VIP
            $userVip = new UserVip();
            $userVip->renew($orderInfo['uid'],$goodsInfo['value']);
        }

        //cache('userinfo_' . $orderInfo['uid'],null);

        echo 'success';
        exit();
    }

    public function dinghui_notify()
    {
        $xianyu =  model('addons\\appbox\\library\\pipes\\Dinghui');
        $res = $xianyu->callback();
        if($res['code'] != 0){
            echo $res['msg'];
            exit();
        }

        $data = $res['data'];

        if($data['status'] != 2){
            echo '订单状态不正确';
            exit();
        }

        

        $order = new OrderModel();
        $orderInfo = $order ->get(['id' => $data['mchOrderNo']]);
        if(!$orderInfo){
            echo '订单不存在';
            exit();
        }

        if(floatval($orderInfo['amount'] * 100) != floatval($data['amount'])){
            echo '订单金额不相同';
            exit();
        }

        //已结束的订单直接返回success
        if($orderInfo['status'] == 1){
            echo 'success';
            exit();
        }

        $goods = new GoodsModel();
        $goodsInfo = $goods->info($orderInfo['goodsId'],$this->config['goods']);
        if(!$goodsInfo){
            echo '商品不存在';
            exit();
        }
        
        //更新订单状态
        $order->setStatus($orderInfo['id'],1);

        if($goodsInfo['type'] == 'score'){
            //加积分
            \app\common\model\User::score(+$goodsInfo['value'], $orderInfo['uid'], '购买金币。');
        }else if($goodsInfo['type'] == 'vip'){
            //获得VIP
            $userVip = new UserVip();
            $userVip->renew($orderInfo['uid'],$goodsInfo['value']);
        }

        //cache('userinfo_' . $orderInfo['uid'],null);

        echo 'success';
        exit();
    }

    public function kuaigou_notify()
    {
        $kuaigou =  model('addons\\appbox\\library\\pipes\\Kuaigou');
        $res = $kuaigou->callback();
        if($res['code'] != 0){
            echo $res['msg'];
            exit();
        }

        $data = $res['data'];

        if($data['orderStatus'] != 1 && $data['orderStatus'] != 4){
            echo '订单状态不正确';
            exit();
        }

        

        $order = new OrderModel();
        $orderInfo = $order ->get(['id' => $data['orderNo']]);
        if(!$orderInfo){
            echo '订单不存在';
            exit();
        }

        if(floatval($orderInfo['amount'] * 100) != floatval($data['paidFee'])){
            echo '订单金额不相同';
            exit();
        }

        //已结束的订单直接返回success
        if($orderInfo['status'] == 1){
            echo 'success';
            exit();
        }

        $goods = new GoodsModel();
        $goodsInfo = $goods->info($orderInfo['goodsId'],$this->config['goods']);
        if(!$goodsInfo){
            echo '商品不存在';
            exit();
        }
        
        //更新订单状态
        $order->setStatus($orderInfo['id'],1);

        if($goodsInfo['type'] == 'score'){
            //加积分
            \app\common\model\User::score(+$goodsInfo['value'], $orderInfo['uid'], '购买金币。');
        }else if($goodsInfo['type'] == 'vip'){
            //获得VIP
            $userVip = new UserVip();
            $userVip->renew($orderInfo['uid'],$goodsInfo['value']);
        }

        //cache('userinfo_' . $orderInfo['uid'],null);

        echo 'success';
        exit();
    }

    public function kuaigou2_notify()
    {
        $kuaigou =  model('addons\\appbox\\library\\pipes\\Kuaigou2');
        $res = $kuaigou->callback();
        if($res['code'] != 0){
            echo $res['msg'];
            exit();
        }

        $data = $res['data'];

        if($data['orderStatus'] != 1 && $data['orderStatus'] != 4){
            echo '订单状态不正确';
            exit();
        }

        

        $order = new OrderModel();
        $orderInfo = $order ->get(['id' => $data['orderNo']]);
        if(!$orderInfo){
            echo '订单不存在';
            exit();
        }

        if(floatval($orderInfo['amount'] * 100) != floatval($data['paidFee'])){
            echo '订单金额不相同';
            exit();
        }

        //已结束的订单直接返回success
        if($orderInfo['status'] == 1){
            echo 'success';
            exit();
        }

        $goods = new GoodsModel();
        $goodsInfo = $goods->info($orderInfo['goodsId'],$this->config['goods']);
        if(!$goodsInfo){
            echo '商品不存在';
            exit();
        }
        
        //更新订单状态
        $order->setStatus($orderInfo['id'],1);

        if($goodsInfo['type'] == 'score'){
            //加积分
            \app\common\model\User::score(+$goodsInfo['value'], $orderInfo['uid'], '购买金币。');
        }else if($goodsInfo['type'] == 'vip'){
            //获得VIP
            $userVip = new UserVip();
            $userVip->renew($orderInfo['uid'],$goodsInfo['value']);
        }

        //cache('userinfo_' . $orderInfo['uid'],null);

        echo 'success';
        exit();
    }

    public function kuaigou3_notify()
    {
        $kuaigou =  model('addons\\appbox\\library\\pipes\\Kuaigou3');
        $res = $kuaigou->callback();
        if($res['code'] != 0){
            echo $res['msg'];
            exit();
        }

        $data = $res['data'];

        if($data['orderStatus'] != 1 && $data['orderStatus'] != 4){
            echo '订单状态不正确';
            exit();
        }

        

        $order = new OrderModel();
        $orderInfo = $order ->get(['id' => $data['orderNo']]);
        if(!$orderInfo){
            echo '订单不存在';
            exit();
        }

        if(floatval($orderInfo['amount'] * 100) != floatval($data['paidFee'])){
            echo '订单金额不相同';
            exit();
        }

        //已结束的订单直接返回success
        if($orderInfo['status'] == 1){
            echo 'success';
            exit();
        }

        $goods = new GoodsModel();
        $goodsInfo = $goods->info($orderInfo['goodsId'],$this->config['goods']);
        if(!$goodsInfo){
            echo '商品不存在';
            exit();
        }
        
        //更新订单状态
        $order->setStatus($orderInfo['id'],1);

        if($goodsInfo['type'] == 'score'){
            //加积分
            \app\common\model\User::score(+$goodsInfo['value'], $orderInfo['uid'], '购买金币。');
        }else if($goodsInfo['type'] == 'vip'){
            //获得VIP
            $userVip = new UserVip();
            $userVip->renew($orderInfo['uid'],$goodsInfo['value']);
        }

        //cache('userinfo_' . $orderInfo['uid'],null);

        echo 'success';
        exit();
    }

    public function xinghui_notify()
    {
        $xianyu =  model('addons\\appbox\\library\\pipes\\Xinghui');
        $res = $xianyu->callback();
        if($res['code'] != 0){
            echo $res['msg'];
            exit();
        }

        $data = $res['data'];

        if($data['status'] != 2){
            echo '订单状态不正确';
            exit();
        }

        

        $order = new OrderModel();
        $orderInfo = $order ->get(['id' => $data['mchOrderNo']]);
        if(!$orderInfo){
            echo '订单不存在';
            exit();
        }

        if(floatval($orderInfo['amount'] * 100) != floatval($data['amount'])){
            echo '订单金额不相同';
            exit();
        }

        //已结束的订单直接返回success
        if($orderInfo['status'] == 1){
            echo 'success';
            exit();
        }

        $goods = new GoodsModel();
        $goodsInfo = $goods->info($orderInfo['goodsId'],$this->config['goods']);
        if(!$goodsInfo){
            echo '商品不存在';
            exit();
        }
        
        //更新订单状态
        $order->setStatus($orderInfo['id'],1);

        if($goodsInfo['type'] == 'score'){
            //加积分
            \app\common\model\User::score(+$goodsInfo['value'], $orderInfo['uid'], '购买金币。');
        }else if($goodsInfo['type'] == 'vip'){
            //获得VIP
            $userVip = new UserVip();
            $userVip->renew($orderInfo['uid'],$goodsInfo['value']);
        }

        //cache('userinfo_' . $orderInfo['uid'],null);

        echo 'success';
        exit();
    }

    public function dajiafa_notify()
    {
        $xianyu =  model('addons\\appbox\\library\\pipes\\Dajiafa');
        $res = $xianyu->callback();
        if($res['code'] != 0){
            echo $res['msg'];
            exit();
        }

        $data = $res['data'];

        if($data['status'] != 2){
            echo '订单状态不正确';
            exit();
        }

        

        $order = new OrderModel();
        $orderInfo = $order ->get(['id' => $data['mchOrderNo']]);
        if(!$orderInfo){
            echo '订单不存在';
            exit();
        }

        if(floatval($orderInfo['amount'] * 100) != floatval($data['amount'])){
            echo '订单金额不相同';
            exit();
        }

        //已结束的订单直接返回success
        if($orderInfo['status'] == 1){
            echo 'success';
            exit();
        }

        $goods = new GoodsModel();
        $goodsInfo = $goods->info($orderInfo['goodsId'],$this->config['goods']);
        if(!$goodsInfo){
            echo '商品不存在';
            exit();
        }
        
        //更新订单状态
        $order->setStatus($orderInfo['id'],1);

        if($goodsInfo['type'] == 'score'){
            //加积分
            \app\common\model\User::score(+$goodsInfo['value'], $orderInfo['uid'], '购买金币。');
        }else if($goodsInfo['type'] == 'vip'){
            //获得VIP
            $userVip = new UserVip();
            $userVip->renew($orderInfo['uid'],$goodsInfo['value']);
        }

        //cache('userinfo_' . $orderInfo['uid'],null);

        echo 'success';
        exit();
    }

    public function dajiafa2_notify()
    {
        $xianyu =  model('addons\\appbox\\library\\pipes\\Dajiafa2');
        $res = $xianyu->callback();
        if($res['code'] != 0){
            echo $res['msg'];
            exit();
        }

        $data = $res['data'];

        if($data['status'] != 2){
            echo '订单状态不正确';
            exit();
        }

        

        $order = new OrderModel();
        $orderInfo = $order ->get(['id' => $data['mchOrderNo']]);
        if(!$orderInfo){
            echo '订单不存在';
            exit();
        }

        if(floatval($orderInfo['amount'] * 100) != floatval($data['amount'])){
            echo '订单金额不相同';
            exit();
        }

        //已结束的订单直接返回success
        if($orderInfo['status'] == 1){
            echo 'success';
            exit();
        }

        $goods = new GoodsModel();
        $goodsInfo = $goods->info($orderInfo['goodsId'],$this->config['goods']);
        if(!$goodsInfo){
            echo '商品不存在';
            exit();
        }
        
        //更新订单状态
        $order->setStatus($orderInfo['id'],1);

        if($goodsInfo['type'] == 'score'){
            //加积分
            \app\common\model\User::score(+$goodsInfo['value'], $orderInfo['uid'], '购买金币。');
        }else if($goodsInfo['type'] == 'vip'){
            //获得VIP
            $userVip = new UserVip();
            $userVip->renew($orderInfo['uid'],$goodsInfo['value']);
        }

        //cache('userinfo_' . $orderInfo['uid'],null);

        echo 'success';
        exit();
    }

    public function lanbo_notify()
    {
        $xianyu =  model('addons\\appbox\\library\\pipes\\Lanbo');
        $res = $xianyu->callback();
        if($res['code'] != 0){
            echo $res['msg'];
            exit();
        }

        $data = $res['data'];

        if($data['status'] != 2){
            echo '订单状态不正确';
            exit();
        }

        

        $order = new OrderModel();
        $orderInfo = $order ->get(['id' => $data['mchOrderNo']]);
        if(!$orderInfo){
            echo '订单不存在';
            exit();
        }

        if(floatval($orderInfo['amount'] * 100) != floatval($data['amount'])){
            echo '订单金额不相同';
            exit();
        }

        //已结束的订单直接返回success
        if($orderInfo['status'] == 1){
            echo 'success';
            exit();
        }

        $goods = new GoodsModel();
        $goodsInfo = $goods->info($orderInfo['goodsId'],$this->config['goods']);
        if(!$goodsInfo){
            echo '商品不存在';
            exit();
        }
        
        //更新订单状态
        $order->setStatus($orderInfo['id'],1);

        if($goodsInfo['type'] == 'score'){
            //加积分
            \app\common\model\User::score(+$goodsInfo['value'], $orderInfo['uid'], '购买金币。');
        }else if($goodsInfo['type'] == 'vip'){
            //获得VIP
            $userVip = new UserVip();
            $userVip->renew($orderInfo['uid'],$goodsInfo['value']);
        }

        //cache('userinfo_' . $orderInfo['uid'],null);

        echo 'success';
        exit();
    }

    public function shiguang_notify()
    {
        $xianyu =  model('addons\\appbox\\library\\pipes\\Shiguang');
        $res = $xianyu->callback();
        if($res['code'] != 0){
            echo $res['msg'];
            exit();
        }

        $data = $res['data'];

        if($data['status'] != 2){
            echo '订单状态不正确';
            exit();
        }

        

        $order = new OrderModel();
        $orderInfo = $order ->get(['id' => $data['mchOrderNo']]);
        if(!$orderInfo){
            echo '订单不存在';
            exit();
        }

        if(floatval($orderInfo['amount'] * 100) != floatval($data['amount'])){
            echo '订单金额不相同';
            exit();
        }

        //已结束的订单直接返回success
        if($orderInfo['status'] == 1){
            echo 'success';
            exit();
        }

        $goods = new GoodsModel();
        $goodsInfo = $goods->info($orderInfo['goodsId'],$this->config['goods']);
        if(!$goodsInfo){
            echo '商品不存在';
            exit();
        }
        
        //更新订单状态
        $order->setStatus($orderInfo['id'],1);

        if($goodsInfo['type'] == 'score'){
            //加积分
            \app\common\model\User::score(+$goodsInfo['value'], $orderInfo['uid'], '购买金币。');
        }else if($goodsInfo['type'] == 'vip'){
            //获得VIP
            $userVip = new UserVip();
            $userVip->renew($orderInfo['uid'],$goodsInfo['value']);
        }

        //cache('userinfo_' . $orderInfo['uid'],null);

        echo 'success';
        exit();
    }

    public function yinyi_notify()
    {
        $xianyu =  model('addons\\appbox\\library\\pipes\\Yinyi');
        $res = $xianyu->callback();
        if($res['code'] != 0){
            echo $res['msg'];
            exit();
        }

        $data = $res['data'];

        // if($data['status'] != 2){
        //     echo '订单状态不正确';
        //     exit();
        // }

        

        $order = new OrderModel();
        $orderInfo = $order ->get(['id' => $data['merchantOrderId']]);
        if(!$orderInfo){
            echo '订单不存在';
            exit();
        }

        if(floatval($orderInfo['amount']) != floatval($data['amount'])){
            echo '订单金额不相同';
            exit();
        }

        //已结束的订单直接返回success
        if($orderInfo['status'] == 1){
            echo 'success';
            exit();
        }

        $goods = new GoodsModel();
        $goodsInfo = $goods->info($orderInfo['goodsId'],$this->config['goods']);
        if(!$goodsInfo){
            echo '商品不存在';
            exit();
        }
        
        //更新订单状态
        $order->setStatus($orderInfo['id'],1);

        if($goodsInfo['type'] == 'score'){
            //加积分
            \app\common\model\User::score(+$goodsInfo['value'], $orderInfo['uid'], '购买金币。');
        }else if($goodsInfo['type'] == 'vip'){
            //获得VIP
            $userVip = new UserVip();
            $userVip->renew($orderInfo['uid'],$goodsInfo['value']);
        }

        //cache('userinfo_' . $orderInfo['uid'],null);

        echo 'success';
        exit();
    }

    public function chuangdong_notify()
    {
        $xianyu =  model('addons\\appbox\\library\\pipes\\Chuangdong');
        $res = $xianyu->callback();
        if($res['code'] != 0){
            echo $res['msg'];
            exit();
        }

        $data = $res['data'];
        if($data['status'] != 2){
            echo '订单状态不正确';
            exit();
        }

        $order = new OrderModel();
        $orderInfo = $order ->get(['id' => $data['mchOrderNo']]);
        if(!$orderInfo){
            echo '订单不存在';
            exit();
        }

        if(floatval($orderInfo['amount'] * 100) != floatval($data['amount'])){
            echo '订单金额不相同';
            exit();
        }

        //已结束的订单直接返回success
        if($orderInfo['status'] == 1){
            echo 'success';
            exit();
        }

        $goods = new GoodsModel();
        $goodsInfo = $goods->info($orderInfo['goodsId'],$this->config['goods']);
        if(!$goodsInfo){
            echo '商品不存在';
            exit();
        }
        
        //更新订单状态
        $order->setStatus($orderInfo['id'],1);

        if($goodsInfo['type'] == 'score'){
            //加积分
            \app\common\model\User::score(+$goodsInfo['value'], $orderInfo['uid'], '购买金币。');
        }else if($goodsInfo['type'] == 'vip'){
            //获得VIP
            $userVip = new UserVip();
            $userVip->renew($orderInfo['uid'],$goodsInfo['value']);
        }

        //cache('userinfo_' . $orderInfo['uid'],null);

        echo 'success';
        exit();
    }

    public function dawangcai_notify()
    {
        $xianyu =  model('addons\\appbox\\library\\pipes\\Dawangcai');
        $res = $xianyu->callback();
        if($res['code'] != 0){
            echo $res['msg'];
            exit();
        }

        $data = $res['data'];

        if($data['state'] != 0 ){
            echo '订单状态不正确';
            exit();
        }else if($data['state'] == 0 && $data['payState'] != 0){
            echo '订单状态不正确';
            exit();
        }

        $order = new OrderModel();
        $orderInfo = $order ->get(['id' => $data['orderNo']]);
        if(!$orderInfo){
            echo '订单不存在';
            exit();
        }

        if(floatval($orderInfo['amount']) != floatval($data['money'])){
            echo '订单金额不相同';
            exit();
        }

        //已结束的订单直接返回success
        if($orderInfo['status'] == 1){
            echo 'success';
            exit();
        }

        $goods = new GoodsModel();
        $goodsInfo = $goods->info($orderInfo['goodsId'],$this->config['goods']);
        if(!$goodsInfo){
            echo '商品不存在';
            exit();
        }
        
        //更新订单状态
        $order->setStatus($orderInfo['id'],1);

        if($goodsInfo['type'] == 'score'){
            //加积分
            \app\common\model\User::score(+$goodsInfo['value'], $orderInfo['uid'], '购买金币。');
        }else if($goodsInfo['type'] == 'vip'){
            //获得VIP
            $userVip = new UserVip();
            $userVip->renew($orderInfo['uid'],$goodsInfo['value']);
        }

        //cache('userinfo_' . $orderInfo['uid'],null);

        echo 'success';
        exit();
    }

    public function wangcai_notify()
    {
        $xianyu =  model('addons\\appbox\\library\\pipes\\Wangcai');
        $res = $xianyu->callback();
        if($res['code'] != 0){
            echo $res['msg'];
            exit();
        }

        $data = $res['data'];

        if($data['state'] != 2){
            echo '订单状态不正确';
            exit();
        }

        

        $order = new OrderModel();
        $orderInfo = $order ->get(['id' => $data['otn']]);
        if(!$orderInfo){
            echo '订单不存在';
            exit();
        }

        if(floatval($orderInfo['amount']) != floatval($data['trade_price'])){
            echo '订单金额不相同';
            exit();
        }

        //已结束的订单直接返回success
        if($orderInfo['status'] == 2){
            echo 'success';
            exit();
        }

        $goods = new GoodsModel();
        $goodsInfo = $goods->info($orderInfo['goodsId'],$this->config['goods']);
        if(!$goodsInfo){
            echo '商品不存在';
            exit();
        }
        
        //更新订单状态
        $order->setStatus($orderInfo['id'],1);

        if($goodsInfo['type'] == 'score'){
            //加积分
            \app\common\model\User::score(+$goodsInfo['value'], $orderInfo['uid'], '购买金币。');
        }else if($goodsInfo['type'] == 'vip'){
            //获得VIP
            $userVip = new UserVip();
            $userVip->renew($orderInfo['uid'],$goodsInfo['value']);
        }

        //cache('userinfo_' . $orderInfo['uid'],null);

        echo 'success';
        exit();
    }

    public function wangcai2_notify()
    {
        $xianyu =  model('addons\\appbox\\library\\pipes\\Wangcai2');
        $res = $xianyu->callback();
        if($res['code'] != 0){
            echo $res['msg'];
            exit();
        }

        $data = $res['data'];

        if($data['state'] != 2){
            echo '订单状态不正确';
            exit();
        }

        

        $order = new OrderModel();
        $orderInfo = $order ->get(['id' => $data['otn']]);
        if(!$orderInfo){
            echo '订单不存在';
            exit();
        }

        if(floatval($orderInfo['amount']) != floatval($data['trade_price'])){
            echo '订单金额不相同';
            exit();
        }

        //已结束的订单直接返回success
        if($orderInfo['status'] == 2){
            echo 'success';
            exit();
        }

        $goods = new GoodsModel();
        $goodsInfo = $goods->info($orderInfo['goodsId'],$this->config['goods']);
        if(!$goodsInfo){
            echo '商品不存在';
            exit();
        }
        
        //更新订单状态
        $order->setStatus($orderInfo['id'],1);

        if($goodsInfo['type'] == 'score'){
            //加积分
            \app\common\model\User::score(+$goodsInfo['value'], $orderInfo['uid'], '购买金币。');
        }else if($goodsInfo['type'] == 'vip'){
            //获得VIP
            $userVip = new UserVip();
            $userVip->renew($orderInfo['uid'],$goodsInfo['value']);
        }

        //cache('userinfo_' . $orderInfo['uid'],null);

        echo 'success';
        exit();
    }

    public function epay_notify()
    {
        $xianyu =  model('addons\\appbox\\library\\pipes\\Epay');
        $res = $xianyu->callback();
        if($res['code'] != 0){
            echo $res['msg'];
            exit();
        }

        $data = $res['data'];

        if($data['status'] != 2){
            echo '订单状态不正确';
            exit();
        }

        

        $order = new OrderModel();
        $orderInfo = $order ->get(['id' => $data['mchOrderNo']]);
        if(!$orderInfo){
            echo '订单不存在';
            exit();
        }

        if(floatval($orderInfo['amount'] * 100) != floatval($data['amount'])){
            echo '订单金额不相同';
            exit();
        }

        //已结束的订单直接返回success
        if($orderInfo['status'] == 2){
            echo 'success';
            exit();
        }

        $goods = new GoodsModel();
        $goodsInfo = $goods->info($orderInfo['goodsId'],$this->config['goods']);
        if(!$goodsInfo){
            echo '商品不存在';
            exit();
        }
        
        //更新订单状态
        $order->setStatus($orderInfo['id'],1);

        if($goodsInfo['type'] == 'score'){
            //加积分
            \app\common\model\User::score(+$goodsInfo['value'], $orderInfo['uid'], '购买金币。');
        }else if($goodsInfo['type'] == 'vip'){
            //获得VIP
            $userVip = new UserVip();
            $userVip->renew($orderInfo['uid'],$goodsInfo['value']);
        }

        //cache('userinfo_' . $orderInfo['uid'],null);

        echo 'success';
        exit();
    }

    public function yk_notify()
    {
        $yk =  model('addons\\appbox\\library\\pipes\\YkPay');
        $res = $yk->callback();
        if($res['code'] != 0){
            echo $res['msg'];
            exit();
        }

        $data = $res['data'];  
        
        
        if($data['tradeStatus'] != '1'){
            echo '订单支付失败';
            exit();
        }

        $order = new OrderModel();
        $orderInfo = $order ->get(['id' => $data['merchantPayNo']]);
        if(!$orderInfo){
            echo '订单不存在';
            exit();
        }

        if(floatval($orderInfo['amount']) *100 != floatval($data['tradeAmt'])*100){
            echo '订单金额不相同';
            exit();
        }

        //已结束的订单直接返回success
        if($orderInfo['status'] == 1){
            echo 'SUCCESS';
            exit();
        }

        $goods = new GoodsModel();
        $goodsInfo = $goods->info($orderInfo['goodsId'],$this->config['goods']);
        if(!$goodsInfo){
            echo '商品不存在';
            exit();
        }
        
        //更新订单状态
        $order->setStatus($orderInfo['id'],1);

        if($goodsInfo['type'] == 'score'){
            //加积分
            \app\common\model\User::score(+$goodsInfo['value'], $orderInfo['uid'], '购买金币。');
        }else if($goodsInfo['type'] == 'vip'){
            //获得VIP
            $userVip = new UserVip();
            $userVip->renew($orderInfo['uid'],$goodsInfo['value']);
        }


        echo 'SUCCESS';
        exit();
    }

    public function qiansong_notify()
    {
        $qiansong =  model('addons\\appbox\\library\\pipes\\Qiansong');
        $res = $qiansong->callback();
        if($res['code'] != 0){
            echo $res['msg'];
            exit();
        }

        $data = $res['data'];       

        $order = new OrderModel();
        $orderInfo = $order ->get(['id' => $data['outTradeNo']]);
        if(!$orderInfo){
            echo '订单不存在';
            exit();
        }

        if(floatval($orderInfo['amount']) *100 != floatval($data['amount'])){
            echo '订单金额不相同';
            exit();
        }

        //已结束的订单直接返回success
        if($orderInfo['status'] == 1){
            echo 'success';
            exit();
        }

        $goods = new GoodsModel();
        $goodsInfo = $goods->info($orderInfo['goodsId'],$this->config['goods']);
        if(!$goodsInfo){
            echo '商品不存在';
            exit();
        }
        
        //更新订单状态
        $order->setStatus($orderInfo['id'],1);

        if($goodsInfo['type'] == 'score'){
            //加积分
            \app\common\model\User::score(+$goodsInfo['value'], $orderInfo['uid'], '购买金币。');
        }else if($goodsInfo['type'] == 'vip'){
            //获得VIP
            $userVip = new UserVip();
            $userVip->renew($orderInfo['uid'],$goodsInfo['value']);
        }


        echo 'success';
        exit();
    }

    public function lvxiaoer_notify()
    {
        $lvxiaoer =  model('addons\\appbox\\library\\pipes\\Lvxiaoer');
        $res = $lvxiaoer->callback();
        if($res['code'] != 0){
            echo $res['msg'];
            exit();
        }

        $data = $res['data'];       

        $order = new OrderModel();
        $orderInfo = $order ->get(['id' => $data['merchantPayNo']]);
        if(!$orderInfo){
            echo '订单不存在';
            exit();
        }

        if(floatval($orderInfo['amount'])!= floatval($data['tradeAmt'])){
            echo '订单金额不相同';
            exit();
        }

        //已结束的订单直接返回success
        if($orderInfo['status'] == 1){
            echo 'success';
            exit();
        }

        $goods = new GoodsModel();
        $goodsInfo = $goods->info($orderInfo['goodsId'],$this->config['goods']);
        if(!$goodsInfo){
            echo '商品不存在';
            exit();
        }
        
        //更新订单状态
        $order->setStatus($orderInfo['id'],1);

        if($goodsInfo['type'] == 'score'){
            //加积分
            \app\common\model\User::score(+$goodsInfo['value'], $orderInfo['uid'], '购买金币。');
        }else if($goodsInfo['type'] == 'vip'){
            //获得VIP
            $userVip = new UserVip();
            $userVip->renew($orderInfo['uid'],$goodsInfo['value']);
        }


        echo 'success';
        exit();
    }

    public function mayun_notify()
    {
        $mayun =  model('addons\\appbox\\library\\pipes\\Mayun');
        $res = $mayun->callback();
        if($res['code'] != 0){
            echo $res['msg'];
            exit();
        }

        $data = $res['data'];       

        $order = new OrderModel();
        $orderInfo = $order ->get(['id' => $data['mchOrderNo']]);
        if(!$orderInfo){
            echo '订单不存在';
            exit();
        }

        if(floatval($orderInfo['amount']) *100 != floatval($data['amount'])){
            echo '订单金额不相同';
            exit();
        }

        //已结束的订单直接返回success
        if($orderInfo['status'] == 1){
            echo 'success';
            exit();
        }

        $goods = new GoodsModel();
        $goodsInfo = $goods->info($orderInfo['goodsId'],$this->config['goods']);
        if(!$goodsInfo){
            echo '商品不存在';
            exit();
        }
        
        //更新订单状态
        $order->setStatus($orderInfo['id'],1);

        if($goodsInfo['type'] == 'score'){
            //加积分
            \app\common\model\User::score(+$goodsInfo['value'], $orderInfo['uid'], '购买金币。');
        }else if($goodsInfo['type'] == 'vip'){
            //获得VIP
            $userVip = new UserVip();
            $userVip->renew($orderInfo['uid'],$goodsInfo['value']);
        }


        echo 'success';
        exit();
    }



    //anxin支付
    public function anxin_notify()
    {
        $anxin =  new Anxin();
        $res = $anxin->callback();
        if($res['code'] != 0){
            echo $res['msg'];
            exit();
        }

        $data = $res['data'];

        if($data['status'] != 2 && $data['status'] != 3){
            echo '订单状态不正确';
            exit();
        }



        $order = new OrderModel();
        $orderInfo = $order ->get(['id' => $data['mchOrderNo']]);
        if(!$orderInfo){
            echo '订单不存在';
            exit();
        }

        if($orderInfo['amount'] * 100 != (int)$data['amount']){
            echo '订单金额不相同';
            exit();
        }

        //已结束的订单直接返回success
        if($orderInfo['status'] == 1){
            echo 'success';
            exit();
        }

        $goods = new GoodsModel();
        $goodsInfo = $goods->info($orderInfo['goodsId'],$this->config['goods']);
        if(!$goodsInfo){
            echo '商品不存在';
            exit();
        }

        //更新订单状态
        $order->setStatus($orderInfo['id'],1);

        if($goodsInfo['type'] == 'score'){
            //加积分
            \app\common\model\User::score(+$goodsInfo['value'], $orderInfo['uid'], '购买金币。');
        }else if($goodsInfo['type'] == 'vip'){
            //获得VIP
            $userVip = new UserVip();
            $userVip->renew($orderInfo['uid'],$goodsInfo['value']);
        }

        //cache('userinfo_' . $orderInfo['uid'],null);

        echo 'success';
        exit();
    }




    //shangyun2支付
    public function shangyun2_notify()
    {
        $shangyun2 =  new Shangyun2();
        $res = $shangyun2->callback();
        if($res['code'] != 0){
            echo $res['msg'];
            exit();
        }

        $data = $res['data'];

        if($data['trade_status'] != 1 ){
            echo '订单状态不正确';
            exit();
        }



        $order = new OrderModel();
        $orderInfo = $order ->get(['id' => $data['out_trade_no']]);
        if(!$orderInfo){
            echo '订单不存在';
            exit();
        }

        if($orderInfo['amount'] != (int)$data['amount']){
            echo '订单金额不相同';
            exit();
        }

        //已结束的订单直接返回success
        if($orderInfo['status'] == 1){
            echo 'success';
            exit();
        }

        $goods = new GoodsModel();
        $goodsInfo = $goods->info($orderInfo['goodsId'],$this->config['goods']);
        if(!$goodsInfo){
            echo '商品不存在';
            exit();
        }

        //更新订单状态
        $order->setStatus($orderInfo['id'],1);

        if($goodsInfo['type'] == 'score'){
            //加积分
            \app\common\model\User::score(+$goodsInfo['value'], $orderInfo['uid'], '购买金币。');
        }else if($goodsInfo['type'] == 'vip'){
            //获得VIP
            $userVip = new UserVip();
            $userVip->renew($orderInfo['uid'],$goodsInfo['value']);
        }

        //cache('userinfo_' . $orderInfo['uid'],null);

        echo 'success';
        exit();
    }


    //dingdang支付
    public function dingdang_notify()
    {
        $dingdang =  new Dingdang();
        $res = $dingdang->callback();
        if($res['code'] != 0){
            echo $res['msg'];
            exit();
        }

        $data = $res['data'];

        if($data['refCode'] != 3 ){
            echo '订单状态不正确';
            exit();
        }



        $order = new OrderModel();
        $orderInfo = $order ->get(['id' => $data['out_trade_no']]);
        if(!$orderInfo){
            echo '订单不存在';
            exit();
        }

        if($orderInfo['amount'] != (int)$data['amount']){
            echo '订单金额不相同';
            exit();
        }

        //已结束的订单直接返回success
        if($orderInfo['status'] == 1){
            echo 'success';
            exit();
        }

        $goods = new GoodsModel();
        $goodsInfo = $goods->info($orderInfo['goodsId'],$this->config['goods']);
        if(!$goodsInfo){
            echo '商品不存在';
            exit();
        }

        //更新订单状态
        $order->setStatus($orderInfo['id'],1);

        if($goodsInfo['type'] == 'score'){
            //加积分
            \app\common\model\User::score(+$goodsInfo['value'], $orderInfo['uid'], '购买金币。');
        }else if($goodsInfo['type'] == 'vip'){
            //获得VIP
            $userVip = new UserVip();
            $userVip->renew($orderInfo['uid'],$goodsInfo['value']);
        }

        //cache('userinfo_' . $orderInfo['uid'],null);

        echo 'success';
        exit();
    }


    //dazhou支付
    public function dazhou_notify()
    {
        $dazhou =  new Dazhou();
        $res = $dazhou->callback();
        if($res['code'] != 0){
            echo $res['msg'];
            exit();
        }

        $data = $res['data'];

        if($data['status'] != 2 && $data['status'] != 3){
            echo '订单状态不正确';
            exit();
        }



        $order = new OrderModel();
        $orderInfo = $order ->get(['id' => $data['mchOrderNo']]);
        if(!$orderInfo){
            echo '订单不存在';
            exit();
        }

        if($orderInfo['amount'] * 100 != (int)$data['amount']){
            echo '订单金额不相同';
            exit();
        }

        //已结束的订单直接返回success
        if($orderInfo['status'] == 1){
            echo 'success';
            exit();
        }

        $goods = new GoodsModel();
        $goodsInfo = $goods->info($orderInfo['goodsId'],$this->config['goods']);
        if(!$goodsInfo){
            echo '商品不存在';
            exit();
        }

        //更新订单状态
        $order->setStatus($orderInfo['id'],1);

        if($goodsInfo['type'] == 'score'){
            //加积分
            \app\common\model\User::score(+$goodsInfo['value'], $orderInfo['uid'], '购买金币。');
        }else if($goodsInfo['type'] == 'vip'){
            //获得VIP
            $userVip = new UserVip();
            $userVip->renew($orderInfo['uid'],$goodsInfo['value']);
        }

        //cache('userinfo_' . $orderInfo['uid'],null);

        echo 'success';
        exit();
    }

    public function guagua_notify()
    {
        $xianyu =  model('addons\\appbox\\library\\pipes\\Guagua');
        $res = $xianyu->callback();
        if($res['code'] != 0){
            echo "支付失败";
            exit();
        }

        $data = $res['data'];
        if($data['status'] != 1){
            echo '订单状态不正确';
            exit();
        }

        $order = new OrderModel();
        $orderInfo = $order ->get(['id' => $data['merOrderTid']]);
        if(!$orderInfo){
            echo '订单不存在';
            exit();
        }

        if(floatval($orderInfo['amount'] ) != floatval($data['money'])){
            echo '订单金额不相同';
            exit();
        }

        //已结束的订单直接返回success
        if($orderInfo['status'] == 1){
            echo 'success';
            exit();
        }

        $goods = new GoodsModel();
        $goodsInfo = $goods->info($orderInfo['goodsId'],$this->config['goods']);
        if(!$goodsInfo){
            echo '商品不存在';
            exit();
        }
        
        //更新订单状态
        $order->setStatus($orderInfo['id'],1);

        if($goodsInfo['type'] == 'score'){
            //加积分
            \app\common\model\User::score(+$goodsInfo['value'], $orderInfo['uid'], '购买金币。');
        }else if($goodsInfo['type'] == 'vip'){
            //获得VIP
            $userVip = new UserVip();
            $userVip->renew($orderInfo['uid'],$goodsInfo['value']);
        }

        //cache('userinfo_' . $orderInfo['uid'],null);

        echo 'success';
        exit();
    }
}
