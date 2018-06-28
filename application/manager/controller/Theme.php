<?php

namespace app\manager\controller;


class Theme extends Base
{
    /**
     * 显示资源列表
     *
     * @route('/console/theme','get')->name('_theme')
     */
    public function index()
    {
        $root = \App::getRootPath();
        $path = $root.'template'.DIRECTORY_SEPARATOR;
        $theme=[];
        foreach(scandir($path) as $dir){
            if($dir !=='.' && $dir !='..' && is_dir($path.$dir)){
                $theme[] =   [
                    'name'  =>  $dir,
                    'pic'   =>  $path.$dir.DIRECTORY_SEPARATOR.'index.png'
                ];
            }
        }
        $this->assign('list',$theme);
        return $this->fetch();
    }

    public function getTheme()
    {
        $root = \App::getRootPath();
        $theme= $root.'template';
        
        return $theme;
    }

    /**
     * 显示创建资源表单页.
     *
     * @return \think\Response
     */
    public function create()
    {
        //
    }

    /**
     * 保存新建的资源
     *
     * @param  \think\Request  $request
     * @return \think\Response
     */
    public function save(Request $request)
    {
        //
    }

    /**
     * 显示指定的资源
     *
     * @param  int  $id
     * @return \think\Response
     */
    public function read($id)
    {
        //
    }

    /**
     * 显示编辑资源表单页.
     *
     * @param  int  $id
     * @return \think\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * 保存更新的资源
     *
     * @param  \think\Request  $request
     * @param  int  $id
     * @return \think\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * 删除指定资源
     *
     * @param  int  $id
     * @return \think\Response
     */
    public function delete($id)
    {
        //
    }
}
