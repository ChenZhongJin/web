<?php
namespace app\common\validate;

use think\Validate;

class User extends Validate
{
    /**
     * 定义验证规则
     * 格式：'字段名'	=>	['规则1','规则2'...]
     *
     * @var array
     */
    protected $rule = [
        'name|用户名'      =>  'require|min:5|max:20|alphaDash',
        'password|密码'    =>  'require|min:5|max:20|alphaDash',
        'repassword'      =>  'confirm:password',
        'code|验证码'      =>  'require|captcha',
    ];
    
    /**
     * 定义错误信息
     * 格式：'字段名.规则名'	=>	'错误信息'
     *
     * @var array
     */
    protected $message = [];

    public function sceneLogin()
    {
        return $this->only(['name','password','code']);
    }
}
