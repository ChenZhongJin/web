<?php

namespace app\common\model;

use think\Model;

class Category extends Model
{
    protected   $table = 'qiyun_category';
    protected function getTypeNameAttr($null,$data)
    {
        $typeName = [1=>'文章' ,2=>'产品'];
        return $typeName[$data['type']];
    }
    public function article()
    {
        return $this->hasMany('Article');
    }
}
