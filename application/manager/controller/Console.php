<?php

namespace app\manager\controller;

use think\Controller;
use think\Request;
use app\common\model\Website;
use app\common\validate\Website as WebsiteValidate;

class Console extends Controller
{
    /**
     * 后台首页
     *
     *
     * @route('/console' ,'get')->name('console_panel')
     */
    public function index()
    {
        return $this->fetch();
    }

    /**
     * 站点配置
     *
     * @route('/console/website','get')->name('console_website')
     */
    public function webSite(Request $request, Website $website)
    {
        return $this->fetch(null, [
            'data' => $website->select()
        ]);
    }

    /**
     * 批量更新站点配置信息
     * @route('/console/website/save','post')->name('console_website_save')
     */
    public function websiteSaveAll(Request $request ,Website $website)
    {
        $data=[];
        foreach ($request->param() as $key => $value) {
            $data[] = [
                'id'        =>  ltrim($key, '_'),
                'content'   =>  $value
            ];
        }
        $resule = $website->saveAll($data);
        return $this->success('完成操作');
    }

    /**
     * 更新配置信息
     * 
     * @route('/console/website/update','post')->name('console_website_update')
     */
    public function websiteUpdate(Request $request ,Website $website)
    {
        $data = $request->only(['id' ,'name' ,'cname' ,'content']);
        $valid = $this->validate($data ,'\app\common\validate\Website.update');
        if ($valid !==true) {
            return $this->error($valid);
        }
        $website->allowField(true)->isUpdate(true)->save($data);
        return $this->success('完成操作');
    }

    /**
     * 新增站点配置
     *
     * @route('/console/website/create','post')->name('console_website_create')
     */
    public function websiteCreate(Request $request,Website $website)
    {
        $data = $request->param();
        $valid = $this->validate($data ,'\app\common\validate\Website.create');
        if ($valid !==true) {
            return $this->error($valid);
        }
        if ($data['id']) {
            $website->allowField(true)->update($data);
        }else{
            $website->allowField(true)->save($data);
        }

        return $this->success('完成操作');
    }
    /**
     * 查找某1条信息
     *
     * @param Request $request
     * @param Website $website
     * @route('/console/website/find','post')->name('console_website_find')
     */
    public function websiteFind(Request $request,Website $website)
    {
        $data = $request->only(['name']);
        $result = $website->get($data);
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
     * @route('/console/website/delete','post')->name('console_website_delete')
     */
    public function websiteDelete(Request $request,Website $website)
    {
        $id = $request->param('id');
        $website->get($id)->delete();
        return $this->success('完成操作');
    }
}
