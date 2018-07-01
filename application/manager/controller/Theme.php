<?php

namespace app\manager\controller;

use think\facade\Config;
use Symfony\Component\Filesystem\Filesystem;
use think\facade\App;

use app\common\unity\Theme as Themes;
use app\common\unity\Unity;
use think\Request;

class Theme extends Base
{
    /**
     * 显示主题列表 默认页面
     *
     * @route('/console/theme','get')->name('_theme')
     */
    public function index(Themes $theme)
    {
        $list = $theme->get();
        unset($list['theme']);
        $this->assign('active',$theme->get('theme'));
        $this->assign('list',$list);
        return $this->fetch();
    }
    /**
     * 设置模板
     *
     * @return void
     * @route('/console/theme/active/:themeName','post')->name('_theme_active')
     */
    public function active($themeName,Themes $theme)
    {
        $theme->active($themeName);
        return Unity::success('主题已设置','_theme');
    }
    /**
     * 显示模板资源
     *
     * @param string $dir
     * @route('/console/theme/list/:themeName/[:dir]','get')->name('_themeList')
     */
    public function list(Themes $theme, $themeName,$dir='')
    {
        $path = $theme->getThemePath($themeName).$dir;
        if(!empty($dir)){
            $path.=DIRECTORY_SEPARATOR;
        }
        if(!is_dir($path)){
            return Unity::error('错误!目录不存在');
        }
        $dirs = scandir($path);
        $mapDir  = [];
        $mapFile = [];
        foreach ($dirs as $name) {
            if($name !=='.' && $name !=='..'){
                if(is_dir($path.$name)){
                    $mapDir[$name] = $path.$name;
                }
                if (is_file($path.$name)) {
                    $file = pathinfo($name,PATHINFO_FILENAME);
                    $mapFile[$file] = $path.$name;
                }
            }
        }
        $this->assign('dirName',$dir);
        $this->assign('themeName',$themeName);
        $this->assign('dirs',$mapDir);
        $this->assign('files',$mapFile);
        return $this->fetch();
    }

    /**
     * 创建文件夹
     *
     * @param string $themeName
     * @param string $name
     * @return void
     * @route('/console/theme/create/dir','post')->name('_theme_create_dir')
     */
    public function createDir(Request $request){
        $data = $request->only(['themeName','dirName']);
        $valid= Unity::valid($data,'ThemeCreateDir');
        if($valid !==true){
            return Unity::error($valid);
        }
        $theme = new Themes();
        $path  = $theme->getThemePath($data['themeName']);
        $fs = new Filesystem();
        if ($fs->exists($path.$data['dirName'])){
            return Unity::error('目录已存在');
        }
        $fs->mkdir($path.$data['dirName']);
        return Unity::success('创建成功',['_themeList',['themeName'=>$data['themeName']]]);
    }
    /**
     * 创建文件
     * @route('/console/theme/create/file','post')->name('_theme_create_file')
     */
    public function createFile(Request $request) {
        $data = $request->only(['themeName','fileName','dirName']);
        $valid= Unity::valid($data,'ThemeCreateFile');
        if($valid !==true){
            return Unity::error($valid);
        }
        
        $theme = new Themes();
        $root  = $theme->getThemePath($data['themeName']);
        $dir   = $data['dirName']??false;
        $file  = $data['fileName'];
        if($dir){
            $template = $root.$dir.DIRECTORY_SEPARATOR.$file.'.html';
        } else {
            $template = $root.$file.'.html';
        }
        $fs    = new Filesystem();
        if($fs->exists($template) ) {
            return Unity::error('文件已存在');
        } else {
            $fs->dumpFile($template,'');
        }
        return Unity::success('创建完成',['_themeList',['themeName'=>$data['themeName']]]);
    }

    /**
     * 删除文件和文件夹
     *
     * @route('/console/theme/remove/:themeName/:dirName/[:fileName]','post')->name('_themeRemove')
     */
    public function remove($themeName,$dirName,$fileName='',Themes $theme)
    {
        // 验证数据
        $data = [
            'themeName' =>  $themeName,
            'dirName'   =>  $dirName,
            'fileName'  =>  $fileName
        ];
        $valid = Unity::valid($data,'ThemeRemove');
        if ($valid !==true) {
            return Unity::error($valid);
        }
        // 配置目录
        $path = $theme->getThemePath($themeName);
        $path.= $dirName;
        if(!empty($fileName)){
            $path .=DIRECTORY_SEPARATOR.$fileName.'.html';
        }
        // 执行操作
        $fs = new Filesystem();
        if($fs->exists($path)){
            $fs->remove($path);
            return Unity::success($dirName.'文件夹已删除',['_themeList',['themeName'=>$themeName]]);
        }
        return Unity::error('文件不存在');
    }
    /**
     * 删除主题目录下的文件
     * @route('/console/theme/rm/:themeName/:fileName','post')->name('_themeRm')
     */
    public function rmFile($themeName,$fileName,Themes $theme)
    {
        // 验证数据
        $data = [
            'themeName' =>  $themeName,
            'fileName'  =>  $fileName
        ];
        $valid = Unity::valid($data,'ThemeRm');
        if ($valid !==true) {
            return Unity::error($valid);
        }
        // 配置目录
        $path = $theme->getThemePath($themeName);
        $path.= $fileName.'.html';
        // 执行操作
        $fs = new Filesystem();
        if($fs->exists($path)){
            $fs->remove($path);
            return Unity::success($fileName.'文件已删除',['_themeList',['themeName'=>$themeName]]);
        }
        return Unity::error('文件不存在');
    }
    /**
     * 编辑模板文件
     *
     * @param string $themeName
     * @param string $dirName
     * @param string $fileName
     * @return void
     * @route('/console/theme/edit/:themeName/:dirName/:fileName')->name('_themeEdit')
     */
    public function edit($themeName,$dirName,$fileName,Themes $theme)
    {
        $path = $theme->getThemePath($themeName);
        $path.= $dirName.DIRECTORY_SEPARATOR.$fileName.'.html';
        if(!is_file($path)){
            return Unity::error('文件不存在');
        }
        $content = file_get_contents($path);
        $this->assign('themeName',$themeName);
        $this->assign('dirName',$dirName);
        $this->assign('fileName',$fileName);
        $this->assign('content',$content);
        return $this->fetch();
    }
    /**
     * 编辑主题根目录模板文件
     *
     * @param string $themeName
     * @param string $dirName
     * @param string $fileName
     * @return void
     * @route('/console/theme/edit/:themeName/:fileName')->name('_themeEditRoot')
     */
    public function editRoot($themeName,$fileName,Themes $theme)
    {
        $path = $theme->getThemePath($themeName);
        $path.= $fileName.'.html';
        if(!is_file($path)){
            return Unity::error('文件不存在');
        }
        $content = file_get_contents($path);

        $this->assign('themeName',$themeName);
        $this->assign('fileName',$fileName);
        $this->assign('dirName','');
        $this->assign('content',$content);
        return $this->fetch('theme/edit');
    }
    /**
     * 更新模板
     *
     * @route('/console/theme/save/:themeName/:dirName/:fileName','post')->name('_theme_save')
     */
    public function save($themeName,$dirName,$fileName,Themes $theme,Request $request)
    {
        $path = $theme->getThemePath($themeName);
        $path.= $dirName.DIRECTORY_SEPARATOR.$fileName.'.html';
        if(!is_file($path)){
            return Unity::error('文件不存在');
        }
        $content = $request->only('content');
        $fs = new Filesystem();
        $fs->dumpFile($path,$content);
        return Unity::success('已修改',['_themeList',['themeName'=>$themeName,'dir'=>$dirName]]);
    }
    /**
     * 更新主题跟目录模板
     *
     * @route('/console/theme/save/:themeName/:fileName','post')->name('_theme_save_root')
     */
    public function saveRoot($themeName,$fileName,Themes $theme,Request $request)
    {
        $path = $theme->getThemePath($themeName);
        $path.= $fileName.'.html';
        if(!is_file($path)){
            return Unity::error('文件不存在');
        }
        $content = $request->only('content');
        $fs = new Filesystem();
        $fs->dumpFile($path,$content);
        return Unity::success('已修改',['_themeList',['themeName'=>$themeName]]);
    }
}
