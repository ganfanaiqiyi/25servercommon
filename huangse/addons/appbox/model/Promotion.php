<?php

namespace addons\appbox\model;

use think\Model;
use think\db;

class Promotion extends Model
{
    // 表名
    protected $name = 'appbox_promotion';
    // 自动写入时间戳字段
    protected $autoWriteTimestamp = 'int';
    // 定义时间戳字段名
    protected $createTime = 'createTime';

    public function invite($uid,$deviceId,$ip)
    {
        $res = $this->get([
            'uid' => $uid,
            'deviceId' => $deviceId
        ]);

        if($res){
            return err(1,"已存在");
        }

        $this->insert([
            'uid' => $uid,
            'deviceId' => $deviceId,
            'ip' => $ip,
            'createTime' => date('Y-m-d H:i:s')
        ]);

        return ok("");
    }

    public function count($uid,$startTime,$endTime)
    {
        $res = $this->where('createTime','between time',[$startTime,$endTime])->count();
        return $res;
    }
    
    public function listData()
    {
        $list = $this->order('id', 'asc')->select();
        return $list;
    }
}