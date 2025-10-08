<?php
namespace addons\appbox\model;

use think\Model;
use think\db;

class UserVip extends Model
{
    // 表名
    protected $name = 'appbox_user_vip';
    protected $pk = 'uid';

    public function vipLog($uid,$duration='',$remark,$operator='system')
    {
        db('appbox_user_vip_log')->insert([
            'uid' => $uid,
            'duration' => $duration,
            'remark' => $remark,
            'operator' => $operator,
            'createTime' => time()
        ]);
    }
    
    public function info($uid)
    {
        //查询VIP表
        $vipData = $this->get(['uid'=>$uid]);
        
        if($vipData){
            return $vipData;
        }else{
            return [
                'uid' => $uid,
                'startTime' => 0,
                'endTime' => 0
            ];
        }
    }

    //增加会员过期时长，注意第2个参数，参数格式参考 strtotime("+1 day",$now)
    public function renew($uid,$datetime)
    {
        $now = time();
        
        $vipData = $this->get(['uid'=>$uid]);
        if(!$vipData){
            $this->insert([
                'uid' => $uid,
                'startTime' => $now,
                'endTime' => strtotime($datetime,$now)
            ]);
        }else{
            if($vipData['endTime'] >= $now){
                $this->where(['uid'=>$uid])->update([
                    'endTime' => strtotime($datetime,$vipData['endTime'])
                ]);
            }else{
                $this->where(['uid'=>$uid])->update([
                    'startTime' => $now,
                    'endTime' => strtotime($datetime, $now)
                ]);
            }
        }
    }
    
    // public function renew($uid,$day)
    // {
    //     $now = time();
        
    //     $vipData = $this->get(['uid'=>$uid]);
    //     if(!$vipData){
    //         $this->insert([
    //             'uid' => $uid,
    //             'startTime' => $now,
    //             'endTime' => strtotime("+" . $day . " day",$now)
    //         ]);
    //     }else{
    //         if($vipData['endTime'] >= $now){
    //             $this->where(['uid'=>$uid])->update([
    //                 'endTime' => strtotime("+" . $day . " day",$vipData['endTime'])
    //             ]);
    //         }else{
    //             $this->where(['uid'=>$uid])->update([
    //                 'startTime' => $now,
    //                 'endTime' => strtotime("+" . $day . " day", $now)
    //             ]);
    //         }
    //     }
    // }
}