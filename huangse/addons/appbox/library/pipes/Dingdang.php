<?php
namespace addons\appbox\library\pipes;

use \think\Log;


class Dingdang
{
    const GATEWAY_URL = "https://zfapi.ddpay1.com";
    const CUSTOMER_NO = "10072"; //商户号
    const KEY = "MTdH5DTdn4ZnJXoYKEYnqWaJyhbq0lZ4dLOLPWalgs4IMYR4MQ8vOtNN0dXUqObO";         //
    const NOTIFY_URL = "https://pay.2u9zxid5.top/api.php/addons/appbox/order/dingdang_notify";   //回调地址
    const SUCCESS_URL = "https://pay.2u9zxid5.top/paysuccess.html";   //回调地址

    private $_errMsg = "";

    public function __construct()
    {
        Log::init([
            'type'  =>  'File',
            'path'  =>  APP_PATH . '../logs/',
            'apart_level'   =>  ['pay_dingdang','pay_notify_dingdang'],
        ]);
    }

    public function createOrder($userId,$orderId,$amount,$payTypeId)
    {
        //创建订单
        $data = [
            'merchant_no' => self::CUSTOMER_NO,
            'code' => $payTypeId,
            'money' => $amount,
            'out_trade_no' => $orderId,
            'notifyurl' => self::NOTIFY_URL,
            'callbackurl' => self::NOTIFY_URL,
        ];


        $sign = $this->sign($data);
        $data = http_build_query($data) . '&sign=' . $sign;

        
        $res = $this->api_post(self::GATEWAY_URL . '/payApi/v1/zfapi/add',$data);
        if(!$res){
            return ['code' =>1,'msg'=>'网络错误'];
        }else{
            $res = json_decode($res,true);

            if($res['status'] == 'success'){
                return ['code' => 0,'msg' => 'ok','data' => $res['data']];
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

        $signData = array( // 返回字段
            "merchant_no" => $data["merchant_no"], // 商户ID
            "amount" =>  $data["amount"], // 交易金额
            "out_trade_no" =>  $data["out_trade_no"], // 订单号
            "pay_amount" =>  $data["pay_amount"], // 交易金额
            "refMsg" => $data["refMsg"],
            "success_time" => $data["success_time"],
            "refCode" => $data["refCode"],
            "transaction_no" => $data["transaction_no"],
        );

        //日志保存
        trace(json_encode($data),'pay_notify_dingdang');

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
        $str = http_build_query($data);
        $str = urldecode($str);
        $str .= "&key=" . self::KEY;

        trace('md5前：' . $str,'pay_dingdang');
        trace('md5后：' . strtoupper(md5($str)),'pay_dingdang');

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
        curl_setopt($oCurl, CURLOPT_POSTFIELDS,  $data);
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
                trace($log,'pay_dingdang');

                return $sContent;
            default:
                $log = "[error] url:" . $url . '----';
                $log .= 'data:' . $data . '----';
                trace($log,'pay_dingdang');
                return false;
        }

    }


}