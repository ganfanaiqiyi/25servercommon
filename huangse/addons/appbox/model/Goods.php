<?php
namespace addons\appbox\model;

use think\Model;
use think\db;

class Goods extends Model
{
    public function info($id,$goods=[])
    {
        foreach($goods as $v){
            if($v['id'] == $id){
                return $v;
            }
        }
        return false;
    }
    
    public function list()
    {
        
    }
}