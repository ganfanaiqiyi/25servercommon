<?php
namespace addons\appbox\model;

use think\Model;
use think\Config;
use think\db;

class Pipe extends Model
{
    public function infoData($name,$pipes=[])
    {
        //$config = Config::load(__DIR__ . "/../appConfig.php");
        //$pipes = $config['pipes'];
        foreach($pipes as $v){
            if($v['name'] == $name){
                return $v;
            }
        }
        return false;
    }
}