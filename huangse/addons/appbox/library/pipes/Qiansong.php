<?php
namespace addons\appbox\library\pipes;

use \think\Log;

class Qiansong
{
    const GATEWAY_URL = "https://qspayzjlql79er8y.zzbbm.xyz/";
    const CUSTOMER_NO = "M1697563049"; //商户号
    const KEY = "08c21b3d2e7040d4b346e6bfd90b405b";         
    const NOTIFY_URL = "https://pay.2u9zxid5.top/api.php/addons/appbox/order/qiansong_notify";   //回调地址
    const SUCCESS_URL = "http://www.dongpiandi.app/paysuccess.html";   //回调地址

    private $_errMsg = "";

    public function __construct()
    {
        Log::init([
            'type'  =>  'File',
            'path'  =>  APP_PATH . '../logs/',
            'apart_level'   =>  ['pay_qiansong','pay_notify_qiansong'],
        ]);
    }

    public function createOrder($userId,$orderId,$amount,$payTypeId)
    {
        //创建订单
        $data = [
            'mchId' => self::CUSTOMER_NO,
            'wayCode' => $payTypeId,
            'subject' => 'VIP充值',
            'body' => 'VIP充值',
            'outTradeNo' => $orderId,
            'amount' => $amount * 100,
            'clientIp' => '127.0.0.1',
            'notifyUrl' => self::NOTIFY_URL,
            'returnUrl' => self::SUCCESS_URL,
            'reqTime' => $this->millisecondWay(),
        ];

        $sign = $this->sign($data);
        $data['sign'] = $sign;

        $res = $this->api_post(self::GATEWAY_URL . 'api/pay/unifiedorder',$data);
        if(!$res){
            return ['code' =>1,'msg'=>'网络错误'];
        }else{
            $res = json_decode($res,true);

            if($res['code'] == '0'){
                return ['code' => 0,'msg' => 'ok','data' => $res['data']['payUrl']];
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
        trace(json_encode($data),'pay_notify_qiansong');

        $signData = [
            'mchId' => $this->getValue($data,'mchId'),
            'tradeNo' => $this->getValue($data,'tradeNo'),
            'outTradeNo' => $this->getValue($data,'outTradeNo'),
            'originTradeNo' => $this->getValue($data,'originTradeNo'),
            'amount' => $this->getValue($data,'amount'),
            'subject' => $this->getValue($data,'subject'),
            'body' => $this->getValue($data,'body'),
            'state' => $this->getValue($data,'state'),
            'notifyTime' => $this->getValue($data,'notifyTime')
        ]; 
        $sign = $this->sign($signData);
        if(strtoupper($data['sign']) != $sign){
            return ['code'=> 1,'msg' => 'sign验证不通过' . $sign];
        }else{
            return ['code' => 0, 'msg'=>'','data' => $data];
        }
    }

    protected function getValue($arr_data,$name)
    {
        if(isset($arr_data[$name])){
            return $arr_data[$name];
        }else{
            return '';
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

        trace('md5前：' . $str,'pay_qiansong');
        trace('md5后：' . strtoupper(md5($str)),'pay_qiansong');

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
                trace($log,'pay_qiansong');

                return $sContent;
            default:
                $log = "[error] url:" . $url . '----';
                $log .= 'data:' . json_encode($data) . '----';
                trace($log,'pay_qiansong');
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