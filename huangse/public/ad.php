<?php
//此入口只允许广告跳转页访问
$tmp = $_SERVER['HTTP_HOST'];
$tmp = substr($tmp,0,2);
if($tmp != 'a.'){
    exit();
}
// +----------------------------------------------------------------------
// | ThinkPHP [ WE CAN DO IT JUST THINK ]
// +----------------------------------------------------------------------
// | Copyright (c) 2006-2016 http://thinkphp.cn All rights reserved.
// +----------------------------------------------------------------------
// | Licensed ( http://www.apache.org/licenses/LICENSE-2.0 )
// +----------------------------------------------------------------------
// | Author: liu21st <liu21st@gmail.com>
// +----------------------------------------------------------------------
// [ 应用入口文件 ]
// 定义应用目录
define('APP_PATH', __DIR__ . '/../application/');
define('APPBOX_ADDONS_PATH', __DIR__ . '/../addons/appbox/');
define('LOG_PATH', APP_PATH . '../logs/');
define('TEMPLATE_PATH', __DIR__ . '/../public/template/');

// 判断是否安装
if (!is_file(APP_PATH . 'admin/command/Install/install.lock')) {
    header("location:./install.php");
    exit;
}

// 加载框架引导文件
require __DIR__ . '/../thinkphp/start.php';
