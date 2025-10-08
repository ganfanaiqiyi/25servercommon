<?php

namespace addons\appbox\validate;

use think\Validate;

class Agent extends Validate
{

    /**
     * 验证规则
     */
    protected $rule = [
        //'username' => 'require|regex:\w{3,30}|unique:appbox_agent',
        'channelCode' => 'require|regex:\w{1,30}|unique:appbox_agent',
        //'password' => 'require|regex:\S{32}',
        'deduction'    => 'require|number|between:0,1',
    ];

    /**
     * 提示消息
     */
    protected $message = [
    ];

    /**
     * 字段描述
     */
    protected $field = [
    ];

    /**
     * 验证场景
     */
    protected $scene = [
        'add'  => ['channelCode','deduction'],
        'edit' => ['deduction'],
    ];

    public function __construct(array $rules = [], $message = [], $field = [])
    {
        // $this->field = [
        //     'username' => __('Username'),
        //     'nickname' => __('Nickname'),
        //     'password' => __('Password'),
        //     'email'    => __('Email'),
        // ];
        $this->message = array_merge($this->message, [
            'username.regex' => __('Please input correct username'),
            'password.regex' => __('Please input correct password')
        ]);
        parent::__construct($rules, $message, $field);
    }

}
