<?php

namespace app\common\model;

use think\Model;

class Product extends Model
{
    protected $table = 'qiyun_product';
    protected $auto  = ['preview','create_time'];
    public function getPreviewAttr($preview,$data)
    {
        return explode('||',$preview);
    }
    public function setPreviewAttr($preview,$data)
    {
        return implode('||',$preview);
    }
}
