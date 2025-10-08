<?php
//【警告】此文件为APP的配置，请谨慎修改，一个标点都可能语法错误造成客户端无法正常打开

return [
    'apk_down_url' => 'https://apk.18moaa2.top:9002/18/c_1.apk',
    'ios_down_url' => 'https://www.18mo1a.top/',  //IOS端跳转地址(跳落地页)
    'res_base_url' => 'https://res.18mo4.info:9002/', //所有静态资源所在的域名
    "agent" => [
        'share_base_url' => 'https://www.18mo1a.top/'
    ],
    "appConfig" => [
        'apps_common' => [    //小程序用到的配置
            'video_trysee' => 600,   //视频类APP试看时长，单位(秒)，为0不开启试看
        ],
        'kefu_url' => 'https://www.18mo1a.top/contact.html',   //'https://rf2vdg.com/chat/text/chat_0olp90.html' ,   //'http://kf.18mo1.info/',
        'group_url' => 'https://t.me/+pRJDlZWxR-ZmNTlh',  //交流群地址
        "theme" => [
            "statusBarStyle" => "light", //dark或light
            "backgroundImage" => "http://img.xker.com/xkerfiles/allimg/1603/1941236092-13.jpg",
        ],
        "upgrade" => [
            "lastVersion" => "1.0.7",   //最新版本
            "isMandatory" => false,       //是否强制升级
            "msg" => "1、修复会员充值后需要重启生效的BUG<br><br>",
            "url" => "https://apk.18moaa2.top:9002/18/c_1.apk"
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
                'href' => 'http://156.251.137.149:8085/?channelCode=share',
                'imageUrl' => ''
            ]
        ],
        'ads' => [
            'start' => [   //开屏广告
                "show" => true,
                "autoRedirect" => false,
                'image' =>'https://res.18mo4.info:9002/user_icons/7e063778c51e44538f32ef9eed27be5c.jpg', //'https://res.18mo4.info:9002/user_icons/hjyx_start.jpg',   //https://res.18mo4.info:9002/images/start1.jpg //'http://pic1.win4000.com/mobile/2020-03-17/5e70362d1a920.jpg', //'https://wx3.sinaimg.cn/mw690/003vLjNzly1gtwc51k715j62064catlu02.jpg',
                'url' =>'https://h6243.com:1888',  //http://552303.vip
                "time" => 5    //倒计时时间，单位秒
            ],
            'home_slide' => [   //首页幻灯片
                "show" => true,
                "height" => "38vw",
                "list" => [
                    // [
                    //     'title' => '',
                    //     'image' => 'https://res.18mo4.info:9002/user_icons/b714-204.jpg',
                    //     'url' => 'https://b3562.com:36555',
                    //     'mode' => 1
                    // ],
                    [
                        'title' => '',
                        'image' => 'https://res.18mo4.info:9002/user_icons/f5fe33e6f67c4b7aa90e85c425b7bf2b.gif',
                        'url' => 'https://9070x.com:8825',
                        'mode' => 1
                    ],
                    [
                        'title' => '',
                        'image' => 'https://res.18mo4.info:9002/user_icons/cfa79762a2854ea09370868fa0e309a0.gif',
                        'url' => 'https://h6146.com:1888',
                        'mode' => 1
                    ],
                    // [
                    //     'title' => '',
                    //     'image' => 'https://res.18mo4.info:9002/user_icons/seyu_banner.jpg',
                    //     'url' => 'https://mdt444.com',
                    //     'mode' => 1
                    // ],
                    [
                        'title' => '',
                        'image' => 'https://res.18mo4.info:9002/user_icons/700.200.2.jpg',
                        'url' => 'http://www.288sss.xyz/?channelCode=H2',
                        'mode' => 1
                    ],
                    // [
                    //     'title' => '',
                    //     'image' => 'https://res.18mo4.info:9002/user_icons/tgsy_banner.jpg',
                    //     'url' => 'http://ac52.54juzi.cc',
                    //     'mode' => 1
                    // ],
                    // [
                    //     'title' => '',
                    //     'image' => 'https://res.18mo4.info:9002/user_icons/seyu_banner.jpg',
                    //     'url' => 'https://xsy06.cc',
                    //     'mode' => 1
                    // ],
                    // [
                    //     'title' => '',
                    //     'image' => 'https://res.18mo4.info:9002/user_icons/694_180.gif',
                    //     'url' => 'http://943583.vip',
                    //     'mode' => 1
                    // ],
                    
                    // [
                    //     'title' => '',
                    //     'image' => 'https://res.18mo4.info:9002/user_icons/694_180.gif',
                    //     'url' => 'https://654b.top', //'https://65728.top',
                    //     'mode' => 1
                    // ],
                    
                    // [
                    //     'title' => '',
                    //     'image' => 'https://res.18mo4.info:9002/images/banner.jpg',
                    //     'url' => 'https://boao8511.com:32202',
                    //     'mode' => 1
                    // ],
                    // [
                    //     'title' => '',
                    //     'image' => 'https://res.18mo4.info:9002/images/byzb.png',
                    //     'url' => 'http://96wf.co',
                        
                    //     'mode' => 1
                    // ],
                    // [
                    //     'title' => '',
                    //     'image' => 'https://res.18mo4.info:9002/user_icons/bet365_banner2.jpg',
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
                    //     'image' => 'https://res.18mo4.info:9002/user_icons/b714-204.jpg',
                    //     'url' => 'https://b3562.com:36555',
                    //     'mode' => 1
                    // ],
                    [
                        'title' => '',
                        'image' => 'https://res.18mo4.info:9002/user_icons/f5fe33e6f67c4b7aa90e85c425b7bf2b.gif',
                        'url' => 'https://9070x.com:8825',
                        'mode' => 1
                    ],
                    [
                        'title' => '',
                        'image' => 'https://res.18mo4.info:9002/user_icons/cfa79762a2854ea09370868fa0e309a0.gif',
                        'url' => 'https://h6146.com:1888',
                        'mode' => 1
                    ],
                    // [
                    //     'title' => '',
                    //     'image' => 'https://res.18mo4.info:9002/user_icons/seyu_banner.jpg',
                    //     'url' => 'https://mdt444.com',
                    //     'mode' => 1
                    // ],
                    [
                        'title' => '',
                        'image' => 'https://res.18mo4.info:9002/user_icons/700.200.2.jpg',
                        'url' => 'http://www.288sss.xyz/?channelCode=H2',
                        'mode' => 1
                    ],
                    // [
                    //     'title' => '',
                    //     'image' => 'https://res.18mo4.info:9002/user_icons/tgsy_banner.jpg',
                    //     'url' => 'http://ac52.54juzi.cc',
                    //     'mode' => 1
                    // ],
                    // [
                    //     'title' => '',
                    //     'image' => 'https://res.18mo4.info:9002/user_icons/razb_banner.jpg',
                    //     'url' => 'http://www.288sss.xyz/?channelCode=H2',
                    //     'mode' => 1
                    // ],
                    // [
                    //     'title' => '',
                    //     'image' => 'https://res.18mo4.info:9002/user_icons/seyu_banner.jpg',
                    //     'url' => 'https://xsy06.cc',
                    //     'mode' => 1
                    // ],
                    // [
                    //     'title' => '',
                    //     'image' => 'https://res.18mo4.info:9002/user_icons/694_180.gif',
                    //     'url' => 'http://943583.vip',
                    //     'mode' => 1
                    // ],
                    
                    // [
                    //     'title' => '',
                    //     'image' => 'https://res.18mo4.info:9002/user_icons/694_180.gif',
                    //     'url' => 'https://654b.top', //'https://65728.top',
                    //     'mode' => 1
                    // ],
                    
                    // [
                    //     'title' => '',
                    //     'image' => 'https://res.18mo4.info:9002/images/banner.jpg',
                    //     'url' => 'https://boao8511.com:32202',
                    //     'mode' => 1
                    // ],
                    // [
                    //     'title' => '',
                    //     'image' => 'https://res.18mo4.info:9002/images/byzb.png',
                    //     //'url' => 'https://nsbieq.xyz/1.html?channelCode=byf829',
                    //     'url' => 'http://96wf.co',
                        
                    //     'mode' => 1
                    // ],
                    // [
                    //     'title' => '',
                    //     'image' => 'https://res.18mo4.info:9002/user_icons/bet365_banner2.jpg',
                    //     'url' => 'https://b3562.com:36555',
                    //     'mode' => 1
                    // ],
                    // [
                    //     'title' => '',
                    //     'image' => 'https://res.18mo4.info:9002/user_icons/bet365_banner2.jpg',
                    //     'url' => 'https://b3562.com:36555',
                    //     'mode' => 1
                    // ],
                    // [
                    //     'title' => '',
                    //     'image' => 'https://res.18mo4.info:9002/images/banner.png',
                    //     'url' => 'https://luo1.xyz?channel_code=OSLLA067',
                    //     'mode' => 1
                    // ]
                ]
            ],
            'live_slide' => [   //首页幻灯片
                "show" => true,
                "height" => "38vw",
                "list" => [
                    // [
                    //     'title' => '',
                    //     'image' => 'https://res.18mo4.info:9002/user_icons/b714-204.jpg',
                    //     'url' => 'https://b3562.com:36555',
                    //     'mode' => 1
                    // ],
                    [
                        'title' => '',
                        'image' => 'https://res.18mo4.info:9002/user_icons/f5fe33e6f67c4b7aa90e85c425b7bf2b.gif',
                        'url' => 'https://9070x.com:8825',
                        'mode' => 1
                    ],
                    [
                        'title' => '',
                        'image' => 'https://res.18mo4.info:9002/user_icons/cfa79762a2854ea09370868fa0e309a0.gif',
                        'url' => 'https://h6146.com:1888',
                        'mode' => 1
                    ],
                    // [
                    //     'title' => '',
                    //     'image' => 'https://res.18mo4.info:9002/user_icons/seyu_banner.jpg',
                    //     'url' => 'https://mdt444.com',
                    //     'mode' => 1
                    // ],
                    [
                        'title' => '',
                        'image' => 'https://res.18mo4.info:9002/user_icons/700.200.2.jpg',
                        'url' => 'http://www.288sss.xyz/?channelCode=H2',
                        'mode' => 1
                    ],
                    // [
                    //     'title' => '',
                    //     'image' => 'https://res.18mo4.info:9002/user_icons/tgsy_banner.jpg',
                    //     'url' => 'http://ac52.54juzi.cc',
                    //     'mode' => 1
                    // ],
                    // [
                    //     'title' => '',
                    //     'image' => 'https://res.18mo4.info:9002/user_icons/razb_banner.jpg',
                    //     'url' => 'http://552303.vip',
                    //     'mode' => 1
                    // ],
                    // [
                    //     'title' => '',
                    //     'image' => 'https://res.18mo4.info:9002/user_icons/seyu_banner.jpg',
                    //     'url' => 'https://xsy06.cc',
                    //     'mode' => 1
                    // ],
                    // [
                    //     'title' => '',
                    //     'image' => 'https://res.18mo4.info:9002/user_icons/694_180.gif',
                    //     'url' => 'http://943583.vip',
                    //     'mode' => 1
                    // ],
                    
                    // [
                    //     'title' => '',
                    //     'image' => 'https://res.18mo4.info:9002/user_icons/694_180.gif',
                    //     'url' => 'https://654b.top', //'https://65728.top',
                    //     'mode' => 1
                    // ],
                    
                    // [
                    //     'title' => '',
                    //     'image' => 'https://res.18mo4.info:9002/images/banner.jpg',
                    //     'url' => 'https://boao8511.com:32202',
                    //     'mode' => 1
                    // ],
                    // [
                    //     'title' => '',
                    //     'image' => 'https://res.18mo4.info:9002/images/byzb.png',
                    //     //'url' => 'https://nsbieq.xyz/1.html?channelCode=byf829',
                    //     'url' => 'http://96wf.co',
                        
                    //     'mode' => 1
                    // ],
                    // [
                    //     'title' => '',
                    //     'image' => 'https://res.18mo4.info:9002/user_icons/bet365_banner2.jpg',
                    //     'url' => 'https://b3562.com:36555',
                    //     'mode' => 1
                    // ],
                    // [
                    //     'title' => '',
                    //     'image' => 'https://res.18mo4.info:9002/images/byzb.png',
                    //     'url' => 'http://96wf.co',
                        
                    //     'mode' => 1
                    // ]
                ]
            ],
            'live_player_float' =>[
                "show" => true,
                'image' => 'https://res.18mo4.info:9002/images/live_ad.png',
                'width' => '120px',
                'height' => '30px',
                'url' => 'https://avmit.xyz/channelCode=avman2'
            ],
            'apps' => [
                'home_slide' => [   //小程序的首页幻灯片
                    "show" => true,
                    "height" => "38vw",
                    "list" => [
                        // [
                        //     'title' => '',
                        //     'image' => 'https://res.18mo4.info:9002/user_icons/b714-204.jpg',
                        //     'url' => 'https://b3562.com:36555',
                        //     'mode' => 1
                        // ],
                        [
                            'title' => '',
                            'image' => 'https://res.18mo4.info:9002/user_icons/f5fe33e6f67c4b7aa90e85c425b7bf2b.gif',
                            'url' => 'https://9070x.com:8825',
                            'mode' => 1
                        ],
                        [
                            'title' => '',
                            'image' => 'https://res.18mo4.info:9002/user_icons/cfa79762a2854ea09370868fa0e309a0.gif',
                            'url' => 'https://h6146.com:1888',
                            'mode' => 1
                        ],
                        // [
                        //     'title' => '',
                        //     'image' => 'https://res.18mo4.info:9002/user_icons/seyu_banner.jpg',
                        //     'url' => 'https://mdt444.com',
                        //     'mode' => 1
                        // ],
                        [
                            'title' => '',
                            'image' => 'https://res.18mo4.info:9002/user_icons/700.200.2.jpg',
                            'url' => 'http://www.288sss.xyz/?channelCode=H2',
                            'mode' => 1
                        ],
                        // [
                        //     'title' => '',
                        //     'image' => 'https://res.18mo4.info:9002/user_icons/tgsy_banner.jpg',
                        //     'url' => 'http://ac52.54juzi.cc',
                        //     'mode' => 1
                        // ],
                        // [
                        //     'title' => '',
                        //     'image' => 'https://res.18mo4.info:9002/user_icons/razb_banner.jpg',
                        //     'url' => 'http://552303.vip',
                        //     'mode' => 1
                        // ],
                        // [
                        //     'title' => '',
                        //     'image' => 'https://res.18mo4.info:9002/user_icons/seyu_banner.jpg',
                        //     'url' => 'https://xsy06.cc',
                        //     'mode' => 1
                        // ],
                        // [
                        //     'title' => '',
                        //     'image' => 'https://res.18mo4.info:9002/user_icons/16-36-20.jpg',
                        //     'url' => 'http://943583.vip',
                        //     'mode' => 1
                        // ],
                        
                        // [
                        //     'title' => '',
                        //     'image' => 'https://res.18mo4.info:9002/user_icons/694_180.gif',
                        //     'url' => 'https://654b.top', //'https://65728.top',
                        //     'mode' => 1
                        // ],
                        
                        // [
                        //     'title' => '',
                        //     'image' => 'https://res.18mo4.info:9002/images/banner.png',
                        //     'url' => 'https://luo1.xyz?channel_code=OSLLA067',
                        //     'mode' => 0
                        // ]
                        
                    ]
                ],
                "player_banner" => [
                    'show' => true,
                    // 'image' => 'https://res.18mo4.info:9002/images/banner.png',
                    // 'url' => 'https://luo1.xyz?channel_code=OSLLA067'
                    'image' => 'https://res.18mo4.info:9002/user_icons/700.200.2.jpg', //'https://res.18mo4.info:9002/user_icons/razb_banner.jpg',
                    'url' => 'http://www.288sss.xyz/?channelCode=H2'
                    
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
            //     "title" => "茉莉直播",
            //     "image" => "https://res.18mo4.info:9002/user_icons/moli_logo.png",
            //     "url" => "https://qdff.0pxhr03.com:88/1/240790.html",
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
            //     "id" => "bet365",
            //     "title" => "365体育",
            //     "image" => "https://res.18mo4.info:9002/user_icons/bet365.png",
            //     "url" => "https://b3562.com:36555",
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
            
            [
                "id" => "amxpj",
                "title" => "澳门新葡京",
                "image" => "https://res.18mo4.info:9002/user_icons/d2144180baa74d97b39f96c9bb0a5e08.gif",
                "url" => "https://9070x.com:8825",
                "version" => 1,
                "mode" => 3,
                "hot" => false,
                'permissions' => [
                    'type' => "normal",
                    'params' => "",
                    'message' => "",
                    'url' => ''
                ]
            ],
            [
                "id" => "hgty",
                "title" => "皇冠体育",
                "image" => "https://res.18mo4.info:9002/user_icons/9584ebb2f78e4184bd30ea254439877f.gif",
                "url" =>"https://h6146.com:1888",
                "version" => 1,
                "mode" => 3,
                "hot" => false,
                'permissions' => [
                    'type' => "normal",
                    'params' => "",
                    'message' => "",
                    'url' => ''
                ]
            ],
            [
                "id" => "ouo",
                "title" => "同城约炮",
                "image" => "https://res.18mo4.info:9002/user_icons/ouo.png",
                "url" =>"https://www.phldv.com?channelCode=19_1",
                "version" => 1,
                "mode" => 3,
                "hot" => false,
                'permissions' => [
                    'type' => "normal",
                    'params' => "",
                    'message' => "",
                    'url' => ''
                ]
            ],
            // [
            //     "id" => "tyc",
            //     "title" => "太阳城",
            //     "image" => "https://res.18mo4.info:9002/user_icons/icon_tyc.png",
            //     "url" => "https://6765t.com:30653",
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
            //     "id" => "banquan",
            //     "title" => "伴圈同城",  //"",
            //     "image" => "https://res.18mo4.info:9002/user_icons/banquan.png",
            //     "url" => "https://xf13.cc",
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
            //     "id" => "mkax",
            //     "title" => "同城速约",
            //     "image" => "https://res.18mo4.info:9002/user_icons/mkax.png",
            //     "url" => "https://www.iobef.com?channelCode=02_3",
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
            //     "id" => "tcmn",
            //     "title" => "同城美女",
            //     "image" => "https://res.18mo4.info:9002/user_icons/tcmn.gif",
            //     "url" => "http://ac52.54juzi.cc",
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
            //     "id" => "blgy",
            //     "title" => "伴邻约炮",
            //     "image" => "https://res.18mo4.info:9002/user_icons/blgy.png",
            //     "url" =>"https://ggt563.com",
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
            //     "id" => "tcyp",
            //     "title" => "同城约啪",
            //     "image" => "https://res.18mo4.info:9002/user_icons/logo3.png",
            //     "url" => "https://9527894.com?channelCode=XY06",    //"https://654b.top/", //"https://xxxttt1.com/?channelCode=X1",
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
            //     "id" => "yppc",
            //     "title" => "约炮嫖娼",  //"",
            //     "image" => "https://res.18mo4.info:9002/user_icons/banquan.png",
            //     "url" => "https://br.xxxsss1.com/?channelCode=X1",
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
            //     "id" => "ralt",
            //     "title" => "如爱约炮",
            //     "image" => "https://res.18mo4.info:9002/user_icons/ralt.png",
            //     "url" => "https://92g.in",    //"https://654b.top/", //"https://xxxttt1.com/?channelCode=X1",
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
            //     "id" => "xinmei",
            //     "title" => "同城模特",
            //     "image" => "https://res.18mo4.info:9002/user_icons/xinmei.png",
            //     "url" => "https://br.xxxsss1.com/?channelCode=X1",
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
            //     "id" => "seyu",
            //     "title" => "SeYu约炮",
            //     "image" => "https://res.18mo4.info:9002/user_icons/ssy.jpg",
            //     "url" => "https://xsy06.cc",
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
            //     "id" => "emp",
            //     "title" => "免费约炮",
            //     "image" => "https://res.18mo4.info:9002/user_icons/emp.png",
            //     "url" => "https://321r.top",
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
            //     "id" => "banye",
            //     "title" => "半夜直播",
            //     "image" => "https://res.18mo4.info:9002/user_icons/banye.png",
            //     "url" => "https://6gzg9.xyz/1.html?channelCode=byf93",
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
            //     "id" => "xinyue",
            //     "title" => "心悦直播",
            //     "image" => "https://res.18mo4.info:9002/user_icons/xinyue.ico",
            //     "url" => "https://qdff.laibaojy.com:89/11/10224.html",
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
            //     "id" => "ylc",
            //     "title" => "上门约炮",
            //     "image" => "https://res.18mo4.info:9002/user_icons/qingqu.png",
            //     "url" => "http://55613.top",
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
            //     "id" => "tgsy",
            //     "title" => "唐宫盛艳",
            //     "image" => "https://res.18mo4.info:9002/user_icons/tgsy.png",
            //     "url" => "https://6006.mx/?channelCode=36",
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
            //     "id" => "yanzhi",
            //     "title" => "胭脂",
            //     "image" => "https://res.18mo4.info:9002/user_icons/yanzhi.png",
            //     "url" => "https://yanzhi13.top",
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
            //     "id" => "jipin",
            //     "title" => "极品直播",
            //     "image" => "https://res.18mo4.info:9002/user_icons/jpzb.png",
            //     "url" => "https://xiangxj.oss-cn-shenzhen.aliyuncs.com/t1/521.apk",
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
            //     "id" => "jiuai",
            //     "title" => "久爱直播",
            //     "image" => "https://res.18mo4.info:9002/user_icons/jiuai.png",
            //     "url" => "https://qdff.jiaxiaweilai.com:88/13/hhh1.html",
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
            //     "id" => "binlan",
            //     "title" => "槟榔直播",
            //     "image" => "https://res.18mo4.info:9002/user_icons/binlan.png",
            //     "url" => "https://75ctu.me/?channelCode=b673",
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
            //     "id" => "tsrj",
            //     "title" => "天上人间",
            //     "image" => "https://res.18mo8.top:9002/user_icons/ssy.jpg",
            //     "url" => "https://nv15.cc/",    //"https://654b.top/", //"https://xxxttt1.com/?channelCode=X1",
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
            //     "id" => "ouo",
            //     "title" => "同城约炮",
            //     "image" => "https://res.18mo4.info:9002/user_icons/ouo.png",
            //     "url" =>"https://mdt444.com",
            //     "version" => 1,
            //     "mode" => 3,
            //     "hot" => false,
            //     'permissions' => [
            //         'type' => "normal",
            //         'params' => "",
            //         'message' => "",
            //         'url' => ''f
            //     ]
            // ],
            // [
            //     "id" => "xinmei",
            //     "title" => "同城模特",
            //     "image" => "https://res.18mo4.info:9002/user_icons/xinmei.png",
            //     "url" => "https://qmf6i.cc",
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
            [
                "id" => "d653",
                "title" => "同城速约",  //"免费约炮",
                "image" => "https://res.18mo4.info:9002/user_icons/13323e3f1a9883cb9c5866b1642380b0.webp",
                "url" => 'https://zuyvg.me',
                "version" => 1,
                "mode" => 3,
                "hot" => false,
                'permissions' => [
                    'type' => "normal",
                    'params' => "",
                    'message' => "",
                    'url' => ''
                ]
            ],
            
            [
                "id" => "aiaiyue",
                "title" => "爱爱约",  //"免费约炮",
                "image" => "https://res.18mo4.info:9002/user_icons/icon_aay.png",
                "url" => 'https://62aa.top',
                "version" => 1,
                "mode" => 3,
                "hot" => false,
                'permissions' => [
                    'type' => "normal",
                    'params' => "",
                    'message' => "",
                    'url' => ''
                ]
            ],
            
            // [
            //     "id" => "yexiu",
            //     "title" => "夜秀",
            //     "image" => "https://res.18mo4.info:9002/user_icons/yexiu.png",
            //     "url" => 'https://g22g.cc/?channelCode=hz71',
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
            //     "id" => "yyzb",
            //     "title" => "夜月直播",
            //     "image" => "https://res.18mo4.info:9002/user_icons/yyzb.png",
            //     "url" => 'https://eu.szruu.com/4037.html',
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
            //     "id" => "hxzb",
            //     "title" => "红袖直播",  //"免费约炮",
            //     "image" => "https://res.18mo4.info:9002/user_icons/hongxiu.png",
            //     "url" => 'http://e0f8.xyz',
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
            //     "id" => "emp",
            //     "title" => "免费约炮",
            //     "image" => "https://res.18mo4.info:9002/user_icons/emp.png",
            //     "url" => "https://321r.top",
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
            //     "id" => "ylc",
            //     "title" => "上门约炮",
            //     "image" => "https://res.18mo4.info:9002/user_icons/qingqu.png",
            //     "url" => "https://321r.top",
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
            //     "id" => "mudan",
            //     "title" => "牡丹直播",
            //     "image" => "https://res.18mo4.info:9002/user_icons/mudan.png",
            //     "url" => "https://pchl.cc/",
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
            //     "id" => "hehua",
            //     "title" => "荷花直播",
            //     "image" => "https://res.18mo4.info:9002/user_icons/hehua.png",
            //     "url" => "http://bf65.xyz",
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
            [
                "id" => "hyzb",
                "title" => "花样直播",
                "image" => "https://res.18mo4.info:9002/user_icons/hyzb.png",
                "url" => "https://kcpca.xyz/channelCode=xhypy1",
                "version" => 1,
                "mode" => 3,
                "hot" => false,
                'permissions' => [
                    'type' => "normal",
                    'params' => "",
                    'message' => "",
                    'url' => ''
                ]
            ],
            [
                "id" => "chunguang",
                "title" => "春光直播",
                "image" => "https://res.18mo4.info:9002/user_icons/chunguang.png",
                "url" => "https://avmit.xyz/channelCode=avman2",
                "version" => 1,
                "mode" => 3,
                "hot" => false,
                'permissions' => [
                    'type' => "normal",
                    'params' => "",
                    'message' => "",
                    'url' => ''
                ]
            ],
            
            // [
            //     "id" => "yiren",
            //     "title" => "伊人直播",
            //     "image" => "https://res.18mo4.info:9002/user_icons/1ren.png",
            //     "url" => "https://uw.dlkic.com/1504.html",    //"https://654b.top/", //"https://xxxttt1.com/?channelCode=X1",
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
            //     "id" => "semao",
            //     "title" => "色猫直播",
            //     "image" => "https://res.18mo4.info:9002/user_icons/icon_sm.png",
            //     "url" => "https://sm44d.xyz/index.html?channelCode=167",    //"https://654b.top/", //"https://xxxttt1.com/?channelCode=X1",
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
            //     "id" => "youwu",
            //     "title" => "尤物视频",
            //     "image" => "https://res.18mo4.info:9002/user_icons/6919.png",
            //     "url" => "https://ab6936.jskk0923.com",
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
            //     "id" => "sysyp",
            //     "title" => "微信约炮小姐",
            //     "image" => "https://res.18mo4.info:9002/user_icons/logo3.png",
            //     "url" => 'http://qq1.54nvyou.cc',// 'http://www.288sss.xyz/?channelCode=H2',    //"http://552303.vip",
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
            [
                "id" => "hjyx",
                "title" => "免费约炮",  //"免费约炮",
                "image" => "https://res.18mo4.info:9002/user_icons/emp.png",
                "url" => 'http://www.288sss.xyz/?channelCode=H2',// 'http://www.288sss.xyz/?channelCode=H2',    //"http://552303.vip",
                "version" => 1,
                "mode" => 3,
                "hot" => false,
                'permissions' => [
                    'type' => "normal",
                    'params' => "",
                    'message' => "",
                    'url' => ''
                ]
            ],
            // [
            //     "id" => "aiqiyu",
            //     "title" => "同城伴游",
            //     "image" => "https://res.18mo4.info:9002/user_icons/02012147bsij.png",
            //     "url" => 'https://dzyhf.com?channelCode=020',
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
            //     "id" => "tcky",
            //     "title" => "同城可约",
            //     "image" => "https://res.18mo4.info:9002/user_icons/635a3775664f8.png",
            //     "url" => 'https://sa999.cyou/?channelCode=jh',
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
            //     "id" => "xunyuan",
            //     "title" => "寻缘",  //"免费约炮",
            //     "image" => "https://res.18mo4.info:9002/user_icons/xunyuan.png",
            //     "url" => 'http://yzjm0.xyz',
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
            //     "id" => "banquan",
            //     "title" => "伴圈伴游",  //"",
            //     "image" => "https://res.18mo4.info:9002/user_icons/banquan.png",
            //     "url" => "https://ee51.cc",
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
            [
                "id" => "chunyu",
                "title" => "春雨直播",  //"",
                "image" => "https://res.18mo4.info:9002/user_icons/chunyuzhibo.png",
                "url" => "https://ar.tusrd.com/5647.html",
                "version" => 1,
                "mode" => 3,
                "hot" => false,
                'permissions' => [
                    'type' => "normal",
                    'params' => "",
                    'message' => "",
                    'url' => ''
                ]
            ],
            // [
            //     "id" => "miyuan",
            //     "title" => "秘缘",  //"免费约炮",
            //     "image" => "https://res.18mo4.info:9002/user_icons/miyuan.png",
            //     "url" => 'http://jsqij.com?channelCode=B10',
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
            //     "id" => "dyxy",
            //     "title" => "岛屿相约",
            //     "image" => "https://res.18mo4.info:9002/user_icons/dyxy.png",
            //     "url" => 'https://dy1547.com/?channelCode=HH457',
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
            //     "id" => "shouyue",
            //     "title" => "守约",
            //     "image" => "https://res.18mo4.info:9002/user_icons/shouyue.png",
            //     "url" => "https://hkt872.com/?channelCode=AA01",
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
            //     "id" => "xianhua",
            //     "title" => "鲜花直播",
            //     "image" => "https://res.18mo4.info:9002/user_icons/xianhua.ico",
            //     "url" => "https://thenine.oss-cn-shenzhen.aliyuncs.com/apk2/400.apk",
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
            //     "id" => "weimei",
            //     "title" => "唯美直播",
            //     "image" => "https://res.18mo4.info:9002/user_icons/weimei.png",
            //     "url" => "http://magic-meadow.com/?channelCode=agd_21",
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
            //     "id" => "mjdz",
            //     "title" => "萌姬大战",
            //     "image" => "https://res.18mo4.info:9002/user_icons/mjdz.jpg",
            //     "url" => "https://ent.orc252.cn/?n=mj137",
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
            //     "id" => "dasheng",
            //     "title" => "大神直播",
            //     "image" => "https://res.18mo4.info:9002/user_icons/dasheng.png",
            //     "url" => "https://dsabc4.top/?channelCode=dszx",
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
            //     "id" => "mitao",
            //     "title" => "蜜桃视频",
            //     "image" => "https://res.18mo4.info:9002/icons/蜜桃.png",
            //     "url" => "https://res.18mo4.info:9002/apps/100/mitao.zip",
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
            //     "id" => "yjya",
            //     "title" => "一键约爱",
            //     "image" => "https://res.18mo4.info:9002/user_icons/029.png",
            //     "url" => "https://883862.xyz/1.html?channelCode=byf10359",
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
            [
                "id" => "hongxing",
                "title" => "红杏视频",
                "image" => "https://res.18mo4.info:9002/icons/红杏视频.png",
                "url" => "https://res.18mo4.info:9002/apps/100/hongxing.zip",
                "version" => 1,
                "mode" => 0,
                "hot" => false,
                'permissions' => [
                    'type' => "trysee",
                    'params' => "",
                    'message' => "",
                    'url' => ''
                ]
            ], [
                "id" => "yinxing",
                "title" => "银杏FM",
                "image" => "https://res.18mo4.info:9002/icons/银杏.png",
                "url" => "https://res.18mo4.info:9002/apps/100/yinxing.zip",
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
            //     "image" => "https://res.18mo4.info:9002/icons/漫漫撸.png",
            //     "url" => "https://res.18mo4.info:9002/apps/100/mmlu.zip",
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
                "image" => "https://res.18mo4.info:9002/icons/猫咪.png",
                "url" => "https://res.18mo4.info:9002/apps/100/maomi.zip",
                "version" => 1,
                "mode" => 0,
                "hot" => false,
                'permissions' => [
                    'type' => "trysee",
                    'params' => "",
                    'message' => "",
                    'url' => ''
                ]
            // ], [
            //     "id" => "xiangjiao",
            //     "title" => "香蕉视频",
            //     "image" => "https://res.18mo4.info:9002/icons/香蕉.png",
            //     "url" => "https://res.18mo4.info:9002/apps/100/xiangjiao.zip",
            //     "version" => 1,
            //     "mode" => 0,
            //     "hot" => false,
            //     'permissions' => [
            //         'type' => "trysee",
            //         'params' => "",
            //         'message' => "",
            //         'url' => ''
            //     ]
            ], [
                "id" => "caomei",
                "title" => "草莓视频",
                "image" => "https://res.18mo4.info:9002/icons/草莓.png",
                "url" => "https://res.18mo4.info:9002/apps/100/caomei.zip",
                "version" => 1,
                "mode" => 0,
                "hot" => false,
                'permissions' => [
                    'type' => "trysee",
                    'params' => "",
                    'message' => "",
                    'url' => ''
                ]
            // ], [
            //     "id" => "bale",
            //     "title" => "芭乐视频",
            //     "image" => "https://res.18mo4.info:9002/icons/芭乐.png",
            //     "url" => "https://res.18mo4.info:9002/apps/100/bale.zip",
            //     "version" => 1,
            //     "mode" => 0,
            //     "hot" => false,
            //     'permissions' => [
            //         'type' => "trysee",
            //         'params' => "",
            //         'message' => "",
            //         'url' => ''
            //     ]
            ], [
                "id" => "xiaoshuo",
                "title" => "成人小说",
                "image" => "https://res.18mo4.info:9002/icons/小说.png",
                "url" => "https://res.18mo4.info:9002/apps/100/xiaoshuo4.zip",
                "version" => 4,
                "mode" => 0,
                "hot" => false,
                'permissions' => [
                    'type' => "trysee",
                    'params' => "",
                    'message' => "",
                    'url' => ''
                ]
            // ], [
            //     "id" => "vqun",
            //     "title" => "微群社区",
            //     "image" => "https://res.18mo4.info:9002/icons/微群社区.png",
            //     "url" => "https://res.18mo4.info:9002/apps/100/vqun.zip",
            //     "version" => 1,
            //     "mode" => 0,
            //     "hot" => false,
            //     'permissions' => [
            //         'type' => "trysee",
            //         'params' => "",
            //         'message' => "",
            //         'url' => ''
            //     ]
            ], [
                "id" => "tupian",
                "title" => "美女图片",
                "image" => "https://res.18mo4.info:9002/icons/美女图片.png",
                "url" => "https://res.18mo4.info:9002/apps/100/tupian.zip",
                "version" => 1,
                "mode" => 0,
                "hot" => false,
                'permissions' => [
                    'type' => "trysee",
                    'params' => "",
                    'message' => "",
                    'url' => ''
                ]
            ], [
                "id" => "daxiaojie",
                "title" => "大小姐",
                "image" => "https://res.18mo4.info:9002/icons/大小姐.png",
                "url" => "https://res.18mo4.info:9002/apps/100/m_daxiaojie.zip",
                "version" => 1,
                "mode" => 0,
                "hot" => false,
                'permissions' => [
                    'type' => "trysee",
                    'params' => "",
                    'message' => "",
                    'url' => ''
                ]
            // ], [
            //     "id" => "zhibo",
            //     "title" => "激情直播",
            //     "image" => "https://res.18mo4.info:9002/icons/激情直播.jpg",
            //     "url" => "https://res.18mo4.info:9002/apps/100/zhibo.zip",
            //     "version" => 1,
            //     "mode" => 0,
            //     "hot" => false,
            //     'permissions' => [
            //         'type' => "normal",
            //         'params' => "",
            //         'message' => "",
            //         'url' => ''
            //     ]
            ], [
                "id" => "newkuaimao",
                "title" => "快猫",
                "image" => "https://res.18mo4.info:9002/icons/快猫.png",
                "url" => "https://res.18mo4.info:9002/apps/100/newkuaimao.zip",
                "version" => 1,
                "mode" => 0,
                "hot" => false,
                'permissions' => [
                    'type' => "trysee",
                    'params' => "",
                    'message' => "",
                    'url' => ''
                ]
            ], [
                "id" => "weixingloufeng",
                "title" => "微杏楼凤",
                "image" => "https://res.18mo4.info:9002/icons/微杏楼凤.png",
                "url" => "https://res.18mo4.info:9002/apps/100/weixingloufeng.zip",
                "version" => 1,
                "mode" => 0,
                "hot" => false,
                'permissions' => [
                    'type' => "normal",
                    'params' => "",
                    'message' => "",
                    'url' => ''
                ]
            // ], [
            //     "id" => "localtest",
            //     "title" => "本地测试",
            //     "image" => "https://res.18mo4.info:9002/icons/淫水机.ico",
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
            ],
            // [
            //     "id" => "meishaonv",
            //     "title" => "美少女",
            //     "image" => "https://res.18mo4.info:9002/icons/%E5%A4%A7%E5%B0%8F%E5%A7%90.ico",
            //     "url" => "https://res.18mo4.info:9002/apps/100/m_meishaonv.zip",
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
                "image" => "https://res.18mo4.info:9002/icons/淫水机.ico",
                "url" => "https://res.18mo4.info:9002/apps/100/m_yinshuiji.zip",
                "version" => 1,
                "mode" => 0,
                "hot" => false,
                'permissions' => [
                    'type' => "trysee",
                    'params' => "",
                    'message' => "",
                    'url' => ''
                ]
            ], [
                "id" => "xiangnaier",
                "title" => "香奶儿",
                "image" => "https://res.18mo4.info:9002/icons/香奶儿.ico",
                "url" => "https://res.18mo4.info:9002/apps/100/m_xiangnaier.zip",
                "version" => 1,
                "mode" => 0,
                "hot" => false,
                'permissions' => [
                    'type' => "trysee",
                    'params' => "",
                    'message' => "",
                    'url' => ''
                ]
            // ], [
            //     "id" => "baipiao",
            //     "title" => "白嫖",
            //     "image" => "https://res.18mo4.info:9002/icons/白嫖.ico",
            //     "url" => "https://res.18mo4.info:9002/apps/100/m_baipiao.zip",
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
            //     "image" => "https://res.18mo4.info:9002/icons/小湿妹.ico",
            //     "url" => "https://res.18mo4.info:9002/apps/100/m_xiaoshimei.zip",
            //     "version" => 1,
            //     "mode" => 0,
            //     "hot" => false,
            //     'permissions' => [
            //         'type' => "trysee",
            //         'params' => "",
            //         'message' => "",
            //         'url' => ''
            //     ]
            ], [
                "id" => "huangav",
                "title" => "黄AV",
                "image" => "https://res.18mo4.info:9002/icons/黄AV.ico",
                "url" => "https://res.18mo4.info:9002/apps/100/m_huangav.zip",
                "version" => 1,
                "mode" => 0,
                "hot" => false,
                'permissions' => [
                    'type' => "trysee",
                    'params' => "",
                    'message' => "",
                    'url' => ''
                ]
            ], [
                "id" => "mangguo",
                "title" => "芒果视频",
                "image" => "https://res.18mo4.info:9002/icons/芒果.png",
                "url" => "https://res.18mo4.info:9002/apps/100/m_mangguozy.zip",
                "version" => 1,
                "mode" => 0,
                "hot" => false,
                'permissions' => [
                    'type' => "trysee",
                    'params' => "",
                    'message' => "",
                    'url' => ''
                ]
            //], [
            //     "id" => "qiukui",
            //     "title" => "秋葵视频",
            //     "image" => "https://res.18mo4.info:9002/icons/秋葵.png",
            //     "url" => "https://res.18mo4.info:9002/apps/100/m_qiukui.zip",
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
            //     "image" => "https://res.18mo4.info:9002/icons/佳丽.png",
            //     "url" => "https://res.18mo4.info:9002/apps/100/m_jiali.zip",
            //     "version" => 1,
            //     "mode" => 0,
            //     "hot" => false,
            //     'permissions' => [
            //         'type' => "trysee",
            //         'params' => "",
            //         'message' => "",
            //         'url' => ''
            //     ]
            ], [
                "id" => "lebo",
                "title" => "乐播",
                "image" => "https://res.18mo4.info:9002/icons/乐播.png",
                "url" => "https://res.18mo4.info:9002/apps/100/m_lebo.zip",
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
            //     "image" => "https://res.18mo4.info:9002/icons/花椒.png",
            //     "url" => "https://res.18mo4.info:9002/apps/100/m_huajiaozy.zip",
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
                "image" => "https://res.18mo4.info:9002/icons/老鸭.ico",
                "url" => "https://res.18mo4.info:9002/apps/100/m_laoya.zip",
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
            //     "image" => "https://res.18mo4.info:9002/user_icons/logo3.png",
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
            //     "image" => "https://res.18mo4.info:9002/user_icons/huafei901.png",
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
            //     "image" => "https://res.18mo4.info:9002/icons/探探.png",
            //     "url" => "https://res.18mo4.info:9002/apps/100/m_tantan.zip",
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
            //     "image" => "https://res.18mo4.info:9002/icons/秀色.png",
            //     "url" => "https://res.18mo4.info:9002/apps/100/m_xiusezy.zip",
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
            //     "image" => "https://res.18mo4.info:9002/icons/爱播.png",
            //     "url" => "https://res.18mo4.info:9002/apps/100/m_aibo3.zip",
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
            //     "image" => "https://res.18mo4.info:9002/icons/sesezy.png",
            //     "url" => "https://res.18mo4.info:9002/apps/100/m_sesezy.zip",
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
            //     "image" => "https://res.18mo4.info:9002/icons/sesezy.png",
            //     "url" => "https://res.18mo4.info:9002/apps/100/m_99zyw.zip",
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
            //     "image" => "https://res.18mo4.info:9002/icons/sesezy.png",
            //     "url" => "https://res.18mo4.info:9002/apps/100/m_lsnzy.zip",
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
            //     "image" => "https://res.18mo4.info:9002/icons/sesezy.png",
            //     "url" => "https://res.18mo4.info:9002/apps/100/m_fedzy.zip",
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
            //         "image" => "https://res.18mo4.info:9002/icons/sesezy.png",
            //         "url" => "https://res.18mo4.info:9002/apps/100/m_zmwzy.zip",
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
            //     "image" => "https://res.18mo4.info:9002/icons/sesezy.png",
            //     "url" => "https://res.18mo4.info:9002/apps/100/m_jczy.zip",
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
                    "image" => "https://res.18mo4.info:9002/icons/jav.jpg",
                    "url" => "https://res.18mo4.info:9002/apps/100/m_javmy.zip",
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
            //     "image" => "https://res.18mo4.info:9002/icons/sesezy.png",
            //     "url" => "https://res.18mo4.info:9002/apps/100/m_lilaizy.zip",
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
            //     "image" => "https://res.18mo4.info:9002/icons/sesezy.png",
            //     "url" => "https://res.18mo4.info:9002/apps/100/m_bttzy.zip",
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
                "image" => "https://res.18mo4.info:9002/icons/huanya.png",
                "url" => "https://res.18mo4.info:9002/apps/100/m_huanyazy.zip",
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
            //     "id" => "qqyp",
            //     "title" => "情趣约炮",
            //     "image" => "https://res.18mo4.info:9002/user_icons/qingqu.png",
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
            //     "image" => "https://res.18mo4.info:9002/crack_apps/兴趣部落.png",
            //     "url" => "https://apk.18moaa2.top:9002/兴趣部落.apk",
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
                "title" => "丝瓜视频",
                "image" => "https://res.18mo4.info:9002/crack_apps/丝瓜视频.jpeg",
                "url" => "https://apk.18moaa2.top:9002/丝瓜视频.apk",
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
                "packname" => "com.redinfo.pvpig",
                "title" => "小猪视频",
                "image" => "https://res.18mo4.info:9002/crack_apps/小猪视频.png",
                "url" => "https://apk.18moaa2.top:9002/小猪视频_1.2.89.apk",
                "startActivity" => "com.redinfo.pvpig.MainActivity",
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
                "title" => "宅男视频",
                "image" => "https://res.18mo4.info:9002/crack_apps/宅男视频.png",
                "url" => "https://apk.18moaa2.top:9002/宅男视频_5.5.0.apk",
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
                "packname" => "com.app.video.playerk",
                "title" => "番茄视频",
                "image" => "https://res.18mo4.info:9002/crack_apps/番茄视频.png",
                "url" => "https://apk.18moaa2.top:9002/番茄视频_9.8.apk",
                "startActivity" => "com.app.aiqiyi.activity.LauncherActivity",
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
                "packname" => "com.qdwmlz.astkcx",
                "title" => "红杏视频",
                "image" => "https://res.18mo4.info:9002/crack_apps/红杏视频.jpg",
                "url" => "https://apk.18moaa2.top:9002/红杏视频_1.1.6.apk",
                "startActivity" => "com.qdwmlz.astkcx.ui.activity.splash.SplashActivity",
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
            //     "image" => "https://res.18mo4.info:9002/crack_apps/快色视频.jpeg",
            //     "url" => "https://apk.18moaa2.top:9002/快色短视频_9.9.9.apk",
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
                "title" => "窝窝社区",
                "image" => "https://res.18mo4.info:9002/crack_apps/窝窝视频.jpeg",
                "url" => "https://apk.18moaa2.top:9002/窝窝社区_1.4.apk",
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
            //     "image" => "https://res.18mo4.info:9002/crack_apps/香蕉影视.png",
            //     "url" => "https://apk.18moaa2.top:9002/香蕉影视_3.0.5.apk",
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
            //     "image" => "https://res.18mo4.info:9002/crack_apps/香蕉视频.jpeg",
            //     "url" => "https://apk.18moaa2.top:9002/香蕉视频.apk",
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
                "title" => "兴趣部落",
                "image" => "https://res.18mo4.info:9002/crack_apps/兴趣部落.png",
                "url" => "https://apk.18moaa2.top:9002/兴趣部落.apk",
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
                "title" => "芭乐视频",
                "image" => "https://res.18mo4.info:9002/crack_apps/芭乐视频.png",
                "url" => "https://apk.18moaa2.top:9002/芭乐视频.apk",
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
                "title" => "大小姐AV",
                "image" => "https://res.18mo4.info:9002/crack_apps/大小姐AV.png",
                "url" => "https://apk.18moaa2.top:9002/大小姐AV.apk",
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
                "title" => "猫咪",
                "image" => "https://res.18mo4.info:9002/crack_apps/猫咪.png",
                "url" => "https://apk.18moaa2.top:9002/猫咪.apk",
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
            //     "image" => "https://res.18mo4.info:9002/crack_apps/银杏视频.jpeg",
            //     "url" => "https://apk.18moaa2.top:9002/银杏视频.apk",
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
                "title" => "1024视频",
                "image" => "https://res.18mo4.info:9002/crack_apps/1024视频.png",
                "url" => "https://apk.18moaa2.top:9002/1024视频_5.5.1.apk",
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
                "packname" => "net.miehuoguan.app",
                "title" => "滅火館",
                "image" => "https://res.18mo4.info:9002/crack_apps/滅火館.png",
                "url" => "https://apk.18moaa2.top:9002/滅火館_1.0.14.apk",
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
            //     "image" => "https://res.18mo4.info:9002/crack_apps/汤姆视频.png",
            //     "url" => "https://apk.18moaa2.top:9002/汤姆视频.apk",
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
            //     "image" => "https://res.18mo4.info:9002/crack_apps/草莓视频.jpeg",
            //     "url" => "https://apk.18moaa2.top:9002/草莓视频.apk",
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
            //     "image" => "https://res.18mo4.info:9002/crack_apps/黑猫视频.png",
            //     "url" => "https://apk.18moaa2.top:9002/黑猫视频_1.0.3.apk",
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
            [
                "packname" => "com.okgsy.dygsh002",
                "title" => "老虎直播",
                "image" => "https://res.18mo4.info:9002/crack_apps/老虎直播.png",
                "url" => "https://apk.18moaa2.top:9002/老虎直播_9.9.9.9.apk",
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
            [
                "packname" => "com.speak.m16",
                "title" => "水果派",
                "image" => "https://res.18mo4.info:9002/crack_apps/水果派.png",
                "url" => "https://apk.18moaa2.top:9002/水果派_999.apk",
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
            //     "image" => "https://res.18mo4.info:9002/crack_apps/51啪.png",
            //     "url" => "https://apk.18moaa2.top:9002/51啪.apk",
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
            //     "image" => "https://res.18mo4.info:9002/crack_apps/大象视频.jpeg",
            //     "url" => "https://apk.18moaa2.top:9002/大象视频.apk",
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
                "title" => "麻豆日记",
                "image" => "https://res.18mo4.info:9002/crack_apps/麻豆日记.jpeg",
                "url" => "https://apk.18moaa2.top:9002/麻豆日记.apk",
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
            //     "image" => "https://res.18mo4.info:9002/crack_apps/香蕉视频.png",
            //     "url" => "https://apk.18moaa2.top:9002/香蕉视频.apk",
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
                "title" => "妖精视频",
                "image" => "https://res.18mo4.info:9002/crack_apps/妖精视频.png",
                "url" => "https://apk.18moaa2.top:9002/妖精视频.apk",
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
                "title" => "青草视频",
                "image" => "https://res.18mo4.info:9002/crack_apps/青草视频.jpeg",
                "url" => "https://apk.18moaa2.top:9002/青草视频_1.0.0.apk",
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
                "title" => "小蝌蚪",
                "image" => "https://res.18mo4.info:9002/crack_apps/小蝌蚪.jpeg",
                "url" => "https://apk.18moaa2.top:9002/小蝌蚪_6.6.6.apk",
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
                "title" => "食色短视频",
                "image" => "https://res.18mo4.info:9002/crack_apps/食色短视频.png",
                "url" => "https://apk.18moaa2.top:9002/食色短视频_3.4.3.2.apk",
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
            //     "image" => "https://res.18mo4.info:9002/crack_apps/猎奇之家.png",
            //     "url" => "https://apk.18moaa2.top:9002/猎奇之家_1.0.8 (1).apk",
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
                "title" => "石榴视频",
                "image" => "https://res.18mo4.info:9002/crack_apps/石榴视频.png",
                "url" => "https://apk.18moaa2.top:9002/石榴视频_5.3.6.apk",
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
            //     "image" => "https://res.18mo4.info:9002/crack_apps/咪咪视频.jpeg",
            //     "url" => "https://apk.18moaa2.top:9002/咪咪视频.apk",
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
            //     "image" => "https://res.18mo4.info:9002/crack_apps/金联.png",
            //     "url" => "https://apk.18moaa2.top:9002/金联_1.0.0 (1).apk",
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
            //     "image" => "https://res.18mo4.info:9002/crack_apps/磨合视频.png",
            //     "url" => "https://apk.18moaa2.top:9002/磨合视频_11.2.apk",
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
            //     "image" => "https://res.18mo4.info:9002/crack_apps/青兔館.png",
            //     "url" => "https://apk.18moaa2.top:9002/青兔馆_3.2.2.apk",
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
            [
                "packname" => "com.phone.seyou.apq1",
                "title" => "色柚视频",
                "image" => "https://res.18mo4.info:9002/crack_apps/色柚视频.png",
                "url" => "https://apk.18moaa2.top:9002/seyoushipin_1.1.4.apk",
                "startActivity" => "cn.miyoumi.shorts.activity.SplashActivity",
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
            //     "packname" => "com.sy.xhf",
            //     "title" => "小黄蜂",
            //     "image" => "https://res.18mo4.info:9002/crack_apps/小黄蜂.png",
            //     "url" => "https://apk.18moaa2.top:9002/小黄蜂_1.0.11.apk",
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
            //     "packname" => "com.xhsyb.kankan",
            //     "title" => "小黄书",
            //     "image" => "https://res.18mo4.info:9002/crack_apps/小黄书.png",
            //     "url" => "https://apk.18moaa2.top:9002/小黄书_2.5.4.apk",
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
            //     "image" => "https://res.18mo4.info:9002/crack_apps/心动直播.png",
            //     "url" => "https://apk.18moaa2.top:9002/心动直播_4.6.23.1.apk",
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
            //     "image" => "https://res.18mo4.info:9002/crack_apps/ytb视频.png",
            //     "url" => "https://apk.18moaa2.top:9002/YTB_5.2.3.apk",
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
            //     "image" => "https://res.18mo4.info:9002/crack_apps/快乐视频.png",
            //     "url" => "https://apk.18moaa2.top:9002/快乐视频_2.7.6.apk",
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
                "title" => "爱浪",
                "image" => "https://res.18mo4.info:9002/crack_apps/爱浪.png",
                "url" => "https://apk.18moaa2.top:9002/爱浪_4.1.7.1_kill.apk",
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
            [
                "packname" => "com.lmgxsgx.cjgsgsg23",
                "title" => "初见",
                "image" => "https://res.18mo4.info:9002/crack_apps/初见.png",
                "url" => "https://apk.18moaa2.top:9002/初见_3.12.11.1.apk",
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
            //     "packname" => "live.svvpz.ieiwie",
            //     "title" => "快手成人版",
            //     "image" => "https://res.18mo4.info:9002/crack_apps/快手成人版.png",
            //     "url" => "https://apk.18moaa2.top:9002/快手成年版_4.2.0.apk",
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
            //     "image" => "https://res.18mo4.info:9002/crack_apps/樱桃影视.jpeg",
            //     "url" => "https://apk.18moaa2.top:9002/樱桃影视_4.3.1.apk",
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
                "title" => "cilicili",
                "image" => "https://res.18mo4.info:9002/crack_apps/cilicili短视频.png",
                "url" => "https://apk.18moaa2.top:9002/CiliCili短视频_3.4.3.2.apk",
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
                "packname" => "com.xvideos.zsq.app",
                "title" => "xVideos",
                "image" => "https://res.18mo4.info:9002/crack_apps/xvideos.png",
                "url" => "https://apk.18moaa2.top:9002/xVideos_1.1.3.apk",
                "startActivity" => "com.xvideos.zsq.app.rg_QiDongLei",
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
            //     "image" => "https://res.18mo4.info:9002/crack_apps/小草.png",
            //     "url" => "https://apk.18moaa2.top:9002/小草_2.2.5.apk",
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
                "title" => "Fulao2",
                "image" => "https://res.18mo4.info:9002/crack_apps/Fulao2.png",
                "url" => "https://apk.18moaa2.top:9002/Fulao2_2.00.apk",
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
            //     "image" => "https://res.18mo4.info:9002/crack_apps/lutube短视频.png",
            //     "url" => "https://apk.18moaa2.top:9002/luTu短视频_2.2.9.apk",
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
            [
                "packname" => "com.xxx.jrtt",
                "title" => "猫咪头条",
                "image" => "https://res.18mo4.info:9002/crack_apps/猫咪头条.png",
                "url" => "https://apk.18moaa2.top:9002/猫咪头条_9.9.9.apk",
                "startActivity" =>'com.xmvideo.app.MainActivity', //"com.ilulutv.fulao2.welcome.WelcomeActivity",
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
            //     "packname" => "com.lddccfcn66",
            //     "title" => "抖阴视频",
            //     "image" => "https://res.18mo4.info:9002/crack_apps/抖阴视频.png",
            //     "url" => "https://apk.18moaa2.top:9002/抖阴视频_1.6.1.apk",
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
            //     "image" => "https://res.18mo4.info:9002/crack_apps/大眼萌.png",
            //     "url" => "https://apk.18moaa2.top:9002/大眼萌_6.85.apk",
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
            //     "image" => "https://res.18mo4.info:9002/crack_apps/性用社.png",
            //     "url" => "https://apk.18moaa2.top:9002/性用社_2.6.apk",
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
                "title" => "北极狐",
                "image" => "https://res.18mo4.info:9002/crack_apps/北极狐.png",
                "url" => "https://apk.18moaa2.top:9002/北极狐_3.0.apk",
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
                "packname" => "com.microphoto.video",
                "title" => "优优视频",
                "image" => "https://res.18mo4.info:9002/crack_apps/优优视频.png",
                "url" => "https://apk.18moaa2.top:9002/优优视频_1.0.0.apk",
                "startActivity" => "com.microphoto.video.view.activity.StartActivity",
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
            //     "packname" => "com.lddccfcm",
            //     "title" => "熊猫视频",
            //     "image" => "https://res.18mo4.info:9002/crack_apps/熊猫视频.png",
            //     "url" => "https://apk.18moaa2.top:9002/熊猫视频_1.6.1.apk",
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
                "title" => "OnlyYou",
                "image" => "https://res.18mo4.info:9002/crack_apps/onlyyou.png",
                "url" => "https://apk.18moaa2.top:9002/OnlyYou_1.1.4.1.apk",
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
            [
                "packname" => "com.app.video.playt",
                "title" => "汤不热",
                "image" => "https://res.18mo4.info:9002/crack_apps/汤不热.png",
                "url" => "https://apk.18moaa2.top:9002/汤不热视频_9.8.apk",
                "startActivity" => "com.app.aiqiyi.activity.LauncherActivity",
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
                "packname" => "com.hihanhan.one.rt43",
                "title" => "一个",
                "image" => "https://res.18mo4.info:9002/crack_apps/一个.jpeg",
                "url" => "https://apk.18moaa2.top:9002/一个_6.6.6.apk",
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
                "title" => "七猫直播",
                "image" => "https://res.18mo4.info:9002/crack_apps/七猫直播.png",
                "url" => "https://apk.18moaa2.top:9002/七猫直播_6.6.6.6.apk",
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
                "title" => "榴莲视频",
                "image" => "https://res.18mo4.info:9002/crack_apps/榴莲.png",
                "url" => "https://apk.18moaa2.top:9002/榴莲视频_7.4.1.apk",
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
            //     "image" => "https://res.18mo4.info:9002/crack_apps/狼友社区.png",
            //     "url" => "https://apk.18moaa2.top:9002/狼友社区_1.0.1.apk",
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
            //     "image" => "https://res.18mo4.info:9002/crack_apps/onlyfans.png",
            //     "url" => "https://apk.18moaa2.top:9002/OnlyFans_1.0.1.apk",
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
                "title" => "AVIN視頻",
                "image" => "https://res.18mo4.info:9002/crack_apps/AVIN免費視頻.png",
                "url" => "https://apk.18moaa2.top:9002/AVIN免費視頻_2.0.apk",
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
            //     "image" => "https://res.18mo4.info:9002/crack_apps/快猫.png",
            //     "url" => "https://apk.18moaa2.top:9002/快猫_4.4.5.apk",
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
            //     "image" => "https://res.18mo4.info:9002/crack_apps/P站.png",
            //     "url" => "https://apk.18moaa2.top:9002/P站视频_4.2.2.apk",
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
            //     "image" => "https://res.18mo4.info:9002/crack_apps/小蝴蝶.png",
            //     "url" => "https://apk.18moaa2.top:9002/小蝴蝶_1.1.00.apk",
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
            [
                "packname" => "com.bytedance.cj7c8934cf5",
                "title" => "雏姬",
                "image" => "https://res.18mo4.info:9002/crack_apps/雏姬.png",
                "url" => "https://apk.18moaa2.top:9002/雏姬11_1.1.1.apk",
                "startActivity" => "com.bytedance.cj7c8934cf5.ui.activity.SplashActivity",
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
                "packname" => "com.latest.mm.video",
                "title" => "香草视频",
                "image" => "https://res.18mo4.info:9002/crack_apps/香草视频.jpeg",
                "url" => "https://apk.18moaa2.top:9002/香草视频_1.0.0_sign.apk",
                "startActivity" => "com.latest.mm.video.view.activity.SplashActivity",
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
                "packname" => "com.hhhhlianzai.apq1",
                "title" => "嘿嘿连载",
                "image" => "https://res.18mo4.info:9002/crack_apps/嘿嘿连载.jpeg",
                "url" => "https://apk.18moaa2.top:9002/嘿嘿连载_3.1.0.apk",
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
                "title" => "漫漫撸",
                "image" => "https://res.18mo4.info:9002/crack_apps/漫漫撸.png",
                "url" => "https://apk.18moaa2.top:9002/漫漫擼2_1.2.8.apk",
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
            [
                "packname" => "com.jiaohua_browser",
                "title" => "JMComic",
                "image" => "https://res.18mo4.info:9002/crack_apps/JMComic.png",
                "url" => "https://apk.18moaa2.top:9002/JMComic2_1.0.apk",
                "startActivity" => "com.jiaohua_browser.MainActivity",
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
                "title" => "看了吗",
                "image" => "https://res.18mo4.info:9002/crack_apps/看了吗.png",
                "url" => "https://apk.18moaa2.top:9002/kanleme_1.0.2.apk",
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
            [
                "packname" => "com.legendsoft.tennxks",
                "title" => "向日葵视频",
                "image" => "https://res.18mo4.info:9002/crack_apps/向日葵视频.png",
                "url" => "https://apk.18moaa2.top:9002/向日葵视频_2.2.4.apk",
                "startActivity" => "com.legendsoft.uixrktwo.ui.SplashActivity",
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
                "packname" => "com.zxbxzerqwt.dwqtzxfasq",
                "title" => "梅花视频",
                "image" => "https://res.18mo4.info:9002/crack_apps/梅花视频.png",
                "url" => "https://apk.18moaa2.top:9002/梅花视频_5.0.7.apk",
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
            [
                "packname" => "com.app.video.play.hx",
                "title" => "蜜桃视频",
                "image" => "https://res.18mo4.info:9002/crack_apps/蜜桃视频.png",
                "url" => "https://apk.18moaa2.top:9002/蜜桃视频_2.2.apk",
                "startActivity" => "com.app.aiqiyi.activity.LauncherActivity",
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
                "packname" => "com.lunaapp.cnpromini",
                "title" => "雏鸟pro",
                "image" => "https://res.18mo4.info:9002/crack_apps/雏鸟pro.png",
                "url" => "https://apk.18moaa2.top:9002/雏鸟Pro._1.1.7.apk",
                "startActivity" => "com.lianzhihui.minitiktok.ui.SplashActivity",
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
                "packname" => "com.fmcd.blmv",
                "title" => "菠萝视频",
                "image" => "https://res.18mo4.info:9002/crack_apps/菠萝视频.png",
                "url" => "https://apk.18moaa2.top:9002/啵罗视频_3.1.5.apk",
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
                "packname" => "com.sf.d4323ce70c9e84747a46d6c1838062d25",
                "title" => "暗网爆料",
                "image" => "https://res.18mo4.info:9002/crack_apps/暗网爆料.png",
                "url" => "https://apk.18moaa2.top:9002/暗网爆料_1.0.2.apk",
                "startActivity" => "com.limit.cache.ui.page.main.WelComeActivity",
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
                "packname" => "com.banana.v3",
                "title" => "芭蕉视频",
                "image" => "https://res.18mo4.info:9002/crack_apps/芭蕉视频.png",
                "url" => "https://apk.18moaa2.top:9002/芭蕉视频_1.0.0.apk",
                "startActivity" => "com.banana.v3.activity.SplashActivity",
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
                "packname" => "com.maidong",
                "title" => "脉动",
                "image" => "https://res.18mo4.info:9002/crack_apps/脉动.png",
                "url" => "https://apk.18moaa2.top:9002/maidong_1.5.apk",
                "startActivity" => "com.maidong.activity.StartupDiagramActivity",
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
                "packname" => "com.latest.mm.videq123",
                "title" => "蓝鸟视频",
                "image" => "https://res.18mo4.info:9002/crack_apps/蓝鸟视频.png",
                "url" => "https://apk.18moaa2.top:9002/蓝鸟视频_1.0.0.apk",
                "startActivity" => "com.latest.mm.video.view.activity.SplashActivity",
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
                'baseUrl' => "https://v1.chifanlemei.com/"
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
                'baseUrl' => "http://8.212.12.240:8099/"
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
                'desc' => '支付宝测试',
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
                    'name' => 'score',    //请勿修改或删除,订单数据中有存在这个值
                    'desc' => '金币支付',
                    'class_name' => 'score',
                    'params' => [
                        'payTypeId' => '0'
                    ]
        ]
    ],
    'goods' => [    //请勿修改id
        [
            'id' => 10,
            'type' => 'vip',    //score金币 vip vip会员
            'name' => '1年',
            'desc' => '限时5折',
            'price' => 100,
            'unit' => 'money',
            'value' => '+1 year',   //VIP时长，单位秒
            'pipes' => "star_alipayH5,star_wechat,gx_alipay,gx_wechat,nn_alipay,nn_wechat,score",
            'ex' => [
                'label' => '1年'
            ]
        ],
        [
            'id' => 11,
            'type' => 'vip',    //score金币 vip vip会员
            'name' => '15天',
            'desc' => '限时9折',
            'price' => 30,
            'unit' => 'money',
            'value' => '+15 day',   //VIP时长，单位秒
            'pipes' => "star_alipayH5,star_wechat,gx_alipay,gx_wechat,nn_alipay,nn_wechat,score",
            'ex' => [
                'label' => '15天'
            ]
        ],
        [
            'id' => 5,
            'type' => 'vip',    //score金币 vip vip会员
            'name' => '1月',
            'desc' => '限时9折',
            'price' => 50,
            'unit' => 'money',
            'value' => '+1 month',   //VIP时长，单位秒
            'pipes' => "star_alipayH5,star_wechat,gx_alipay,gx_wechat,nn_alipay,nn_wechat,score",
            'ex' => [
                'label' => '包年'
            ]
        ],
        [
            'id' => 6,
            'type' => 'vip',    //score金币 vip vip会员
            'name' => '永久会员',
            'desc' => '限时9折',
            'price' => 200,
            'unit' => 'money',
            'value' => '+100 year',   //VIP时长，单位秒
            'pipes' => "star_alipayH5,star_wechat,gx_alipay,gx_wechat,nn_alipay,nn_wechat,score",
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
        //     'pipes' => "star_alipayH5,star_wechat,gx_alipay,gx_wechat,nn_alipay,nn_wechat,score",
        //     'ex' => [
        //         'label' => '包日'
        //     ]
        // ],
        
        
        
        // [
        //     'id' => 4,
        //     'type' => 'vip',    //score金币 vip vip会员
        //     'name' => '1月',
        //     'desc' => '限时9折',
        //     'price' => 30,
        //     'unit' => 'money',
        //     'value' => '+1 month',   //VIP时长，单位秒
        //     'pipes' => "star_alipayH5,star_wechat,gx_alipay,gx_wechat,nn_alipay,nn_wechat,score",
        //     //'pipes' => "star_alipayH5,star_wechat,gx_alipay,gx_wechat,nn_alipay,nn_wechat,score",
            
        //     'ex' => [
        //         'label' => '包月'
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
        //     'pipes' => "star_alipayH5,star_wechat,gx_alipay,gx_wechat,nn_alipay,nn_wechat,score",
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
        //     'pipes' => "star_alipayH5,star_wechat,gx_alipay,gx_wechat,nn_alipay,nn_wechat,score",
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
        //     'pipes' => "star_alipayH5,star_wechat,gx_alipay,gx_wechat,nn_alipay,nn_wechat,score",
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
            'pipes' => "star_alipayH5,star_wechat,gx_alipay,gx_wechat,nn_alipay,nn_wechat",
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
            'pipes' => "star_alipayH5,star_wechat,gx_alipay,gx_wechat,nn_alipay,nn_wechat",
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
            'pipes' => "star_alipayH5,star_wechat,gx_alipay,gx_wechat,nn_alipay,nn_wechat",
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
        'baseUrl' => 'http://www.18mo1.info/',
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
