<?php
//【警告】此文件为APP的配置，请谨慎修改，一个标点都可能语法错误造成客户端无法正常打开

return [
    'apk_down_url' => 'https://apk.18moaa4.top:9002/18/c_1.apk',
    'ios_down_url' => 'https://www.18mo1a.top/',  //IOS端跳转地址(跳落地页) https://www.18mo1a.top/
    'res_base_url' => 'https://res.18moaa6.top:9002/', //所有静态资源所在的域名
    'ad_jump_url' =>  'https://a.18mo9k.top:9002/goa/', //'https://down.18mo6k.top:9002/goa/', //     //'https://down.18mo6k.top:9002/goa/', // 'https://down.18mo3t.top/goa/',
    "agent" => [
        'share_base_url' => 'https://www.18mo1a.top/'
    ],
    "appConfig" => [
        'apps_common' => [    //小程序用到的配置
            'video_trysee' => 600,   //视频类APP试看时长，单位(秒)，为0不开启试看
        ],
        // 'upload_task' => [
        //     'enable' => true,
        //     'minBytes' => 5000,
        //     'isCompress' => true,
        //     'minCompress' => 1024*1024,
        //     'url' =>'http://img.dev.jbwind.xyz:8892/OpenApi/UploadImg'  //'http://156.251.137.149:8083/api/index/uploadImage'    //
        // ],
        'kefu_url' => 'https://w3pk2h.com/chat/text/chat_0olp90.html', //'https://www.18mo1a.top/contact.html',   //'http://kf.18mo1.info/',
        'group_url' => 'https://t.me/+SrEQeLQHTjNiN2Jh',  //交流群地址
        'my_menu_telegram_fuli_link' => 'https://t.me/hzwrjpjvpn',  //设置下方的telegram福利菜单，为空不开启
        "theme" => [
            "statusBarStyle" => "light", //dark或light
            "backgroundImage" => "http://img.xker.com/xkerfiles/allimg/1603/1941236092-13.jpg",
        ],
        "upgrade" => [
            "lastVersion" => '1.0.7', //"1.0.7",   //最新版本
            "isMandatory" => false,       //是否强制升级
            "msg" => "1、修复多处BUG，增加稳定性<br><br>",
            "url" => "https://apk.18moaa4.top:9002/18/c_1.apk"
        ],
        'notice' => [
            'home_popup' => [
                'title' => '公告',
                //'content' => 'APP每日为非VIP提供<span style="color:red;">20</span>分钟免费试看时间APP每日为非VIP提供<span style="color:red;">20</span>分钟免费试看时间APP每日为非VIP提供<span style="color:red;">20</span>分钟免费试看时间',
                'content' => 'APP每日为非VIP提供<span style="color:red;">20</span>分钟免费试看时间APP每日为非VIP提供<span style="color:red;">20</span>分钟免费试看时间APP每日为非VIP提供<span style="color:red;">20</span>分钟免费试看时间',
                'show' => false
            ],
            'home_queue' => [
                [
                    'title'=> '精品应用（独家破解，无需二次付费，精彩！）',
                    'content' => '精品应用（独家破解，无需二次付费，精彩！）',
                    'url' => '',
                    'mode' => 'alert'   //alert:弹出modal webview:APP内部打开 browser:外部浏览器打开 navigateTo:内部地址
                ]
            ],
            'crack_queue' => [
                [
                    'title'=> '精品应用（独家破解，无需二次付费，精彩！）',
                    'content' => '精品应用（独家破解，无需二次付费，精彩！）',
                    'url' => '',
                    'mode' => 'alert'   //alert:弹出modal webview:APP内部打开 browser:外部浏览器打开 navigateTo:内部地址
                ]
            ],
            'live_queue' => [
                [
                    'title'=> '精品应用（独家破解，无需二次付费，精彩！）',
                    'content' => '精品应用（独家破解，无需二次付费，精彩！）',
                    'url' => '',
                    'mode' => 'alert'   //alert:弹出modal webview:APP内部打开 browser:外部浏览器打开 navigateTo:内部地址
                ]
            ]
        ],
        'share' => [
            'ruleText' => '分享规则：<br>
				1、新用户打开您分享的网址即可获得1天VIP。<br />
				2、新用户打开您分享的网并点击了下载APP可再获得1天VIP。<br />
				3、获得的VIP天数可无限叠加。',
            'params' => [   //参考uni.shareWithSystem(object)
                'type' => 'text',
                'summary' => '',
                'href' => 'http://127.0.0.1:8085/?channelCode=share',
                'imageUrl' => ''
            ]
        ],
        'ads' => [
            'start' => [   //开屏广告
                "show" => true,
                "autoRedirect" => true,
                'image' =>'', //'https://res.18moaa6.top:9002/user_icons/hjyx_start.jpg',   //https://res.18moaa6.top:9002/images/start1.jpg //'http://pic1.win4000.com/mobile/2020-03-17/5e70362d1a920.jpg', //'https://wx3.sinaimg.cn/mw690/003vLjNzly1gtwc51k715j62064catlu02.jpg',
                'url' =>'',  //http://552303.vip
                "time" => 5    //倒计时时间，单位秒
            ],
            'home_slide' => [   //首页幻灯片
                "show" => true,
                "height" => "38vw",
                "list" => [
                    // [
                    //     'title' => '',
                    //     'image' => 'https://res.18moaa6.top:9002/user_icons/b714-204.jpg',
                    //     'url' => 'https://b3562.com:36555',
                    //     'mode' => 1
                    // ],
                ]
            ],
            'crack_slide' => [
                "show" => true,
                "height" => "38vw",
                "list" => [
                    // [
                    //     'title' => '',
                    //     'image' => 'https://res.18moaa6.top:9002/user_icons/b714-204.jpg',
                    //     'url' => 'https://b3562.com:36555',
                    //     'mode' => 1
                    // ],
                ]
            ],
            'live_slide' => [   //首页幻灯片
                "show" => true,
                "height" => "38vw",
                "list" => [
                    // [
                    //     'title' => '',
                    //     'image' => 'https://res.18moaa6.top:9002/user_icons/b714-204.jpg',
                    //     'url' => 'https://b3562.com:36555',
                    //     'mode' => 1
                    // ],
                ]
            ],
            'live_player_float' =>[
                "show" => true,
                'image' => '',
                'width' => '120px',
                'height' => '30px',
                'url' => ''
            ],
            'apps' => [
                'home_slide' => [   //小程序的首页幻灯片
                    "show" => true,
                    "height" => "38vw",
                    "list" => [
                        // [
                        //     'title' => '',
                        //     'image' => 'https://res.18moaa6.top:9002/user_icons/b714-204.jpg',
                        //     'url' => 'https://b3562.com:36555',
                        //     'mode' => 1
                        // ],
                    ]
                ],
                "player_banner" => [
                    'show' => true,
                    // 'image' => 'https://res.18moaa6.top:9002/images/banner.png',
                    // 'url' => 'https://luo1.xyz?channel_code=OSLLA067'
                    'image' => '', //'https://res.18moaa6.top:9002/user_icons/razb_banner.jpg',
                    'url' => ''
                    
                ]
            ]
        ],
        "apps" => [
            // [
            //     "id" => "id",   //唯一ID
            //     'title' => "",  //APP显示的名称
            //     'image' => $v->icon,    //图标地址
            //     'url' => $v->url,       //小程序为下载地址，内部页面为路由路径，远程为URL
            //     'mode' => $v->self,    //0小程序，1:远程H5 2：app内置页面 3：外部链接（浏览器打开）
            //     'hot' => false,          //是否显示热门TAG
            //     'permissions' => [
            //         'type' => "normal",    //normal:无限制 vip：vip appinstall：需安装指定APP share：需分享 seetry:限制试看时间
            //         'params' => "",    //各类型的参数值，JSON
            //         'message' => "此应用需要安装APP才可使用",
            //         'url' => 'http://www.baidu.com'
            //     ]
            // ],
            
            // [
            //     "id" => "mitao",
            //     "title" => "蜜桃视频",
            //     "image" => "https://res.18moaa6.top:9002/icons/蜜桃.png",
            //     "url" => "https://res.18moaa6.top:9002/apps/100/mitao.zip",
            //     "version" => 1,
            //     "mode" => 0,
            //     "hot" => false,
            //     'permissions' => [
            //         'type' => "trysee",
            //         'params' => "",
            //         'message' => "",
            //         'url' => ''
            //     ]
            // ],

            
            [
                "id" => "hongxing",
                "title" => "红杏视频",
                "image" => "https://res.18moaa6.top:9002/icons/红杏视频.png",
                "url" => "https://res.18moaa6.top:9002/apps/100/hongxing.zip",
                "version" => 1,
                "mode" => 0,
                "hot" => false,
                'permissions' => [
                    'type' => "trysee",
                    'params' => "",
                    'message' => "",
                    'url' => ''
                ]
            ],
            [
                "id" => "yinxing",
                "title" => "银杏FM",
                "image" => "https://res.18moaa6.top:9002/icons/银杏.png",
                "url" => "https://res.18moaa6.top:9002/apps/100/yinxing.zip",
                "version" => 1,
                "mode" => 0,
                "hot" => false,
                'permissions' => [
                    'type' => "trysee",
                    'params' => "",
                    'message' => "",
                    'url' => ''
                ]
            ], 
            // [
            //     "id" => "mmlu",
            //     "title" => "漫漫撸",
            //     "image" => "https://res.18moaa6.top:9002/icons/漫漫撸.png",
            //     "url" => "https://res.18moaa6.top:9002/apps/100/mmlu.zip",
            //     "version" => 3,
            //     "mode" => 0,
            //     "hot" => false,
            //     'permissions' => [
            //         'type' => "trysee",
            //         'params' => "",
            //         'message' => "",
            //         'url' => ''
            //     ]
            // ], 
            [
                "id" => "maomi",
                "title" => "猫咪",
                "image" => "https://res.18moaa6.top:9002/icons/猫咪.png",
                "url" => "https://res.18moaa6.top:9002/apps/100/maomi.zip",
                "version" => 1,
                "mode" => 0,
                "hot" => false,
                'permissions' => [
                    'type' => "trysee",
                    'params' => "",
                    'message' => "",
                    'url' => ''
                ]
            ],
            // [
            //     "id" => "xiangjiao",
            //     "title" => "香蕉视频",
            //     "image" => "https://res.18moaa6.top:9002/icons/香蕉.png",
            //     "url" => "https://res.18moaa6.top:9002/apps/100/xiangjiao.zip",
            //     "version" => 1,
            //     "mode" => 0,
            //     "hot" => false,
            //     'permissions' => [
            //         'type' => "trysee",
            //         'params' => "",
            //         'message' => "",
            //         'url' => ''
            //     ]
            [
                "id" => "caomei",
                "title" => "草莓视频",
                "image" => "https://res.18moaa6.top:9002/icons/草莓.png",
                "url" => "https://res.18moaa6.top:9002/apps/100/caomei.zip",
                "version" => 1,
                "mode" => 0,
                "hot" => false,
                'permissions' => [
                    'type' => "trysee",
                    'params' => "",
                    'message' => "",
                    'url' => ''
                ]
            ],
            // [
            //     "id" => "bale",
            //     "title" => "芭乐视频",
            //     "image" => "https://res.18moaa6.top:9002/icons/芭乐.png",
            //     "url" => "https://res.18moaa6.top:9002/apps/100/bale.zip",
            //     "version" => 1,
            //     "mode" => 0,
            //     "hot" => false,
            //     'permissions' => [
            //         'type' => "trysee",
            //         'params' => "",
            //         'message' => "",
            //         'url' => ''
            //     ]
            [
                "id" => "xiaoshuo",
                "title" => "成人小说",
                "image" => "https://res.18moaa6.top:9002/icons/小说.png",
                "url" => "https://res.18moaa6.top:9002/apps/100/xiaoshuo4.zip",
                "version" => 4,
                "mode" => 0,
                "hot" => false,
                'permissions' => [
                    'type' => "trysee",
                    'params' => "",
                    'message' => "",
                    'url' => ''
                ]
            ],
            // [
            //     "id" => "vqun",
            //     "title" => "微群社区",
            //     "image" => "https://res.18moaa6.top:9002/icons/微群社区.png",
            //     "url" => "https://res.18moaa6.top:9002/apps/100/vqun.zip",
            //     "version" => 1,
            //     "mode" => 0,
            //     "hot" => false,
            //     'permissions' => [
            //         'type' => "trysee",
            //         'params' => "",
            //         'message' => "",
            //         'url' => ''
            //     ]
            // ],
            // [
            //     "id" => "tupian",
            //     "title" => "美女图片",
            //     "image" => "https://res.18moaa6.top:9002/icons/美女图片.png",
            //     "url" => "https://res.18moaa6.top:9002/apps/100/tupian.zip",
            //     "version" => 1,
            //     "mode" => 0,
            //     "hot" => false,
            //     'permissions' => [
            //         'type' => "trysee",
            //         'params' => "",
            //         'message' => "",
            //         'url' => ''
            //     ]
            // ],
            // [
            //     "id" => "daxiaojie",
            //     "title" => "大小姐",
            //     "image" => "https://res.18moaa6.top:9002/icons/大小姐.png",
            //     "url" => "https://res.18moaa6.top:9002/apps/100/m_daxiaojie.zip",
            //     "version" => 1,
            //     "mode" => 0,
            //     "hot" => false,
            //     'permissions' => [
            //         'type' => "trysee",
            //         'params' => "",
            //         'message' => "",
            //         'url' => ''
            //     ]
            // ], [
            //     "id" => "zhibo",
            //     "title" => "激情直播",
            //     "image" => "https://res.18moaa6.top:9002/icons/激情直播.jpg",
            //     "url" => "https://res.18moaa6.top:9002/apps/100/zhibo.zip",
            //     "version" => 1,
            //     "mode" => 0,
            //     "hot" => false,
            //     'permissions' => [
            //         'type' => "normal",
            //         'params' => "",
            //         'message' => "",
            //         'url' => ''
            //     ]
            [
                "id" => "newkuaimao",
                "title" => "快猫",
                "image" => "https://res.18moaa6.top:9002/icons/快猫.png",
                "url" => "https://res.18moaa6.top:9002/apps/100/newkuaimao.zip",
                "version" => 1,
                "mode" => 0,
                "hot" => false,
                'permissions' => [
                    'type' => "trysee",
                    'params' => "",
                    'message' => "",
                    'url' => ''
                ]
            ], 
            [
                "id" => "weixingloufeng",
                "title" => "微杏楼凤",
                "image" => "https://res.18moaa6.top:9002/icons/微杏楼凤.png",
                "url" => "https://res.18moaa6.top:9002/apps/100/weixingloufeng.zip",
                "version" => 1,
                "mode" => 0,
                "hot" => false,
                'permissions' => [
                    'type' => "normal",
                    'params' => "",
                    'message' => "",
                    'url' => ''
                ]
            ],
            // ], [
            //     "id" => "localtest",
            //     "title" => "本地测试",
            //     "image" => "https://res.18moaa6.top:9002/icons/淫水机.ico",
            //     "url" => "http://192.168.2.173:8080/",
            //     "version" => 1,
            //     "mode" => 1,
            //     "hot" => false,
            //     'permissions' => [
            //         'type' => "normal",
            //         'params' => "",
            //         'message' => "",
            //         'url' => ''
            //     ]
            
            // [
            //     "id" => "meishaonv",
            //     "title" => "美少女",
            //     "image" => "https://res.18moaa6.top:9002/icons/%E5%A4%A7%E5%B0%8F%E5%A7%90.ico",
            //     "url" => "https://res.18moaa6.top:9002/apps/100/m_meishaonv.zip",
            //     "version" => 1,
            //     "mode" => 0,
            //     "hot" => false,
            //     'permissions' => [
            //         'type' => "trysee",
            //         'params' => "",
            //         'message' => "",
            //         'url' => ''
            //     ]
            // ], 
            [
                "id" => "yinshuiji",
                "title" => "淫水机",
                "image" => "https://res.18moaa6.top:9002/icons/淫水机.ico",
                "url" => "https://res.18moaa6.top:9002/apps/100/m_yinshuiji.zip",
                "version" => 1,
                "mode" => 0,
                "hot" => false,
                'permissions' => [
                    'type' => "trysee",
                    'params' => "",
                    'message' => "",
                    'url' => ''
                ]
            ], 
            [
                "id" => "xiangnaier",
                "title" => "香奶儿",
                "image" => "https://res.18moaa6.top:9002/icons/香奶儿.ico",
                "url" => "https://res.18moaa6.top:9002/apps/100/m_xiangnaier.zip",
                "version" => 1,
                "mode" => 0,
                "hot" => false,
                'permissions' => [
                    'type' => "trysee",
                    'params' => "",
                    'message' => "",
                    'url' => ''
                ]
            ], 
            //[
            //     "id" => "baipiao",
            //     "title" => "白嫖",
            //     "image" => "https://res.18moaa6.top:9002/icons/白嫖.ico",
            //     "url" => "https://res.18moaa6.top:9002/apps/100/m_baipiao.zip",
            //     "version" => 1,
            //     "mode" => 0,
            //     "hot" => false,
            //     'permissions' => [
            //         'type' => "trysee",
            //         'params' => "",
            //         'message' => "",
            //         'url' => ''
            //     ]
            // ], [
            //     "id" => "xiaoshimei",
            //     "title" => "小湿妹",
            //     "image" => "https://res.18moaa6.top:9002/icons/小湿妹.ico",
            //     "url" => "https://res.18moaa6.top:9002/apps/100/m_xiaoshimei.zip",
            //     "version" => 1,
            //     "mode" => 0,
            //     "hot" => false,
            //     'permissions' => [
            //         'type' => "trysee",
            //         'params' => "",
            //         'message' => "",
            //         'url' => ''
            //     ]
            //], 
            [
                "id" => "huangav",
                "title" => "黄AV",
                "image" => "https://res.18moaa6.top:9002/icons/黄AV.ico",
                "url" => "https://res.18moaa6.top:9002/apps/100/m_huangav.zip",
                "version" => 1,
                "mode" => 0,
                "hot" => false,
                'permissions' => [
                    'type' => "trysee",
                    'params' => "",
                    'message' => "",
                    'url' => ''
                ]
            ], 
            [
                "id" => "mangguo",
                "title" => "芒果视频",
                "image" => "https://res.18moaa6.top:9002/icons/芒果.png",
                "url" => "https://res.18moaa6.top:9002/apps/100/m_mangguozy.zip",
                "version" => 1,
                "mode" => 0,
                "hot" => false,
                'permissions' => [
                    'type' => "trysee",
                    'params' => "",
                    'message' => "",
                    'url' => ''
                ]
            ], 
            //[
            //     "id" => "qiukui",
            //     "title" => "秋葵视频",
            //     "image" => "https://res.18moaa6.top:9002/icons/秋葵.png",
            //     "url" => "https://res.18moaa6.top:9002/apps/100/m_qiukui.zip",
            //     "version" => 1,
            //     "mode" => 0,
            //     "hot" => false,
            //     'permissions' => [
            //         'type' => "normal",
            //         'params' => "",
            //         'message' => "",
            //         'url' => ''
            //     ]
            // ], [
            //     "id" => "jiali",
            //     "title" => "佳丽",
            //     "image" => "https://res.18moaa6.top:9002/icons/佳丽.png",
            //     "url" => "https://res.18moaa6.top:9002/apps/100/m_jiali.zip",
            //     "version" => 1,
            //     "mode" => 0,
            //     "hot" => false,
            //     'permissions' => [
            //         'type' => "trysee",
            //         'params' => "",
            //         'message' => "",
            //         'url' => ''
            //     ]
            //], 
            [
                "id" => "lebo",
                "title" => "乐播",
                "image" => "https://res.18moaa6.top:9002/icons/乐播.png",
                "url" => "https://res.18moaa6.top:9002/apps/100/m_lebo.zip",
                "version" => 1,
                "mode" => 0,
                "hot" => false,
                'permissions' => [
                    'type' => "trysee",
                    'params' => "",
                    'message' => "",
                    'url' => ''
                ]
            ],
            // [
            //     "id" => "huajiaozy",
            //     "title" => "花椒",
            //     "image" => "https://res.18moaa6.top:9002/icons/花椒.png",
            //     "url" => "https://res.18moaa6.top:9002/apps/100/m_huajiaozy.zip",
            //     "version" => 1,
            //     "mode" => 0,
            //     "hot" => false,
            //     'permissions' => [
            //         'type' => "trysee",
            //         'params' => "",
            //         'message' => "",
            //         'url' => ''
            //     ]
            // ],
            [
                "id" => "laoya",
                "title" => "老鸭",
                "image" => "https://res.18moaa6.top:9002/icons/老鸭.ico",
                "url" => "https://res.18moaa6.top:9002/apps/100/m_laoya.zip",
                "version" => 1,
                "mode" => 0,
                "hot" => false,
                'permissions' => [
                    'type' => "trysee",
                    'params' => "",
                    'message' => "",
                    'url' => ''
                ]
            ],
            // [
            //     "id" => "smyp",
            //     "title" => "扫码约炮",
            //     "image" => "https://res.18moaa6.top:9002/user_icons/logo3.png",
            //     "url" =>"http://qq1.54nvyou.cc",
            //     "version" => 1,
            //     "mode" => 3,
            //     "hot" => false,
            //     'permissions' => [
            //         'type' => "normal",
            //         'params' => "",
            //         'message' => "",
            //         'url' => ''
            //     ]
            // ],
            // [
            //     "id" => "huafei",
            //     "title" => "话费四折",
            //     "image" => "https://res.18moaa6.top:9002/user_icons/huafei901.png",
            //     "url" => "https://m.33yxd.com/",
            //     "version" => 1,
            //     "mode" => 3,
            //     "hot" => false,
            //     'permissions' => [
            //         'type' => "normal",
            //         'params' => "",
            //         'message' => "",
            //         'url' => ''
            //     ]
            // ],
            
            // ], [
            //     "id" => "tantan",
            //     "title" => "探探",
            //     "image" => "https://res.18moaa6.top:9002/icons/探探.png",
            //     "url" => "https://res.18moaa6.top:9002/apps/100/m_tantan.zip",
            //     "version" => 1,
            //     "mode" => 0,
            //     "hot" => false,
            //     'permissions' => [
            //         'type' => "trysee",
            //         'params' => "",
            //         'message' => "",
            //         'url' => ''
            //     ]
            
            // [
            //     "id" => "xiuse",
            //     "title" => "秀色",
            //     "image" => "https://res.18moaa6.top:9002/icons/秀色.png",
            //     "url" => "https://res.18moaa6.top:9002/apps/100/m_xiusezy.zip",
            //     "version" => 1,
            //     "mode" => 0,
            //     "hot" => false,
            //     'permissions' => [
            //         'type' => "trysee",
            //         'params' => "",
            //         'message' => "",
            //         'url' => ''
            //     ]
            // ],
            // [
            //     "id" => "aibo",
            //     "title" => "爱播",
            //     "image" => "https://res.18moaa6.top:9002/icons/爱播.png",
            //     "url" => "https://res.18moaa6.top:9002/apps/100/m_aibo3.zip",
            //     "version" => 3,
            //     "mode" => 0,
            //     "hot" => false,
            //     'permissions' => [
            //         'type' => "trysee",
            //         'params' => "",
            //         'message' => "",
            //         'url' => ''
            //     ]
            // ]
            // [
            //     "id" => "sesezy",
            //     "title" => "色色影视",
            //     "image" => "https://res.18moaa6.top:9002/icons/sesezy.png",
            //     "url" => "https://res.18moaa6.top:9002/apps/100/m_sesezy.zip",
            //     "version" => 1,
            //     "mode" => 0,
            //     "hot" => false,
            //     'permissions' => [
            //         'type' => "trysee",
            //         'params' => "",
            //         'message' => "",
            //         'url' => ''
            //     ]
            // ],
            // [
            //     "id" => "99zyw",
            //     "title" => "玖玖影视",
            //     "image" => "https://res.18moaa6.top:9002/icons/sesezy.png",
            //     "url" => "https://res.18moaa6.top:9002/apps/100/m_99zyw.zip",
            //     "version" => 1,
            //     "mode" => 0,
            //     "hot" => false,
            //     'permissions' => [
            //         'type' => "trysee",
            //         'params' => "",
            //         'message' => "",
            //         'url' => ''
            //     ]
            // ],
            // [
            //     "id" => "lsnzy",
            //     "title" => "狼少年",
            //     "image" => "https://res.18moaa6.top:9002/icons/sesezy.png",
            //     "url" => "https://res.18moaa6.top:9002/apps/100/m_lsnzy.zip",
            //     "version" => 1,
            //     "mode" => 0,
            //     "hot" => false,
            //     'permissions' => [
            //         'type' => "trysee",
            //         'params' => "",
            //         'message' => "",
            //         'url' => ''
            //     ]
            // ],
            // [
            //     "id" => "fedzy",
            //     "title" => "富二代",
            //     "image" => "https://res.18moaa6.top:9002/icons/sesezy.png",
            //     "url" => "https://res.18moaa6.top:9002/apps/100/m_fedzy.zip",
            //     "version" => 1,
            //     "mode" => 0,
            //     "hot" => false,
            //     'permissions' => [
            //         'type' => "trysee",
            //         'params' => "",
            //         'message' => "",
            //         'url' => ''
            //     ]
            // ],
            // [
            //         "id" => "zmwzy",
            //         "title" => "中文字幕",
            //         "image" => "https://res.18moaa6.top:9002/icons/sesezy.png",
            //         "url" => "https://res.18moaa6.top:9002/apps/100/m_zmwzy.zip",
            //         "version" => 1,
            //         "mode" => 0,
            //         "hot" => false,
            //         'permissions' => [
            //             'type' => "trysee",
            //             'params' => "",
            //             'message' => "",
            //             'url' => ''
            //         ]
            // ],
            // [
            //     "id" => "jczy",
            //     "title" => "久草视频",
            //     "image" => "https://res.18moaa6.top:9002/icons/sesezy.png",
            //     "url" => "https://res.18moaa6.top:9002/apps/100/m_jczy.zip",
            //     "version" => 1,
            //     "mode" => 0,
            //     "hot" => false,
            //     'permissions' => [
            //         'type' => "trysee",
            //         'params' => "",
            //         'message' => "",
            //         'url' => ''
            //     ]
            // ],
            [
                    "id" => "javmy",
                    "title" => "JAV名优",
                    "image" => "https://res.18moaa6.top:9002/icons/jav.jpg",
                    "url" => "https://res.18moaa6.top:9002/apps/100/m_javmy.zip",
                    "version" => 1,
                    "mode" => 0,
                    "hot" => false,
                    'permissions' => [
                        'type' => "trysee",
                        'params' => "",
                        'message' => "",
                        'url' => ''
                    ]
            ],
            // [
            //     "id" => "lilaizy",
            //     "title" => "利来影视",
            //     "image" => "https://res.18moaa6.top:9002/icons/sesezy.png",
            //     "url" => "https://res.18moaa6.top:9002/apps/100/m_lilaizy.zip",
            //     "version" => 1,
            //     "mode" => 0,
            //     "hot" => false,
            //     'permissions' => [
            //         'type' => "trysee",
            //         'params' => "",
            //         'message' => "",
            //         'url' => ''
            //     ]
            // ],
            // [
            //     "id" => "bttzy",
            //     "title" => "博天堂",
            //     "image" => "https://res.18moaa6.top:9002/icons/sesezy.png",
            //     "url" => "https://res.18moaa6.top:9002/apps/100/m_bttzy.zip",
            //     "version" => 1,
            //     "mode" => 0,
            //     "hot" => false,
            //     'permissions' => [
            //         'type' => "trysee",
            //         'params' => "",
            //         'message' => "",
            //         'url' => ''
            //     ]
            // ],
            [
                "id" => "huanyazy",
                "title" => "环亚影视",
                "image" => "https://res.18moaa6.top:9002/icons/huanya.png",
                "url" => "https://res.18moaa6.top:9002/apps/100/m_huanyazy.zip",
                "version" => 1,
                "mode" => 0,
                "hot" => false,
                'permissions' => [
                    'type' => "trysee",
                    'params' => "",
                    'message' => "",
                    'url' => ''
                ]
            ],
            [
                "id" => "putaozy",
                "title" => "葡萄视频",
                "image" => "https://res.18moaa6.top:9002/icons/putao.png",
                "url" => "https://res.18moaa6.top:9002/apps/100/m_putao.zip",
                "version" => 4,
                "mode" => 0,
                "hot" => false,
                'permissions' => [
                    'type' => "trysee",
                    'params' => "",
                    'message' => "",
                    'url' => ''
                ]
            ],
            [
                "id" => "naichazy",
                "title" => "奶茶视频",
                "image" => "https://res.18moaa6.top:9002/icons/naicha.png",
                "url" => "https://res.18moaa6.top:9002/apps/100/m_naicha.zip",
                "version" => 4,
                "mode" => 0,
                "hot" => false,
                'permissions' => [
                    'type' => "trysee",
                    'params' => "",
                    'message' => "",
                    'url' => ''
                ]
            ],
            // [
            //     "id" => "qqyp",
            //     "title" => "情趣约炮",
            //     "image" => "https://res.18moaa6.top:9002/user_icons/qingqu.png",
            //     "url" =>"https://65728.top", //"https://654b.top", //"https://65728.top",
            //     "version" => 1,
            //     "mode" => 3,
            //     "hot" => false,
            //     'permissions' => [
            //         'type' => "normal",
            //         'params' => "",
            //         'message' => "",
            //         'url' => ''
            //     ]
            // ],
        ],
        'crack_apps' => [
            // [
            //     "packname" => "com.video",
            //     “version” => "1818",
            //     "title" => "91视频",
            //     "image" => "http://156.251.137.247:8081/Data/apk/91视频.png",
            //     "url" => "http://156.251.137.247:8081/Data/apk/91视频.apk",
            //     "mode" => 0,
            //     "hot" => false,
            //     'permissions' => [
            //         'type' => "normal",
            //         'params' => "",
            //         'message' => "",
            //         'url' => ''
            //     ]
            // ],
            // [
            //     "packname" => "com.lhfecegc",
            //     "title" => "测试",
            //     "image" => "http://156.251.137.247:8081/Data/apk/91视频.png",
            //     "url" => "https://cdn.uviewui.com/uview/resources/uView2.x.apk",
            //     "mode" => 0,
            //     "hot" => false,
            //     'permissions' => [
            //         'type' => "normal",
            //         'params' => "",
            //         'message' => "",
            //         'url' => ''
            //     ]
            // ],
            // [
            //     "packname" => "ytbcvv22edasa.ytbczx2qwasb",
            //     "title" => "YTB视频",
            //     "image" => "http://156.251.137.247:8081/Data/uploads/20220105/20220105015001_30455.png",
            //     "url" => "http://156.251.137.247:8081/Data/apk/YTB 视频_5.2.3.apk",
            //     "mode" => 0,
            //     "hot" => false,
            //     'permissions' => [
            //         'type' => "normal",
            //         'params' => "",
            //         'message' => "",
            //         'url' => ''
            //     ]
            // ],
            // [
            //     "packname" => "hhapp.begbadasdv",
            //     "title" => "合欢视频",
            //     "image" => "http://103.82.143.181/Data/uploads/20220115/20220115020702_31414.png",
            //     "url" => "http://103.82.143.181/Data/apk/合欢视频.apk",
            //     "mode" => 0,
            //     "hot" => false,
            //     'permissions' => [
            //         'type' => "normal",
            //         'params' => "",
            //         'message' => "",
            //         'url' => ''
            //     ]
            // ],
            // [
            //     "packname" => "com.lhhjfm.edmugj",
            //     "title" => "红杏视频",
            //     "image" => "http://103.82.143.181/Data/uploads/20220115/20220115021312_84071.png",
            //     "url" => "http://103.82.143.181/Data/apk/红杏视频.apk",
            //     "mode" => 0,
            //     "hot" => false,
            //     'permissions' => [
            //         'type' => "normal",
            //         'params' => "",
            //         'message' => "",
            //         'url' => ''
            //     ]
            // ],
            // [
            //     "packname" => "com.dwqzgkhdsu.qygkzsdla",
            //     "title" => "红牛视频",
            //     "image" => "http://103.82.143.181/Data/uploads/20220105/20220105014032_88477.png",
            //     "url" => "http://103.82.143.181/Data/apk/红牛视频_6.6.6.apk",
            //     "mode" => 0,
            //     "hot" => false,
            //     'permissions' => [
            //         'type' => "normal",
            //         'params' => "",
            //         'message' => "",
            //         'url' => ''
            //     ]
            // ],
            // [
            //     "packname" => "com.seven.videos",
            //     "title" => "妖精视频",
            //     "image" => "http://103.82.143.181/Data/uploads/20220105/20220105011418_23651.png",
            //     "url" => "http://103.82.143.181/Data/apk/妖精视频_9.9.apk",
            //     "mode" => 0,
            //     "hot" => false,
            //     'permissions' => [
            //         'type' => "normal",
            //         'params' => "",
            //         'message' => "",
            //         'url' => ''
            //     ]
            // ],
            // [
            //     "packname" => "com.xiangjiao.tiktok",
            //     "title" => "香蕉短视频",
            //     "image" => "http://103.82.143.181/Data/uploads/20220105/20220105010113_81948.png",
            //     "url" => "http://103.82.143.181/Data/apk/香蕉短视频.apk",
            //     "mode" => 0,
            //     "hot" => false,
            //     'permissions' => [
            //         'type' => "normal",
            //         'params' => "",
            //         'message' => "",
            //         'url' => ''
            //     ]
            // ],
            // [
            //     "packname" => "com.example.interesttribe",
            //     "title" => "兴趣部落",
            //     "image" => "https://res.18moaa6.top:9002/crack_apps/兴趣部落.png",
            //     "url" => "https://apk.18moaa4.top:9002/兴趣部落.apk",
            //     "startActivity" => "com.example.interesttribe.MainActivity",
            //     "mode" => 0,
            //     "hot" => false,
            //     'permissions' => [
            //         'type' => "appinstall",
            //         'params' => "com.test222",
            //         'message' => "此应用需要安装APP才可使用",
            //         'url' => 'http://www.baidu.com'
            //     ]
            // ],
            [
                "packname" => "com.legenfsoft.tensi46474",
                // "version" => "32",
                "title" => "丝瓜视频",
                "image" => "https://res.18moaa6.top:9002/crack_apps/丝瓜视频.jpeg",
                "url" => "https://apk.18moaa4.top:9002/丝瓜视频.apk",
                "startActivity" => "com.legendsoft.uisgone.ui.SplashActivity",
                "mode" => 0,
                "hot" => false,
                'permissions' => [
                    'type' => "vip",
                    'params' => "",
                    'message' => "",
                    'url' => ''
                ]
            ],
            [
                "packname" => "com.redinfo.pvpig_v_1_2_81",
                "title" => "小猪视频",
                "version" => "84",
                "image" => "https://res.18moaa6.top:9002/crack_apps/小猪视频.png",
                "url" => "https://apk.18moaa4.top:9002/小猪视频_1.2.89.apk",
                "startActivity" => "com.redinfo.pvpig_v_1_2_81.MainActivity",
                "mode" => 0,
                "hot" => false,
                'permissions' => [
                    'type' => "vip",
                    'params' => "",
                    'message' => "",
                    'url' => ''
                ]
            ],
            [
                "packname" => "znxdrtgfvghnag.zcsdccvbfb",
                "version" => "1098979",
                "title" => "宅男视频",
                "image" => "https://res.18moaa6.top:9002/crack_apps/宅男视频.png",
                "url" => "https://apk.18moaa4.top:9002/宅男视频_5.5.0.apk",
                "startActivity" => "com.sp1024dads.sp1024dads.MainActivity",
                "mode" => 0,
                "hot" => false,
                'permissions' => [
                    'type' => "vip",
                    'params' => "",
                    'message' => "",
                    'url' => ''
                ]
            ],
            // [
            //     "packname" => "com.app.video.playerk",
            //     "title" => "番茄视频",
            //     "image" => "https://res.18moaa6.top:9002/crack_apps/番茄视频.png",
            //     "url" => "https://apk.18moaa4.top:9002/番茄视频_9.8.apk",
            //     "startActivity" => "com.app.aiqiyi.activity.LauncherActivity",
            //     "mode" => 0,
            //     "hot" => false,
            //     'permissions' => [
            //         'type' => "vip",
            //         'params' => "",
            //         'message' => "",
            //         'url' => ''
            //     ]
            // ],
            [
                "packname" => "com.degozx.stappg",
                "version" => "116",
                "title" => "红杏视频",
                "image" => "https://res.18moaa6.top:9002/crack_apps/红杏视频.jpg",
                "url" => "https://apk.18moaa4.top:9002/红杏视频_1.1.6.apk",
                "startActivity" => "com.degozx.stappg.ui.activity.splash.SplashActivity",
                "mode" => 0,
                "hot" => false,
                'permissions' => [
                    'type' => "vip",
                    'params' => "",
                    'message' => "",
                    'url' => ''
                ]
            ],
            // [
            //     "packname" => "com.tran.slate.d666",
            //     "title" => "快色视频",
            //     "image" => "https://res.18moaa6.top:9002/crack_apps/快色视频.jpeg",
            //     "url" => "https://apk.18moaa4.top:9002/快色短视频_9.9.9.apk",
            //     "startActivity" => "com.grass.pomegranate.ui.activity.SplashActivity",
            //     "mode" => 0,
            //     "hot" => false,
            //     'permissions' => [
            //         'type' => "vip",
            //         'params' => "",
            //         'message' => "",
            //         'url' => ''
            //     ]
            // ],
            [
                "packname" => "com.wwsqvip.app",
                "version" => '2',
                "title" => "窝窝社区",
                "image" => "https://res.18moaa6.top:9002/crack_apps/窝窝视频.jpeg",
                "url" => "https://apk.18moaa4.top:9002/窝窝社区_1.4.apk",
                "startActivity" => "com.wwsqvip.app.splash.WelComeActivity",
                "mode" => 0,
                "hot" => false,
                'permissions' => [
                    'type' => "vip",
                    'params' => "",
                    'message' => "",
                    'url' => ''
                ]
            ],
            // [
            //     "packname" => "com.gujingtongyou",
            //     "title" => "香蕉影视",
            //     "image" => "https://res.18moaa6.top:9002/crack_apps/香蕉影视.png",
            //     "url" => "https://apk.18moaa4.top:9002/香蕉影视_3.0.5.apk",
            //     "startActivity" => "com.gujingtongyou.rg_QiDongLei",
            //     "mode" => 0,
            //     "hot" => false,
            //     'permissions' => [
            //         'type' => "vip",
            //         'params' => "",
            //         'message' => "",
            //         'url' => ''
            //     ]
            // ],
            // [
            //     "packname" => "com.gujingtongyou",
            //     "title" => "香蕉视频",
            //     "image" => "https://res.18moaa6.top:9002/crack_apps/香蕉视频.jpeg",
            //     "url" => "https://apk.18moaa4.top:9002/香蕉视频.apk",
            //     "startActivity" => "com.gujingtongyou.rg_QiDongLei",
            //     "mode" => 0,
            //     "hot" => false,
            //     'permissions' => [
            //         'type' => "vip",
            //         'params' => "",
            //         'message' => "",
            //         'url' => ''
            //     ]
            // ],
            [
                "packname" => "com.example.interesttribe",
                "version" => '1',
                "title" => "兴趣部落",
                "image" => "https://res.18moaa6.top:9002/crack_apps/兴趣部落.png",
                "url" => "https://apk.18moaa4.top:9002/兴趣部落.apk",
                "startActivity" => "com.example.interesttribe.MainActivity",
                "mode" => 0,
                "hot" => false,
                'permissions' => [
                    'type' => "vip",
                    'params' => "",
                    'message' => "",
                    'url' => ''
                ]
            ],
            [
                "packname" => "com.legendsoft.ytm",
                "version" => '99',
                "title" => "芭乐视频",
                "image" => "https://res.18moaa6.top:9002/crack_apps/芭乐视频.png",
                "url" => "https://apk.18moaa4.top:9002/芭樂視頻_2.2.4.apk",
                "startActivity" => "com.legendsoft.uiyeartfour.ui.main.activity.SplashActivity",
                "mode" => 0,
                "hot" => false,
                'permissions' => [
                    'type' => "vip",
                    'params' => "",
                    'message' => "",
                    'url' => ''
                ]
            ],
            [
                "packname" => "com.small.brother",
                "version" => '99',
                "title" => "大小姐AV",
                "image" => "https://res.18moaa6.top:9002/crack_apps/大小姐AV.png",
                "url" => "https://apk.18moaa4.top:9002/大小姐AV.apk",
                "startActivity" => "com.small.brother.ui.SplashActivity",
                "mode" => 0,
                "hot" => false,
                'permissions' => [
                    'type' => "vip",
                    'params' => "",
                    'message' => "",
                    'url' => ''
                ]
            ],
            [
                "packname" => "com.tnt.f11",
                "version" => '26',
                "title" => "猫咪",
                "image" => "https://res.18moaa6.top:9002/crack_apps/猫咪.png",
                "url" => "https://apk.18moaa4.top:9002/猫咪.apk",
                "startActivity" => "com.xmvideo.app.WelcomeActivity",
                "mode" => 0,
                "hot" => false,
                'permissions' => [
                    'type' => "vip",
                    'params' => "",
                    'message' => "",
                    'url' => ''
                ]
            ],
            // [
            //     "packname" => "yxb2exe.qsdjb6swrf",
            //     "title" => "银杏视频",
            //     "image" => "https://res.18moaa6.top:9002/crack_apps/银杏视频.jpeg",
            //     "url" => "https://apk.18moaa4.top:9002/银杏视频.apk",
            //     "startActivity" => "com.yxmaadddf21.yxmaadddf21.MainActivity",
            //     "mode" => 0,
            //     "hot" => false,
            //     'permissions' => [
            //         'type' => "vip",
            //         'params' => "",
            //         'message' => "",
            //         'url' => ''
            //     ]
            // ],
            [
                "packname" => "szcc2vcacxe.qdfmccvbo",
                "version" => '1099077',
                "title" => "1024视频",
                "image" => "https://res.18moaa6.top:9002/crack_apps/1024视频.png",
                "url" => "https://apk.18moaa4.top:9002/1024视频_5.5.1.apk",
                "startActivity" => "com.sp1024dads.sp1024dads.MainActivity",
                "mode" => 0,
                "hot" => false,
                'permissions' => [
                    'type' => "vip",
                    'params' => "",
                    'message' => "",
                    'url' => ''
                ]
            ],
            [
                "packname" => "net.miehuoguan.apq123",
                "version" => '1014',
                "title" => "滅火館",
                "image" => "https://res.18moaa6.top:9002/crack_apps/滅火館.png",
                "url" => "https://apk.18moaa4.top:9002/滅火館_1.0.14.apk",
                "startActivity" => "io.dcloud.PandoraEntry",
                "mode" => 0,
                "hot" => false,
                'permissions' => [
                    'type' => "vip",
                    'params' => "",
                    'message' => "",
                    'url' => ''
                ]
            ],
            // [
            //     "packname" => "com.bluet.ttt.toocau2",
            //     "title" => "汤姆视频",
            //     "image" => "https://res.18moaa6.top:9002/crack_apps/汤姆视频.png",
            //     "url" => "https://apk.18moaa4.top:9002/汤姆视频.apk",
            //     "startActivity" => "com.yulong.tomMovie.ui.activity.SplashActivity",
            //     "mode" => 0,
            //     "hot" => false,
            //     'permissions' => [
            //         'type' => "vip",
            //         'params' => "",
            //         'message' => "",
            //         'url' => ''
            //     ]
            // ],
            // [
            //     "packname" => "com.legendsoft.newysixcm",
            //     "title" => "草莓视频",
            //     "image" => "https://res.18moaa6.top:9002/crack_apps/草莓视频.jpeg",
            //     "url" => "https://apk.18moaa4.top:9002/草莓视频.apk",
            //     "startActivity" => "com.legendsoft.uicmten.ui.SplashActivity",
            //     "mode" => 0,
            //     "hot" => false,
            //     'permissions' => [
            //         'type' => "vip",
            //         'params' => "",
            //         'message' => "",
            //         'url' => ''
            //     ]
            // ],
            // [
            //     "packname" => "com.pada.vid2",
            //     "title" => "黑猫视频",
            //     "image" => "https://res.18moaa6.top:9002/crack_apps/黑猫视频.png",
            //     "url" => "https://apk.18moaa4.top:9002/黑猫视频_1.0.3.apk",
            //     "startActivity" => "com.panda.vid1.activity.StartActivity",
            //     "mode" => 0,
            //     "hot" => false,
            //     'permissions' => [
            //         'type' => "vip",
            //         'params' => "",
            //         'message' => "",
            //         'url' => ''
            //     ]
            // ],
            // [
            //     "packname" => "com.okgsy.dygsh002",
            //     "title" => "老虎直播",
            //     "image" => "https://res.18moaa6.top:9002/crack_apps/老虎直播.png",
            //     "url" => "https://apk.18moaa4.top:9002/老虎直播_9.9.9.9.apk",
            //     "startActivity" => "com.ch.myframe.ui.activity.start.CheckActivity",
            //     "mode" => 0,
            //     "hot" => false,
            //     'permissions' => [
            //         'type' => "vip",
            //         'params' => "",
            //         'message' => "",
            //         'url' => ''
            //     ]
            // ],
            [
                "packname" => "com.ijjyts.qcingsyt35",
                "version" => '1080',
                "title" => "青橙",
                "image" => "https://res.18moaa6.top:9002/crack_apps/青橙.png",
                "url" => "https://apk.18moaa4.top:9002/青橙_4.4.20.1.apk",
                "startActivity" => "com.sevengms.myframe.ui.activity.start.CheckActivity",
                "mode" => 0,
                "hot" => false,
                'permissions' => [
                    'type' => "vip",
                    'params' => "",
                    'message' => "",
                    'url' => ''
                ]
            ],
            [
                "packname" => "com.speak.m16",
                "version" => '9',
                "title" => "水果派",
                "image" => "https://res.18moaa6.top:9002/crack_apps/水果派.png",
                "url" => "https://apk.18moaa4.top:9002/水果派_999.apk",
                "startActivity" => "com.speak.movie.activity.SplashActivity",
                "mode" => 0,
                "hot" => false,
                'permissions' => [
                    'type' => "vip",
                    'params' => "",
                    'message' => "",
                    'url' => ''
                ]
            ],
            // [
            //     "packname" => "com.sy.tianmao",
            //     "title" => "51啪",
            //     "image" => "https://res.18moaa6.top:9002/crack_apps/51啪.png",
            //     "url" => "https://apk.18moaa4.top:9002/51啪.apk",
            //     "startActivity" => "com.sy.comment.ui.activity.SplashActivity",
            //     "mode" => 0,
            //     "hot" => false,
            //     'permissions' => [
            //         'type' => "vip",
            //         'params' => "",
            //         'message' => "",
            //         'url' => ''
            //     ]
            // ],
            // [
            //     "packname" => "com.sk.xnvideo",
            //     "title" => "大象视频",
            //     "image" => "https://res.18moaa6.top:9002/crack_apps/大象视频.jpeg",
            //     "url" => "https://apk.18moaa4.top:9002/大象视频.apk",
            //     "startActivity" => "com.sk.xnvideo.mvvm.welcome.WelcomeActivity",
            //     "mode" => 0,
            //     "hot" => false,
            //     'permissions' => [
            //         'type' => "vip",
            //         'params' => "",
            //         'message' => "",
            //         'url' => ''
            //     ]
            // ],
            [
                "packname" => "com.jjfqezdhqwez.sdzheqshdfq",
                "version" => '666',
                "title" => "麻豆日记",
                "image" => "https://res.18moaa6.top:9002/crack_apps/麻豆日记.jpeg",
                "url" => "https://apk.18moaa4.top:9002/麻豆日记.apk",
                "startActivity" => "com.fengwoo.videoplayer.main.SplashActivity",
                "mode" => 0,
                "hot" => false,
                'permissions' => [
                    'type' => "vip",
                    'params' => "",
                    'message' => "",
                    'url' => ''
                ]
            ],
            // [
            //     "packname" => "com.mtbook34.capp",
            //     "title" => "香蕉视频",
            //     "image" => "https://res.18moaa6.top:9002/crack_apps/香蕉视频.png",
            //     "url" => "https://apk.18moaa4.top:9002/香蕉视频.apk",
            //     "startActivity" => "com.squirrel.video.ui.activity.FirstActivity",
            //     "mode" => 0,
            //     "hot" => false,
            //     'permissions' => [
            //         'type' => "vip",
            //         'params' => "",
            //         'message' => "",
            //         'url' => ''
            //     ]
            // ],
            [
                "packname" => "com.seven.vi8558a11",
                "version" => '88',
                "title" => "妖精视频",
                "image" => "https://res.18moaa6.top:9002/crack_apps/妖精视频.png",
                "url" => "https://apk.18moaa4.top:9002/妖精视频.apk",
                "startActivity" => "com.seven.videos.activitys.SplashActivity",
                "mode" => 0,
                "hot" => false,
                'permissions' => [
                    'type' => "vip",
                    'params' => "",
                    'message' => "",
                    'url' => ''
                ]
            ],
            [
                "packname" => "com.wowoshequ",
                "version" => '1',
                "title" => "青草视频",
                "image" => "https://res.18moaa6.top:9002/crack_apps/青草视频.jpeg",
                "url" => "https://apk.18moaa4.top:9002/青草视频_1.0.0.apk",
                "startActivity" => "com.wowoshequ.rg_QiDongLei",
                "mode" => 0,
                "hot" => false,
                'permissions' => [
                    'type' => "vip",
                    'params' => "",
                    'message' => "",
                    'url' => ''
                ]
            ],
            [
                "packname" => "xkdapp.begbvsdvc",
                "version" => '6666666',
                "title" => "小蝌蚪",
                "image" => "https://res.18moaa6.top:9002/crack_apps/小蝌蚪.jpeg",
                "url" => "https://apk.18moaa4.top:9002/小蝌蚪_6.6.6.apk",
                "startActivity" => "com.xrkapp.a49ba59a.MainActivity",
                "mode" => 0,
                "hot" => false,
                'permissions' => [
                    'type' => "vip",
                    'params' => "",
                    'message' => "",
                    'url' => ''
                ]
            ],
            [
                "packname" => "com.oemnny.mrudsg",
                "version" => '20220520',
                "title" => "食色短视频",
                "image" => "https://res.18moaa6.top:9002/crack_apps/食色短视频.png",
                "url" => "https://apk.18moaa4.top:9002/食色短视频_3.4.3.2.apk",
                "startActivity" => "com.fuerdai.tiktok.activity.SplashActivity",
                "mode" => 0,
                "hot" => false,
                'permissions' => [
                    'type' => "vip",
                    'params' => "",
                    'message' => "",
                    'url' => ''
                ]
            ],
            
            // [
            //     "packname" => "com.lieqizhijia.app",
            //     "title" => "猎奇之家",
            //     "image" => "https://res.18moaa6.top:9002/crack_apps/猎奇之家.png",
            //     "url" => "https://apk.18moaa4.top:9002/猎奇之家_1.0.8 (1).apk",
            //     "startActivity" => "com.lieqizhijia.app.SplashActivity",
            //     "mode" => 0,
            //     "hot" => false,
            //     'permissions' => [
            //         'type' => "vip",
            //         'params' => "",
            //         'message' => "",
            //         'url' => ''
            //     ]
            // ],
            [
                "packname" => "slvftyhbftyj.srtyuczxckxf",
                "version" => '1098882',
                "title" => "石榴视频",
                "image" => "https://res.18moaa6.top:9002/crack_apps/石榴视频.png",
                "url" => "https://apk.18moaa4.top:9002/石榴视频_5.3.6.apk",
                "startActivity" => "com.sp1024dads.sp1024dads.MainActivity",
                "mode" => 0,
                "hot" => false,
                'permissions' => [
                    'type' => "vip",
                    'params' => "",
                    'message' => "",
                    'url' => ''
                ]
            ],
            // [
            //     "packname" => "com.androids.profit.d1657590606346095006",
            //     "title" => "咪咪视频",
            //     "image" => "https://res.18moaa6.top:9002/crack_apps/咪咪视频.jpeg",
            //     "url" => "https://apk.18moaa4.top:9002/咪咪视频.apk",
            //     "startActivity" => "com.grass.pomegranate.ui.activity.SplashActivity",
            //     "mode" => 0,
            //     "hot" => false,
            //     'permissions' => [
            //         'type' => "vip",
            //         'params' => "",
            //         'message' => "",
            //         'url' => ''
            //     ]
            // ],
            
            // [
            //     "packname" => "com.lxsgkjtyxwmen.svyiizwsjinhc",
            //     "title" => "金联",
            //     "image" => "https://res.18moaa6.top:9002/crack_apps/金联.png",
            //     "url" => "https://apk.18moaa4.top:9002/金联_1.0.0 (1).apk",
            //     "startActivity" => "com.lxsgkjtyxwmen.svyiizwsjinhc.ui.activity.TTDFDnvJSj",
            //     "mode" => 0,
            //     "hot" => false,
            //     'permissions' => [
            //         'type' => "vip",
            //         'params' => "",
            //         'message' => "",
            //         'url' => ''
            //     ]
            // ],
            // [
            //     "packname" => "com.kpkphlby1.videohl1",
            //     "title" => "磨合视频",
            //     "image" => "https://res.18moaa6.top:9002/crack_apps/磨合视频.png",
            //     "url" => "https://apk.18moaa4.top:9002/磨合视频_11.2.apk",
            //     "startActivity" => "com.e4a.runtime.android.StartActivity",
            //     "mode" => 0,
            //     "hot" => false,
            //     'permissions' => [
            //         'type' => "vip",
            //         'params' => "",
            //         'message' => "",
            //         'url' => ''
            //     ]
            // ],
            // [
            //     "packname" => "com.qtgjym.vip",
            //     "title" => "青兔馆",
            //     "image" => "https://res.18moaa6.top:9002/crack_apps/青兔館.png",
            //     "url" => "https://apk.18moaa4.top:9002/青兔馆_3.2.2.apk",
            //     "startActivity" => "com.e4a.runtime.android.mainActivity",
            //     "mode" => 0,
            //     "hot" => false,
            //     'permissions' => [
            //         'type' => "vip",
            //         'params' => "",
            //         'message' => "",
            //         'url' => ''
            //     ]
            // ],
            // [
            //     "packname" => "com.phone.seyou.apq1",
            //     "title" => "色柚视频",
            //     "image" => "https://res.18moaa6.top:9002/crack_apps/色柚视频.png",
            //     "url" => "https://apk.18moaa4.top:9002/seyoushipin_1.1.4.apk",
            //     "startActivity" => "cn.miyoumi.shorts.activity.SplashActivity",
            //     "mode" => 0,
            //     "hot" => false,
            //     'permissions' => [
            //         'type' => "vip",
            //         'params' => "",
            //         'message' => "",
            //         'url' => ''
            //     ]
            // ],
            [
                "packname" => "com.erzvq594283y.a07u",
                "version" => '1018',
                "title" => "小黄蜂",
                "image" => "https://res.18moaa6.top:9002/crack_apps/小黄蜂.png",
                "url" => "https://apk.18moaa4.top:9002/小黄蜂_1.0.182.apk",
                "startActivity" => "com.sy.comment.ui.activity.y3N7XWxdUuCPn9p6",
                "mode" => 0,
                "hot" => false,
                'permissions' => [
                    'type' => "vip",
                    'params' => "",
                    'message' => "",
                    'url' => ''
                ]
            ],
            // [
            //     "packname" => "com.xhsyb.kankan",
            //     "title" => "小黄书",
            //     "image" => "https://res.18moaa6.top:9002/crack_apps/小黄书.png",
            //     "url" => "https://apk.18moaa4.top:9002/小黄书_2.5.4.apk",
            //     "startActivity" => "com.xhsyb.kankan.activity.SplashActivity",
            //     "mode" => 0,
            //     "hot" => false,
            //     'permissions' => [
            //         'type' => "vip",
            //         'params' => "",
            //         'message' => "",
            //         'url' => ''
            //     ]
            // ],
            // [
            //     "packname" => "ecgyvd.ltmpeh.nxqqer",
            //     "title" => "心动直播",
            //     "image" => "https://res.18moaa6.top:9002/crack_apps/心动直播.png",
            //     "url" => "https://apk.18moaa4.top:9002/心动直播_4.6.23.1.apk",
            //     "startActivity" => "com.sevengms.myframe.ui.activity.start.CheckActivity",
            //     "mode" => 0,
            //     "hot" => false,
            //     'permissions' => [
            //         'type' => "vip",
            //         'params' => "",
            //         'message' => "",
            //         'url' => ''
            //     ]
            // ],
            // [
            //     "packname" => "ytbcvv22edasa.ytbczx2qwasb",
            //     "title" => "ytb视频",
            //     "image" => "https://res.18moaa6.top:9002/crack_apps/ytb视频.png",
            //     "url" => "https://apk.18moaa4.top:9002/YTB_5.2.3.apk",
            //     "startActivity" => "com.hhg12ad32eqw.hhg12ad32eqw.MainActivity",
            //     "mode" => 0,
            //     "hot" => false,
            //     'permissions' => [
            //         'type' => "vip",
            //         'params' => "",
            //         'message' => "",
            //         'url' => ''
            //     ]
            // ],
            // [
            //     "packname" => "com.cxw.happyvideo",
            //     "title" => "快乐视频",
            //     "image" => "https://res.18moaa6.top:9002/crack_apps/快乐视频.png",
            //     "url" => "https://apk.18moaa4.top:9002/快乐视频_2.7.6.apk",
            //     "startActivity" => "com.cxw.hv_launch.OpenScreenActivity",
            //     "mode" => 0,
            //     "hot" => false,
            //     'permissions' => [
            //         'type' => "vip",
            //         'params' => "",
            //         'message' => "",
            //         'url' => ''
            //     ]
            // ],
            [
                "packname" => "com.lmgssxs.altgbnhy67",
                "version" => '554',
                "title" => "爱浪",
                "image" => "https://res.18moaa6.top:9002/crack_apps/爱浪.png",
                "url" => "https://apk.18moaa4.top:9002/爱浪_4.1.7.1_kill.apk",
                "startActivity" => "com.ch.myframe.ui.activity.start.CheckActivity",
                "mode" => 0,
                "hot" => false,
                'permissions' => [
                    'type' => "vip",
                    'params' => "",
                    'message' => "",
                    'url' => ''
                ]
            ],
            // [
            //     "packname" => "com.lmgxsgx.cjgsgsg23",
            //     "title" => "初见",
            //     "image" => "https://res.18moaa6.top:9002/crack_apps/初见.png",
            //     "url" => "https://apk.18moaa4.top:9002/初见_3.12.11.1.apk",
            //     "startActivity" => "com.ch.myframe.ui.activity.start.CheckActivity",
            //     "mode" => 0,
            //     "hot" => false,
            //     'permissions' => [
            //         'type' => "vip",
            //         'params' => "",
            //         'message' => "",
            //         'url' => ''
            //     ]
            // ],
            // [
            //     "packname" => "live.svvpz.ieiwie",
            //     "title" => "快手成人版",
            //     "image" => "https://res.18moaa6.top:9002/crack_apps/快手成人版.png",
            //     "url" => "https://apk.18moaa4.top:9002/快手成年版_4.2.0.apk",
            //     "startActivity" => "com.iksvl.common.activity.SplashActivity",
            //     "mode" => 0,
            //     "hot" => false,
            //     'permissions' => [
            //         'type' => "vip",
            //         'params' => "",
            //         'message' => "",
            //         'url' => ''
            //     ]
            // ],
            // [
            //     "packname" => "com.nanguaeightqimao35599.app",
            //     "title" => "樱桃影视",
            //     "image" => "https://res.18moaa6.top:9002/crack_apps/樱桃影视.jpeg",
            //     "url" => "https://apk.18moaa4.top:9002/樱桃影视_4.3.1.apk",
            //     "startActivity" => "com.moonbeam.treasureboxqimao35599.activity.LaunchActivity",
            //     "mode" => 0,
            //     "hot" => false,
            //     'permissions' => [
            //         'type' => "vip",
            //         'params' => "",
            //         'message' => "",
            //         'url' => ''
            //     ]
            // ],
            [
                "packname" => "com.tosme.bosme",
                "version" => '1018',
                "title" => "cilicili",
                "image" => "https://res.18moaa6.top:9002/crack_apps/cilicili短视频.png",
                "url" => "https://apk.18moaa4.top:9002/CiliCili短视频_3.4.3.2.apk",
                "startActivity" => "com.fuerdai.tiktok.activity.SplashActivity",
                "mode" => 0,
                "hot" => false,
                'permissions' => [
                    'type' => "vip",
                    'params' => "",
                    'message' => "",
                    'url' => ''
                ]
            ],
            [
                "packname" => "com.example.b.xVideos",
                "version" => '1',
                "title" => "xVideos",
                "image" => "https://res.18moaa6.top:9002/crack_apps/xvideos.png",
                "url" => "https://apk.18moaa4.top:9002/xVideos_1.0.0.apk",
                "startActivity" => "com.example.b.xVideos.主窗口",
                "mode" => 0,
                "hot" => false,
                'permissions' => [
                    'type' => "vip",
                    'params' => "",
                    'message' => "",
                    'url' => ''
                ]
            ],
            // [
            //     "packname" => "com.cl.newt66y",
            //     "title" => "小草",
            //     "image" => "https://res.18moaa6.top:9002/crack_apps/小草.png",
            //     "url" => "https://apk.18moaa4.top:9002/小草_2.2.5.apk",
            //     "startActivity" => "com.cl.newt66y.MainActivity",
            //     "mode" => 0,
            //     "hot" => false,
            //     'permissions' => [
            //         'type' => "vip",
            //         'params' => "",
            //         'message' => "",
            //         'url' => ''
            //     ]
            // ],
            [
                "packname" => "com.ilulutv.fulao2",
                "version" => '88',
                "title" => "Fulao2",
                "image" => "https://res.18moaa6.top:9002/crack_apps/Fulao2.png",
                "url" => "https://apk.18moaa4.top:9002/Fulao2_2.00.apk",
                "startActivity" => "com.ilulutv.fulao2.welcome.WelcomeActivity",
                "mode" => 0,
                "hot" => false,
                'permissions' => [
                    'type' => "vip",
                    'params' => "",
                    'message' => "",
                    'url' => ''
                ]
            ],
            // [
            //     "packname" => "com.hk.fastlu",
            //     "title" => "Lutu短视频",
            //     "image" => "https://res.18moaa6.top:9002/crack_apps/lutube短视频.png",
            //     "url" => "https://apk.18moaa4.top:9002/luTu短视频_2.2.9.apk",
            //     "startActivity" => "com.hk.fastlu.ui.activity.ScreenLockCheckActivity",
            //     "mode" => 0,
            //     "hot" => false,
            //     'permissions' => [
            //         'type' => "vip",
            //         'params' => "",
            //         'message' => "",
            //         'url' => ''
            //     ]
            // ],
            // [
            //     "packname" => "com.xxx.jrtt",
            //     "title" => "猫咪头条",
            //     "image" => "https://res.18moaa6.top:9002/crack_apps/猫咪头条.png",
            //     "url" => "https://apk.18moaa4.top:9002/猫咪头条_9.9.9.apk",
            //     "startActivity" =>'com.xmvideo.app.MainActivity', //"com.ilulutv.fulao2.welcome.WelcomeActivity",
            //     "mode" => 0,
            //     "hot" => false,
            //     'permissions' => [
            //         'type' => "vip",
            //         'params' => "",
            //         'message' => "",
            //         'url' => ''
            //     ]
            // ],
            // [
            //     "packname" => "com.lddccfcn66",
            //     "title" => "抖阴视频",
            //     "image" => "https://res.18moaa6.top:9002/crack_apps/抖阴视频.png",
            //     "url" => "https://apk.18moaa4.top:9002/抖阴视频_1.6.1.apk",
            //     "startActivity" => "com.lddccfcm.ui.laucher.StartCompatActivity",
            //     "mode" => 0,
            //     "hot" => false,
            //     'permissions' => [
            //         'type' => "vip",
            //         'params' => "",
            //         'message' => "",
            //         'url' => ''
            //     ]
            // ],
            // [
            //     "packname" => "com.cdkaydsb.dym",
            //     "title" => "大眼萌",
            //     "image" => "https://res.18moaa6.top:9002/crack_apps/大眼萌.png",
            //     "url" => "https://apk.18moaa4.top:9002/大眼萌_6.85.apk",
            //     "startActivity" => "com.e4a.runtime.android.StartActivity",
            //     "mode" => 0,
            //     "hot" => false,
            //     'permissions' => [
            //         'type' => "vip",
            //         'params' => "",
            //         'message' => "",
            //         'url' => ''
            //     ]
            // ],
            // [
            //     "packname" => "com.videomjsp.caoav",
            //     "title" => "性用社",
            //     "image" => "https://res.18moaa6.top:9002/crack_apps/性用社.png",
            //     "url" => "https://apk.18moaa4.top:9002/性用社_2.6.apk",
            //     "startActivity" => "com.e4a.runtime.android.StartActivity",
            //     "mode" => 0,
            //     "hot" => false,
            //     'permissions' => [
            //         'type' => "vip",
            //         'params' => "",
            //         'message' => "",
            //         'url' => ''
            //     ]
            // ],
            [
                "packname" => "com.bjhsvip.app",
                "version" => '3',
                "title" => "北极狐",
                "image" => "https://res.18moaa6.top:9002/crack_apps/北极狐.png",
                "url" => "https://apk.18moaa4.top:9002/北极狐_3.0.apk",
                "startActivity" => "com.e4a.runtime.android.StartActivity",
                "mode" => 0,
                "hot" => false,
                'permissions' => [
                    'type' => "vip",
                    'params' => "",
                    'message' => "",
                    'url' => ''
                ]
            ],
            // [
            //     "packname" => "com.microphoto.videp1",
            //     "title" => "优优视频",
            //     "image" => "https://res.18moaa6.top:9002/crack_apps/youyou.png",
            //     "url" => "https://apk.18moaa4.top:9002/优优视频_1.0.0.apk",
            //     "startActivity" => "com.microphoto.video.view.activity.StartActivity",
            //     "mode" => 0,
            //     "hot" => false,
            //     'permissions' => [
            //         'type' => "vip",
            //         'params' => "",
            //         'message' => "",
            //         'url' => ''
            //     ]
            // ],
            // [
            //     "packname" => "com.lddccfcm",
            //     "title" => "熊猫视频",
            //     "image" => "https://res.18moaa6.top:9002/crack_apps/熊猫视频.png",
            //     "url" => "https://apk.18moaa4.top:9002/熊猫视频_1.6.1.apk",
            //     "startActivity" => "com.lddccfcm.ui.laucher.StartCompatActivity",
            //     "mode" => 0,
            //     "hot" => false,
            //     'permissions' => [
            //         'type' => "vip",
            //         'params' => "",
            //         'message' => "",
            //         'url' => ''
            //     ]
            // ],
            [
                "packname" => "com.k41i6dg9a21i.c3ha2n5g9v36er.s81io0n9g3e.i1g9ro0g8e",
                "version" => '20220811',
                "title" => "OnlyYou",
                "image" => "https://res.18moaa6.top:9002/crack_apps/onlyyou.png",
                "url" => "https://apk.18moaa4.top:9002/OnlyYou_1.1.4.1.apk",
                "startActivity" => "com.i1t5s8us8e3d6t03o.g9i1e3rm51it5n21al.activity.SplashActivity",
                "mode" => 0,
                "hot" => false,
                'permissions' => [
                    'type' => "vip",
                    'params' => "",
                    'message' => "",
                    'url' => ''
                ]
            ],
            // [
            //     "packname" => "com.soft.play.t2",
            //     "title" => "汤不热",
            //     "image" => "https://res.18moaa6.top:9002/crack_apps/汤不热.png",
            //     "url" => "https://apk.18moaa4.top:9002/汤不热视频2_10.0.apk",
            //     "startActivity" => "com.soft.play.activity.LauncherActivity",
            //     "mode" => 0,
            //     "hot" => false,
            //     'permissions' => [
            //         'type' => "vip",
            //         'params' => "",
            //         'message' => "",
            //         'url' => ''
            //     ]
            // ],
            [
                "packname" => "com.hihanhan.one.rt45",
                "version" => '2007010050',
                "title" => "一个",
                "image" => "https://res.18moaa6.top:9002/crack_apps/一个.jpeg",
                "url" => "https://apk.18moaa4.top:9002/一个_2.2.6_sign_sign.apk",
                "startActivity" => "com.hihanhan.one.ui.page.splash.SplashActivity",
                "mode" => 0,
                "hot" => false,
                'permissions' => [
                    'type' => "vip",
                    'params' => "",
                    'message' => "",
                    'url' => ''
                ]
            ],
            [
                "packname" => "lxgpun.xhsysh.rhcxzd",
                "version" => '6.6.6.6',
                "title" => "七猫直播",
                "image" => "https://res.18moaa6.top:9002/crack_apps/七猫直播.png",
                "url" => "https://apk.18moaa4.top:9002/七猫直播_6.6.6.6.apk",
                "startActivity" => "com.sevengms.myframe.ui.activity.start.CheckActivity",
                "mode" => 0,
                "hot" => false,
                'permissions' => [
                    'type' => "vip",
                    'params' => "",
                    'message' => "",
                    'url' => ''
                ]
            ],
            [
                "packname" => "llcvb5gggj.dfdd4ase",
                "version" => '1118977',
                "title" => "榴莲视频",
                "image" => "https://res.18moaa6.top:9002/crack_apps/榴莲.png",
                "url" => "https://apk.18moaa4.top:9002/榴莲视频_7.4.1.apk",
                "startActivity" => "com.ll354tsdasds.ll354tsdasds.MainActivity",
                "mode" => 0,
                "hot" => false,
                'permissions' => [
                    'type' => "vip",
                    'params' => "",
                    'message' => "",
                    'url' => ''
                ]
            ],
            // [
            //     "packname" => "com.onlyfans.community7",
            //     "title" => "狼友社区",
            //     "image" => "https://res.18moaa6.top:9002/crack_apps/狼友社区.png",
            //     "url" => "https://apk.18moaa4.top:9002/狼友社区_1.0.1.apk",
            //     "startActivity" => "com.niming.weipa.ui.splash.SplashActivity",
            //     "mode" => 0,
            //     "hot" => false,
            //     'permissions' => [
            //         'type' => "vip",
            //         'params' => "",
            //         'message' => "",
            //         'url' => ''
            //     ]
            // ],
            // [
            //     "packname" => "com.onlyfans.community_0110",
            //     "title" => "OnlyFans",
            //     "image" => "https://res.18moaa6.top:9002/crack_apps/onlyfans.png",
            //     "url" => "https://apk.18moaa4.top:9002/OnlyFans_1.0.1.apk",
            //     "startActivity" => "com.niming.weipa.ui.splash.SplashActivity",
            //     "mode" => 0,
            //     "hot" => false,
            //     'permissions' => [
            //         'type' => "vip",
            //         'params' => "",
            //         'message' => "",
            //         'url' => ''
            //     ]
            // ],
            [
                "packname" => "com.videoapp.avgo",
                "version" => '2',
                "title" => "AVIN視頻",
                "image" => "https://res.18moaa6.top:9002/crack_apps/AVIN免費視頻.png",
                "url" => "https://apk.18moaa4.top:9002/AVIN免費視頻_2.0.apk",
                "startActivity" => "com.videoapp.avgo.MainActivity",
                "mode" => 0,
                "hot" => false,
                'permissions' => [
                    'type' => "vip",
                    'params' => "",
                    'message' => "",
                    'url' => ''
                ]
            ],
            // [
            //     "packname" => "com.xxx.svideo",
            //     "title" => "快猫",
            //     "image" => "https://res.18moaa6.top:9002/crack_apps/快猫.png",
            //     "url" => "https://apk.18moaa4.top:9002/快猫_4.4.5.apk",
            //     "startActivity" => "com.xxx.svideo.base.SplashActivity",
            //     "mode" => 0,
            //     "hot" => false,
            //     'permissions' => [
            //         'type' => "vip",
            //         'params' => "",
            //         'message' => "",
            //         'url' => ''
            //     ]
            // ],
            // [
            //     "packname" => "com.pzhan.news",
            //     "title" => "P站",
            //     "image" => "https://res.18moaa6.top:9002/crack_apps/P站.png",
            //     "url" => "https://apk.18moaa4.top:9002/P站视频_4.2.2.apk",
            //     "startActivity" => "com.bbb.fastcloud.mvp.ui.activity.SplashActivity",
            //     "mode" => 0,
            //     "hot" => false,
            //     'permissions' => [
            //         'type' => "vip",
            //         'params' => "",
            //         'message' => "",
            //         'url' => ''
            //     ]
            // ],
            // [
            //     "packname" => "com.sy.tianmao",
            //     "title" => "小蝴蝶",
            //     "image" => "https://res.18moaa6.top:9002/crack_apps/小蝴蝶.png",
            //     "url" => "https://apk.18moaa4.top:9002/小蝴蝶_1.1.00.apk",
            //     "startActivity" => "com.sy.comment.ui.activity.SplashActivity",
            //     "mode" => 0,
            //     "hot" => false,
            //     'permissions' => [
            //         'type' => "vip",
            //         'params' => "",
            //         'message' => "",
            //         'url' => ''
            //     ]
            // ],
            // [
            //     "packname" => "com.bytedance.cj7c8934cf5",
            //     "version" => '111',
            //     "title" => "雏姬",
            //     "image" => "https://res.18moaa6.top:9002/crack_apps/雏姬.png",
            //     "url" => "https://apk.18moaa4.top:9002/雏姬11_1.1.1.apk",
            //     "startActivity" => "com.bytedance.cj7c8934cf5.ui.activity.SplashActivity",
            //     "mode" => 0,
            //     "hot" => false,
            //     'permissions' => [
            //         'type' => "vip",
            //         'params' => "",
            //         'message' => "",
            //         'url' => ''
            //     ]
            // ],
            // [
            //     "packname" => "com.latest.mm.video",
            //     "title" => "香草视频",
            //     "image" => "https://res.18moaa6.top:9002/crack_apps/香草视频.jpeg",
            //     "url" => "https://apk.18moaa4.top:9002/香草视频_1.0.0_2.apk",
            //     "startActivity" => "com.latest.mm.video.view.activity.SplashActivity",
            //     "mode" => 0,
            //     "hot" => false,
            //     'permissions' => [
            //         'type' => "vip",
            //         'params' => "",
            //         'message' => "",
            //         'url' => ''
            //     ]
            // ],
            [
                "packname" => "com.hhhhlianzai.apq1",
                "version" => '20220202',
                "title" => "嘿嘿连载",
                "image" => "https://res.18moaa6.top:9002/crack_apps/嘿嘿连载.jpeg",
                "url" => "https://apk.18moaa4.top:9002/嘿嘿连载_3.1.0.apk",
                "startActivity" => "com.heiheilianzai.app.ui.activity.SplashActivity",
                "mode" => 0,
                "hot" => false,
                'permissions' => [
                    'type' => "vip",
                    'params' => "",
                    'message' => "",
                    'url' => ''
                ]
            ],
            [
                "packname" => "com.manma56",
                "version" => '12',
                "title" => "漫漫撸",
                "image" => "https://res.18moaa6.top:9002/crack_apps/漫漫撸.png",
                "url" => "https://apk.18moaa4.top:9002/漫漫擼2_1.2.8.apk",
                "startActivity" => "com.manmanlu2.activity.splash.SplashActivity",
                "mode" => 0,
                "hot" => false,
                'permissions' => [
                    'type' => "vip",
                    'params' => "",
                    'message' => "",
                    'url' => ''
                ]
            ],
            // [
            //     "packname" => "com.jiaohua_browser",
            //     "title" => "JMComic",
            //     "image" => "https://res.18moaa6.top:9002/crack_apps/JMComic.png",
            //     "url" => "https://apk.18moaa4.top:9002/JMComic2_1.0.apk",
            //     "startActivity" => "com.jiaohua_browser.MainActivity",
            //     "mode" => 0,
            //     "hot" => false,
            //     'permissions' => [
            //         'type' => "vip",
            //         'params' => "",
            //         'message' => "",
            //         'url' => ''
            //     ]
            // ],
            [
                "packname" => "io.github.nekoinverter.ehviewer",
                "version" => '100010',
                "title" => "EhViewer",
                "image" => "https://res.18moaa6.top:9002/crack_apps/EhViewer.png",
                "url" => "https://apk.18moaa4.top:9002/EhViewer_1.7.26.3.apk",
                "startActivity" => "com.hippo.ehviewer.ui.MainActivity",
                "mode" => 0,
                "hot" => false,
                'permissions' => [
                    'type' => "vip",
                    'params' => "",
                    'message' => "",
                    'url' => ''
                ]
            ],
            [
                "packname" => "com.video",
                "version" => '2',
                "title" => "看了吗",
                "image" => "https://res.18moaa6.top:9002/crack_apps/看了吗.png",
                "url" => "https://apk.18moaa4.top:9002/kanleme_1.0.2.apk",
                "startActivity" => "com.video.MainActivity",
                "mode" => 0,
                "hot" => false,
                'permissions' => [
                    'type' => "vip",
                    'params' => "",
                    'message' => "",
                    'url' => ''
                ]
            ],
            // [
            //     "packname" => "com.legendsoft.tennxks",
            //     "title" => "向日葵视频",
            //     "image" => "https://res.18moaa6.top:9002/crack_apps/向日葵视频.png",
            //     "url" => "https://apk.18moaa4.top:9002/向日葵视频.apk",
            //     "startActivity" => "com.legendsoft.uixrktwo.ui.SplashActivity",
            //     "mode" => 0,
            //     "hot" => false,
            //     'permissions' => [
            //         'type' => "vip",
            //         'params' => "",
            //         'message' => "",
            //         'url' => ''
            //     ]
            // ],
            [
                "packname" => "com.zxbxzerqwt.dwqtzxfasq",
                "version" => '100010',
                "title" => "梅花视频",
                "image" => "https://res.18moaa6.top:9002/crack_apps/梅花视频.png",
                "url" => "https://apk.18moaa4.top:9002/梅花视频_5.0.7.apk",
                "startActivity" => "com.fengwoo.videoplayer.main.SplashActivity",
                "mode" => 0,
                "hot" => false,
                'permissions' => [
                    'type' => "vip",
                    'params' => "",
                    'message' => "",
                    'url' => ''
                ]
            ],
            // [
            //     "packname" => "com.app.video.play.hx",
            //     "title" => "蜜桃视频",
            //     "image" => "https://res.18moaa6.top:9002/crack_apps/蜜桃视频.png",
            //     "url" => "https://apk.18moaa4.top:9002/蜜桃视频_2.4.apk",
            //     "startActivity" => "com.app.aiqiyi.activity.LauncherActivity",
            //     "mode" => 0,
            //     "hot" => false,
            //     'permissions' => [
            //         'type' => "vip",
            //         'params' => "",
            //         'message' => "",
            //         'url' => ''
            //     ]
            // ],
            // [
            //     "packname" => "com.lunaapp.cnpromini",
            //     "version" => '116124',
            //     "title" => "雏鸟pro",
            //     "image" => "https://res.18moaa6.top:9002/crack_apps/雏鸟pro.png",
            //     "url" => "https://apk.18moaa4.top:9002/雏鸟Pro._1.1.7.apk",
            //     "startActivity" => "com.lianzhihui.minitiktok.ui.SplashActivity",
            //     "mode" => 0,
            //     "hot" => false,
            //     'permissions' => [
            //         'type' => "vip",
            //         'params' => "",
            //         'message' => "",
            //         'url' => ''
            //     ]
            // ],
            [
                "packname" => "com.fmcd.blmv",
                "version" => '315',
                "title" => "菠萝视频",
                "image" => "https://res.18moaa6.top:9002/crack_apps/菠萝视频.png",
                "url" => "https://apk.18moaa4.top:9002/啵罗视频_3.1.5.apk",
                "startActivity" => "com.blmvl.blvl.activity.SplashActivity",
                "mode" => 0,
                "hot" => false,
                'permissions' => [
                    'type' => "vip",
                    'params' => "",
                    'message' => "",
                    'url' => ''
                ]
            ],
            // [
            //     "packname" => "com.sf.d4323ce70c9e84747a46d6c1838062d25",
            //     "title" => "暗网爆料",
            //     "image" => "https://res.18moaa6.top:9002/crack_apps/暗网爆料.png",
            //     "url" => "https://apk.18moaa4.top:9002/暗网爆料_1.0.2.apk",
            //     "startActivity" => "com.limit.cache.ui.page.main.WelComeActivity",
            //     "mode" => 0,
            //     "hot" => false,
            //     'permissions' => [
            //         'type' => "vip",
            //         'params' => "",
            //         'message' => "",
            //         'url' => ''
            //     ]
            // ],
            // [
            //     "packname" => "com.banana.v3",
            //     "title" => "芭蕉视频",
            //     "image" => "https://res.18moaa6.top:9002/crack_apps/芭蕉视频.png",
            //     "url" => "https://apk.18moaa4.top:9002/芭蕉视频_1.0.0.apk",
            //     "startActivity" => "com.banana.v3.activity.SplashActivity",
            //     "mode" => 0,
            //     "hot" => false,
            //     'permissions' => [
            //         'type' => "vip",
            //         'params' => "",
            //         'message' => "",
            //         'url' => ''
            //     ]
            // ],
            // [
            //     "packname" => "com.maidoni",
            //     "title" => "脉动",
            //     "image" => "https://res.18moaa6.top:9002/crack_apps/脉动.png",
            //     "url" => "https://apk.18moaa4.top:9002/脉动_1.6.apk",
            //     "startActivity" => "com.maidong.activity.StartupDiagramActivity",
            //     "mode" => 0,
            //     "hot" => false,
            //     'permissions' => [
            //         'type' => "vip",
            //         'params' => "",
            //         'message' => "",
            //         'url' => ''
            //     ]
            // ],
            // [
            //     "packname" => "com.latest.mm.videq123",
            //     "title" => "蓝鸟视频",
            //     "image" => "https://res.18moaa6.top:9002/crack_apps/蓝鸟视频.png",
            //     "url" => "https://apk.18moaa4.top:9002/蓝鸟视频_1.0.0.apk",
            //     "startActivity" => "com.latest.mm.video.view.activity.SplashActivity",
            //     "mode" => 0,
            //     "hot" => false,
            //     'permissions' => [
            //         'type' => "vip",
            //         'params' => "",
            //         'message' => "",
            //         'url' => ''
            //     ]
            // ],
            [
                "packname" => "gov.sichuan.yvrnq.supgbo",
                "version" => '120',
                "title" => "GTV",
                "image" => "https://res.18moaa6.top:9002/crack_apps/GTV.png",
                "url" => "https://apk.18moaa4.top:9002/GTV_1.2.0.apk",
                "startActivity" => "com.xgaymv.activity.SplashActivity",
                "mode" => 0,
                "hot" => false,
                'permissions' => [
                    'type' => "vip",
                    'params' => "",
                    'message' => "",
                    'url' => ''
                ]
            ],
            [
                "packname" => "zknb.ejov.eqtz.hsvl",
                "version" => '365',
                "title" => "番茄社区",
                "image" => "https://res.18moaa6.top:9002/crack_apps/番茄社区.png",
                "url" => "https://apk.18moaa4.top:9002/番茄社區_3.6.5.apk",
                "startActivity" => "com.one.tomato.mvp.ui.start.view.SplashActivity",
                "mode" => 0,
                "hot" => false,
                'permissions' => [
                    'type' => "vip",
                    'params' => "",
                    'message' => "",
                    'url' => ''
                ]
            ],
            [
                "packname" => "qk354faddsceq.qk354faddsceq",
                "version" => '1098579',
                "title" => "秋葵视频",
                "image" => "https://res.18moaa6.top:9002/crack_apps/秋葵视频.png",
                "url" => "https://apk.18moaa4.top:9002/秋葵视频_5.0.3.apk",
                "startActivity" => "com.qk354fdsceq.qk354fdsceq.MainActivity",
                "mode" => 0,
                "hot" => false,
                'permissions' => [
                    'type' => "vip",
                    'params' => "",
                    'message' => "",
                    'url' => ''
                ]
            ],
            // [
            //     "packname" => "com.bygeysvpy",
            //     "title" => "百叶果",
            //     "image" => "https://res.18moaa6.top:9002/crack_apps/byg.png",
            //     "url" => "https://apk.18moaa4.top:9002/百叶果_9.98.apk",
            //     "startActivity" => "com.e4a.runtime.android.StartActivity",
            //     "mode" => 0,
            //     "hot" => false,
            //     'permissions' => [
            //         'type' => "vip",
            //         'params' => "",
            //         'message' => "",
            //         'url' => ''
            //     ]
            // ],
            [
                "packname" => "com.soft.play.h2",
                "version" => '116',
                "title" => "红杏影视",
                "image" => "https://res.18moaa6.top:9002/crack_apps/hxys.png",
                "url" => "https://apk.18moaa4.top:9002/红杏视频_1.1.6.apk",
                "startActivity" => "com.soft.play.activity.LauncherActivity",
                "mode" => 0,
                "hot" => false,
                'permissions' => [
                    'type' => "vip",
                    'params' => "",
                    'message' => "",
                    'url' => ''
                ]
            ],
            // [
            //     "packname" => "com.ojj7166.ia08379",
            //     "title" => "悦色视频",
            //     "image" => "https://res.18moaa6.top:9002/crack_apps/yssp.png",
            //     "url" => "https://apk.18moaa4.top:9002/悦色视频_1.7.4",
            //     "startActivity" => "com.ojj7166.ia08379.ui.laucher.StartCompatActivity",
            //     "mode" => 0,
            //     "hot" => false,
            //     'permissions' => [
            //         'type' => "vip",
            //         'params' => "",
            //         'message' => "",
            //         'url' => ''
            //     ]
            // ],
            [
                "packname" => "com.polymerization.app.v2",
                "version" => '10',
                "title" => "51涩",
                "image" => "https://res.18moaa6.top:9002/crack_apps/51涩.png",
                "url" => "https://apk.18moaa4.top:9002/51涩_1.0.0.apk",
                "startActivity" => "com.polymerization.app.v2.ui.home.activity.SplashActivity",
                "mode" => 0,
                "hot" => false,
                'permissions' => [
                    'type' => "vip",
                    'params' => "",
                    'message' => "",
                    'url' => ''
                ]
            ],
            [
                "packname" => "com.snhccm.humor.email",
                "version" => '11',
                "title" => "猫咪段子",
                "image" => "https://res.18moaa6.top:9002/crack_apps/猫咪段子.png",
                "url" => "https://apk.18moaa4.top:9002/猫咪段子_1.1.6.apk",
                "startActivity" => "com.newmmdz.humor.base.SplashActivity",
                "mode" => 0,
                "hot" => false,
                'permissions' => [
                    'type' => "vip",
                    'params' => "",
                    'message' => "",
                    'url' => ''
                ]
            ],
            [
                "packname" => "com.android.pstation.d1671758706725092506",
                "version" => '102',
                "title" => "PornHub",
                "image" => "https://res.18moaa6.top:9002/crack_apps/PornHub.png",
                "url" => "https://apk.18moaa4.top:9002/PornHub_1.0.2.apk",
                "startActivity" => "com.grass.cstore.ui.SplashActivity",
                "mode" => 0,
                "hot" => false,
                'permissions' => [
                    'type' => "vip",
                    'params' => "",
                    'message' => "",
                    'url' => ''
                ]
            ],
            [
                "packname" => "com.porn",
                ////"version" => '116',
                "title" => "UCJizz",
                "image" => "https://res.18moaa6.top:9002/crack_apps/UCJizz.png",
                "url" => "https://apk.18moaa4.top:9002/UCJizz_0.2003.30.1251.apk",
                "startActivity" => "com.porn.LauncherActivity",
                "mode" => 0,
                "hot" => false,
                'permissions' => [
                    'type' => "vip",
                    'params' => "",
                    'message' => "",
                    'url' => ''
                ]
            ],
            // [
            //     "packname" => "com.android.pstation.d1671758706725092506",
            //     "title" => "梅花短视频",
            //     "image" => "https://res.18moaa6.top:9002/crack_apps/梅花短视频.png",
            //     "url" => "https://apk.18moaa4.top:9002/PornHub_1.0.2.apk",
            //     "startActivity" => "com.grass.cstore.ui.SplashActivity",
            //     "mode" => 0,
            //     "hot" => false,
            //     'permissions' => [
            //         'type' => "vip",
            //         'params' => "",
            //         'message' => "",
            //         'url' => ''
            //     ]
            // ],
            [
                "packname" => "com.leyou.asdklhjg",
                "version" => '1301',
                "title" => "蜜柚",
                "image" => "https://res.18moaa6.top:9002/crack_apps/蜜柚.png",
                "url" => "https://apk.18moaa4.top:9002/蜜柚_1.3.1.apk",
                "startActivity" => "com.jriarobanb.kasisxianla.main.loading.LoadingActivity",
                "mode" => 0,
                "hot" => false,
                'permissions' => [
                    'type' => "vip",
                    'params' => "",
                    'message' => "",
                    'url' => ''
                ]
            ],
            [
                "packname" => "vjdarkf.ygdixtll.ncpcxcvf",
                "version" => '1000000',
                "title" => "微群社区",
                "image" => "https://res.18moaa6.top:9002/crack_apps/微群社区.png",
                "url" => "https://apk.18moaa4.top:9002/微群社区_1.0.apk",
                "startActivity" => "com.asdfg2.daili.LunchActivity",
                "mode" => 0,
                "hot" => false,
                'permissions' => [
                    'type' => "vip",
                    'params' => "",
                    'message' => "",
                    'url' => ''
                ]
            ],
            [
                "packname" => "com.tiktik.dounaipure",
                "version" => "20220810",
                "title" => "豆奶短视频",
                "image" => "https://res.18moaa6.top:9002/crack_apps/豆奶短视频.png",
                "url" => "https://apk.18moaa4.top:9002/豆奶短视频_1.0.0.0.apk",
                "startActivity" => "com.fuerdai.tiktok.activity.SplashActivity",
                "mode" => 0,
                "hot" => false,
                'permissions' => [
                    'type' => "vip",
                    'params' => "",
                    'message' => "",
                    'url' => ''
                ]
            ],
            [
                "packname" => "com.mimihot.pronpure",
                "version" => "20220810",
                "title" => "91porn",
                "image" => "https://res.18moaa6.top:9002/crack_apps/91porn.png",
                "url" => "https://apk.18moaa4.top:9002/91porn_1.0.0.0.apk",
                "startActivity" => "com.fuerdai.tiktok.activity.SplashActivity",
                "mode" => 0,
                "hot" => false,
                'permissions' => [
                    'type' => "vip",
                    'params' => "",
                    'message' => "",
                    'url' => ''
                ]
            ],
            [
                "packname" => "dlhirh.paclrt.mwnbt.vmbkij",
                "version" => "48",
                "title" => "快播",
                "image" => "https://res.18moaa6.top:9002/crack_apps/kuaibo.png",
                "url" => "https://apk.18moaa4.top:9002/快播_7.0.0bc848c3.apk",
                "startActivity" => "com.paulkman.nova.MainActivity",
                "mode" => 0,
                "hot" => false,
                'permissions' => [
                    'type' => "vip",
                    'params' => "",
                    'message' => "",
                    'url' => ''
                ]
            ],
            [
                "packname" => "org.aqidu.nhqthi",
                "version" => "338",
                "title" => "绿巨人视频",
                "image" => "https://res.18moaa6.top:9002/crack_apps/lvjuren.png",
                "url" => "https://apk.18moaa4.top:9002/绿巨人视频_3.3.0.apk",
                "startActivity" => "com.blmvl.blvl.activity.SplashActivity",
                "mode" => 0,
                "hot" => false,
                'permissions' => [
                    'type' => "vip",
                    'params' => "",
                    'message' => "",
                    'url' => ''
                ]
            ],
            [
                "packname" => "com.redinfo.porn_cinema_v_1_2_99",
                "version" => "1",
                "title" => "金鸡视频",
                "image" => "https://res.18moaa6.top:9002/crack_apps/金鸡视频.png",
                "url" => "https://apk.18moaa4.top:9002/金鸡视频_1.2.99.apk",
                "startActivity" => "com.redinfo.porn_cinema_v_1_2_99.MainActivity",
                "mode" => 0,
                "hot" => false,
                'permissions' => [
                    'type' => "vip",
                    'params' => "",
                    'message' => "",
                    'url' => ''
                ]
            ],
            [
                "packname" => "com.ruanjianku.app",
                "version" => "1",
                "title" => "莲花视频",
                "image" => "https://res.18moaa6.top:9002/crack_apps/莲花视频.png",
                "url" => "https://apk.18moaa4.top:9002/莲花视频_1.1.apk",
                "startActivity" => "top.webcat.myapp.MainActivity",
                "mode" => 0,
                "hot" => false,
                'permissions' => [
                    'type' => "vip",
                    'params' => "",
                    'message' => "",
                    'url' => ''
                ]
            ],
            [
                "packname" => "com.mtbook34.capq123",
                "version" => "6",
                "title" => "看看视频",
                "image" => "https://res.18moaa6.top:9002/crack_apps/看看视频.png",
                "url" => "https://apk.18moaa4.top:9002/看看视频_9.9.9.apk",
                "startActivity" => "com.squirrel.video.ui.activity.FirstActivity",
                "mode" => 0,
                "hot" => false,
                'permissions' => [
                    'type' => "vip",
                    'params' => "",
                    'message' => "",
                    'url' => ''
                ]
            ],
            [
                "packname" => "com.anzogame.qjnn",
                "version" => "999999999",
                "title" => "4Read",
                "image" => "https://res.18moaa6.top:9002/crack_apps/4Read.png",
                "url" => "https://apk.18moaa4.top:9002/4Read_999999999.apk",
                "startActivity" => "com.anzogame.qjnn.view.activity.SplashActivity",
                "mode" => 0,
                "hot" => false,
                'permissions' => [
                    'type' => "vip",
                    'params' => "",
                    'message' => "",
                    'url' => ''
                ]
            ],
            [
                "packname" => "com.tikhub",
                "version" => "1",
                "title" => "Tikhub",
                "image" => "https://res.18moaa6.top:9002/crack_apps/Tikhub.png",
                "url" => "https://apk.18moaa4.top:9002/Tikhub_1.1.3.apk",
                "startActivity" => "com.e4a.runtime.android.StartActivity",
                "mode" => 0,
                "hot" => false,
                'permissions' => [
                    'type' => "vip",
                    'params' => "",
                    'message' => "",
                    'url' => ''
                ]
            ],
            [
                "packname" => "com.exsydo.aevgzx",
                "version" => "1020",
                "title" => "小松鼠",
                "image" => "https://res.18moaa6.top:9002/crack_apps/小松鼠.png",
                "url" => "https://apk.18moaa4.top:9002/小松鼠_1.0.20.apk",
                "startActivity" => "com.sy.comment.ui.activity.VirkaNEL8b",
                "mode" => 0,
                "hot" => false,
                'permissions' => [
                    'type' => "vip",
                    'params' => "",
                    'message' => "",
                    'url' => ''
                ]
            ],
            [
                "packname" => "plus.H510CDC0A",
                "version" => "83",
                "title" => "桃色91",
                "image" => "https://res.18moaa6.top:9002/crack_apps/桃色91.png",
                "url" => "https://apk.18moaa4.top:9002/桃色91_1.0.1.apk",
                "startActivity" => "io.dcloud.PandoraEntry",
                "mode" => 0,
                "hot" => false,
                'permissions' => [
                    'type' => "vip",
                    'params' => "",
                    'message' => "",
                    'url' => ''
                ]
            ],
            [
                "packname" => "com.yyds.wuyou",
                "version" => "124",
                "title" => "无忧短视频",
                "image" => "https://res.18moaa6.top:9002/crack_apps/无忧短视频.png",
                "url" => "https://apk.18moaa4.top:9002/无忧短视频_1.2.4.0.apk",
                "startActivity" => "com.yyds.tomato.splash.ui.SplashActivity",
                "mode" => 0,
                "hot" => false,
                'permissions' => [
                    'type' => "vip",
                    'params' => "",
                    'message' => "",
                    'url' => ''
                ]
            ],
            [
                "packname" => "com.dsfkkd.liuss",
                "version" => "9999999",
                "title" => "青丘视频",
                "image" => "https://res.18moaa6.top:9002/crack_apps/青丘.png",
                "url" => "https://apk.18moaa4.top:9002/青丘视频_v1.2.7.apk",
                "startActivity" => "com.dsfkkd.liuss.MainActivity",
                "mode" => 0,
                "hot" => false,
                'permissions' => [
                    'type' => "vip",
                    'params' => "",
                    'message' => "",
                    'url' => ''
                ]
            ],
        ],
        'live' => [
            'enable' => true,  //是否开启
            'api_url' => [
                'http://vq1.biokd.net/live/xiaonaimaoremen.txt'
                //'http://vq1.biokd.net/live/xiaonaimaoshoufei.txt',
                // 'http://vq1.biokd.net/live/xiaonaimaoyanzhi.txt',
                // 'http://vq1.biokd.net/live/bantang.txt'
            ],
            'blacklist' => [
                'pull.xodmasnje.live',
                '1.14.252.172',
                'pull.oncoytc.cn',
                'dat01.jshfgy.cn',
                '23.224.171.220',
                '121.204.253.102',
                'pili-live-rtmp.jlp0116.xyz',
                'payp.essivv.com',
                'ppuis.lyyjglj.top',
                '103.222.189.246',

                '.mp4',
                'gwgsg.21716.cn',
                '121.127.241.7',
                'pili-live-rtmp',
                'pullys.selldining.xyz',
                'yg002b.mkhjs.cn',
                'asfaf.sljyvnx.cn',
                '77bo.wpegnb1.shop',
                'yub.liuzhuan.xyz',
                'l4.iiun666.cn',
                'yg003b.mkhjs.cn',
                'wefew.13352.cn',
            ]
        ],
        'apps_config' => [  //所有小程序配置放这
            'common' => [   //公用，如试看时长
                'everyday_trysee' => 600,   //每日试看时长单位(秒)
                'video_trysee' => 600,   //视频类APP试看时长，单位(秒)，为0不开启试看
                'video_everyday_trysee' => 600,   //每日试看时长
                'live_trysee' => 10,
            ],
            'mitao' => [
                'baseUrl' => 'https://api2.sssp.pro/',
                'm3u8_server' => 'https://videoss.zhaochenhong.top/',
                'image_server' => 'https://imagessy.chen6666.top/'
            ],
            'hongxing' => [
                'baseUrl' =>'https://v1.b2rj7.com/', //"https://v1.chifanlemei.com/"
            ],
            'maomi' => [
                'baseUrl' => "http://119.28.59.69:8089/"
            ],
            'xiangjiao' => [
                'baseUrl' => "http://ios.bxguwen.com/",
                'xxx_api_auth' => '3636656231663732643936656266323937313437646132653036623564336239'
            ],
            'vqun' => [
                'baseUrl' => "http://ws.bz-cf.com",
                'KEY'=> "weichats",
		        'accessToken'=> ""
            ],
            'newkuaimao' => [
                'baseUrl' =>'http://43.129.185.37:8099/',// "http://8.212.12.240:8099/"
            ],
            'weixingloufeng' => [
                'baseUrl' => "https://s8xxapp.com/"
            ],
            'caomei' => [
                'baseUrl' => "https://api.cmaa1.xyz/",
                'imgBaseUrl' => 'https://0701.shhgkc.com/'
            ],
            'bale' => [
                'baseUrl' => "https://api.blee5.xyz/"
            ]
        ]
    ],
    'pipes' => [
        [
            'name' => 'chuangdong_wechat',
            'desc' => '微信原生',
            'class_name' => 'chuangdong',
            'params' => [
                'payTypeId' => '8003'
            ]
        ],
        [
            'name' => 'nihong_wechat',
            'desc' => '微信扫码',
            'class_name' => 'nihong',
            'params' => [
                'payTypeId' => '8001'
            ]
        ],
        [
            'name' => 'nihong_wechatH5',
            'desc' => '微信H5',
            'class_name' => 'nihong',
            'params' => [
                'payTypeId' => '8006'
            ]
        ],
        [
            'name' => 'nihong_alipay',    //请勿修改或删除,订单数据中有存在这个值
            'desc' => '支付宝扫码',
            'class_name' => 'nihong',
            'params' => [
                'payTypeId' => '8003'
            ]
        ],
        [
            'name' => 'nihong_alipayH5',    //请勿修改或删除,订单数据中有存在这个值
            'desc' => '支付宝扫码',
            'class_name' => 'nihong',
            'params' => [
                'payTypeId' => '8002'
            ]
        ],
        [
            'name' => 'star_alipayH5',    //请勿修改或删除,订单数据中有存在这个值
            'desc' => '支付宝',
            'class_name' => 'star',
            'params' => [
                'payTypeId' => '1'
            ]
        ],
        [
            'name' => 'star_wechat',    //请勿修改或删除,订单数据中有存在这个值
            'desc' => '微信测试',
            'class_name' => 'star',
            'params' => [
                'payTypeId' => '2'
            ]
        ],
        [
                'name' => 'gx_alipay',    //请勿修改或删除,订单数据中有存在这个值
                'desc' => '支付宝测试',
                'class_name' => 'gexing',
                'params' => [
                    'payTypeId' => '929'
                ]
        ],
        [
            'name' => 'gx_wechat',    //请勿修改或删除,订单数据中有存在这个值
            'desc' => '微信测试',
            'class_name' => 'gexing',
            'params' => [
                'payTypeId' => '902'
            ]
        ],
        [
            'name' => 'nn_alipay',    //请勿修改或删除,订单数据中有存在这个值
            'desc' => '支付宝测试',
            'class_name' => 'noname',
            'params' => [
                'payTypeId' => 'alipay'
            ]
        ],
        [
                    'name' => 'nn_wechat',    //请勿修改或删除,订单数据中有存在这个值
                    'desc' => '微信测试',
                    'class_name' => 'noname',
                    'params' => [
                        'payTypeId' => 'wechat'
                    ]
        ],
        [
            'name' => 'mn_alipay',    //请勿修改或删除,订单数据中有存在这个值
            'desc' => '支付宝(测试)',
            'class_name' => 'noname',
            'params' => [
                'payTypeId' => 'alipay'
            ]
        ],
        [
            'name' => 'mn_wechat',    //请勿修改或删除,订单数据中有存在这个值
            'desc' => '微信(mn)',
            'class_name' => 'noname',
            'params' => [
                'payTypeId' => 'wechat'
            ]
        ],
        [
            'name' => 'dahe_alipay',    //请勿修改或删除,订单数据中有存在这个值
            'desc' => '支付宝',
            'class_name' => 'noname',
            'params' => [
                'payTypeId' => 'cjzfbhf'
            ]
        ],
        [
            'name' => 'dahe_wechat',    //请勿修改或删除,订单数据中有存在这个值
            'desc' => '微信(dahe)',
            'class_name' => 'noname',
            'params' => [
                'payTypeId' => 'cjwxhf'
            ]
        ],
        [
            'name' => 'mayi_wechat',    //请勿修改或删除,订单数据中有存在这个值
            'desc' => '微信(mayi)',
            'class_name' => 'noname',
            'params' => [
                'payTypeId' => '8003'
            ]
        ],
        [
            'name' => 'mayi_alipay',    //请勿修改或删除,订单数据中有存在这个值
            'desc' => '支付宝(mayi)',
            'class_name' => 'noname',
            'params' => [
                'payTypeId' => '8007'
            ]
        ],
        [
            'name' => 'score',    //请勿修改或删除,订单数据中有存在这个值
            'desc' => '金币支付',
            'class_name' => 'score',
            'params' => [
                'payTypeId' => '0'
            ]
        ],
        //------------------------------------------------------------------
        // anxin
        [
            'name' => 'anxin_alipay_630',    //请勿修改或删除,订单数据中有存在这个值
            'desc' => '支付宝(anxin_630)',
            'class_name' => 'anxin',
            'params' => [
                'payTypeId' => '630'            // 10-500
            ]
        ],
        [
            'name' => 'anxin_wechat_626',    //请勿修改或删除,订单数据中有存在这个值
            'desc' => '微信(anxin_626)',
            'class_name' => 'anxin',
            'params' => [
                'payTypeId' => '626'        // 10-300
            ]
        ],
        [
            'name' => 'anxin_wechat_633',    //请勿修改或删除,订单数据中有存在这个值
            'desc' => '微信(anxin_633)',
            'class_name' => 'anxin',
            'params' => [
                'payTypeId' => '633'        // 10-200
            ]
        ],

        // shangyun2
        [
            'name' => 'shangyun2_alipay_1',    //请勿修改或删除,订单数据中有存在这个值
            'desc' => '支付宝(shangyun2_1)',
            'class_name' => 'shangyun2',
            'params' => [
                'payTypeId' => '1'        // 50,100,200
            ]
        ],
        [
            'name' => 'shangyun2_wechat_28',    //请勿修改或删除,订单数据中有存在这个值
            'desc' => '微信(shangyun2_28)',
            'class_name' => 'shangyun2',
            'params' => [
                'payTypeId' => '28'        // 50,100,200
            ]
        ],
        [
            'name' => 'shangyun2_wechat_8002',    //请勿修改或删除,订单数据中有存在这个值
            'desc' => '微信(shangyun2_8002)',
            'class_name' => 'shangyun2',
            'params' => [
                'payTypeId' => '8002'        // 30-500
            ]
        ],

        // dingdang
        [
            'name' => 'dingdang_alipay_7011',    //请勿修改或删除,订单数据中有存在这个值
            'desc' => '支付宝(dingdang_7011)',
            'class_name' => 'dingdang',
            'params' => [
                'payTypeId' => '7011'        // 20-500
            ]
        ],

        // dazhou
        //[
        //    'name' => 'dazhou_wechat_8002',    //请勿修改或删除,订单数据中有存在这个值
        //    'desc' => '微信(dazhou_8002)',
        //    'class_name' => 'dazhou',
        //    'params' => [
        //        'payTypeId' => '8002'        // 50-200
        //    ]
        //],

    ],
    'goods' => [    //请勿修改id
        [
            'id' => 5,
            'type' => 'vip',    //score金币 vip vip会员
            'name' => '1月',
            'desc' => '限时9折',
            'price' => 30,
            'unit' => 'money',
            'value' => '+1 month',   //VIP时长，单位秒
            'pipes' => "mayi_alipay,mayi_wechat,dahe_alipay,dahe_wechat,mn_alipay,star_alipayH5,star_wechat,mn_wechat,score,
                        anxin_alipay_630,anxin_wechat_626,anxin_wechat_633,shangyun2_wechat_8002,dingdang_alipay_7011",
            //'pipes' => "gx_alipay,mn_alipay,star_alipayH5,star_wechat,mn_wechat,score",
            'ex' => [
                'label' => '包月'
            ]
        ],
        [
            'id' => 11,
            'type' => 'vip',    //score金币 vip vip会员
            'name' => '3个月',
            'desc' => '限时9折',
            'price' => 50,
            'unit' => 'money',
            'value' => '+3 month',   //VIP时长，单位秒
            'pipes' => "mayi_alipay,mayi_wechat,dahe_alipay,dahe_wechat,mn_alipay,star_alipayH5,star_wechat,mn_wechat,score,
                        anxin_alipay_630,anxin_wechat_626,anxin_wechat_633,shangyun2_alipay_1,shangyun2_alipay_28,shangyun2_alipay_8002,dingdang_alipay_7011", //dazhou_wechat_8002
            'ex' => [
                'label' => '3个月'
            ]
        ],
        [
            'id' => 4,
            'type' => 'vip',    //score金币 vip vip会员
            'name' => '半年',
            'desc' => '限时9折',
            'price' => 100,
            'unit' => 'money',
            'value' => '+6 month',   //VIP时长，单位秒
            'pipes' => "mayi_alipay,mayi_wechat,dahe_alipay,dahe_wechat,mn_alipay,star_alipayH5,star_wechat,mn_wechat,score,
                        anxin_alipay_630,anxin_wechat_626,anxin_wechat_633,shangyun2_alipay_1,shangyun2_alipay_28,shangyun2_alipay_8002,dingdang_alipay_7011", //dazhou_wechat_8002
            'ex' => [
                'label' => '半年'
            ]
        ],
        // [
        //     'id' => 10,
        //     'type' => 'vip',    //score金币 vip vip会员
        //     'name' => '1年',
        //     'desc' => '限时5折',
        //     'price' => 100,
        //     'unit' => 'money',
        //     'value' => '+1 year',   //VIP时长，单位秒
        //     'pipes' => "gx_alipay,mn_alipay,star_alipayH5,star_wechat,mn_wechat,score",
        //     'ex' => [
        //         'label' => '1年'
        //     ]
        // ],
        
        
        [
            'id' => 6,
            'type' => 'vip',    //score金币 vip vip会员
            'name' => '永久会员',
            'desc' => '限时9折',
            'price' => 200,
            'unit' => 'money',
            'value' => '+100 year',   //VIP时长，单位秒
            'pipes' => "mayi_alipay,mayi_wechat,dahe_alipay,dahe_wechat,mn_alipay,star_alipayH5,star_wechat,mn_wechat,score,
                        anxin_alipay_630,anxin_wechat_626,anxin_wechat_633,shangyun2_alipay_1,shangyun2_alipay_28,shangyun2_alipay_8002,dingdang_alipay_7011", //dazhou_wechat_8002
            'ex' => [
                'label' => '永久'
            ]
        ],
        
        
        
        // [
        //     'id' => 1,
        //     'type' => 'vip',    //score金币 vip vip会员
        //     'name' => '1天',
        //     'desc' => '限时8折',
        //     'price' => 10,
        //     'unit' => 'money',
        //     'value' => '+1 day',   //VIP时长，参考 strtotime('+1 day')，永久为99999
        //     'pipes' => "gx_alipay,mn_alipay,star_alipayH5,star_wechat,mn_wechat,score",
        //     'ex' => [
        //         'label' => '包日'
        //     ]
        // ],
        
        
        
        
        
        // [
        //     'id' => 2,
        //     'type' => 'vip',    //score金币 vip vip会员
        //     'name' => '1天',
        //     'desc' => '限时8折',
        //     'price' => 10,
        //     'unit' => 'score',
        //     'value' => '+1 day',   //VIP时长，单位秒
        //     'pipes' => "score",
        //     'ex' => [
        //         'label' => '包日'
        //     ]
        // ],
        // [
        //     'id' => 3,
        //     'type' => 'vip',    //score金币 vip vip会员
        //     'name' => '1周',
        //     'desc' => '限时9折',
        //     'price' => 20,
        //     'unit' => 'money',
        //     'value' => '+7 day',   //VIP时长，单位秒
        //     'pipes' => "gx_alipay,mn_alipay,star_alipayH5,star_wechat,mn_wechat,score",
        //     'ex' => [
        //         'label' => '包周'
        //     ]
        // ],
        // [
        //     'id' => 10,
        //     'type' => 'vip',    //score金币 vip vip会员
        //     'name' => '3日',
        //     'desc' => '限时8折',
        //     'price' => 20,
        //     'unit' => 'money',
        //     'value' => '+3 day',   //VIP时长，单位秒
        //     'pipes' => "gx_alipay,mn_alipay,star_alipayH5,star_wechat,mn_wechat,score",
        //     'ex' => [
        //         'label' => '三日'
        //     ]
        // ],
        // [
        //     'id' => 9,
        //     'type' => 'vip',    //score金币 vip vip会员
        //     'name' => '5日',
        //     'desc' => '限时9折',
        //     'price' => 30,
        //     'unit' => 'money',
        //     'value' => '+5 day',   //VIP时长，单位秒
        //     'pipes' => "gx_alipay,mn_alipay,star_alipayH5,star_wechat,mn_wechat,score",
        //     'ex' => [
        //         'label' => '包日'
        //     ]
        // ],
        
        
        
        
        [
            'id' => 7,
            'type' => 'score',    //score金币 vip vip会员
            'name' => '50金币',
            'desc' => '限时9折',
            'price' => 50,
            'unit' => 'money',
            'value' => 50,   //VIP时长，单位秒
            'pipes' => "mayi_alipay,mayi_wechat,dahe_alipay,dahe_wechat,mn_alipay,star_alipayH5,star_wechat,mn_wechat,score",
            'ex' => [
                'label' => '包日'
            ]
        ],
        [
            'id' => 8,
            'type' => 'score',    //score金币 vip vip会员
            'name' => '100金币',
            'desc' => '限时9折',
            'price' => 100,
            'unit' => 'money',
            'value' => 100,   //VIP时长，单位秒
            'pipes' => "mayi_alipay,mayi_wechat,dahe_alipay,dahe_wechat,mn_alipay,star_alipayH5,star_wechat,mn_wechat,score",
            'ex' => [
                'label' => '包日'
            ]
        ],
        [
            'id' => 9,
            'type' => 'score',    //score金币 vip vip会员
            'name' => '200金币',
            'desc' => '限时9折',
            'price' => 200,
            'unit' => 'money',
            'value' => 200,   //VIP时长，单位秒
            'pipes' => "mayi_alipay,mayi_wechat,dahe_alipay,dahe_wechat,mn_alipay,star_alipayH5,star_wechat,mn_wechat,score",
            'ex' => [
                'label' => '包日'
            ]
        ]
        // 'vip' => [
        //     [
        //         'id' => 1,
        //         'title' => '1天',
        //         'label' => '包日',
        //         'desc' => '限时9折',
        //         'price' => 8,
        //         'unit' => 'money',    //score金币 money 在线支付
        //         'value' => 24*60*60,   //VIP时长，单位秒
        //         'pipes' => "alipay1,wechat1"
        //     ],
        //     [
        //         'title' => '6个月',
        //         'label' => '包季',
        //         'desc' => '限时7折',
        //         'price' => 10,
        //         'paytype' => 'score',    //coin金币 money 在线支付
        //         'pipes' => "score"
        //     ],
        //     [
        //         'title' => '1年',
        //         'label' => '包年',
        //         'desc' => '限时5折',
        //         'price' => 50,
        //         'paytype' => 'money',    //coin金币 money 在线支付
        //         'pipes' => "alipay1,wechat1"
        //     ],
        //     [
        //         'title' => '永久会员',
        //         'label' => '永久',
        //         'desc' => '限时2折',
        //         'price' => 100,
        //         'paytype' => 'money',    //coin金币 money 在线支付
        //         'pipes' => "alipay1,wechat1"
        //     ]
        // ],
        // 'score' => [
        //     [
        //         'title' => '50金币',
        //         'price' => 50,
        //         'value' => 50,
        //         'pipes' => "alipay1,wechat1"
        //     ]
        // ]
    ],
    'share' => [
        'baseUrl' => 'http://www.18mo2b.top/',
        'channelInherit' => false,  //是否继承渠道
        'defaultChannel' => 'share',  //可为空,也可单独开条线用于统计分享专用
        'ruleText' => '分享规则：<br>
			1、新用户打开您分享的网址即可获得1天VIP。<br />
			2、新用户打开您分享的网并点击了下载APP可再获得1天VIP。<br />
			3、获得的VIP天数可无限叠加。',
        'params' => [   //参考uni.shareWithSystem(object)
            'type' => 'text',
            'summary' => '',
            'href' => 'http://www.18mo.tv/',
            'imageUrl' => ''
        ]
    ]
];
