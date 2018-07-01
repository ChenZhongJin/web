<?php

namespace app\manager\controller;

use think\Controller;
use think\Request;
use app\common\model\Product as ProductModel;
use app\common\model\Category as CategoryModel;
use app\common\unity\Unity;
use think\Db;
use Symfony\Component\DomCrawler\Crawler;

class Product extends Base
{
    private $categoryType = 2;


    /**
     * 新增产品
     *
     * @param  \think\Request  $request
     * @return \think\Response
     * @route('/console/product/save','post')->name('_product_save')
     */
    public function save(Request $request, ProductModel $product)
    {
        $data = $request->param();
        $valid= Unity::valid($data, 'ProductCreate');
        if ($valid !==true) {
            return Unity::error($valid);
        }
        $product->save($data);
        return Unity::success('已新增', '_productListImg');
    }


    /**
     * 编辑页面
     *
     * @param  int  $id
     * @return \think\Response
     * @route('/console/product/[:id]','get')->name('_productEdit')
     */
    public function edit($id=0, ProductModel $product, CategoryModel $cats)
    {
        $data = $product->get($id);
        $list = $cats->where(['type'=>$this->categoryType])->select();
        $this->assign('data', $data);
        $this->assign('list', $list);
        return $this->fetch();
    }

    /**
     * 更新
     *
     * @param  \think\Request  $request
     * @route('/console/product/update','post')->name('_product_update')
     */
    public function update(Request $request, ProductModel $product)
    {
        $data = $request->param();
        $valid = Unity::valid($data, 'ProductUpdate');
        if ($valid!==true) {
            return Unity::error($valid);
        }
        $product->update($data);
        return Unity::success('已更新', '_productListImg');
    }
    /**
     * 产品列表
     *
     * @return void
     * @route('/console/product/listimg','get')->name('_productListImg')
     */
    public function listImg(ProductModel $product ,$rows=10)
    {
        $list = $product->paginate($rows);
        $page = preg_replace('/<(\/?)span/','<$1a',$list->render());
        $page = preg_replace('/<a([^>]*)>/is','<a class="page-link" $1>',$page);
        $page = preg_replace('/<ul.*?>/','<ul class="pagination justify-content-center">',$page);
        $this->assign('page',$page);
        $this->assign('list', $list);
        return $this->fetch();
    }

    /**
     * 删除指定资源
     *
     * @param  int  $id
     * @return \think\Response
     * @route('/console/product/delete/:id','post')->name('_product_delete')
     */
    public function delete($id, ProductModel $product)
    {
        $item = $product->get($id);
        if(!empty($item)){
            $item->delete();
            return Unity::success($item->name.'已删除', '_productListImg');
        }
        return Unity::error('删除失败','_productListImg');
    }
}
