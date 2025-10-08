<?php

namespace addons\appbox\controller;

//use think\addons\Controller;
use fast\Random;
use app\common\controller\Api;
use addons\appbox\model\User;
use think\Log;

class Base extends Api
{
    const AES_KEY = "tvPTuQsMrZwEsrojLdNgj3Eq34rHQtiD";
    const IS_DEV = false;

    protected $_params = [];
    
    public function __construct()
    {
        parent::__construct();
        $this->_params = $this->params();
    }

    //解密并获得参数集合
    protected function params()
    {        
        if (strpos($this->request->server('CONTENT_TYPE'), 'application/x-www-form-urlencoded') === false) {
            return [];
        }

        $data = $_POST["data"];
        
        if (!$data) {
            return [];
        }

        if(self::IS_DEV){
            return json_decode($data, true);
        }

        $data = openssl_decrypt(base64_decode($data), 'AES-256-CBC', self::AES_KEY, OPENSSL_RAW_DATA, substr(md5(self::AES_KEY), 0, 16));

        if (!$data) {
            return [];
        }

        $data = json_decode($data, true);
        // Log::init([
        //     'type'  =>  'File',
        //     'path'  =>  APP_PATH . '../logs/',
        //     'apart_level'   =>  ['post'],
        // ]);
        // trace(json_encode($data), 'post');
        return $data;
    }

    protected function getParam($name)
    {
        if (isset($this->_params[$name])) {
            return $this->_params[$name];
        } else {
            return "";
        }
    }

    //重写成功返回
    protected function success($msg = '', $data = null, $code = 1, $type = null, array $header = [])
    {
        if(self::IS_DEV){
            return parent::success($msg, $data, $code, $type, $header);
        }
        $d = $data;
        if (isset($data)) {
            $d = openssl_encrypt(json_encode($data), 'AES-256-CBC', self::AES_KEY, OPENSSL_RAW_DATA, substr(md5(self::AES_KEY), 0, 16));
            $d = base64_encode($d);
        }
        return parent::success($msg, $d, $code, $type, $header);
    }

    //重写错误返回
    protected function error($msg = '', $data = null, $code = 0, $type = null, array $header = [])
    {
        $d = $data;
        if (isset($data)) {
            $d = openssl_encrypt(json_encode($data), 'AES-256-CBC', self::AES_KEY, OPENSSL_RAW_DATA, substr(md5(self::AES_KEY), 0, 16)); 
            $d = base64_encode($d);
        }

        return parent::error($msg, $data, $code, $type, $header);
    }

    //创建用户并登录
    protected function createRandomUser($deviceid,$agentId=0)
    {
        $username = millisecondWay();
        $password = Random::alnum();

        //获取IP，兼容cf
        //$ip =  isset($_SERVER['HTTP_CF_CONNECTING_IP']) ? $_SERVER['HTTP_CF_CONNECTING_IP'] : $_SERVER['REMOTE_ADDR'];

        //真实IP
        $ip = request()->ip();
        if(isset($_SERVER['HTTP_X_REAL_IP'])){
            $ip = $_SERVER['HTTP_X_REAL_IP'];
        }

        $res = $this->auth->register($username, $password, '', '', ['deviceid' => $deviceid,'agentid' => $agentId]);
        if (!$res) {
            //$errMsg = $this->auth->getError();
            //return $this->error("注册失败！");
            return false;
        } else {
            return true;
        }
    }
}
