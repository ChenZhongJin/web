<?php

namespace app\manager\controller;

use think\Request;
use app\common\Valid;
use app\common\unity\Unity;

class Task extends Base
{
    /**
     * 默认页
     * @route('/console/task','get')->name('_task')
     */
    public function index()
    {
        return $this->fetch();
    }
    /**
     * 任务列表
     * @route('/console/task/list','get')->name('_taskList')
     */
    public function list()
    {
        return $this->fetch();
    }
    /**
     * 采集任务
     * @route('/console/task/collect/:action','post')->name('_task_collect')
     */
    public function collect($action='', Request $request)
    {
        $data = $request->param();
        $valid = Unity::valid($data, 'TaskCollect');
        if ($valid !==true) {
            return Unity::error($valid);
        }
        $uri = $data['list_page'];
        $mi = preg_match('/http(s?)\:\/\/.*?\//',$uri,$match);
        dump($mi);
        $body= visit($uri);
        
        switch ($action) {
            case 1:
                // 捕获采集目标
                preg_match_all('/'.$data['list_reg'].'/im',$body,$match);
                if(is_array($match[1])){
                    $pageURL = $match[1][0];
                }
                // break;
            case 2:
                // 捕获标题
                $body = visit($pageURL); 
                dump($body);
                break;
            case 3:
                // 捕获主体
                break;
            case 4:
                // 替换
                break;
        }
        // 保存
        return '';
    }
}
