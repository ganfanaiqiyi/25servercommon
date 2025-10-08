<?php
namespace addons\appbox\library\pipes;

class Alipay implements IPipe
{
    private $_errMsg = "";

    public function bulidUrl($orderInfo)
    {
        return "http://www.baidu.com/";
    }

    public function callback()
    {
        
    }

    public function getError()
    {
        return $this->_errMsg;
    }
}