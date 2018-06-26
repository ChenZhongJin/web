<?php

namespace app\common;

use think\Validate;

class Valid extends Validate
{
    /**
     * 定义验证规则
     * 格式：'字段名'	=>	['规则1','规则2'...]
     *
     * @var array
     */	
	protected $rule = [
        'id|索引'               =>  'number',
        'name|名称'             =>  'require|max:200',
        'title|标题'            =>  'require|max:200|token',
        'keywords|关键字'       =>  'max:200',
        'description|描述'      =>  'max:200',
        'content|主体内容'      =>  'max:5000',
        'parent'               =>  'number',
        'category_id|栏目'      =>  'number',
        'user_id'               =>  'number',
        'model|产品型号'         =>  'max:200',
        'serial_number|产品序列号'  =>  'max:100',
        'preview|预览图'         =>  'arrayLength:500',
    ];
    
    /**
     * 定义错误信息
     * 格式：'字段名.规则名'	=>	'错误信息'
     *
     * @var array
     */	
    protected $message = [];

    protected function arrayLength($v,$rule,$data)
    {
        return strlen(json_encode($v))<$rule?true:'预览图片太多，删掉2张试试？';
    }
    /**
     * 文章更新
     *
     * @return void
     */
    public function sceneArticleUpdate()
    {
        return $this->only(['id','title','keywords','description','content']);
    }

    public function sceneArticleCreate()
    {
        return $this->only(['title' ,'keywords','description','content']);
    }
    public function sceneProductUpdate()
    {
        return $this->only([
            'id','title','keywords','description',
            'name','model','category_id','serial_number',
            'preview','content']);
    }
    public function sceneProductCreate()
    {
        return $this->only([
            'title','keywords','description',
            'name','model','category_id','serial_number',
            'preview','content']);
    }
}
