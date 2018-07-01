<?php

namespace app\manager\controller;

use think\Controller;
use think\Request;
use app\common\model\Article as ArticleModle;
use app\common\model\Category as CategoryModel;
use app\common\Valid;
use think\facade\Session;
use app\common\unity\Unity;

class Article extends Base
{
    /**
     * 显示资源列表
     * 
     * @route('/console/article/edit/[:id]','get')->name('_articleEdit')
     */
    public function edit($id=0,ArticleModle $atc,CategoryModel $cat)
    {
        $this->assign('categorys' ,$cat->where(['type'=>1])->select());
        $this->assign('data',$atc->get($id));
        return $this->fetch();
    }

    /**
     * 保存新建的资源
     *
     * @param  \think\Request  $request
     * @route('/console/article/save','post')->name('_article_save')
     */
    public function save(Request $request ,ArticleModle $atc)
    {
        $data  = $request->param();
        $data['user_id'] = Session::get('user.id');
        $valid = Unity::valid($data ,'ArticleCreate');
        if ($valid !==true) {
            return Unity::error($valid);
        }
        $atc->allowField(true)->save($data);
        return Unity::success('发布完成','_article');
    }

    /**
     * 保存更新的资源
     *
     * @param  \think\Request  $request
     * @param  int  $id
     * @route('/console/article/update','post')->name('_article_update')
     */
    public function update(Request $request ,ArticleModle $atc)
    {
        $data = $request->param();
        $data['user_id'] = Session::get('user.id');
        $valid= Unity::valid($data,'ArticleUpdate');
        if($valid !==true){
            return Unity::error($valid);
        }
        $atc->allowField(true)->update($data);
        return Unity::success('已更新','_article');
    }

    /**
     * 删除指定资源
     *
     * @param  int  $id
     * @return \think\Response
     * @route('/console/article/delete/:id','get')->name('_article_delete')
     */
    public function delete($id,ArticleModle $atc)
    {
        $data = $atc->get($id);
        if($data){
            $data->delete();
            return Unity::success('文章已删除','_article');
        }
        return Unity::error('删除失败','_article');
    }

    /**
     * 文章列表
     *
     * @return void
     * @route('/console/article/list','get')->name('_article')
     */
    public function list(ArticleModle $atc ,$rows=10)
    {
        $list = $atc->paginate($rows);
        $page = preg_replace('/<(\/?)span/','<$1a',$list->render());
        $page = preg_replace('/<a([^>]*)>/is','<a class="page-link" $1>',$page);
        $page = preg_replace('/<ul.*?>/','<ul class="pagination justify-content-center">',$page);
        $this->assign('list',$list);
        $this->assign('page',$page);
        return $this->fetch();
    }
}
