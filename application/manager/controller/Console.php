<?php

namespace app\manager\controller;

use think\Request;
use app\common\model\Site as SiteModel;
use app\common\unity\Unity;
use app\common\Valid;
class Console extends Base
{

    /**
     * 站点配置
     *
     * @route('/console','get')->name('_console')
     */
    public function index(Request $request, SiteModel $site)
    {
        $data = $site->all();
        $this->assign('data',$data);
        return $this->fetch();
    }

    /**
     * 批量更新站点配置信息
     * 
     * @route('/console/site/saveAll','post')->name('_site_save_all')
     */
    public function siteSaveAll(Request $request ,SiteModel $site)
    {
        $data=[];
        foreach ($request->param() as $key => $value) {
            $data[] = [
                'id'        =>  ltrim($key, '_'),
                'content'   =>  $value
            ];
        }
        $resule = $site->saveAll($data);
        return Unity::success('完成操作','_console');
    }

    /**
     * 1条数据新增和更新
     *
     * @route('/console/site/save','post')->name('_site_save')
     */
    public function siteSave(Request $request,SiteModel $site)
    {
        $data = $request->param();
        if(empty($data['id'])){
            // 新增
            $valid = Unity::valid($data,'SiteSave');
        } else {
            // 更新
            $valid = Unity::valid($data ,'SiteUpdate');
            $site  = $site->get($data['id']);
        }
        if ($valid !==true) {
            return Unity::error($valid);
        }
        $site->allowField(true)->save($data);
        return Unity::success('完成操作','_console');
    }
    /**
     * 查找某1条信息
     *
     * @param Request $request
     * @param Website $website
     * @route('/console/site/find','post')->name('_site_find')
     */
    public function siteFind(Request $request,SiteModel $site)
    {
        $data = $request->only(['name']);
        $result = $site->where($data)->find();
        return $result?Unity::success(null,null,['data'=>$result]):Unity::error();
    }

    /**
     * 删除某1条
     *
     * @param Request $request
     * @param Website $website
     * @return void
     * @route('/console/site/delete','post')->name('_site_delete')
     */
    public function siteDelete(Request $request,SiteModel $site)
    {
        $data = $request->param();
        if(!empty($data['id'])){
            $site->get($data['id'])->delete();
            return Unity::success('完成操作','_console');
        }
        return Unity::error('获取数据错误！删除失败');
    }
}
