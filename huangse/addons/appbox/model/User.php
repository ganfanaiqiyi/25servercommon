<?php

namespace addons\appbox\model;

use think\Model;
use think\db;
use app\common\model\User as UserModel;
use addons\appbox\model\TryseeTime;

class User extends UserModel
{
    public function infoData($uid)
    {
        //$info = cache('userinfo_' . $uid);
        //if(!$info){
            $info = $this->get(['id'=>$uid]);

            //c109渠道返回永久会员
            // if($info['agentid'] == 80){
            //     $info['vip_start_time'] = time();
            //     $info['vip_end_time'] = 4092599349;   //2099-09-09 09:09:09
            // }else{
        
                $userVip = new UserVip();
                $vipData = $userVip->info($uid);
                $info['vip_start_time'] = $vipData['startTime'];
                $info['vip_end_time'] = $vipData['endTime'];
            //}

            cache('userinfo_' . $uid,$info);
        //}

        

        // //todo:临时修改为试看时间内为VIP
        // $tryseeTime = new TryseeTime();
        // $tryseeStartTime = $tryseeTime->setStartTime($info['deviceid']);

        // if((int)$info['vip_end_time'] <= time()){   //非会员
        //     if((time()-$tryseeStartTime) < 600){
        //         $info['vip_start_time'] = $tryseeStartTime;
        //         $info['vip_end_time'] = strtotime('+600 seconds',$tryseeStartTime);
        //     }
        // }

        

        //所有非会员全部返回会员状态，临时
        // if((int)$info['vip_end_time'] <= time()){   //非会员
        //     $info['vip_end_time'] = strtotime('+1 day',time());
        // }

        // //todo:临时放这
        // if((int)$info['vip_end_time'] <= time()){   //非会员
        //     //新设备赠送1天会员
        //     $deviceFirstUserInfo = $this->get(['deviceid' => $info['deviceid']]);
        //     if((time() - $deviceFirstUserInfo['createtime']) < 600){
        //         //赠送24小时会员
        //         $info['vip_end_time'] = strtotime('+600 seconds',$deviceFirstUserInfo['createtime']);
        //     }
        // }

        
        return $info;
    }

    //有VIP优先(因旧规则同设备存在多个用户)
    public function getInfoByDeviceId($deviceId)
    {
        //todo:暂时返回第一个
        $info = $this->get(['deviceid' => $deviceId]);
        if($info){
            return $this->infoData($info['id']);
        }else{
            return false;
        }

        $list = db('user')
            ->alias('a')
            ->join('appbox_user_vip b','a.id=b.uid','LEFT')
            ->field('a.*,b.uid')
            ->where(['a.deviceid' => $deviceId])
            ->order('a.id desc')
            ->select();
        
        if(count($list) == 0){
            return false;
        }

        foreach($list as $item){
            
            if($item['uid'] != NULL){
                return $this->infoData($item['id']);
                //return $item;
            }
        }

        return $this->infoData($list[0]['id']);
    }

    public function updateLastLogin($uid)
    {
        $userinfo = $this->get(['id' => $uid]);
        if(!$userinfo){
            return false;
        }

        $prevtime = $userinfo['logintime'];


        $this->update([
            'prevtime' => $prevtime,
            'logintime' => time()
        ],['id' => $uid]);
        
        return true;
    }

    public function modifyUsername($uid, $username)
    {
        $userinfo = $this->get(['username' => $username]);
        if($userinfo){
            return false;
        }

        $this->update([
            'username' => $username
        ],['id' => $uid]);
        
        return true;
    }

    public function resetPassword($username,$answer)
    {

    }
    
    public function setTodayFirstLoginTime($id,$todayfirstlogintime)
    {
        $today = strtotime(date('Y-m-d',time()));
        $firstdate = strtotime(date('Y-m-d',$todayfirstlogintime));

        if($firstdate == $today) return false;

        $time = time();
        $this->update([
            'todayfirstlogintime' => $time
        ],['id' => $id]);
        return $time;
    }
}