<?php
namespace addons\appbox\model;

use think\Model;
use think\db;

class FeedBack extends Model
{
    // 表名
    protected $name = 'appbox_feedback';

    // 自动写入时间戳字段
    protected $autoWriteTimestamp = 'int';

    protected $createTime = 'createTime';

    public function listData($where,$page,$limit)
    {
        return $this->where($where)->limit($limit)->page($page)->select();
    }
}