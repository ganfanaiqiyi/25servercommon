<?php
namespace addons\agent\controller;

use addons\appbox\model\Agent as AgentModel;
use app\common\controller\Api;
use think\Request;
use think\Response;
use fast\Random;
use app\common\library\Token;

class Base extends Api
{
    protected $request;

    public function __construct(Request $request = null)
    {
        

        $this->request = is_null($request) ? Request::instance() : $request;

        check_cors_request();

        //parent::__construct();
    }

    protected function checkLogin()
    {
        $uid = input('server.HTTP_USERID');
        $token = input('server.HTTP_TOKEN');

        if (!$uid || !$token) {
            $this->err("请重新登录", 401);
        }

        $user = AgentModel::get(['id' => (int)$uid]);
        if (!$user) {
            return $this->err('代理用户不存在', 401);
        }

        if ($user->password != $token) {
            return $this->err('无效的token');
        }
    }

    protected function res($code,$msg = '',$data = null)
    {
        echo json_encode(['code' => $code,'msg' => $msg,'data' => $data]);
        exit();
        //return ['code' => $code,'msg' => $msg,'data' => $data];
    }

    protected function ok($data=null,$msg='')
    {
        return $this->res(0,$msg,$data);
    }

    protected function err($msg,$code=1,$data=null)
    {
        return $this->res($code,$msg,$data);
    }

    /**
     * 获取密码加密后的字符串
     * @param string $password 密码
     * @param string $salt     密码盐
     * @return string
     */
    protected function getEncryptPassword($password)
    {
        return md5(md5($password));
    }
}
