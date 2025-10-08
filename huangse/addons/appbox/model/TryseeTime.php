<?php

namespace addons\appbox\model;

use think\Model;
use think\db;

class TryseeTime extends Model
{
    protected $name = 'appbox_tryseetime';

    //不存在就添加，返回当日首次设置时间
    public function setStartTime($deviceId)
    {
        $res = $this->get([
            'id' => $deviceId
        ]);

        $now = time();

        if (!$res) {
            $this->insert([
                'id' => $deviceId,
                'starttime' => $now
            ]);
            return $now;
        }else{
            $today = strtotime(date('Y-m-d',$now));
            $starttime = strtotime(date('Y-m-d',$res['starttime']));

            if($starttime == $today){
                return $res['starttime'];
            }else{
                $this->update([
                    'starttime' => $now
                ],['id'=>$deviceId]);
                return $now;
            }
        }
    }
}
