<?php
namespace app\manager\controller;

/**
 * 开发文档，解析文件中的注释
 */
class Document extends \think\Controller
{
    /**
     * 默认首页
     */
    public function index($fileid=0)
    {
        $content = [];
        // 解析注释
        $classList = $this->getNamespaces();
        foreach ($classList as $n => $class) {
            $doc = $this->parseComment($class, $n);
            if (!empty($doc)) {
                list($root, $module, $effect) = explode('\\', $doc['namespace']);
                $map[$module.'\\'.$effect][]=$doc;
            }
            if ($fileid==$n) {
                $content=$doc;
            }
            if ($fileid==0) {
                $content = $this->parseComment(__CLASS__);
            }
        }
        // 拼装目录
        $side = '';
        array_walk($map, function ($vo, $key) use (&$side) {
            $side  .= '<li>' .$key .'</li>';
            array_walk($vo, function ($svo, $skey) use (&$side) {
                $side .= '<li><a href="?fileid='.$svo['fileid'] .'">'.$svo['name'].'</a></li>';
            });
        });
        $this->assign('side', $side);
        $this->assign('content', $content);
        return $this->fetch();
    }
    /**
     * 文件路径转换成命名空间
     */
    public function getNamespaces():array
    {
        $apppath = \App::getAppPath();
        $root = \App::getNamespace();
        $list = $this->getFiles($apppath);
        $map = array();
        foreach ($list as $file) {
            // step 1. /home/goo/website/cms/application/manager/controller/User.php
            $file = substr($file, 0, -4);
            // step 2. /home/goo/website/cms/application/manager/controller/User
            $file = substr($file, strlen($apppath));
            // step 3. /manager/controller/User
            $file = str_replace(DIRECTORY_SEPARATOR, '\\', $file);
            // step 4 .\manager\controller\User
            $file = $root.'\\'.$file;
            // out app\manager\controller\User
            $map[]=$file;
        }
        return $map;
    }
    /**
     * 遍历一级目录
     * 获取指定文件夹下的文件夹
     * exp: getDir('/home')
     * @param string $root
     * @param array
     */
    public function getDir($root=''):array
    {
        $list = array();
        if (is_dir($root)) {
            foreach (scandir($root) as $dir) {
                if (is_dir($root.$dir) && $dir !=='.' && $dir !=='..') {
                    $list[]=$root.$dir;
                }
            }
        }
        return $list;
    }
    /**
     * 遍历指定文件夹下指定后缀的文件
     * exp: getFile('/home/dir' ,'txt')
     * @param string $dir 要遍历的目录
     * @param string $ext 文件后缀
     */
    public function getFile($dir='', $ext=''):array
    {
        $list = array();
        if (is_dir($dir)) {
            foreach (scandir($dir) as $file) {
                if ($ext == pathinfo($file, PATHINFO_EXTENSION)) {
                    $list[]=$file;
                }
            }
        }
        return $list;
    }
    /**
     * 文件遍历
     * 遍历出指定目录下，所有以$ext为后缀的文件
     * getFiles('/home/dir' ,'php')
     * @param string $path
     * @param string $ext
     * @return array
     */
    private function getFiles($root='', $ext='php') :array
    {
        $recursion = function ($dir) use (&$recursion, $root, &$ext) {
            static $files = [];
            foreach (scandir($dir) as $file) {
                // 过滤根目录
                if ($file =='.' || $file =='..') {
                    continue;
                }
                // 递归到下一层
                if (is_dir($dir.$file)) {
                    $recursion($dir.$file.DIRECTORY_SEPARATOR);
                }
                // 遍历出$ext文件
                if (pathinfo($file, PATHINFO_EXTENSION) ==$ext) {
                    $files[]=$dir.$file;
                }
            }
            return $files;
        };
        return $recursion($root);
    }
    /**
     * 注释文本格式化
     * @param string $doc
     */
    public function fmt($doc='') :array
    {
        $lines = explode(PHP_EOL, $doc);
        $parse = [];
        foreach ($lines as $line) {
            $line = trim($line, '/* ');
            if (!empty($line)) {
                $parse[]=$line;
            }
        }
        return $parse;
    }
    /**
     * 类方法格式化
     * @param ReflectionMethod $method
     */
    public function fmtMethod(\ReflectionMethod $method):array
    {
        $doc = $method->getDocComment();
        $doc = $this->fmt($doc);
        $modifier = \Reflection::getModifierNames($method->getModifiers());
        $string  = ' function ';
        $string .= $method->getName();
        $string .= '(';
        foreach ($method->getParameters() as $param) {
            $string .= $param->getType() .' $'.$param->getName();
            if ($param->isOptional()) {
                $string .= ' = ' .json_encode($param->getDefaultValue());
            }
            $string .=',';
        }
        $string = rtrim($string, ',') .')';
        return ['comment' =>$doc ,'modifier'=>$modifier ,'compose'=>$string];
    }
    /**
     * 类属性格式化
     * @param ReflectionClass $ref 反射类
     * @param ReflectionProperty $property 反射类属性
     */
    public function fmtProperties(\ReflectionClass $ref, \ReflectionProperty $property)
    {
        $doc = $property->getDocComment();
        $doc = $this->fmt($doc);
        $modifier = \Reflection::getModifierNames($property->getModifiers());
        $string = ' $' .$property->getName();
        $defaultValues = $ref->getDefaultProperties();
        $value = $defaultValues[$property->getName()];
        $string .= ' =' . json_encode($value);
        return ['comment' =>$doc ,'modifier'=>$modifier ,'compose'=>$string];
    }
    /**
     * 解析文件注释
     * @param string $class
     */
    private function parseComment($class, $fileid=null)
    {
        if (!class_exists($class)) {
            return false;
        }
        $map = [
          'fileid'      => $fileid,
          'name'        =>  '',
          'namespace'   =>  '',
          'path'        =>  '',
          'comment'     =>  [],
          'methods'     =>  [],
          'property'    =>  [],
        ];
        // 反射实例
        $ref = new \ReflectionClass($class);
        // 类名（文件名）
        $map['name'] = $ref->getShortName();
        // 命名空间
        $map['namespace'] = $ref->getNamespaceName();
        // 文件路径
        $map['path'] = $ref->getFileName();
        // 类描述
        $map['comment'] = $this->fmt($ref->getDocComment());
        // 方法遍历
        foreach ($ref->getMethods() as $method) {
            if ($ref->getName()===$method->class) {
                $map['methods'][] = $this->fmtMethod($method);
            }
        }
        // 属性遍历
        foreach ($ref->getProperties() as $property) {
            if ($ref->getName()===$property->class) {
                $map['property'][] = $this->fmtProperties($ref, $property);
            }
        }
        return $map;
    }
}
