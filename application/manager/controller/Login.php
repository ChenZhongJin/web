<?php
namespace app\manager\controller;

use \think\Controller;

/**
 *
 */
class Login extends Controller
{
    /**
     * 用户登录
     * @route('/login' ,'get')
     */
    public function index()
    {
        return $this->fetch();
    }

    /**
     * 用户注册
     * @route('/login/register' ,'get')
     */
    public function viewRegister()
    {
        return $this->fetch();
    }
    /**
     * 用户注销
     * @route('/login/out' ,'post')
     */
    public function logout()
    {
        \Session::set('user', null);
        return $this->success('已注销', 'home/index/index');
    }
    /**
     * 登录
     * @route('/login/in' ,'post')
     */
    public function login()
    {
        $map = \Request::only(['name' ,'password']);
        $user = model('User');
        $map['password'] =$user->crypto($map['name'], $map['password']);
        $data = $user->where($map)->find();
        if (empty($data)) {
            return $this->error('用户名与密码不匹配');
        }
        \Session::set('user', $data);
        return $this->success('登录成功', 'manager/console/index');
    }
    /**
     * 注册
     * @route('/login/register' ,'post')
     */
    public function register()
    {
        $map = \Request::only(['name' ,'cname' ,'password' ,'repassword']);
        $valid = $this->validate($map, 'User.register');
        if ($valid !==true) {
            return $this->error($valid);
        }
        $result = model('User')->allowField(true)->save($map);
        if (empty($result)) {
            return $this->error('新增失败');
        }
        return $this->success('注册成功', 'manager/console/index');
    }
}
