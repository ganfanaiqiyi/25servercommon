<?php
namespace addons\appbox\library\pipes;

use \think\Log;


class Epay
{
    const GATEWAY_URL = "https://pay.epaynb.com";
    const CUSTOMER_NO = "20000035"; //商户号
    const APP_ID = "ce057b043f3a462e83fc4233ea8d3389";
    const KEY = "CBXBKOHSIHS0OBZWJR8YZR6DWB9FSRY8DUZQJXAVEL3XFCWHJLRGJMODFIU0RGLWBCZT4MQMNL0H74AMUJIB39BZ92WJZ5GRYEPSBWN2AZY7TT2JEPLQMPJJ5VDDUOVM";         //
    const NOTIFY_URL = "https://pay.2u9zxid5.top/api.php/addons/appbox/order/epay_notify";   //回调地址
    const SUCCESS_URL = "http://www.dongpiandi.app/paysuccess.html";   //回调地址

    private $_errMsg = "";

    public function __construct()
    {
        Log::init([
            'type'  =>  'File',
            'path'  =>  APP_PATH . '../logs/',
            'apart_level'   =>  ['pay_epay','pay_notify_epay'],
        ]);
    }

    public function createOrder($userId,$orderId,$amount,$payTypeId)
    {
        //创建订单
        $data = [
            'mchId' => self::CUSTOMER_NO,
            'appId' => self::APP_ID,
            'productId' => $payTypeId,
            'mchOrderNo' => $orderId,
            'currency' => 'cny',
            'amount' => $amount * 100,
            
            'notifyUrl' => self::NOTIFY_URL,
            //'callback_url' => self::SUCCESS_URL,
            
            //'pay_attach' => $userId,
            'subject' => 'VIP充值',
            'body' => 'VIP充值',
            //'reqTime' => date('Y-m-d H:i:s'),
            'signType' => 1
        ];

        $sign = $this->sign($data);
        //$data['pay_attach'] = $userId;
        //$data['pay_productname'] = 'VIP充值';
        $data = http_build_query($data) . '&sign=' . $sign;

        
        $res = $this->api_post(self::GATEWAY_URL . '/api/pay/create_order',$data);
        if(!$res){
            return ['code' =>1,'msg'=>'网络错误'];
        }else{
            $res = json_decode($res,true);

            if($res['retCode'] == 'SUCCESS'){
                return ['code' => 0,'msg' => 'ok','data' =>$res['payParams']['payUrl']];
            }else{
                return ['code' => 1,'msg'=>$res['retMsg']];
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
        trace(json_encode($data),'pay_notify_epay');

        $signData = [
            'income' => $data['income'],
            'mchId' => $data['mchId'],
            'payOrderId' => $data['payOrderId'],
            'productId' => $data['productId'],
            'appId' => $data['appId'],
            'mchOrderNo' => $data['mchOrderNo'],
            //'channelOrderNo' => $data['channelOrderNo'],
            'amount' => $data['amount'],
            'status' => $data['status'],
            //'paySuccTime' => $data['paySuccTime'],
            'backType' => $data['backType'],
            //'reqTime' => $data['reqTime'],
        ];

        if(isset($data['channelOrderNo']) && !empty($data['channelOrderNo'])){
            $signData['channelOrderNo'] = $data['channelOrderNo'];
        }

        if(isset($data['paySuccTime']) && !empty($data['paySuccTime'])){
            $signData['paySuccTime'] = $data['paySuccTime'];
        }

        if(isset($data['backType']) && !empty($data['backType'])){
            $signData['backType'] = $data['backType'];
        }

        

        
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
        $str .= "&key=" . self::KEY;

        trace('md5前：' . $str,'pay_epay');
        trace('md5后：' . strtoupper(md5($str)),'pay_epay');

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
                trace($log,'pay_epay');

                return $sContent;
            default:
                $log = "[error] url:" . $url . '----';
                $log .= 'data:' . $data . '----';
                trace($log,'pay_epay');
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

    private function getArrayValue($arr,$name)
    {

    }
}