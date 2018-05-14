<?php
namespace app\manager\controller;

/**
 * 角色管理
 */
class Role extends Base
{
    /**
     * 角色管理
     * @route('/manager/role/index' ,'get')
     */
    public function index()
    {
        $this->assign('roles', model('Role')->all());
        return $this->fetch();
    }
    /**
     * 设置角色视图
     * @param int $id 角色ID
     * @ route('/manager/role/edit/[:roleid]' ,'get')
     */
    public function editRole($roleid=0)
    {
        $this->assign('role', model('Role')->get($roleid));
        return $this->fetch();
    }
    /**
     * 配置路由视图
     * @param int $roleid
     */
    public function editRoute($roleid=0)
    {
        return $this->fetch();
    }
    /**
     * 配置用户视图
     * @param int $roleid
     */
    public function editUser($routeid=0)
    {
        return $this->fetch();
    }

    /**
     * 新增或修改角色
     * @route('/sys/role/save' ,'post')
     */
    public function saveRole()
    {
        $map = \Request::param();
        $valid = $this->validate($map, ['name'=>'require']);
        if ($valid !==true) {
            return $this->error($valid);
        }
        $role = model('Role')->get($map['id'])?:model('Role');
        $role->allowField(true)->save($map);
        return $this->success('角色已设置', 'manager/role/index');
    }
    /**
     * 角色组路由配置
     */
    public function saveRoute()
    {
        $map = \Request::param();
        dump($map);
    }
    /**
     * @route('/sys/role/remove' ,'post')
     */
    public function remove($roleid=0)
    {
        $id = \Request::param('roleid');
        model('Role')->get($id)->delete();
        return $this->success('角色已删除', 'manager/role/index');
    }
}
