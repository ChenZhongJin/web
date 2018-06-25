<?php

namespace app\common\validate;

use think\Validate;

class Category extends Validate
{
    /**
     * 定义验证规则
     * 格式：'字段名'	=>	['规则1','规则2'...]
     *
     * @var array
     */	
	protected $rule = [
        'id|索引'            => 'require|number',
        'name|名称'          =>  'require|alphaDash',
        'path|路径'          =>  'require|alphaDash|exc',
        'cname|中文名称'     =>  'require|max:50',
        'parent|父级索引'    =>  'require|number'
    ];
    
    /**
     * 定义错误信息
     * 格式：'字段名.规则名'	=>	'错误信息'
     *
     * @var array
     */	
    protected $message = [];
    public function exc($data,$rule)
    {
        $exclude = ['console'];
        return in_array($data,$exclude)?'不允许使用'.$data:true;
    }

    public function sceneUpdate()
    {
        return $this->only(['cname','path','parent','id']);
    }
    public function sceneSave()
    {
        return $this->only(['cname','path','parent']);
    }
}
