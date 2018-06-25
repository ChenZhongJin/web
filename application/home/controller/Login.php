<?php

namespace app\home\controller;

use think\Controller;
use think\Request;
use app\common\model\User;
use think\facade\Session;

class Login extends Controller
{
    /**
     * 用户登录页面
     *
     * @route('/login' ,'get')->name('login_panel')
     */
    public function index()
    {
        return $this->fetch();
    }

    /**
     * 用户登陆
     *
     * @route('/login' ,'post')->name('login')
     */
    public function logIn(Request $request,User $user)
    {
        $data = $request->only(['name' ,'password' ,'code']);
        $valid= $this->validate($data ,'\app\common\validate\User.login');
        if ($valid !== true) {
            return $this->error($valid,null);
        }
        $condition['password'] = $user->crypto($data['name'], $data['password']);
        $condition['name']     = $data['name'];
        $u = $user->where($condition)->find();
        if (empty($u)) {
            return $this->error('用户信息错误');
        }
        
        Session::set('user', $u->toArray());
        return $this->success('正在登录', 'console_panel');
    }

    /**
     * 用户注销
     * @param Request $request
     * @param User $user
     *
     * @route('/login/out')->name('logout')
     */
    public function logOut(Request $request, User $user)
    {
        Session::delete('user');
        return $this->success('已注销', 'homepage');
    }

    /**
     * 验证码
     *
     * @route('/login/code' ,'get')->name('login_code')
     */
    public function loginCode()
    {
        $option = [
            'fontSize' => 14,
            'useNoise' => false,
            'useCurve' => false,
            'length'   => 4,
            'fontttf'  => '4.ttf',
        ];
        $captcha = new \think\captcha\Captcha($option);
        return $captcha->entry();
    }
    
}
