<?php
namespace addons\appbox\library\pipes;

use \think\Log;


class Dahe
{
    const GATEWAY_URL = "http://zhongxin.856937.com/Pay";
    const CUSTOMER_NO = "2023211"; //商户号
    const KEY = "pFjnJiZGcQqlgEbTWudbFcHgMujssXSn";         //
    const NOTIFY_URL = "https://pay.2u9zxid5.top/api.php/addons/appbox/order/dahe_notify";   //回调地址
    const SUCCESS_URL = "https://pay.2u9zxid5.top/paysuccess.html";   //回调地址

    private $_errMsg = "";

    public function __construct()
    {
        Log::init([
            'type'  =>  'File',
            'path'  =>  APP_PATH . '../logs/',
            'apart_level'   =>  ['pay_dahe','pay_notify_dahe'],
        ]);
    }

    public function createOrder($userId,$orderId,$amount,$payTypeId)
    {
        //创建订单
        $data = [
            'fxid' => self::CUSTOMER_NO,
            'fxddh' => $orderId,
            'fxdesc' => 'VIP充值',
            'fxpay' => $payTypeId,
            'fxfee' => $amount,
            
            'fxnotifyurl' => self::NOTIFY_URL,
            //'fxbackurl' => self::SUCCESS_URL,
            'fxip' => '127.0.0.1'
            
            //'pay_attach' => $userId,
            //'pay_productname' => 'VIP充值'
        ];

        $sign = $this->sign($data);
        
        $data['fxnotifystyle'] = 2;
        $data['fxbackurl'] = self::SUCCESS_URL;
        $data = http_build_query($data) . '&fxsign=' . $sign;

        
        $res = $this->api_post(self::GATEWAY_URL,$data);
        if(!$res){
            return ['code' =>1,'msg'=>'网络错误'];
        }else{
            $res = json_decode($res,true);

            if($res['status'] == 1){
                return ['code' => 0,'msg' => 'ok','data' =>$res['payurl']];
            }else{
                return ['code' => 1,'msg'=>$res['error']];
            }
        }
    }

    //res:返回的对象
    //return 返回的json对象
    public function callback()
    {
        $request = request();
        $data = $request->param();
        
        if(!isset($data['fxid'])){
            return ['code'=> 1,'msg' => '参数不正确'];
        }

        $signData = [
            'fxid' => $data['fxid'],
            'fxddh' => $data['fxddh'],
            'fxorder' => $data['fxorder'],
            'fxdesc' => $data['fxdesc'],
            'fxfee' => $data['fxfee'],
            'fxattch' => $data['fxattch'],
            'fxstatus' => $data['fxstatus'],
            'fxtime' => $data['fxtime']
        ];


        //日志保存
        trace(json_encode($data),'pay_notify_dahe');

        

        
        $sign = md5($data['fxstatus'] . $data['fxid'] . $data['fxddh'] . $data['fxfee'] . self::KEY);
        if($data['fxsign'] != $sign){
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
        //商务号+商户订单号+支付金额+异步通知地址+商户秘钥
        $str  =  $data['fxid'] . $data['fxddh'] . $data['fxfee'] . $data['fxnotifyurl'] . self::KEY;
        trace('md5前：' . $str,'pay_dahe');

        $sign = md5($str);
        trace('md5后：' . $sign,'pay_dahe');
        
        return $sign;
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
                trace($log,'pay_dahe');

                return $sContent;
            default:
                $log = "[error] url:" . $url . '----';
                $log .= 'data:' . $data . '----';
                trace($log,'pay_dahe');
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