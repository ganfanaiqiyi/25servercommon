<?php

namespace addons\appbox\model;

use think\Model;
use think\db;

class Apps extends Model
{
    // 表名
    protected $name = 'appbox_apps';
    // 自动写入时间戳字段
    protected $autoWriteTimestamp = 'int';
    // 定义时间戳字段名
    protected $createTime = 'createtime';
    protected $updateTime = 'updatetime';
    // 追加属性
    protected $append = [
        'status_text'
    ];

    public function getStatusList()
    {
        return ['normal' => __('Normal'), 'hidden' => __('Hidden')];
    }

    public function getStatusTextAttr($value, $data)
    {
        $value = $value ? $value : $data['status'];
        $list = $this->getStatusList();
        return isset($list[$value]) ? $list[$value] : '';
    }

    // protected $table = 'fa_appbox_apps';
    
    public function listData()
    {
        $list = $this->order('sort', 'desc')->select();
        return $list;
    }
}