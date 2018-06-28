<?php

namespace app\common\model;

use think\Model;

class Site extends Model
{
    protected   $table = 'qiyun_website';
    public function map()
    {
        $list = self::all();
        $map  = [];
        foreach ($list as $map) {
            $map[$map['name']]=$map['content'];
        }
        return $map;
    }
}
