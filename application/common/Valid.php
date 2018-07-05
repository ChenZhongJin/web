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
        // 常用字段
        'id'                         =>  'require|number',
        'name'                       =>  'require|min:5|max:200|alphaDash',
        'cname'                      =>  'require|min:5|max:20',
        'path'                       =>  'require|alphaDash|exclude',
        'parent'                     =>  'require|number',
        
        // 用户相关
        // 'name|用户名'             =>  'require|min:5|max:20|alphaDash',
        'password'                   =>  'require|min:5|max:20|alphaDash',
        'repassword'                 =>  'require|confirm:password',
        'code'                       =>  'require|captcha',
        
        // 页面信息
        'title'                      =>  'require|max:200',
        'keywords'                   =>  'max:200',
        'description'                =>  'max:200',
        'content'                    =>  'max:5000',
        'category_id'                =>  'require|number',
        'user_id'                    =>  'require|number',
        
        // 产品相关
        'model'                      =>  'require|max:200',
        'serial_number'              =>  'require|max:200',
        'preview'                    =>  'require|arrayLength:500',
        // 工具类
        'token'                      =>  'require|token',
        'hash'                       =>  'require|token:hash',
        'captcha'                    =>  'require|captcha',
    ];
    protected $field = [
        'token'     =>  '令牌',
        'hash'      =>  '令牌—散列',
        'captcha'   =>  '验证码',
        'id'        =>  '索引',
        'name'      =>  '名称',
        'cname'     =>  '别名',
        'path'      =>  '路径',
        'parent'    =>  '上级索引',
        'password'  =>  '密码',
        'repassword'=>  '校验密码',
        'code'      =>  '验证码',
        'title'     =>  '页面标题',
        'keywords'  =>  '页面关键字',
        'description'   =>  '页面描述',
        'content'       =>  '页面主体内容',
        'category_id'   =>  '栏目索引',
        'user_id'       =>  '用户索引',
        'model'         =>  '产品型号',
        'serial_number' =>  '产品序列号',
        'priview'       =>  '预览图',
    ];
    /**
     * 数组长度限制
     */
    protected function arrayLength($v, $rule, $data)
    {
        return strlen(json_encode($v))<$rule?true:'预览图片太多，删掉2张试试？';
    }
    /**
     * 排除特定字符
     */
    public function exclude($data, $rule)
    {
        if(empty($rule)){
            $rule = ['console','article','product'];
        } else {
            $rule = explode(',',$rule);
        }
        return in_array($data, $rule)?'不允许使用'.$data:true;
    }
    /**
     * 更改名称
     * @param array|string $name 名称或键值对
     * @param string    $value 值
     */
    public function rename($name='',$value='')
    {
        if (is_array($name)) {
            $this->field = array_merge($this->field, $name);
        } else if(is_string($name)){
            $this->field = array_merge($this->field,[$name=>$value]);
        }
        return $this;
    }
    public function sceneTest()
    {
        return $this->only(['name'])
        ->append('name', 'require|min:5');
    }
    // 文章 更新
    public function sceneArticleUpdate()
    {
        return $this->only(['id','title','keywords','description','content','category_id','user_id'])
            ->append('title','token')
            ->rename('category_id','栏目ID')
            ->rename('user_id','用户ID');
    }
    // 文章 新增
    public function sceneArticleCreate()
    {
        return $this->only(['title' ,'keywords','description','content','category_id','user_id'])
            ->append('title','token')
            ->rename('category_id','栏目ID')
            ->rename('user_id','用户ID');
    }
    // 文章 删除
    public function sceneArticleDelete()
    {
        return $this->only(['id'])->append('id', 'require');
    }
    // 产品 更新
    public function sceneProductUpdate()
    {
        return $this->only(['id','title','keywords','description',
            'name','model','category_id','serial_number',
            'preview','content'])
            ->append('id', 'require')
            ->remove('model','require')
            ->remove('serial_number','require')
            ->rename('name','产品名称');
    }
    // 产品 新增
    public function sceneProductCreate()
    {
        return $this->only(['title','keywords','description',
            'name','model','category_id','serial_number','preview','content'])
            ->remove('model','require')
            ->remove('serial_number','require')
            ->rename('name','产品名称');
    }
    // 站点配置
    public function sceneSiteSave()
    {
        return $this->only(['name','cname','content'])
            ->remove('name','min')
            ->append('name','unique:qiyun_site|min:3')
            ->remove('cname','min')
            ->append('cname','min:4')
            ->rename('cname','配置描述')
            ->rename('name','调用名称')
            ->rename('content','配置值');
    }
    // 站点配置
    public function sceneSiteUpdate()
    {
        return $this->only(['id','name','cname','content'])
            ->remove('cname','min')
            ->append('cname','min:4')
            ->append('name','unique:qiyun_site|min:3')
            ->rename('cname','配置描述')
            ->rename('name','调用名称')
            ->rename('content','配置值')
            ->rename('id','获取索引失败！索引');
    }
    // 栏目 更新
    public function sceneCategoryUpdate()
    {
        return $this->only(['cname','path','parent'])
            ->append('cname','require|max:100')
            ->append('path','require|max:100|alphaDash|exclude|unique:qiyun_category')
            ->append('parent','require|number')
            ->append('view','alpha|max:20')
            ->append('type_view','alpha|max:20')
            ->rename('cname','栏目名称')
            ->rename('path','路径')
            ->rename('parent','父级索引')
            ->rename('view','栏目模板')
            ->rename('type_view','内容页模板');
    }
    // 栏目 新增
    public function sceneCategorySave()
    {
        return $this->only(['cname','path','parent'])
            ->append('cname','require|max:100')
            ->append('path','require|max:100|alphaDash|exclude|unique:qiyun_category')
            ->append('parent','require|number')
            ->append('view','alpha|max:20')
            ->append('type_view','alpha|max:20')
            ->rename('cname','栏目名称')
            ->rename('path','路径')
            ->rename('parent','父级索引')
            ->rename('view','栏目模板')
            ->rename('type_view','内容页模板');
    }
    // 用户
    public function sceneUserLogin()
    {
        return $this->only(['name','password','captcha'])->rename(['name'=>'用户名']);
    }
    // 主题 创建文件夹
    public function sceneThemeCreateDir()
    {
        return $this->only(['theneName','dirName'])
            ->append('themeName','require|alpha|max:20')
            ->append('dirName','require|alpha|max:20')
            ->rename('themeName','主题名称')
            ->rename('dirName','文件');
    }
    // 主题 创建模板文件
    public function sceneThemeCreateFile()
    {
        return $this->only(['themeName','fileName'])
            ->append('themeName',['require','alpha','max:20'])
            ->append('fileName',['require','alpha','max:20'])
            ->append('dirName','alpha|max:20')
            ->rename('themeName','主题名称')
            ->rename('fileName','文件名');
    }
    // 主题 删除目录或文件
    public function sceneThemeRemove()
    {
        return $this->only(['themeName','dirName','fileName'])
            ->append('themeName','require|alpha|max:20')
            ->append('dirName','require|alpha|max:20')
            ->append('fileName','alpha|max:20')
            ->rename('themeName','主题名称')
            ->rename('dirName','文件夹');
    }
    // 主题 删除主题目录下的文件
    public function sceneThemeRm()
    {
        return $this->only(['themeName','fileName'])
            ->append('themeName','require|alpha|max:20')
            ->append('fileName','require|alpha|max:20')
            ->rename('themeName','主题名称')
            ->rename('fileName','文件');
    }
}
