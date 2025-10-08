<?php

namespace addons\appbox\model;

use think\Model;
use think\db;
use think\Config;
use think\Cache;

class Task extends Model
{
    // 表名
    protected $name = 'appbox_task_list';
    
    // 自动写入时间戳字段
    protected $autoWriteTimestamp = false;
}