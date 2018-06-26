<?php

namespace app\common\model;

use think\Model;

class Product extends Model
{
    protected $table = 'qiyun_product';
    protected $auto  = ['preview','create_time'];
    public function getPreviewAttr($preview)
    {
        $preview = substr($preview,1,-1);
        $preview = stripcslashes($preview);
        $list = [];
        $arr  = json_decode($preview,true);
        if(is_array($arr) && count($arr)>0){
            foreach($arr as $alt =>$src){
                $filename = pathinfo($alt,PATHINFO_FILENAME);
                $list[]=['src' =>$src,'alt'=>$filename];
            }
        }
        return $list;
    }
    public function setPreviewAttr($preview,$data)
    {
        return json_encode($preview);
    }
    protected function category()
    {
        return $this->hasOne('Category','id','category_id');
    }
}
