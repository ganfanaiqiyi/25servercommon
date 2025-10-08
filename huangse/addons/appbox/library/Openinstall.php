<?php
namespace addons\appbox\library;

class Openinstall
{
    const BASE_URL = "https://data.openinstall.io/";
    const API_KEY = "f59db96790107fd77ebd13ff78758c129cee4ecee792e8a1a3243a03";

    const APP_ID = '1388318918';    //获得所有渠道数据用,可在OP渠道报表页抓包获取
    const LOGINED_COOKIES = '_t_token_=3897315086923506938; u_token=7441869167710145363;';

    public function alive_status()
    {
        $url = 'https://d-api.openinstall.io/cgi/channel/events/list';
        $map = [
            't' => time(),
            'page'=> 0,
            'appId'=> self::APP_ID,
            'pageSize'=>  10,
            'sortField'=>  'createTime',
            'asc'=>  false,
            'startTime'=>  '',
            'endTime'=>  '',
            'platform'=> '',
            'eventIds[]'=> '',
            'type'=>  'h5',
            'search'=> ''
        ];

        $p = http_build_query($map);

        $url .= '?' . $p;

        //echo $url;exit();

        $res = $this->op_ajax_get($url);
    }

    //特殊方法，通过渠道报表ajax获得数据，无需登录状态
    public function all_data($startTime,$endTime)
    {
        $startTime = str_replace('-','/',$startTime);
        $endTime = str_replace('-','/',$endTime);

        $url = 'https://d-api.openinstall.io/cgi/channel/events/list';
        $map = [
            't' => time(),
            'page'=> 0,
            'appId'=> self::APP_ID,
            'pageSize'=>  1000,
            'sortField'=>  'createTime',
            'asc'=>  false,
            'startTime'=>  $startTime,
            'endTime'=>  $endTime,
            'platform'=> '',
            'eventIds[]'=> '',
            'type'=>  'h5',
            'search'=> ''
        ];

        $p = http_build_query($map);

        $url .= '?' . $p;

        //echo $url;exit();

        $res = $this->op_ajax_get($url);
        if(!$res){
            return false;
        }
        //echo $res;exit();
        $res = json_decode($res,true);
        

        if($res['code'] != 0 || empty($res['body'])){
            return false;
        }

        $dict = [];
        foreach($res['body']['page']['rows'] as $item){
            $values = [];
            foreach($res['body']['events'] as $k=>$event){
                $values[$event[0]] = $item['values'][$k];
            }
            
            $dict[$item['channelCode']] = $values;
            //array_push($rows,$row);
        }

        // $rows = [];
        // foreach($res['body']['page']['rows'] as $item){
        //     $row = [
        //         'channelCode' => $item['channelCode'],
        //     ];
        //     $values = [];
        //     foreach($res['body']['events'] as $k=>$event){
        //         $values[$event[0]] = $item['values'][$k];
        //     }
        //     $row['values'] = $values;
        //     array_push($rows,$row);
        // }
        return $dict;
    }

    //op登录状态专用
    protected function op_ajax_get($url)
    {
        
        $headers = [
            'cookie:' . self::LOGINED_COOKIES
        ];

        $oCurl = curl_init($url);
        curl_setopt_array($oCurl, array(
            // CURLOPT_POST => 1,
            // CURLOPT_POSTFIELDS => json_encode($data),
            CURLOPT_HTTPHEADER => $headers,
            CURLOPT_RETURNTRANSFER => true
        ));

        //curl_setopt($oCurl, CURLOPT_PROXY, '127.0.0.1:8888');

        

        $sContent = curl_exec($oCurl);
        $aStatus = curl_getinfo($oCurl);
        $err = curl_error($oCurl);
        curl_close($oCurl);

        switch (intval($aStatus["http_code"])) {
            case 200:
            case 400:
                return $sContent;
            default:
                return false;
        }
    }

    public function channelAdd($channelCode,$channelName)
    {
        $url = self::BASE_URL . "data/channel/add";
        $query = [
            'apiKey' => self::API_KEY,
            'channelCode' => $channelCode,
            'channelName' => $channelName,
            // 'customURL' => '',
            // 'groupName' => '',
            'allowChild' => 1,
            // 'sharePrivate' => '',
            // 'sharePassword' => ''
        ];
        $url = $url . '?' . http_build_query($query);

        return $this->api_get($url);
    }

    public function channelGet($channelCode)
    {
        $url = self::BASE_URL . "data/channel/get";
        $query = [
            'apiKey' => self::API_KEY,
            'channelCode' => $channelCode
        ];
        $url = $url . '?' . http_build_query($query);
        
        return $this->api_get($url);
    }

    protected function api_get($url)
    {
        $oCurl = curl_init();
        if (stripos($url, "https://") !== FALSE) {
            curl_setopt($oCurl, CURLOPT_SSL_VERIFYPEER, FALSE);
            curl_setopt($oCurl, CURLOPT_SSL_VERIFYHOST, FALSE);
        }
        curl_setopt($oCurl, CURLOPT_URL, $url);
        curl_setopt($oCurl, CURLOPT_RETURNTRANSFER, 1);

        //curl_setopt($oCurl,CURLOPT_PROXY,'127.0.0.1:8888');

        $sContent = curl_exec($oCurl);
        $aStatus = curl_getinfo($oCurl);
        curl_close($oCurl);


        switch (intval($aStatus["http_code"])) {
            case 200:
            case 400:
                return json_decode($sContent);
            default:
                return false;
        }
    }
}