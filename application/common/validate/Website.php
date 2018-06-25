<?php

namespace app\common\validate;

use think\Validate;

class Website extends Validate
{
    /**
     * 定义验证规则
     * 格式：'字段名'	=>	['规则1','规则2'...]
     *
     * @var array
     */	
	protected $rule = [
        'id|索引'           =>  'require',
        'name|字段名称'     =>  'require|min:5|max:20',
        'cname|识别描述'    =>  'require|max:20',
        'content|内容'      =>  'require|max:200',
    ];
    
    /**
     * 定义错误信息
     * 格式：'字段名.规则名'	=>	'错误信息'
     *
     * @var array
     */	
    protected $message = [];
    public function sceneCreate()
    {
        return $this->only(['name','cname','content']);
    }
    public function sceneUpdate()
    {
        return $this->only(['id','name','cname','content']);
    }
}
