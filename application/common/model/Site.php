<?php

namespace app\common\model;

use think\Model;

class Site extends Model
{
    protected   $table = 'qiyun_site';
    public function map()
    {
        $list = self::all();
        $map  = [];
        foreach ($list as $item) {
            $map[$item['name']]=$item['content'];
        }
        return $map;
    }
}
