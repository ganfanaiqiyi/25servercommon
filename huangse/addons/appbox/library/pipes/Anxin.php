<?php
namespace addons\appbox\library\pipes;

use \think\Log;


class Anxin
{
    const GATEWAY_URL = "http://pay.anxinf.club";
    const CUSTOMER_NO = "10146"; //商户号
    const KEY = "C5HPIIEDCNI1INX0OAR0CBLPURB43CUTSCH39O2PNVYQTXV59SNNCOWURZ7QXRNFFPVMH9Z7UDQIWXBH3CVMYS2FA2DVGDWOW1DXBRHNJMYCTBKROSVMJ5CTTJNP118M";         //
    const NOTIFY_URL = "https://pay.2u9zxid5.top/api.php/addons/appbox/order/anxin_notify";   //回调地址
    const SUCCESS_URL = "https://pay.2u9zxid5.top/paysuccess.html";   //回调地址

    private $_errMsg = "";

    public function __construct()
    {
        Log::init([
            'type'  =>  'File',
            'path'  =>  APP_PATH . '../logs/',
            'apart_level'   =>  ['pay_anxin','pay_notify_anxin'],
        ]);
    }

    public function createOrder($userId,$orderId,$amount,$payTypeId)
    {
        //创建订单
        $data = [
            'mchId' => self::CUSTOMER_NO,
            'productId' => $payTypeId,
            'amount' => $amount * 100,
            'mchOrderNo' => $orderId,
            'notifyUrl' => self::NOTIFY_URL,
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
                return ['code' => 0,'msg' => 'ok','data' => $res['payParams']['payUrl']];
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
            'mchId' => $data['mchId'],  // 本渠道系统分配的商户号
            'payOrderId' => $data['payOrderId'],// 本渠道系统的订单号
            'productId' => $data['productId'],  // 支付产品ID
            'mchOrderNo' => $data['mchOrderNo'],    // 商户生成并上传的订单号
            'amount' => $data['amount'],    // 支付金额,单位分
            'status' => $data['status'],    //支付状态,0-订单生成,1-支付中,2-支付成功,3-业务处理完成
            'paySuccTime' => $data['paySuccTime'],  //精确到毫秒
        ];

        //日志保存
        trace(json_encode($data),'pay_notify_anxin');

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

        trace('md5前：' . $str,'pay_anxin');
        trace('md5后：' . strtoupper(md5($str)),'pay_anxin');

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
                trace($log,'pay_anxin');

                return $sContent;
            default:
                $log = "[error] url:" . $url . '----';
                $log .= 'data:' . $data . '----';
                trace($log,'pay_anxin');
                return false;
        }

    }


}