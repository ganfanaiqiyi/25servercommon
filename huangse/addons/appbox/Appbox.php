<?php

namespace addons\appbox;

use app\common\library\Menu;
use think\Addons;

/**
 * 插件
 */
class Appbox extends Addons
{

    /**
     * 插件安装方法
     * @return bool
     */
    public function install()
    {
        // $menu = [
        //     [
        //         'name'    => 'appbox',
        //         'title'   => '应用盒子',
        //         'icon'    => 'fa fa-map-marker',
        //         'sublist' => [
        //             ["name"  => "appbox/index","title" => "列表"],
        //             ["name"  => "signin/add","title" => "添加"],
        //             ["name"  => "signin/edit","title" => "编辑"],
        //             ["name"  => "signin/del","title" => "删除"],
        //             ["name"  => "signin/multi","title" => "批量更新"],
        //         ]
        //     ]
        // ];
        // Menu::create($menu);

        return true;
    }

    /**
     * 插件卸载方法
     * @return bool
     */
    public function uninstall()
    {

        return true;
    }

    /**
     * 插件启用方法
     * @return bool
     */
    public function enable()
    {

        return true;
    }

    /**
     * 插件禁用方法
     * @return bool
     */
    public function disable()
    {

        return true;
    }

    /**
     * 应用初始化
     */
    public function appInit()
    {
        //\think\Loader::addNamespace('addons\mydemo\library\pipes', ADDON_PATH . 'appbox' . DS . 'library' . DS . 'pipes' . DS . 'Alipay');
    }
}
