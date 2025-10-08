<?php

namespace addons\appbox\model;

use think\Model;
use think\db;
use think\Log;

class AgentStatistics extends Model
{
    // 表名
    protected $name = 'appbox_agent_statistics';

    // 关闭自动写入时间戳
    protected $autoWriteTimestamp = false;

    // // 自动写入时间戳字段
    // protected $autoWriteTimestamp = 'int';
    // // 定义时间戳字段名
    // protected $createTime = 'createTime';

    //添加安装统计数(创建新用户时调用)
    public function addInstall($agentId,$deduction)
    {
        Log::init([
            'type'  =>  'File',
            'path'  =>  APP_PATH . '../logs/',
            'apart_level'   =>  ['agent_statistics'],
        ]);
        //$request = request();
        //trace($request->url(true),'agent_statistics');

        //是否扣量
        $isDeduction = false;

        if($deduction != 0){
            //扣量按随机（不增加数据）
            $rnd = mt_rand(1,100);
            if($rnd <= $deduction * 100){
                $isDeduction = true;
                trace('agentId:' . $agentId . '扣量：' . $deduction . ';rand:' . $rnd,'agent_statistics');
                //return;
            }
            
            //trace('agentId:' . $agentId . '不扣量：' . $deduction . ';rand:' . $rnd,'agent_statistics');
        }
        
        $today = date("Y/m/d");
        $res = $this->get([
            'agentId' => $agentId,
            'date' =>$today
        ]);

        

        if($isDeduction){
            if(!$res){
                $this->insert([
                    'agentId' => $agentId,
                    'date' =>$today,
                    'install' => 1,     //第一条记录不扣量
                    'installReal' =>1
                ]);
            }else{
                $this->update([
                    'installReal' => $res['installReal']+1
                ],[
                    'agentId' => $agentId,
                    'date' =>$today
                ]);
            }
        }else{
            if(!$res){
                $this->insert([
                    'agentId' => $agentId,
                    'date' =>$today,
                    'install' => 1,
                    'installReal' =>1
                ]);
            }else{
                $this->update([
                    'install' => $res['install']+1,
                    'installReal' => $res['installReal']+1
                ],[
                    'agentId' => $agentId,
                    'date' =>$today
                ]);
            }
        }
    }

    public function addHits($agentId)
    {
       
        $today = date("Y/m/d");
        $res = $this->get([
            'agentId' => $agentId,
            'date' =>$today
        ]);

        if(!$res){
            $this->insert([
                'agentId' => $agentId,
                'date' =>$today,
                'hits' => 1
            ]);
        }else{
            $this->update([
                'hits' => $res['hits']+1
            ],[
                'agentId' => $agentId,
                'date' =>$today
            ]);
        }
    }

    public function addInstall_bak($agentId,$deduction)
    {
        Log::init([
            'type'  =>  'File',
            'path'  =>  APP_PATH . '../logs/',
            'apart_level'   =>  ['agent_statistics'],
        ]);
        
        $today = date("Y/m/d");
        $res = $this->get([
            'agentId' => $agentId,
            'date' =>$today
        ]);

        if($deduction != 0){
            //扣量按随机（不增加数据）
            $rnd = mt_rand(1,100);
            if($rnd <= $deduction * 100){
                
                trace('agentId:' . $agentId . '扣量：' . $deduction . ';rand:' . $rnd,'agent_statistics');
                return;
            }
            
            trace('agentId:' . $agentId . '不扣量：' . $deduction . ';rand:' . $rnd,'agent_statistics');
        }

        if(!$res){
            $this->insert([
                'agentId' => $agentId,
                'date' =>$today,
                'install' => 1
            ]);
        }else{
            $this->update([
                'install' => $res['install']+1
            ],[
                'agentId' => $agentId,
                'date' =>$today
            ]);
        }
    }

    public function list($agentId,$startDate,$endDate)
    {
        $res = $this->where(['agentId' => $agentId])
            ->where('date',['>=',$startDate],['<=',$endDate],'and')
            ->where('date','>','2023-06-13')
            ->group('date')
            ->select();
        return $res;
    }
}