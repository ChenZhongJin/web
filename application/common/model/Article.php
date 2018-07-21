<?php

namespace app\common\model;

use think\Model;
use think\facade\Session;

class Article extends Model
{

    protected       $table = 'qiyun_article';
    protected       $autoWriteTimestamp = true;
    protected       $auto  = ['user_id','description' ,'keywords'];
    protected function setUserIdAttr($id)
    {
        return $id?$id:Session::get('user.id');
    }
    // protected function setCreateTimeAttr($time)
    // {
    //     return time();
    // }
    protected function setKeywordsAttr($words)
    {
        if (empty($words)) {
            return '';
        }
    }
    /**
     * 获取文章第一张图片
     */
    protected function getImageAttr($v,$data)
    {
        preg_match('@<img.*?src=\"(.*?)\"[^>]*>@',$data['content'],$match);
        return isset($match[1])?$match[1]:'';
    }
    protected function setDescriptionAttr($desc,$data)
    {
        if (empty($desc)) {
            $desc = html_entity_decode($data['content']);
            $desc = strip_tags($desc);
            $desc = preg_replace('/\s| /is','',$desc);
            $desc = mb_substr($desc,0,200);
        }
        return $desc;
    }
    protected function getLinkAttr($v,$data)
    {
        return url('article' ,['id'=>$data['id']]);
    }
    public function user()
    {
        return $this->hasOne('User','id','user_id');
    }
    public function category()
    {
        return $this->hasOne('Category','id','category_id');
    }
}
