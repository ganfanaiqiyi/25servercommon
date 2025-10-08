<?php
namespace addons\appbox\library\pipes;

use \think\Log;

class Nihong
{
    const GATEWAY_URL = "https://api.nihong168.com/c/payment/pay";
    const CUSTOMER_NO = "sh1656820863099"; //商户号
    const KEY = "8d6cb2cdfdb341878479251d6b2e8a2d";         //
    const CUSTOMER_CALLBACK_URL = "https://pay.2u9zxid5.top/api.php/addons/appbox/order/callback";   //回调地址

    private $_errMsg = "";

    public function __construct()
    {
        Log::init([
            'type'  =>  'File',
            'path'  =>  APP_PATH . '../logs/',
            'apart_level'   =>  ['pay','pay_notify'],
        ]);

        
    }

    public function createOrder($userId,$orderId,$amount,$payTypeId)
    {
        //创建订单
        $data = [
            'timestamp' => $this->millisecondWay(),
            'userId' => $userId,
            'customerNo' => self::CUSTOMER_NO,
            'payTypeId' => $payTypeId,
            'amount' => $amount,
            'orderNo' => $orderId,
            'customerCallbackUrl' => self::CUSTOMER_CALLBACK_URL
        ];

        $sign = $this->sign($data);
        $data = http_build_query($data) . '&sign=' . $sign;

        
        $res = $this->api_post(self::GATEWAY_URL,$data);
        if(!$res){
            return ['code' =>1,'msg'=>'网络错误'];
        }else{
            $res = json_decode($res);

            if($res->success){
                return ['code' => 0,'msg' => 'ok','data' =>$res->data->url];
            }else{
                return ['code' => 1,'msg'=>$res->message];
            }
        }
    }

    //res:返回的对象
    //return 返回的json对象
    public function callback()
    {
        $data = file_get_contents("php://input");
        trace($data,'pay_notify');

        $data = json_decode($data);

        if(!isset($data->success)){
            return ['code'=> 1,'msg' => '格式不正确'];
        }
        

        //验证sign
        $p = [
            'transactionalNumber' => $data->data->transactionalNumber,
            'orderNo' => $data->data->orderNo,
            'amount' => $data->data->amount
        ];
        $sign = $this->sign($p);
        if($data->sign != $sign){
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
        trace('md5后：' . md5($str),'pay');

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