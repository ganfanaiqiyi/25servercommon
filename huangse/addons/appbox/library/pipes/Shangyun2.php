<?php
namespace addons\appbox\library\pipes;

use \think\Log;


class Shangyun2
{
    const GATEWAY_URL = "http://shangyunmon-api.meisuobudamiya.com";
    const CUSTOMER_NO = "4e2fe1ec2effab659ac54244"; //商户号
    const KEY = "676690726aA984f8ff1e0C1665D967f6918BD89a";         //
    const NOTIFY_URL = "https://pay.2u9zxid5.top/api.php/addons/appbox/order/shangyun2_notify";   //回调地址
    const SUCCESS_URL = "https://pay.2u9zxid5.top/paysuccess.html";   //回调地址

    private $_errMsg = "";

    public function __construct()
    {
        Log::init([
            'type'  =>  'File',
            'path'  =>  APP_PATH . '../logs/',
            'apart_level'   =>  ['pay_shangyun2','pay_notify_shangyun2'],
        ]);
    }

    public function createOrder($userId,$orderId,$amount,$payTypeId)
    {
        //创建订单
        $data = [
            'app_id' => self::CUSTOMER_NO,
            'product_id' => $payTypeId,
            'amount' => $amount,
            'out_trade_no' => $orderId,
            'notify_url' => self::NOTIFY_URL,
            "time"=>time(),
            "desc"=>"vip",
        ];


        $sign = $this->sign($data);
        //$data['pay_attach'] = $userId;
        //$data['pay_productname'] = 'VIP充值';
        $data = http_build_query($data) . '&sign=' . $sign;

        
        $res = $this->api_post(self::GATEWAY_URL . '/api/order',$data);
        if(!$res){
            return ['code' =>1,'msg'=>'网络错误'];
        }else{
            $res = json_decode($res,true);

            if($res['code'] == '200'){
                return ['code' => 0,'msg' => 'ok','data' => $res['data']['url']];
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

        $signData = array(
            "trade_no"  =>  $data["trade_no"],
            "product_id"=>  $data["product_id"],
            "app_id"    =>  $data["app_id"],
            "out_trade_no"=>    $data["out_trade_no"],
            "trade_status"=>    $data["trade_status"],
            "amount"    =>  $data["amount"],
            "real_amount"=> $data["real_amount"],
            "desc"  =>  $data['desc'],
            "time"  =>  $data["time"],
        );

        //日志保存
        trace(json_encode($data),'pay_notify_shangyun2');

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

        trace('md5前：' . $str,'pay_shangyun2');
        trace('md5后：' . strtolower(md5($str)),'pay_shangyun2');

        return strtolower(md5($str));
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
                trace($log,'pay_shangyun2');

                return $sContent;
            default:
                $log = "[error] url:" . $url . '----';
                $log .= 'data:' . $data . '----';
                trace($log,'pay_shangyun2');
                return false;
        }

    }


}