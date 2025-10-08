<?php
namespace addons\appbox\model;

use think\Model;
use think\db;

class VipCode extends Model
{
    // 表名
    protected $name = 'appbox_vip_code';
    protected $pk = 'key';

    public function setUseStatus($key, $uid)
    {
        $this->update([
            'uid' => $uid,
            'status'=>1,
            'updateTime' => time()
        ],['key'=>$key]);
    }

    //$value: 1d,1w,1m,1y
    public function createCode($title,$value,$source='')
    {
        //内置一些期限
        $values = [
            '1d' => '+1 day',
            '1w' => '+1 week',
            '1m' => '+1 month',
            '1y' => '+1 year'
        ];

        if(!isset($values[$value])){
            return false;
        }


        $key = '';
        while(true){
            $key = $this->bulidKey();
            $info = $this->get(['key' => $key]);
            if(!$info){
                break;
            }
        }

        $now = time();

        $this->insert([
            'key' => $key,
            'source' => $source,
            'status' => 0,
            'title' => $title,
            'value' => $values[$value],
            'uid' => 0,
            'createTime' => $now,
            'updateTime' => $now,
            'expiryTime' => $now+31536000   //一年
        ]);

        return $key;
    }

    protected function bulidKey()
    {
        $str = "0123456789QWERTYUIOPASDFGHJKLZXCVBNM";
        return substr( str_shuffle($str) , 0 , 8  );
    }
}