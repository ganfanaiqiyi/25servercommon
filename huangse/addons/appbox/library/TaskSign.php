<?php
namespace addons\appbox\library;

use think\Cache;

class TaskSign
{
    public function isSign($uid)
    {
        $key = $this->getkey($uid);
        $flag = Cache::store('redis')->get($key);
        if($flag===false){
            return false;
        }else{
            return true;
        }
    }

    public function doSign($uid)
    {
        $key = $this->getkey($uid);
        Cache::store('redis')->set($key, time(), 86400);
    }

    private function getKey($uid)
    {
        $d = date("Y_m_d",time());
        $key = 'tasksign_' . $d . '_' . $uid;
        return $key;
    }
}