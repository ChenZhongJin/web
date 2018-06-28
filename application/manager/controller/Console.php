<?php

namespace app\manager\controller;

use think\Controller;
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
     * @route('/console/site/save','post')->name('_site_save')
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
        return $this->success('完成操作','_console');
    }

    /**
     * 更新配置信息
     * 
     * @route('/console/site/update','post')->name('_site_update')
     */
    public function siteUpdate(Request $request ,SiteModel $site)
    {
        $data = $request->only(['id' ,'name' ,'cname' ,'content']);
        $valid = Unity::valid($data ,'SiteUpdate');
        if ($valid !==true) {
            return Unity::error($valid);
        }
        $site->allowField(true)->isUpdate(true)->save($data);
        return Unity::success('完成操作','_console');
    }

    /**
     * 新增站点配置
     *
     * @route('/console/site/create','post')->name('_site_create')
     */
    public function websiteCreate(Request $request,SiteModel $site)
    {
        $data = $request->param();
        $valid = Unity::valid($data ,'SiteCreate');
        if ($valid !==true) {
            return Unity::error($valid);
        }
        if ($data['id']) {
            $site->allowField(true)->update($data);
        }else{
            $site->allowField(true)->save($data);
        }

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
        $result = $site->get($data);
        if (!empty($result)) {
            return $result;
        }
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
        $id = $request->param('id');
        $site->get($id)->delete();
        return Unity::success('完成操作','_console');
    }
}
