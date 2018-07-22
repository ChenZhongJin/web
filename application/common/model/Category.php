<?php

namespace app\common\model;

use think\Model;

class Category extends Model
{
    protected   $table = 'qiyun_category';
    public function getViewAttr($view)
    {
        return empty($view)?'view':$view;
    }
    public function getTypeViewAttr($typeView)
    {
        return empty($typeView)?'typeview':$typeView;
    }
    protected function getTypeNameAttr($null,$data)
    {
        $typeName = [1=>'文章' ,2=>'产品'];
        return $typeName[$data['type']];
    }
    public function getLinkAttr($v,$data)
    {
        return url($data['path']);
    }
    public function article()
    {
        return $this->hasMany('Article');
    }
    public function product()
    {
        return $this->hasMany('Product');
    }
}
