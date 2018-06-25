<?php

namespace app\manager\controller;

use think\Controller;
use think\Request;
use app\common\model\Product as ProductModel;
use app\common\model\Category as CategoryModel;

class Product extends Base
{
    /**
     * 显示资源列表
     *
     * @return \think\Response
     */
    public function index()
    {
        //
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
     * @route('/console/product/save','post')->name('_product_save')
     */
    public function save(Request $request)
    {
        // $data = $request->param();
        // return $data;
        $file = $request->file('file');
        dump($file);
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
     * @route('/console/product/[:id]','get')->name('_productEdit')
     */
    public function edit($id=0,ProductModel $product,CategoryModel $cats)
    {
        return $this->info();
        $data = $product->get($id);
        $list = $cats->where(['type'=>2])->select();
        $this->assign('data',$data);
        $this->assign('list',$list);
        return $this->fetch();
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
     * 图片列表
     *
     * @return void
     * @route('/console/product/listimg','get')->name('_productListImg')
     */
    public function listImg(ProductModel $product)
    {
        $list = $product->all();
        $this->assign('list',$list);
        return $this->fetch();
    }
    /**
     * 文本列表
     *
     * @return void
     * @route('/console/product/listtxt','get')->name('_productListTxt')
     */
    public function listTxt()
    {
        $list = $product->all();
        $this->assign('list',$list);
        return $this->fetch();
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
