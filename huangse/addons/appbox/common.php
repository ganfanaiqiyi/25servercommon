<?php
function ok($data=null)
{
    return ['code' => 0, 'msg' => 'ok', 'data' => $data];
}

function err($code=1, $msg='error')
{
	return ['code' => $code, 'msg' => $msg];
}

/**
 * 获取一个毫秒级的时间戳 13位
 * 1604563860556
 * @return void
 */
function millisecondWay()
{
    list($s1, $s2) = explode(' ', microtime());
    return (float)sprintf('%.0f', (floatval($s1) + floatval($s2)) * 1000);
}

//数组插入
function array_insert($array,$pos,$obj)
{
    
    $newArray = [];
    foreach($array as $k=>$v){
        if($k == $pos){
            array_push($newArray,$obj);
        }

        array_push($newArray,$v);
    }

    if(count($array) <= $pos){
        array_push($newArray,$obj);
    }

    return $newArray;
}

function crack_apps_sort($array)
{
    
}