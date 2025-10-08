<?php
namespace addons\appbox\controller;

use addons\appbox\controller\Base;
use app\common\controller\Api;
use addons\appbox\library\ChannelTrack as ChannelTrackLib;

class Channeltrack extends Api
{
    protected $noNeedLogin = '*';
    protected $noNeedRight = '*';

    public function track()
    {
        header('Access-Control-Allow-Origin:*');
        
        $channelCode = $this->request->param('channelCode');

        if(!isset($channelCode)){
            return $this->error('渠道代码不能为空');
            //return $this->success('ok')
        }
        
        //真实IP
        $ip = request()->ip();
        if(isset($_SERVER['HTTP_X_REAL_IP'])){
            $ip = $_SERVER['HTTP_X_REAL_IP'];    
        }
       

        $channelTrack = new ChannelTrackLib();
        $channelTrack->setItem($ip,$channelCode);
        //echo $channelTrack->getItem($ip);

        // $info = db('appbox_channel_track')->find($ip);
        // if(!$info){
        //     db('appbox_channel_track')->insert([
        //         'ip' => $ip,
        //         'channelCode' => $channelCode
        //     ]);
        // }else{
        //     db('appbox_channel_track')->update([
        //         'channelCode' => $channelCode
        //     ],['ip' => $ip]);
        // }

        $isDeduction = false;

        $info = model('addons\appbox\model\Agent')->get(['channelCode' => $channelCode]);
        if($info){
            //扣量按随机（不增加数据）
            $rnd = mt_rand(1,100);
            if($rnd <= $info['deduction'] * 100){
                $isDeduction = true;
            }
        }

        

        return $this->success('ok',$isDeduction);
    }

    public function getData()
    {
        $ip = $this->request->param('ip');
        if (empty($ip)) {
            return $this->error('参数错误');
        }
        $channelTrack = new ChannelTrackLib();

        $channelCode = $channelTrack->getItem($ip);
        if (empty($channelCode)) {
            return $this->error('数据不存在', null, 404);
        } else {
            return $this->success('ok', $channelCode);
        }
    }
}