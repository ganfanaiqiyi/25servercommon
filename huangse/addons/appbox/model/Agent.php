<?php

namespace addons\appbox\model;

use think\Model;
use think\db;

class Agent extends Model
{
    // 表名
    protected $name = 'appbox_agent';
    // 自动写入时间戳字段
    protected $autoWriteTimestamp = false;
    // 定义时间戳字段名
    protected $createTime = 'createTime';

    public function getInfo($channelCode)
    {
        return $this->get(['channelCode' => $channelCode]);
        // if(!$info){
        //     $info = [
        //         'channelCode' => '',
        //         'status' => 1,
        //         'price' => 2.2,
        //         'deduction' => 0.3,
        //         'apk_url' => ''
        //     ];
        // }
    }

    public function list($page=1,$limit=20)
    {
        return $this->limit($limit)->page($page)->order("createTime desc")->select();
    }
}