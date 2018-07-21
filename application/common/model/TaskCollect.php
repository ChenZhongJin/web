<?php

namespace app\common\model;
use think\Model;
class TaskCollect extends Model
{
    protected $table = 'qiyun_task_collect';
    public function getCssTitleAttr($v)
    {
        return !empty($v)?:'/html/head/title';
    }
}