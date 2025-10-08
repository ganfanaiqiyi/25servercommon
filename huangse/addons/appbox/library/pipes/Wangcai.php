<?php
namespace addons\appbox\library\pipes;

use \think\Log;


class Wangcai
{
    const GATEWAY_URL = "http://wc.wangcaizf888.cyou/";
    const APP_KEY = "a0342e9887ee66de2ce479051a4a633b";
    const APP_SECRET = "6b63e4c76dbd19c9071484b24ac2e6ae";         //
    const NOTIFY_URL = "https://pay.2u9zxid5.top/api.php/addons/appbox/order/wangcai_notify";   //回调地址
    const SUCCESS_URL = "http://www.dongpiandi.app/paysuccess.html";   //回调地址

    private $_errMsg = "";

    public function __construct()
    {
        Log::init([
            'type'  =>  'File',
            'path'  =>  APP_PATH . '../logs/',
            'apart_level'   =>  ['pay_wangcai','pay_notify_wangcai'],
        ]);
    }

    public function createOrder($userId,$orderId,$amount,$payTypeId)
    {
        //创建订单
        $data = [
            'otn' => $orderId,
            'app_key' => self::APP_KEY,
            //'app_secret' => self::APP_SECRET,
            'price' => $amount,
            'code' => $payTypeId,
            'notify_url' => self::NOTIFY_URL,
            'rand_r' => md5(microtime(true)),
            'order_time' => time()
        ];

        $sign = $this->sign($data);
        $data = http_build_query($data) . '&sign=' . $sign;

        
        $res = $this->api_post(self::GATEWAY_URL . 'api/open/CreateOrder',$data);
        if(!$res){
            return ['code' =>1,'msg'=>'网络错误'];
        }else{
            $res = json_decode($res,true);

            if($res['code'] == 200){
                return ['code' => 0,'msg' => 'ok','data' => $res['data']['url']];
            }else{
                return ['code' => 1,'msg'=>$res['msg']];
            }
        }
    }

    //res:返回的对象
    //return 返回的json对象
    public function callback()
    {
        $request = request();
        $data = $request->param();

        //日志保存
        trace(json_encode($data),'pay_notify_wangcai');

        $signData = [
            'otn' => $data['otn'],
            'code' => $data['code'],
            'state' => $data['state'],
            'rand_r' => $data['rand_r'],
            'app_key' => $data['app_key'],
            'channel_id' => $data['channel_id'],
            'create_time' => $data['create_time'],
            'trade_price' => $data['trade_price'],
            'channel_rate' => $data['channel_rate'],
            'supplier_otn' => $data['supplier_otn'],
        ];

        // if(isset($data['paySuccTime']) && !empty($data['paySuccTime'])){
        //     $signData['paySuccTime'] = $data['paySuccTime'];
        // }

        

        
        $sign = $this->sign($signData);
        if($data['sign'] != $sign){
            return ['code'=> 1,'msg' => 'sign验证不通过' . $sign];
        }else{
            return ['code' => 0, 'msg'=>'','data' => $data];
        }
    }

    public function getError()
    {
        return $this->_errMsg;
    }

    private function sign($data)
    {
        ksort($data);
        reset($data);
        $str = http_build_query($data);
        $str = urldecode($str);
        $str .= "&app_secret=" . self::APP_SECRET;

        trace('md5前：' . $str,'pay_wangcai');
        trace('md5后：' . strtoupper(md5($str)),'pay_wangcai');

        return md5($str);
    }

    protected function api_post($url, $data)
    {
        $oCurl = curl_init();
        if (stripos($url, "https://") !== FALSE) {
            curl_setopt($oCurl, CURLOPT_SSL_VERIFYPEER, FALSE);
            curl_setopt($oCurl, CURLOPT_SSL_VERIFYHOST, FALSE);
        }

        curl_setopt($oCurl, CURLOPT_POST, 1);
        curl_setopt($oCurl, CURLOPT_URL, $url);
        curl_setopt($oCurl, CURLOPT_POSTFIELDS, $data);
        curl_setopt($oCurl, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($oCurl, CURLOPT_TIMEOUT, 60);          //单位 秒
        // curl_setopt(
        //     $oCurl,
        //     CURLOPT_HTTPHEADER,
        //     $this->createApiHeader()
        // );

        //curl_setopt($oCurl, CURLOPT_PROXY, '127.0.0.1:8888');

        $sContent = curl_exec($oCurl);
        $aStatus = curl_getinfo($oCurl);
        $err = curl_error($oCurl);
        curl_close($oCurl);

        switch (intval($aStatus["http_code"])) {
            case 200:
            case 400:
                $log = "url:" . $url . '----';
                $log .= 'data:' . $data . '----';
                $log .= 'response:' . $sContent;
                trace($log,'pay_wangcai');

                return $sContent;
            default:
                $log = "[error] url:" . $url . '----';
                $log .= 'data:' . $data . '----';
                trace($log,'pay_wangcai');
                return false;
        }

    }

    /**
     * 获取一个毫秒级的时间戳 13位
     * 1604563860556
     * @return void
     */
    private function millisecondWay()
    {
        list($s1, $s2) = explode(' ', microtime());
        return (float)sprintf('%.0f', (floatval($s1) + floatval($s2)) * 1000);
    }
}