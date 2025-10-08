<?php
namespace addons\appbox\model;

use think\Model;

class CrackApps extends Model
{
    // 表名
    protected $name = 'appbox_crack_apps';

    // 自动写入时间戳字段
    protected $autoWriteTimestamp = false;

    public function getStatusList()
    {
        return ['normal' => __('Normal'), 'hidden' => __('Hidden')];
    }
}