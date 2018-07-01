<?php

namespace app\common\unity;

use think\facade\App;
use Symfony\Component\Filesystem\Filesystem;
use think\facade\Config;

class Theme
{
    /**
     * 主题目录
     * @var string
     */
    protected $path;
    /**
     * 主题配置文件
     * @var string
     */
    protected $file;
    /**
     * 当前主题
     * @var string
     */
    private $theme;
    /**
     * 配置数组
     * @var array
     */
    public $config = [];
    public function __construct()
    {
        $this->path = App::getRootPath().'template'.DIRECTORY_SEPARATOR;
        $this->file = $this->path.'config.json';
        $content = file_get_contents($this->file);
        $this->config  = json_decode($content, true);
        $this->theme   = $this->config['theme'];
        $this->path   .= $this->theme;
    }
    /**
     * 配置主题
     * @param string $name
     * @param array $option
     * @return mixed
     */
    public function set($name, $option)
    {
        // 添加或重新设置$name的主题
        $this->config[$name] = array_merge($this->config[$name], $option);
    }
    /**
     * 删除主题
     * @param string $name
     */
    public function remove($name)
    {
        if (is_array($this->config[$name])) {
            unset($this->config[$name]);
        }
        $this->write();
    }
    
    /**
     * 获取主题信息
     * 
     * @param string $name
     */
    public function get($name='')
    {
        // 返回配置项
        if (isset($this->config[$name])) {
            return $this->config[$name];
        }
        // 空参 返回所有配置
        if(empty($name)){
            return $this->config;
        }
        return false;
    }
    /**
     * 设置前端或返回当前主题
     *
     * @param string $name
     */
    public function active($name)
    {
        // 激活新主题
        if (is_array($this->config[$name])) {
            // 调整路径
            $this->path = substr($this->path, 0, -strlen($this->theme));
            $this->path.= $name;
            $this->theme= $name;
            $this->config['theme'] = $this->theme;
            $this->write();
        }
        return false;
    }
    /**
     * 写配置文件
     */
    public function write()
    {
        $json = json_encode($this->config);
        $fs = new Filesystem();
        $fs->dumpFile($this->file, $json);
    }
    /**
     * 获取某个主题的目录
     *
     * @param string $name
     * @return string|bool 
     */
    public function getThemePath($name)
    {
        $path = substr($this->path,0,-strlen($this->theme));
        return is_dir($path.$name)?$path.$name.DIRECTORY_SEPARATOR:false;
    }
}
