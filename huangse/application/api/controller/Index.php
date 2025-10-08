<?php

namespace app\api\controller;

use app\common\controller\Api;

/**
 * 首页接口
 */
class Index extends Api
{
    protected $noNeedLogin = ['*'];
    protected $noNeedRight = ['*'];

    /**
     * 首页
     *
     */
    public function index()
    {
        $this->success('请求成功');
    }

    public function alive_openinstall()
    {
        $op = new \addons\appbox\library\Openinstall();
        $opData = $op->alive_status();
        return 'ok';
    }
}
