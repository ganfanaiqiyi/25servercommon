<?php
namespace addons\appbox\library\pipes;

use \think\Log;


class Xinghui
{
    const GATEWAY_URL = "http://39.104.24.35:56780/";
    const CUSTOMER_NO = "20000025"; //商户号
    const KEY = "F4P3P2FZDKLOHTRLMTRKW5SNWSTPPDRNQYV3AKPCJX3JNGVG23ZRVTBQJG2PK9BTROXHHEGHXLS9JDLVWJLCPI53GYWKDIJCMO0ZMFENHNT2JXKKKPPI0QFPYZAR8XPX";         //
    const NOTIFY_URL = "https://pay.2u9zxid5.top/api.php/addons/appbox/order/xinghui_notify";   //回调地址
    const SUCCESS_URL = "https://pay.2u9zxid5.top/paysuccess.html";   //回调地址

    private $_errMsg = "";

    public function __construct()
    {
        Log::init([
            'type'  =>  'File',
            'path'  =>  APP_PATH . '../logs/',
            'apart_level'   =>  ['pay_xinghui','pay_notify_xinghui'],
        ]);
    }

    public function createOrder($userId,$orderId,$amount,$payTypeId)
    {
        //创建订单
        $data = [
            'mchId' => self::CUSTOMER_NO,
            'productId' => $payTypeId,
            'mchOrderNo' => $orderId,
            'amount' => $amount * 100,
            'currency' => 'cny',
            //'clientIp' => '127.0.0.1',
            'notifyUrl' => self::NOTIFY_URL,
            'returnUrl' => self::SUCCESS_URL,
            'subject' => 'VIP充值',
            'body' => 'VIP充值',
            'reqTime' => date('Ymdhis'),
            'version' => '1.0'
        ];

        $sign = $this->sign($data);
        $data = http_build_query($data) . '&sign=' . $sign;

        
        $res = $this->api_post(self::GATEWAY_URL . 'api/pay/create_order',$data);
        if(!$res){
            return ['code' =>1,'msg'=>'网络错误'];
        }else{
            $res = json_decode($res,true);

            if($res['retCode'] == 0){
                return ['code' => 0,'msg' => 'ok','data' => $res['payJumpUrl']];
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
        trace(json_encode($data),'pay_notify_xinghui');

        $signData = [
            'payOrderId' => $this->getValue($data,'payOrderId'),
            'mchId' => $this->getValue($data,'mchId'),
            'productId' => $this->getValue($data,'productId'),
            'mchOrderNo' => $this->getValue($data,'mchOrderNo'),
            'amount' => $this->getValue($data,'amount'),
            'income' => $this->getValue($data,'income'),
            'status' => $this->getValue($data,'status'),
            'paySuccTime' => $this->getValue($data,'paySuccTime'),
            'backType' => $this->getValue($data,'backType'),
            'reqTime' => $this->getValue($data,'reqTime')
        ];

        

        

        
        $sign = $this->sign($signData);
        if($data['sign'] != $sign){
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

        trace('md5前：' . $str,'pay_xinghui');
        trace('md5后：' . strtoupper(md5($str)),'pay_xinghui');

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
                trace($log,'pay_xinghui');

                return $sContent;
            default:
                $log = "[error] url:" . $url . '----';
                $log .= 'data:' . $data . '----';
                trace($log,'pay_xinghui');
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