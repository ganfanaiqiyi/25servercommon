<?php
namespace addons\appbox\library\pipes;

use \think\Log;


class Guagua
{
    const GATEWAY_URL = "http://rfbseviekzlmamu7arwo.itxt002.xyz";
    const CUSTOMER_NO = "M200049"; //商户号
    const KEY = "b5199f42b4c1f159f63e5925d2a393c2";         //
    const NOTIFY_URL = "https://api.4f1e9hvb.top/api.php/addons/appbox/order/guagua_notify";   //回调地址
    const SUCCESS_URL = "https://api.4f1e9hvb.top/paysuccess.html";   //回调地址

    private $_errMsg = "";

    public function __construct()
    {
        Log::init([
            'type'  =>  'File',
            'path'  =>  APP_PATH . '../logs/',
            'apart_level'   =>  ['pay_guagua','pay_notify_guagua'],
        ]);
    }

    public function createOrder($userId,$orderId,$amount,$payTypeId)
    {
        //创建订单
        $data = [
            'mid' => self::CUSTOMER_NO,
            'merOrderTid' => $orderId,
            'money' => $amount,
            'channelCode' => intval($payTypeId),
            'notifyUrl' => self::NOTIFY_URL
        ];

        $sign = $this->sign($data);
        $data['sign'] = $sign;
        // $data = json_encode($data);

        $data = http_build_query($data) ;

        
        $res = $this->api_post2(self::GATEWAY_URL . '/api/services/app/Api_PayOrder/CreateOrderPay',$data);
        if(!$res){
            return ['code' =>1,'msg'=>'网络错误'];
        }else{
            $res = json_decode($res,true);

            if($res['status'] === 0){
                return ['code' => 0,'msg' => 'ok','data' => $res['result']['payUrl']];
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
        trace(json_encode($data),'pay_notify_guagua');
        $signData = [
            'merOrderTid' => $data['merOrderTid'],
            'tid' => $data['tid'],
            'money' => $data['money'],
            'status' => $data['status'],
            // 'sign' => $data['sign']
        ];

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
        $str .= "&" . self::KEY;

        trace('md5前：' . $str,'pay_guagua');
        trace('md5后：' . strtoupper(md5($str)),'pay_guagua');

        return strtoupper(md5($str));
    }

    protected function api_post2($url, $data)
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
                trace($log,'pay_guagua');

                return $sContent;
            default:
                $log = "[error] url:" . $url . '----';
                $log .= 'data:' . $data . '----';
                $log .= 'response:' . $sContent;
                trace($log,'pay_guagua');
                return false;
        }


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
                trace($log,'pay_guagua');

                return $sContent;
            default:
                $log = "[error] url:" . $url . '----';
                $log .= 'data:' . $data . '----';
                trace($log,'pay_guagua');
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