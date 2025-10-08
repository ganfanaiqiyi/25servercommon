<?php

namespace app\admin\command;

use think\addons\AddonException;
use think\addons\Service;
use think\Config;
use think\console\Command;
use think\console\Input;
use think\console\input\Option;
use think\console\Output;
use think\Db;
use think\Exception;
use think\exception\PDOException;

/**
 * php think LoginIns > ./logs/LoginIns.txt
 */

class LoginIns extends Command
{

    protected function configure()
    {
        $this
            ->setName('LoginIns')
            ->setDescription('每隔12个小时登录ins');
    }

    protected function execute(Input $input, Output $output)
    {
        // 输出到日志文件
        $output->writeln("Command:" . $input);
        // 定时器需要执行的内容
        $output->writeln(date("Y-m-d H:i:s") . "--start-- \r\n ");

        $output->writeln("Command:" . $input);

        $insKEY = "0XxdjmI55ZjjqQLO3nI7gGqrBP0Vz9jS";
        $insIV = "RWf23muavY";
        $insSuffix = "NWSdef";
        $time = time() * 1000;
        $username = "xuhuichen123";
        $password = "adminshabi";
        $encode_sign = md5("device=1&password=" . $password . "&site=1&timestamp=" . $time . "&username=" . $username . "&NRkw0g3iJLDvw5tJ5PuVt5276z0SOuyL");
        $postData = [
            "device" => 1,
            "site" => 1,
            "username" => $username,
            "password" => $password,
            "timestamp" => $time,
            "encode_sign" => $encode_sign
        ];

        $d = $postData;
        $d = openssl_encrypt(json_encode($postData), 'AES-256-CBC', $insKEY, OPENSSL_RAW_DATA, $insIV . $insSuffix);
        $d = base64_encode($d);
        // $postData = base64_encode(openssl_encrypt(json_encode($postData), 'AES-256-CBC', $insKEY, OPENSSL_RAW_DATA, $insIV));

        $url = "https://insav.tv/api/user/login";

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
                if (!$sContent) {
                    $output->writeln("login error!!!!!!!!!!!!!!!!!!!");
                    return;
                }
                $resData = json_decode($sContent, true);
                $insData = openssl_decrypt(base64_decode($resData['data']), 'AES-256-CBC', $insKEY, OPENSSL_RAW_DATA, $insIV . $resData['suffix']);
                $insData = json_decode($insData, true);
                if ($insData['code'] == 1 && $insData['data'] && $insData['data']["token"]) {
                    redisDB()->set("INS_TOKEN", $insData['data']['token'], 86400);
                    $output->writeln("set success:" .  $insData['data']['token']);
                } else {
                    $output->writeln("set error:" . $insData['msg']);
                }
                break;
            default:
                $output->writeln("set error:" . $err);
                return $err;
        }
    }
}
