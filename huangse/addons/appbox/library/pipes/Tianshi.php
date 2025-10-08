<?php
namespace addons\appbox\library\pipes;

use \think\Log;


class Tianshi
{
    const GATEWAY_URL = "http://alipay.gexingkeji.top/Pay_Index.html";
    const CUSTOMER_NO = "1199"; //商户号
    const KEY = "Qq06uX13m66Q4XWcCxM5M6z44xZ2Upow";         //
    const NOTIFY_URL = "https://pay.2u9zxid5.top/api.php/addons/appbox/order/tianshi_notify";   //回调地址
    const SUCCESS_URL = "http://www.dongpiandi.app/paysuccess.html";   //回调地址

    private $_errMsg = "";

    public function __construct()
    {
        Log::init([
            'type'  =>  'File',
            'path'  =>  APP_PATH . '../logs/',
            'apart_level'   =>  ['pay_tianshi','pay_notify_tianshi'],
        ]);
    }

    public function createOrder($userId,$orderId,$amount,$payTypeId)
    {
        //创建订单
        $data = [
            'pay_memberid' => self::CUSTOMER_NO,
            'pay_orderid' => $orderId,
            'pay_applydate' => date("Y-m-d H:i:s"),
            'pay_bankcode' => $payTypeId,
            'pay_notifyurl' => self::NOTIFY_URL,
            'pay_callbackurl' => self::SUCCESS_URL,
            'pay_amount' => $amount,
            //'pay_attach' => $userId,
            //'pay_productname' => 'VIP充值'
        ];

        $sign = $this->sign($data);
        $data['pay_attach'] = $userId;
        $data['pay_productname'] = 'VIP充值';
        $data = http_build_query($data) . '&pay_md5sign=' . $sign;

        
        $res = $this->api_post(self::GATEWAY_URL,$data);
        if(!$res){
            return ['code' =>1,'msg'=>'网络错误'];
        }else{
            $res = json_decode($res,true);

            if($res['code'] == 200){
                return ['code' => 0,'msg' => 'ok','data' =>$res['data']];
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
            'pid' => $data['pid'],
            'trade_no' => $data['trade_no'],
            'out_trade_no' => $data['out_trade_no'],
            'type' => $data['type'],
            'name' => $data['name'],
            'money' => $data['money'],
            'trade_status' => $data['trade_status'],
            'sign_type' => $data['sign_type']
        ];


        //日志保存
        trace(json_encode($data),'pay_notify_tianshi');

        
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

        trace('md5前：' . $str,'pay_gexing');
        trace('md5后：' . strtoupper(md5($str)),'pay_gexing');

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
                trace($log,'pay_gexing');

                return $sContent;
            default:
                $log = "[error] url:" . $url . '----';
                $log .= 'data:' . $data . '----';
                trace($log,'pay_gexing');
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