<?php

use Crunz\Schedule;
$schedule = new Schedule();
$schedule->run(function(){
        // 采集
        // 1.读取配置信息
        // require_once __DIR__.'/../thinkphp/base.php';
        // $td = Db->
        
//        $detail = TaskDetail::where('type','=','collect')->select();

//        $detail = $detail->where('type','=','collect')->select();
//        foreach ($detail as $task) {
               
//        }
       // 2.访问列表页
       // 3.捕获文章页地址表
       // 4.循环
       // 5.排除已存在
       // 6.访问文章页
       // 7.捕获标题
       // 8.捕获主体
       // 9.下载远程图片
       // 10.入库，完成 
})       
        ->everyMinute()
        ->description('Create a backup of the project directory.');
return $schedule;