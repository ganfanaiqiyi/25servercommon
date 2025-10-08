<?php
//限制api.*以外的域名访问
// $tmp = $_SERVER['HTTP_HOST'];
// $tmp = substr($tmp,0,4);
// $tmp2 = substr($tmp,0,7);
// if($tmp != 'api.'){
//     exit();
// }else if($tmp2 != 'newapi.'){
//     exit();
// }

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

// 判断是否安装
if (!is_file(APP_PATH . 'admin/command/Install/install.lock')) {
    header("location:./install.php");
    exit;
}

// 加载框架引导文件
require __DIR__ . '/../thinkphp/start.php';
