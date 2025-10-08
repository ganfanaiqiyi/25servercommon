<?php

namespace addons\appbox\model;

use think\Model;
use think\db;
use think\Config;
use think\Cache;

class Ads extends Model
{
    // 表名
    protected $name = 'appbox_ad_list';

    // 自动写入时间戳字段
    protected $autoWriteTimestamp = false;



    public function listData()
    {
        $list = $this->order('id', 'asc')->select();
        return $list;
    }



    public function getAdPosition()
    {
        $list =  collection((array)db('appbox_ad_position')->order('sort', 'desc')->select())->column('name', 'id');
        return $list;
    }
    public function getConfig($uid = 0)
    {
        $alllist = $this->allList();
        return $alllist;
    }

    protected function getStartAd2($alllist, $adinfo = [])
    {
        $startList = $this->list_filter($alllist, 2);
        $startListCount = count($startList);

        if ($startListCount == 0) {
            $adinfo['show'] = false;
        } else {
            $adinfo['title'] = $startList[0]['title'];
            $adinfo['image'] = $startList[0]['image'];
            $adinfo['url'] = $startList[0]['url'];
        }
        return $adinfo;
    }

    //轮循
    protected function getStartAd($alllist, $uid = 0, $adinfo = [])
    {



        $startList = $this->list_filter($alllist, 1);
        $startListCount = count($startList);

        if ($startListCount == 0) {
            $adinfo['show'] = false;
        } else if ($startListCount == 1) {
            $adinfo['image'] = $startList[0]['image'];
            $adinfo['url'] = $startList[0]['url'];
        } else {
            //获得用户最后一次获得的广告(轮播)
            //由于客户端缓存机制，这里获得的广告链接应该要是前一次的

            //首次返回第一个
            $lastStartAdIdx = Cache::store('redis')->get('lastStartAdIdx_' . $uid);

            if ($lastStartAdIdx === false) {
                $adinfo['lastStartAdIdx'] = $lastStartAdIdx;
                $adinfo['image'] = $startList[0]['image'];
                $adinfo['url'] = $startList[0]['url'];

                Cache::store('redis')->set('lastStartAdIdx_' . $uid, 0, 86400);
            } else {
                $lastStartAdIdx = (int)$lastStartAdIdx;

                if ($lastStartAdIdx >= $startListCount) {
                    //重新轮播
                    $adinfo['image'] = $startList[0]['image'];
                    $adinfo['url'] = $startList[0]['url'];

                    Cache::store('redis')->set('lastStartAdIdx_' . $uid, 0, 86400);
                } else {
                    //url使用旧的
                    $adinfo['url'] = $startList[$lastStartAdIdx]['url'];

                    //图片使用新的
                    $lastStartAdIdx++;

                    if ($lastStartAdIdx >= $startListCount) {
                        $lastStartAdIdx = 0;
                    }
                    $adinfo['image'] = $startList[$lastStartAdIdx]['image'];

                    Cache::store('redis')->set('lastStartAdIdx_' . $uid, $lastStartAdIdx, 86400);
                }
            }



            return $adinfo;
        }
    }

    public function allList()
    {
        // ->field('a.id,a.title,a.image,a.desc,a.url,b.positionId')
        $list = db('appbox_ad_list')->alias('a')
            ->join('fa_appbox_ad_position b', 'a.positionId=b.id', 'LEFT')
            ->field('a.id,a.title,a.image,a.desc,a.url,a.positionId')
            ->where(['a.status' => 'normal'])
            ->order('b.sort desc,a.sort desc')
            ->select();



        //重写url为动态地址
        //  $config = config('appConfig');
        // for ($i = 0; $i < count($list); $i++) {
            // $list[$i]['originalUrl'] = $list[$i]['url'];
            // $list[$i]['image'] = "http://127.0.0.1:8080/256.js";
        // }

        return $list;
    }

    function list_filter($source = [], $positionId = 0)
    {

        $list = [];
        foreach ($source as $item) {
            if ($item['positionId'] == $positionId) {
                array_push($list, $item);
            }
        }
        return $list;
    }
}
