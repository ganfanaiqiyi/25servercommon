<?php
namespace addons\appbox\model;

use think\Model;
use think\db;

class Order extends Model
{
    // 表名
    protected $name = 'appbox_order';

    // 自动写入时间戳字段
    protected $autoWriteTimestamp = 'int';

    protected $createTime = 'createTime';

    public function createOrder($uid, $goodsId,$remark,$amount,$paymentMethod)
    {
        while(true){
            $orderId = $this->createOrderId();
            if(!$this->get(['id'=>$orderId])){
                break;
            }
        }

        $now = time();
        $this->insert([
            'id' => $orderId,
            'uid' => $uid,
            'goodsId' => $goodsId,
            'remark' => $remark,
            'amount' => $amount,
            'status' => 0,
            'paymentMethod' => $paymentMethod,
            'createTime' => $now,
            'updateTime' => $now
        ]);

        return $orderId;
    }
    
    public function setStatus($id,$status)
    {
        $now = time();
        $this->where(['id'=>$id])->update([
            'status' => $status,
            'updateTime' => $now
        ]);
    }

    public function list($uid, $status,$page=1,$limit=20)
    {
        return $this->where(['uid'=>$uid, 'status' => $status])->limit($limit)->page($page)->order("createTime desc")->select();
    }

    //创建唯一订单号
    protected function createOrderId()
    {
        return 'H' . date('Ymd').substr(implode(NULL, array_map('ord', str_split(substr(uniqid(), 7, 13), 1))), 0, 8);
    }
}