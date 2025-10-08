<?php
namespace addons\appbox\library\pipes;

interface IPipe
{
    public function bulidUrl($orderInfo);
    public function getError();
    public function callback();
}