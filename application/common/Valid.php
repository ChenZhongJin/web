<?php

namespace app\common;

use think\facade\Session;
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
        // alphaDash alpha confirm:password captcha token
        'captcha'       =>  'require|captcha'
    ];
    protected $field = [
        'captcha'       =>  '验证码'
    ];
    
    /**
     * 排除特定字符
     */
    protected function exclude($data, $rule)
    {
        if (empty($rule)) {
            $rule = ['console','article','product'];
        } else {
            $rule = explode(',', $rule);
        }
        return in_array($data, $rule)?'不允许使用'.$data:true;
    }
    /**
     * 更改名称
     * @param array|string $name 名称或键值对
     * @param string    $value 值
     */
    public function rename($name='', $value='')
    {
        if (is_array($name)) {
            $this->field = array_merge($this->field, $name);
        } elseif (is_string($name)) {
            $this->field = array_merge($this->field, [$name=>$value]);
        }
        return $this;
    }
    // 文章 更新
    public function sceneArticleUpdate()
    {
        return $this->only(['id','title','keywords','description','content','category_id','user_id'])
            ->append('id', 'require')
            ->rename('id', '文章ID')
            ->append('title', 'require')
            ->rename('title', '文章标题')
            ->append('keywords', 'max:50')
            ->rename('keywords','页面关键词')
            ->append('description', 'max:500')
            ->rename('description','页面描述')
            ->append('content', 'max:5000')
            ->rename('content', '内容')
            ->append('category_id', 'require')
            ->rename('category_id', '栏目ID')
            ->append('user_id', 'require')
            ->rename('user_id', '用户ID');
    }
    // 文章 新增
    public function sceneArticleCreate()
    {
        return $this->only(['title','keywords','description','content','category_id','user_id'])
            ->append('title', 'require')
            ->rename('title', '文章标题')
            ->append('keywords', 'max:50')
            ->rename('keywords','页面关键词')
            ->append('description', 'max:500')
            ->rename('description','页面描述')
            ->append('content', 'max:5000')
            ->rename('content', '内容')
            ->append('category_id', 'require')
            ->rename('category_id', '栏目ID')
            ->append('user_id', 'require')
            ->rename('user_id', '用户ID');
    }
    
    // 产品 更新
    public function sceneProductUpdate()
    {
        return $this->only(['id','name','title','keywords','description','content','category_id','model','serial_number','preview'])
            ->append('id', 'require')
            ->rename('id', '产品ID')
            ->append('title', 'require')
            ->rename('title', '页面标题')
            ->append('keywords', 'max:50')
            ->rename('keywords', '页面关键词')
            ->append('description', 'max:500')
            ->rename('description', '页面描述')
            ->append('content', 'max:5000')
            ->append('content', '页面内容')
            ->append('category_id', 'require')
            ->rename('category_id', '栏目ID')
            ->append('name', 'require|max:200')
            ->rename('name', '产品名称')
            ->append('model', 'max:200')
            ->rename('model', '产品型号')
            ->append('serial_number', 'max:200')
            ->rename('serial_number', '产品序列号')
            ->append('preview', 'length:10')
            ->rename('preview', '预览图');
    }
    // 产品 新增
    public function sceneProductCreate()
    {
        return $this->only(['name','title','keywords','description','content','category_id','model','serial_number','preview'])
            ->append('title', 'require')
            ->rename('title', '页面标题')
            ->append('keywords', 'max:50')
            ->rename('keywords', '页面关键词')
            ->append('description', 'max:500')
            ->rename('description', '页面描述')
            ->append('content', 'max:5000')
            ->append('content', '页面内容')
            ->append('category_id', 'require')
            ->rename('category_id', '栏目ID')
            ->append('name', 'require|max:200')
            ->rename('name', '产品名称')
            ->append('model', 'max:200')
            ->rename('model', '产品型号')
            ->append('serial_number', 'max:200')
            ->rename('serial_number', '产品序列号')
            ->append('preview', 'length:10')
            ->rename('preview', '预览图');
    }
    // 站点配置
    public function sceneSiteSave()
    {
        return $this->only(['name','cname','content'])
            ->append('name', 'unique:qiyun_site|min:3')
            ->rename('name', '调用名称')
            ->append('cname', 'min:4')
            ->rename('cname', '配置描述')
            ->append('content', 'max:200')
            ->rename('content', '配置值');
    }
    // 站点配置
    public function sceneSiteUpdate()
    {
        return $this->only(['id','name','cname','content'])
            ->append('id', 'require')
            ->rename('id', '获取索引失败！索引')
            ->append('cname', 'min:4')
            ->rename('cname', '配置描述')
            ->append('name', 'unique:qiyun_site|min:3')
            ->rename('name', '调用名称')
            ->append('content', 'max:200')
            ->rename('content', '配置值');
    }
    // 栏目 更新
    public function sceneCategoryUpdate()
    {
        return $this->only(['id','cname','path','parent','view','type_view'])
            ->append('id', 'require')
            ->rename('id', '栏目索引ID')
            ->append('cname', 'require|max:100')
            ->rename('cname', '栏目名称')
            ->append('path', 'require|max:100|alphaDash|exclude|unique:qiyun_category')
            ->rename('path', '路径')
            ->append('parent', 'require|number')
            ->rename('parent', '父级索引')
            ->append('view', 'alpha|max:20')
            ->rename('view', '栏目模板')
            ->append('type_view', 'alpha|max:20')
            ->rename('type_view', '内容页模板');
    }
    // 栏目 新增
    public function sceneCategorySave()
    {
        return $this->only(['cname','path','parent','view','type_view'])
            ->append('cname', 'require|max:100')
            ->rename('cname', '栏目名称')
            ->append('path', 'require|max:100|alphaDash|exclude|unique:qiyun_category')
            ->rename('path', '路径')
            ->append('parent', 'require|number')
            ->rename('parent', '父级索引')
            ->append('view', 'alpha|max:20')
            ->rename('view', '栏目模板')
            ->append('type_view', 'alpha|max:20')
            ->rename('type_view', '内容页模板');
    }
    // 用户
    public function sceneUserLogin()
    {
        return $this->only(['captcha','name','password'])
            ->append('name', 'require|min:5|max:50|alphaDash')
            ->rename('name', '用户名')
            ->append('password', 'require|min:5|max:200|alphaDash')
            ->rename('password', '密码');
    }
    // 主题 创建文件夹
    public function sceneThemeCreateDir()
    {
        return $this->only(['theneName','dirName'])
            ->append('themeName', 'require|alpha|max:20')
            ->rename('themeName', '主题名称')
            ->append('dirName', 'require|alpha|max:20')
            ->rename('dirName', '文件');
    }
    // 主题 创建模板文件
    public function sceneThemeCreateFile()
    {
        return $this->only(['themeName','fileName','dirName'])
            ->append('themeName', ['require','alpha','max:20'])
            ->rename('themeName', '主题名称')
            ->append('fileName', ['require','alpha','max:20'])
            ->rename('fileName', '文件名')
            ->append('dirName', 'alpha|max:20')
            ->rename('dirName', '文件夹');
    }
    // 主题 删除目录或文件
    public function sceneThemeRemove()
    {
        return $this->only(['themeName','fileName','dirName'])
            ->append('themeName', 'require|alpha|max:20')
            ->rename('themeName', '主题名称')
            ->append('fileName', 'alpha|max:20')
            ->rename('fileName', '文件名称')
            ->append('dirName', 'require|alpha|max:20')
            ->rename('dirName', '文件夹');
    }
    // 主题 删除主题目录下的文件
    public function sceneThemeRm()
    {
        return $this->only(['themeName','fileName'])
            ->append('themeName', 'require|alpha|max:20')
            ->append('fileName', 'require|alpha|max:20')
            ->rename('themeName', '主题名称')
            ->rename('fileName', '文件');
    }
    // 任务 采集任务 新增
    public function sceneTaskCollectAdd()
    {
        return $this->only(['name','link','xpath_list'])
        ->append('name', 'require|max:200')
        ->rename('name', '任务名称/描述')
        ->append('link', 'require|url')
        ->rename('link', '列表页地址')
        ->append('xpath_list', 'require|max:200')
        ->rename('xpath_list', '采集量');
    }
    // 任务 采集任务 更新
    public function sceneTaskCollectUpdate()
    {
        return $this->only(['id' ,'name','link','xpath_list'])
        ->append('id','require|number')
        ->rename('id','任务索引')
        ->append('name', 'require|max:200')
        ->rename('name', '任务名称/描述')
        ->append('link', 'require|url')
        ->rename('link', '列表页地址')
        ->append('xpath_list', 'require|max:200')
        ->rename('xpath_list', '采集量');
    }
    // 任务 采集任务 测试
    public function sceneTaskTest()
    {
        return $this->only(['link','xpath_list'])
        ->append('link', 'require|url')
        ->rename('link', '列表页地址')
        ->append('xpath_list','require')
        ->rename('xpath_list','规则');
    }
}
