<?php
namespace addons\appbox\library\pipes;

use \think\Log;

class Lvxiaoer
{
    const GATEWAY_URL = "http://47.236.100.90:8089";
    const CUSTOMER_NO = "M1721556123951646"; //商户号
    const KEY = "6e403891ab6e4851bba59146ca17cbb3";         
    const NOTIFY_URL = "https://pay.2u9zxid5.top/api.php/addons/appbox/order/lvxiaoer_notify";   //回调地址
    const SUCCESS_URL = "https://pay.2u9zxid5.top/paysuccess.html";   //回调地址

    private $_errMsg = "";

    public function __construct()
    {
        Log::init([
            'type'  =>  'File',
            'path'  =>  APP_PATH . '../logs/',
            'apart_level'   =>  ['pay_lvxiaoer','pay_notify_lvxiaoer'],
        ]);
    }

    public function createOrder($userId,$orderId,$amount,$payTypeId)
    {
        //创建订单
        $data = [
            'merchantId' => self::CUSTOMER_NO,
            'merchantPayNo' => $orderId,
            'tradeType' => $payTypeId,
            'amt' => $amount,//订单金额(单位:元,最多保留两位小数)
            'notifyUrl' => self::NOTIFY_URL,
            'goodsName' => 'VIP充值',
        ];
        trace(json_encode($data),'pay_notify_lvxiaoer');

        $sign = $this->sign($data);
        $data['sign'] = $sign;

        $res = $this->api_post(self::GATEWAY_URL . '/channel/apiPay',$data);
        if(!$res){
            return ['code' =>1,'msg'=>'网络错误'];
        }else{
            $res = json_decode($res,true);

            if($res['code'] == '0000'){
                return ['code' => 0,'msg' => 'ok','data' => $res['data']['url']];
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
        trace(json_encode($data),'pay_notify_lvxiaoer');

        $signData = [
            'payNo' => $this->getValue($data,'payNo'),
            'merchantPayNo' => $this->getValue($data,'merchantPayNo'),
            'tradeType' => $this->getValue($data,'tradeType'),
            'tradeAmt' => $this->getValue($data,'tradeAmt'),
            'fee' => $this->getValue($data,'fee'),
            'actualAmt' => $this->getValue($data,'actualAmt'),
            'tradeStatus' => $this->getValue($data,'tradeStatus')
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

        trace('md5前：' . $str,'pay_lvxiaoer');
        trace('md5后：' . strtoupper(md5($str)),'pay_lvxiaoer');

        return strtoupper(md5($str));
    }

    protected function api_post($url, $data)
    {
        $oCurl = curl_init();  // 初始化 CURL
        curl_setopt($oCurl, CURLOPT_URL, $url);  // 设置请求的 URL
        curl_setopt($oCurl, CURLOPT_POST, true);  // 设置为 POST 请求
        curl_setopt($oCurl, CURLOPT_POSTFIELDS, http_build_query($data));  // 设置 POST 请求的表单数据
        curl_setopt($oCurl, CURLOPT_RETURNTRANSFER, true);  // 返回结果而不是直接输出

        $sContent = curl_exec($oCurl);  // 执行请求并获取响应
        $aStatus = curl_getinfo($oCurl);
        curl_close($oCurl);

        switch (intval($aStatus["http_code"])) {
            case 200:
            case 400:
                $log = "url:" . $url . '----';
                $log .= 'data:' . json_encode($data) . '----';
                $log .= 'response:' . $sContent;
                trace($log,'pay_lvxiaoer');

                return $sContent;
            default:
                $log = "[error] url:" . $url . '----';
                $log .= 'data:' . json_encode($data) . '----';
                trace($log,'pay_lvxiaoer');
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