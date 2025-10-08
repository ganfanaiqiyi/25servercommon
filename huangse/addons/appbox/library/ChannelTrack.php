<?php
namespace addons\appbox\library;

use think\Cache;

class ChannelTrack
{
    // public function __construct()
    // {
    //     $options = [
    //         // 缓存类型为File
    //        'type'   => 'File', 
    //         // 缓存有效期为永久有效
    //        'expire' => 86400,   //24小时
    //         // 指定缓存目录
    //        'path'   => APP_PATH . '../runtime/cache/channel_track/', 
    //    ];
    //    Cache::connect($options);
    // }

    public function setItem($ip,$channelCode)
    {
        return Cache::store('redis')->set('ip_' . $ip, $channelCode, 86400);
    }

    public function getItem($ip)
    {
        return Cache::store('redis')->get('ip_' . $ip);
    }
}