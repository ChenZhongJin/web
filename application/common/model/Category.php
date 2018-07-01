<?php

namespace app\common\model;

use think\Model;

class Category extends Model
{
    protected   $table = 'qiyun_category';
    protected  $auto = ['view','type_view'];
    public function setViewAttr($view)
    {
        if(empty($view)){
            return null;
        }
        $pos = strpos('.',$view);
        if($pos ===true){
            $view = substr($view,0,-$pos);
        }
        return $view;
    }
    public function setTypeViewAttr($typeView)
    {
        if(empty($typeView)){
            return null;
        }
        $pos = strpos('.',$typeView);
        if($pos===true){
            $typeView=substr($typeView,0,-$pos);
        }
        return $typeView;
    }
    public function getViewAttr($view)
    {
        return empty($view)?'view.html':$view;
    }
    public function getTypeViewAttr($typeView)
    {
        return empty($typeView)?'typeview.html':$typeView;
    }
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
