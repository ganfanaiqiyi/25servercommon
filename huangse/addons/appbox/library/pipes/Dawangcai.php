<?php
namespace addons\appbox\library\pipes;

use \think\Log;


class Dawangcai
{
    const GATEWAY_URL = "https://api.wangcai688.xyz/";
    const CUSTOMER_NO = "lvjuren888"; //商户号
    
    const NOTIFY_URL = "https://pay.2u9zxid5.top/api.php/addons/appbox/order/dawangcai_notify";   //回调地址
    const SUCCESS_URL = "https://pay.2u9zxid5.top/paysuccess.html";   //回调地址

    private $_errMsg = "";
    private $KEY;        //
    public function __construct()
    {
        Log::init([
            'type'  =>  'File',
            'path'  =>  APP_PATH . '../logs/',
            'apart_level'   =>  ['pay_dawangcai','pay_notify_dawangcai'],
        ]);
    }

    public function createOrder($userId,$orderId,$amount,$payTypeId)
    {
        $this->KEY = $payTypeId == 92?"BB2A9C58306739DC95F06ABDB3515614":"BB2A9C58306739DC95F06ABDB3515614";
        //创建订单
        $data = [
            'merchantId' => $payTypeId == 92?"lvjuren888":"lvjuren888",
            'orderNo' => $orderId,
            'money' => $amount,
            'timeSpan' => $this->millisecondWay(),
            'callBackUrl' => self::NOTIFY_URL,
            "accountName" => md5(microtime(true)),
            "ip" => '127.0.0.1',
            "productName" => 'VIP充值',
            'productId' => $payTypeId,
            'returnUrl' => self::SUCCESS_URL
        ];

        $sign = $this->sign($data);
        $data['sign'] = $sign;
        $data = json_encode($data);

        //$data = http_build_query($data) . '&sign=' . $sign;

        
        $res = $this->api_post(self::GATEWAY_URL . 'api/commonpay/pay',$data);
        if(!$res){
            return ['code' =>1,'msg'=>'网络错误'];
        }else{
            $res = json_decode($res,true);

            if($res['state'] === 0){
                return ['code' => 0,'msg' => 'ok','data' => $res['data']];
            }else{
                return ['code' => 1,'msg'=>$res['message']];
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
        trace(json_encode($data),'pay_notify_dawangcai');

        $signData = [
            'state' => $data['state'],
            'payState' => $data['payState'],
            'message' => $data['message'],
            'data' => $data['data'],
            'merchantId' => $data['merchantId'],
            'timeSpan' => $data['timeSpan'],
            'orderNo' => $data['orderNo'],
            'money' => $data['money'],
            'platOrderNo' => $data['platOrderNo']
        ];
        return ['code' => 0, 'msg'=>'','data' => $data];
        // $sign = $this->sign($signData);
        // if($data['sign'] != $sign){
        //     return ['code'=> 1,'msg' => 'sign验证不通过' . $sign];
        // }else{
        //     return ['code' => 0, 'msg'=>'','data' => $data];
        // }
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
        $str .= "&key=" . $this->KEY;

        trace('md5前：' . $str,'pay_dawangcai');
        trace('md5后：' . strtoupper(md5($str)),'pay_dawangcai');

        return strtoupper(md5($str));
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
        curl_setopt($oCurl, CURLOPT_HTTPHEADER, array(
            'Content-Type: application/json',
            'Content-Length: ' . strlen($data))
        );

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
                trace($log,'pay_dawangcai');

                return $sContent;
            default:
                $log = "[error] url:" . $url . '----';
                $log .= 'data:' . $data . '----';
                trace($log,'pay_dawangcai');
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