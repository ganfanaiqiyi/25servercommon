<?php
namespace addons\appbox\library\pipes;

use \think\Log;


class Kuaigou
{
    const GATEWAY_URL = "https://api.fastdog.ink/";
    const CUSTOMER_NO = "UEBG6152"; //商户号
    const KEY = "QXKDEA2+FII949ESHZN/25QMK/M";         //
    const NOTIFY_URL = "https://pay.2u9zxid5.top/api.php/addons/appbox/order/kuaigou_notify";   //回调地址
    const SUCCESS_URL = "http://www.dongpiandi.app/paysuccess.html";   //回调地址

    private $_errMsg = "";

    public function __construct()
    {
        Log::init([
            'type'  =>  'File',
            'path'  =>  APP_PATH . '../logs/',
            'apart_level'   =>  ['pay_kuaigou','pay_notify_kuaigou'],
        ]);
    }

    public function createOrder($userId,$orderId,$amount,$payTypeId)
    {
        switch($payTypeId){
            case '135':
                $payType = 'ZFBPAY';
                break;
            default:
                return ['code' =>1,'msg'=>'支付编码错误'];
                break;
        }

        //创建订单
        $data = [
            'appId' => self::CUSTOMER_NO,
            'groupCode' => $payTypeId,
            'orderNo' => $orderId,
            'payType' => $payType,    //WXPAY
            'currency' => 'CNY',
            'paidFee' => $amount * 100,
            'urlMode' => '1',
            'clientIp' => '127.0.0.1',
            'deviceType' => '2',
            'remark' => '7777',
            'notifyUrl' => self::NOTIFY_URL,
            'returnUrl' => self::SUCCESS_URL
        ];

        $sign = $this->sign($data);
        $data['sign'] = $sign;
        //$data = http_build_query($data) . '&sign=' . $sign;

        
        $res = $this->api_post(self::GATEWAY_URL . 'order/create',$data);
        if(!$res){
            return ['code' =>1,'msg'=>'网络错误'];
        }else{
            $res = json_decode($res,true);

            if($res['code'] == '200'){
                return ['code' => 0,'msg' => 'ok','data' => $res['data']['payUrl']];
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
        trace(json_encode($data),'pay_notify_kuaigou');

        $signData = [
            'currency' => $data['currency'],
            'orderNo' => $data['orderNo'],
            'orderStatus' => $data['orderStatus'],
            'paidFee' => $data['paidFee'],
            //'paidTime' => $data['paidTime']
        ];

        if(isset($data['paidTime'])){
            $signData['paidTime'] = $data['paidTime'];
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

        trace('md5前：' . $str,'pay_kuaigou');
        trace('md5后：' . strtoupper(md5($str)),'pay_kuaigou');

        return strtoupper(md5($str));
    }

    protected function api_post($url, $data)
    {
        $oCurl = curl_init($url);
        $headers = array("Content-Type: application/json");
        curl_setopt_array($oCurl, array(
            CURLOPT_POST => 1,
            CURLOPT_POSTFIELDS => json_encode($data),
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
                $log = "url:" . $url . '----';
                $log .= 'data:' . json_encode($data) . '----';
                $log .= 'response:' . $sContent;
                trace($log,'pay_kuaigou');

                return $sContent;
            default:
                $log = "[error] url:" . $url . '----';
                $log .= 'data:' . json_encode($data) . '----';
                trace($log,'pay_kuaigou');
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