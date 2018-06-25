<?php

namespace app\manager\controller;

use think\Controller;
use think\Request;
use app\common\model\Category as CategoryModle;
use think\facade\Route;

Route::pattern(['parent'=>'\d+']);
Route::pattern(['id'=>'\d+']);
class Category extends Controller
{
    /**
     * 分类列表
     *
     * @route('/console/category/[:parent]','get')->name('_category');
     */
    public function index($parent=0, CategoryModle $cats)
    {
        $data = $cats->get($parent);
        if (empty($data)) {
            $data['id']     =0;
            $data['parent'] =0;
        }
        $this->assign('parent', $data);
        $this->assign(
            'list',
            $cats->where(['parent'=>$parent])
                        ->select()
        );
        return $this->fetch();
    }

    /**
     * 保存新建的资源
     *
     * @param  \think\Request  $request
     * @return \think\Response
     * @route('/console/category/save','post')->name('_category_save')
     */
    public function save(Request $request, CategoryModle $cats)
    {
        $data = $request->param();
        $valid= $this->validate($data, '\\app\\common\\validate\\Category.save');
        if ($valid !==true) {
            return $this->error($valid);
        }
        if($data['parent']!=0){
            $data['type']=$cats->get($data['parent'])->type;
        }
        $cats->allowField(true)->save($data);
        return $this->success('完成新增', url('_category',['parent'=>$cats->parent]));
    }

    /**
     * 显示编辑资源表单页.
     *
     * @return \think\Response
     * @route('/console/category/edit/:parent/:id','get')->name('_categoryEdit')
     */
    public function edit($parent=0, $id=0, CategoryModle $cats)
    {
        // 1.新增顶级栏目
        // 2.已知父级新增子级 $parent
        // 3.修改当前的栏目   $id
        // 模板需要的数据 $data   当前栏目
        //               $parent 父级栏目
        //               $list   栏目列表
        $data = $cats->get($id);
        if ($id==0&&$parent==0) {
            // 1.新增顶级栏目
            $list = $cats->all();
            $parent= $cats->get($parent);
        } elseif ($parent && $id==0) {
            // 2.已知父级新增子级 $parent
            $parent = $cats->get($parent);
            $list = $cats->where(['type'=>$parent->type])
                         ->select();
        } elseif ($parent && $id) {
            // 3.修改当前的栏目   $id
            $parent = $cats->where(['id'=>$data->parent])->find();
            $list = $cats->where(['type'=>$parent->type])
                         ->select();
        } elseif ($parent ==0 &&$id){
            // 4.修改顶级栏目
            $parent = ['id'=>0];
            $list = $cats->where(['type'=>$data->type])
                         ->select();
        }
        $this->assign('parent', $parent);
        $this->assign('data', $data);
        $this->assign('list', $list);
        return $this->fetch();
    }

    /**
     * 保存更新的资源
     *
     * @param  \think\Request  $request
     * @return \think\Response
     * @route('/console/category/update','post')->name('_category_update')
     */
    public function update(Request $request, CategoryModle $cats)
    {
        $data = $request->param();
        $valid = $this->validate($data, '\\app\\common\\validate\\Category.update');
        if ($valid !==true) {
            return $this->error($valid);
        }
        $result = $cats->allowField(true)->update($data);
        
        return $this->success('已更新', url('_category',['parent'=>$result->parent]));
    }

    /**
     * 删除指定资源
     *
     * @route('/console/category/delete/:id','post')->name('_category_delete')
     */
    public function delete($id, CategoryModle $cats)
    {
        $data = $cats->get($id);
        $jump = '';
        if($data){
            $jump = url('_category',['parent'=>$data->parent]);
        }
        if ($cats->where(['parent'=>$data->id])->find()) {
            return $this->error('有子类存在，不会删除',$jump);
        }
        $data->delete();
        return $this->success('已删除',$jump);
    }
}
