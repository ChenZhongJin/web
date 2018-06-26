<?php

namespace app\manager\controller;

use think\Controller;
use think\Request;
use app\common\model\Product as ProductModel;
use app\common\model\Category as CategoryModel;
use app\common\unity\Unity;
use think\Db;
class Product extends Base
{
    private     $categoryType = 2;
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
    public function save(Request $request,ProductModel $product)
    {
        $data = $request->param();
        $valid= $this->validate($data,'\\app\\common\\Valid.ProductCreate');
        if ($valid !==true) {
            return Unity::error($valid);
        }
        $product->save($data);
        return Unity::success('已新增','_productListImg');
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
        $data = $product->get($id);
        $list = $cats->where(['type'=>$this->categoryType])->select();
        $this->assign('data',$data);
        $this->assign('list',$list);
        return $this->fetch();
    }

    /**
     * 保存更新的资源
     *
     * @param  \think\Request  $request
     * @route('/console/product/update','post')->name('_product_update')
     */
    public function update(Request $request,ProductModel $product)
    {
        $data = $request->param();
        $valid = Unity::valid($data,'ProductUpdate');
        if($valid!==true){
            return Unity::error($valid);
        }
        $product->update($data);
        return Unity::success('已更新','_productListImg');
    }
    /**
     * 图片列表
     *
     * @return void
     * @route('/console/product/listimg','get')->name('_productListImg')
     */
    public function listImg(ProductModel $product)
    {
        $option = [
            'list_rows'=>2,
        ];
        $list = $product->paginate(2,false,$option);
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
     * @route('/console/product/delete/:id','post')->name('_product_delete')
     */
    public function delete($id,ProductModel $product)
    {
        $item = $product->get($id);
        $item->delete();
        return Unity::success($item->name.'已删除','_productListImg');
    }
}
