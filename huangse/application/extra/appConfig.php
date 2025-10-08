<?php
//【警告】此文件为APP的配置，请谨慎修改，一个标点都可能语法错误造成客户端无法正常打开
return [
    "appConfig" => [
        'kefu_url' => 'http://service.8rytqdpm.top/index/index/home?business_id=1&groupid=0&special=1&theme=05202d', //客服
        'tgqun_url' => 'https://t.me/avdqChannel', //tg群
        'shangwu_url' => 'https://t.me/avshangwu999', //商务
        "HOME_URL" => "https://www.avdaquan.info", //永久官网
        "HOME_URL2" => "https://6x6d0r4b.kj2qphig.top?c=c1_1", //国内可访问下载官网&用于分享链接
        'insConfig' => [
            'insBaseUrl' => 'https://dm.buph897.com',
            'insKEY' => "0XxdjmI55ZjjqQLO3nI7gGqrBP0Vz9jS",
            'insIV' => "RWf23muavY",
            'insSuffix' => "NWSdef",
            'insSign' => "NRkw0g3iJLDvw5tJ5PuVt5276z0SOuyL"
        ],
        'mmConfig' => [
            'mmBaseUrl' => "https://mltjson.46z02bj3.com/luntan/site_bbs/postBarLists-",
            'mmImageUrl' => "https://jpg.tlxxw.cc",
            'mmVideoUrl' => "https://tma.qianchengwandian.top",
            'mmKEY' => "9a1d65b4a693ad0e40e5b156df25e406",
            'mmVidKey' => "D7hGKHnWThaECaQ3ji4XyAF3MfYKJ53M",
            'mmIV' => "9a61e6977b",
            'mmCateListSuffix' => [
                "-24-298-25-0-0-2-null.js",
                "-24-298-299-0-0-2-null.js",
                "-24-298-301-0-0-2-null.js",
                "-24-298-323-0-0-2-null.js"
            ]
        ],
        "upgrade" => [
            "lastVersion" => "100",  //最新版本
            "isShow" => false,       //是否显示升级通知
        ]
    ],
    'pipes' => [
            [
                'name' => 'guagua_alipay',    //请勿修改或删除,订单数据中有存在这个值
                'desc' => '支付宝(guagua)',
                'class_name' => 'guagua',
                'params' => [
                    'payTypeId' => '111'            // 10-500
                ]
            ],
            [
                'name' => 'guagua_wechat',    //请勿修改或删除,订单数据中有存在这个值
                'desc' => '微信(guagua)',
                'class_name' => 'guagua',
                'params' => [
                    'payTypeId' => '1111'        // 10-300
                ]
            ]
        ],
    'goods' => [    //请勿修改id
        [
            'id' => 2,
            'type' => 'vip',    //score金币 vip vip会员
            'name' => '7天体验卡',
            'desc' => '限时优惠',
            'price' => 20,
            'unit' => 'money',
            'value' => '+7 day',   //VIP时长，单位秒
            'pipes' => "guagua_alipay,guagua_wechat",
            'ex' => [
                'label' => '7日'
            ]
        ],
        // [
        //     'id' => 3,
        //     'type' => 'vip',    //score金币 vip vip会员
        //     'name' => '30天',
        //     'desc' => '限时优惠',
        //     'price' => 30,
        //     'unit' => 'money',
        //     'value' => '+30 day',   //VIP时长，单位秒
        //     'pipes' => "guagua_alipay,guagua_wechat",
        //     'ex' => [
        //         'label' => '30天'
        //     ]
        // ],
        [
            'id' => 5,
            'type' => 'vip',    //score金币 vip vip会员
            'name' => '永久会员',
            'desc' => '永久免费',
            'price' => 100,
            'unit' => 'money',
            'value' => '+100 year',   //VIP时长，单位秒
            'pipes' => "guagua_alipay,guagua_wechat",
            'ex' => [
                'label' => '永久'
            ]
        ]
        // ,
        // [
        //     'id' => 6,
        //     'type' => 'vip',    //score金币 vip vip会员
        //     'name' => '1天体验卡',
        //     'desc' => '限时优惠',
        //     'price' => 20,
        //     'unit' => 'money',
        //     'value' => '+1 day',   //VIP时长，单位秒
        //     'pipes' => "score",
        //     'ex' => [
        //         'label' => '1日'
        //     ]
        // ],
        // [
        //     'id' => 7,
        //     'type' => 'vip',    //score金币 vip vip会员
        //     'name' => '3天体验卡',
        //     'desc' => '限时优惠',
        //     'price' => 50,
        //     'unit' => 'money',
        //     'value' => '+3 day',   //VIP时长，单位秒
        //     'pipes' => "score",
        //     'ex' => [
        //         'label' => '3日'
        //     ]
        // ],
        // [
        //     'id' => 8,
        //     'type' => 'vip',    //score金币 vip vip会员
        //     'name' => '10天体验卡',
        //     'desc' => '限时优惠',
        //     'price' => 100,
        //     'unit' => 'money',
        //     'value' => '+10 day',   //VIP时长，单位秒
        //     'pipes' => "score",
        //     'ex' => [
        //         'label' => '10日'
        //     ]
        // ]
    ],
    'vip_pipes' => [
        [
            'name' => 'guagua_alipay',
            'title' => '支付宝',
            'desc' => '推荐',
            'icon' => 'alipay'
        ],
        [
            'name' => 'guagua_wechat',
            'title' => '微信',
            'desc' => '推荐',
            'icon' => 'wepay'
        ],
        [
            'name' => 'score',
            'title' => '金币支付',
            'desc' => '推荐',
            'icon' => 'score'
        ]
    ]
];
