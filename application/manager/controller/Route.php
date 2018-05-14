<?php
namespace app\manager\controller;

/**
 *
 */
class Route extends Base
{
    /**
     * 新增或修改路由
     * @route('/sys/route/index' ,'get')
     */
    public function index()
    {
        $id = \Request::get($id);
        $route = model('Route')->get($id);
        $this->assign([
          'route'      =>  $route,
        ]);
        return $this->fetch();
    }
    /**
     * @desc post 新增或修改路由
     * @route('/sys/route/save' ,'post')
     */
    public function save()
    {
        $id = \Request::get('id');
        $map= \Request::param();
        $route = model('Route');
        if (!empty($id)) {
            $route->get($id);
        }
        $route->allowField(true)->save($map);
        return $this->success('完成操作', 'manager/route/index');
    }
}
