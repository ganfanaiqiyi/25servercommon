<?php
namespace addons\appbox\library\pipes;

use \think\Log;


class Shangshun
{
    const GATEWAY_URL = "http://8.219.177.22/?c=pay";
    const CUSTOMER_NO = "ysapp01"; //商户号
    const KEY = "f4731c11efc2efecc227bf03f1757b45fac6b0ff";         //
    const NOTIFY_URL = "https://pay.2u9zxid5.top/api.php/addons/appbox/order/shangshun_notify";   //回调地址
    const SUCCESS_URL = "http://www.dongpiandi.app/paysuccess.html";   //回调地址

    private $_errMsg = "";

    public function __construct()
    {
        Log::init([
            'type'  =>  'File',
            'path'  =>  APP_PATH . '../logs/',
            'apart_level'   =>  ['pay_shangshun','pay_notify_shangshun'],
        ]);
    }

    public function createOrder($userId,$orderId,$amount,$payTypeId)
    {
        //创建订单
        $data = [
            'mch_id' => self::CUSTOMER_NO,
            'ptype' => $payTypeId,
            'from_name' => '',
            'order_sn' => $orderId,
            'money' => $amount,
            'goods_desc' => '',
            'client_ip' => '127.0.0.1',
            'format' =>  'json',
            'notify_url' => self::NOTIFY_URL,
            'pay_backurl' => self::SUCCESS_URL,
            'time' => time()
        ];

        $sign = $this->sign($data);
        $data = http_build_query($data) . '&sign=' . $sign;

        
        $res = $this->api_post(self::GATEWAY_URL,$data);
        if(!$res){
            return ['code' =>1,'msg'=>'网络错误'];
        }else{
            $res = json_decode($res,true);

            if($res['code'] == '1'){
                return ['code' => 0,'msg' => 'ok','data' => self::GATEWAY_URL . '&a=info&osn=' . $res['data']['order_sn']];
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

        $signData = [
            'sh_order' => $data['sh_order'],
            'pt_order' => $data['pt_order'],
            'money' => $data['money'],
            'time' => $data['time'],
            'status' => $data['status']
        ];

        //日志保存
        trace(json_encode($data),'pay_notify_shangshun');

        
        $sign = $this->sign($signData);
        if($data['sign'] != strtolower($sign)){
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

        trace('md5前：' . $str,'pay_shangshun');
        trace('md5后：' . strtoupper(md5($str)),'pay_shangshun');

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
                trace($log,'pay_shangshun');

                return $sContent;
            default:
                $log = "[error] url:" . $url . '----';
                $log .= 'data:' . $data . '----';
                trace($log,'pay_shangshun');
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