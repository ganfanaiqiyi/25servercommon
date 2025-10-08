<?php

namespace addons\appbox\model;

use think\Model;
use think\db;

class ShabiSms extends Model
{
    // 表名
    protected $name = 'appbox_shabi_sms';
    // 自动写入时间戳字段
    protected $autoWriteTimestamp = false;
    // 定义时间戳字段名
    protected $createTime = 'createTime';

    public function list($page=1,$limit=20)
    {
        return $this->limit($limit)->page($page)->order("createTime desc")->select();
    }
}