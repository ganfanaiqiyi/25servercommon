<?php
namespace addons\appbox\library\pipes;

use \think\Log;


class Noname
{
    const GATEWAY_URL = "https://tk.tczajy.com";
    const CUSTOMER_NO = "225"; //商户号
    const KEY = "47529c6b533db07163595cb85af33a74";         //
    const NOTIFY_URL = "https://pay.2u9zxid5.top/api.php/addons/appbox/order/nn_notify";   //回调地址
    const SUCCESS_URL = "http://www.dongpiandi.app/paysuccess.html";   //回调地址

    private $_errMsg = "";

    public function __construct()
    {
        Log::init([
            'type'  =>  'File',
            'path'  =>  APP_PATH . '../logs/',
            'apart_level'   =>  ['pay_noname','pay_notify_noname'],
        ]);
    }

    public function createOrder($userId,$orderId,$amount,$payTypeId)
    {
        //创建订单
        $data = [
            'channel' => self::CUSTOMER_NO,
            'type' => $payTypeId,
            'orderno' => $orderId,
            'notifyurl' => self::NOTIFY_URL,
            'callback_url' => self::SUCCESS_URL,
            'money' => $amount*100,
            'attach' => $userId
        ];

        $sign = $this->sign($data);
        //$data['attach'] = $userId;
        //$data['pay_productname'] = 'VIP充值';
        $data = http_build_query($data) . '&sign=' . $sign;

        
        $res = $this->api_post(self::GATEWAY_URL . '/gate/take_order.do',$data);
        if(!$res){
            return ['code' =>1,'msg'=>'网络错误'];
        }else{
            $res = json_decode($res,true);

            if($res['result']){
                return ['code' => 0,'msg' => 'ok','data' =>$res['data']['pay_url']];
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
            'th_orderno' => $data['th_orderno'],
            'orderno' => $data['orderno'],
            'notifyurl' => $data['notifyurl'],
            'order_money' => $data['order_money'],
            'payed_money' => $data['payed_money'],
            'channel' => $data['channel'],
            'attach' => $data['attach'],
        ];


        //日志保存
        trace(json_encode($data),'pay_notify_noname');

        // $postSign = '';
        // if(isset($data['sign'])){
        //     $postSign = $data['sign'];
        //     unset($data['sign']);
        // }

        // if(isset($data['attach'])){
        //     unset($data['attach']);
        // }
        

        // $memberid = $this->request->post('memberid');
        // $orderid = $this->request->post('orderid');
        // $amount = $this->request->post('amount');
        // $transaction_id = $this->request->post('transaction_id');
        // $datetime = $this->request->post('datetime');
        // $returncode = $this->request->post('returncode');
        // $attach = $this->request->post('attach');
        // $sign = $this->request->post('sign');

        // if($data['returncode'] != '00'){
        //     return ['code'=> 1,'msg' => '格式不正确'];
        // }
        
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

        trace('md5前：' . $str,'pay_noname');
        trace('md5后：' . strtoupper(md5($str)),'pay_noname');

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
                trace($log,'pay_noname');

                return $sContent;
            default:
                $log = "[error] url:" . $url . '----';
                $log .= 'data:' . $data . '----';
                trace($log,'pay_noname');
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