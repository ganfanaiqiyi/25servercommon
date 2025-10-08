<?php
namespace addons\appbox\library\pipes;

use \think\Log;

class Star
{
    const GATEWAY_URL = "https://mapi.daxingxing168.xyz/api/commonpay/pay";
    const CUSTOMER_NO = "zoul300"; //商户号
    const KEY = "B7C5F09C816B2FBE40421AA15386848E";         //
    const CUSTOMER_CALLBACK_URL = "https://pay.2u9zxid5.top/api.php/addons/appbox/order/callback2";   //回调地址
    const SUCCESS_URL = "https://www.dongpiandi.app/paysuccess.html";   //回调地址

    private $_errMsg = "";

    public function __construct()
    {
        Log::init([
            'type'  =>  'File',
            'path'  =>  APP_PATH . '../logs/',
            'apart_level'   =>  ['pay','pay_notify_star'],
        ]);

        
    }

    public function createOrder($userId,$orderId,$amount,$payTypeId)
    {
        //创建订单
        $data = [
            'timeSpan' => $this->millisecondWay(),
            'accountName' => $userId,
            'merchantId' => self::CUSTOMER_NO,
            'productId' => $payTypeId,
            'money' => $amount,
            'orderNo' => $orderId,
            'callBackUrl' => self::CUSTOMER_CALLBACK_URL,
            'ip' => '127.0.0.1',
            'productName' => '购买VIP',
            'returnUrl' => self::SUCCESS_URL
        ];

        $sign = $this->sign($data);
        $data['sign'] = $sign;
        $data = json_encode($data);

        $res = $this->api_post(self::GATEWAY_URL,$data);
        if(!$res){
            return ['code' =>1,'msg'=>'网络错误'];
        }else{
            $res = json_decode($res,true);

            if($res['state'] == 0){
                return ['code' => 0,'msg' => 'ok','data' =>$res['data']];
            }else{
                return ['code' => 1,'msg'=>$res['message']];
            }
        }
    }

    //res:返回的对象
    //return 返回的json对象
    public function callback()
    {
        $data = file_get_contents("php://input");
        trace($data,'pay_notify_star');

        $data = json_decode($data,true);

        if(!isset($data['state'])){
            return ['code'=> 1,'msg' => '格式不正确'];
        }
        if($data['state'] != 0){
            return ['code'=> 1,'msg' => '请求失败'];
        }
        

        //验证sign
        $p = [
            'state' => $data['state'],
            'payState' =>$data['payState'],
            'message' =>$data['message'],
            'data' => $data['data'],
            'merchantId' =>$data['merchantId'],
            'timeSpan' =>$data['timeSpan'],
            'orderNo' =>$data['orderNo'],
            'money' =>$data['money'],
            'platOrderNo' =>$data['platOrderNo']
        ];
        $sign = $this->sign($p);
        if($data['sign'] != $sign){
            return ['code'=> 1,'msg' => 'sign验证不通过'];
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
        $str .= "&key=" . self::KEY;
        
        trace('md5前：' . $str,'pay');
        trace('md5后：' . strtoupper(md5($str)),'pay');

        return strtoupper(md5($str));
    }

    //json格式
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

        curl_setopt($oCurl, CURLOPT_HTTPHEADER, array(
            'Content-Type: application/json',
            'Content-Length: ' . strlen($data))
        );

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
                trace($log,'pay');

                return $sContent;
            default:
                $log = "[error] url:" . $url . '----';
                $log .= 'data:' . $data . '----';
                trace($log,'pay');
                return false;
        }

        // if (intval($aStatus["http_code"]) == 200) {
        //     return $sContent;
        // } else {
        //     return false;
        // }
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