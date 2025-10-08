<?php

namespace addons\appbox\controller;

use addons\appbox\controller\Base;
use addons\appbox\model\FeedBack;
use addons\appbox\model\User;
use addons\appbox\model\UserVip;
use addons\appbox\model\VipCode;
use addons\appbox\model\Agent;
use addons\appbox\model\Ads;
use addons\appbox\model\Apps;
use addons\appbox\model\Crackapp;
use addons\appbox\model\AgentStatistics;
use addons\appbox\model\TryseeTime;
use app\common\model\ScoreLog;
use addons\appbox\model\Promotion;
//use addons\appbox\library\ChannelTrack as ChannelTrackLib;
use think\Config;
use think\Request;
use think\Lang;
use think\Log;
use think\Cache;

class Test extends Base
{
    protected $noNeedLogin = ['test1'];
    protected $noNeedRight = '*';

    protected $config = [];

    public function __construct()
    {
        Lang::load(APPBOX_ADDONS_PATH . "lang/zh-cn/Api.php");

        $this->config = config('appConfig');
        parent::__construct();
    }

    public function test()
    {
        $insKEY = "0XxdjmI55ZjjqQLO3nI7gGqrBP0Vz9jS";
        $insIV = "RWf23muavY";
        $insSuffix = "NWSdef";
        $time = time() * 1000;
        $username = "shabi123321";
        $password = "shabi123";
        $encode_sign = md5("device=1&password=".$password."&site=1&timestamp=" . $time . "&username=".$username."&NRkw0g3iJLDvw5tJ5PuVt5276z0SOuyL");
        $postData = [
            "device" => 1,
            "site" => 1,
            "username"=>$username,
            "password"=>$password,
            "timestamp" => $time,
            "encode_sign" => $encode_sign
        ];

        $d = $postData;
        $d = openssl_encrypt(json_encode($postData), 'AES-256-CBC', $insKEY, OPENSSL_RAW_DATA, $insIV . $insSuffix);
        $d = base64_encode($d);
        // $postData = base64_encode(openssl_encrypt(json_encode($postData), 'AES-256-CBC', $insKEY, OPENSSL_RAW_DATA, $insIV));

        $url = "https://dm.wcyz328.com/api/user/login";

        $oCurl = curl_init();
        if (stripos($url, "https://") !== FALSE) {
            curl_setopt($oCurl, CURLOPT_SSL_VERIFYPEER, FALSE);
            curl_setopt($oCurl, CURLOPT_SSL_VERIFYHOST, FALSE);
        }

        $data = [
            "post-data" => $d
        ];
        curl_setopt($oCurl, CURLOPT_POST, 1);
        curl_setopt($oCurl, CURLOPT_URL, $url);
        curl_setopt($oCurl, CURLOPT_POSTFIELDS, json_encode($data));
        curl_setopt($oCurl, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($oCurl, CURLOPT_TIMEOUT, 60);          //单位 秒
        $headers = [
            'Suffix: NWSdef',
            'Content-Type: application/json',
        ];
        curl_setopt($oCurl, CURLOPT_HTTPHEADER, $headers);
        $sContent = curl_exec($oCurl);
        $aStatus = curl_getinfo($oCurl);
        $err = curl_error($oCurl);
        curl_close($oCurl);

        switch (intval($aStatus["http_code"])) {
            case 200:
            case 400:
                $resData = json_decode($sContent, true);
                $insData = openssl_decrypt(base64_decode($resData['data']), 'AES-256-CBC', $insKEY, OPENSSL_RAW_DATA, $insIV . $resData['suffix']);
                $insData = json_decode($insData, true);
                var_dump($insData);
                return;
                if ($insData['code'] == 1) {
                    foreach ($insData['data'] as $key => $value) {
                        if($insData['data']){
                            // redisDB()->set("INS_TOKEN",$insData['data']['token'],86400);
                        }
                    }
                } else {
                    // $output->writeln("set error:" . $insData['msg']);
                }
                break;
            default:
                // $output->writeln("set error:" . $err);
                return $err;
        }
    }
}
