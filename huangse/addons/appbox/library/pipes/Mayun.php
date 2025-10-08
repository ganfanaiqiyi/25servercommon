<?php
namespace addons\appbox\library\pipes;

use \think\Log;

class mayun
{
    const GATEWAY_URL = "http://pay.mayunzf.cfd";
    const CUSTOMER_NO = 10001; //商户号
    const KEY = "BGA2SIXYIYP2XEAAS70WUUOTW6VYLQG7VESJQFTLJULT6QPEPJ05VJZOJVMGTBW0DXKVFA4AYRMXHQBFMNORYKCWBS8DACHA1URH2AMM2NQIO3VS673HEYXIRCATI7PQ";         
    const NOTIFY_URL = "https://pay.2u9zxid5.top/api.php/addons/appbox/order/mayun_notify";   //回调地址
    const SUCCESS_URL = "http://www.dongpiandi.app/paysuccess.html";   //回调地址

    private $_errMsg = "";

    public function __construct()
    {
        Log::init([
            'type'  =>  'File',
            'path'  =>  APP_PATH . '../logs/',
            'apart_level'   =>  ['pay_mayun','pay_notify_mayun'],
        ]);
    }

    public function createOrder($userId,$orderId,$amount,$payTypeId)
    {
        //创建订单
        $data = [
            'mchId' => self::CUSTOMER_NO,
            'productId' => $payTypeId,
            'mchOrderNo' => $orderId,
            'amount' => $amount * 100,//订单金额(单位:元,最多保留两位小数)
            'notifyUrl' => self::NOTIFY_URL
        ];
        trace(json_encode($data),'pay_notify_mayun');

        $sign = $this->sign($data);
        $data['sign'] = $sign;

        $res = $this->api_post2(self::GATEWAY_URL . '/api/pay/create_order',$data);
        if(!$res){
            return ['code' =>1,'msg'=>'网络错误'];
        }else{
            $res = json_decode($res,true);
            
            if($res['retCode'] == 'SUCCESS'){
                return ['code' => 0,'msg' => 'ok','data' => $res['payParams']['payUrl']];
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
        trace(json_encode($data),'pay_notify_mayun');

        $signData = [
            'payOrderId' => $this->getValue($data,'payOrderId'),
            'mchId' => $this->getValue($data,'mchId'),
            'productId' => $this->getValue($data,'productId'),
            'mchOrderNo' => $this->getValue($data,'mchOrderNo'),
            'amount' => $this->getValue($data,'amount'),
            'status' => $this->getValue($data,'status'),
            'paySuccTime' => $this->getValue($data,'paySuccTime')
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

        trace('md5前：' . $str,'pay_mayun');
        trace('md5后：' . strtoupper(md5($str)),'pay_mayun');

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
                trace($log,'pay_mayun');

                return $sContent;
            default:
                $log = "[error] url:" . $url . '----';
                $log .= 'data:' . json_encode($data) . '----';
                trace($log,'pay_mayun');
                return false;
        }

    }

    protected function api_post2($url, $data)
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
                trace($log,'pay_mayun');

                return $sContent;
            default:
                $log = "[error] url:" . $url . '----';
                $log .= 'data:' . json_encode($data) . '----';
                trace($log,'pay_mayun');
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