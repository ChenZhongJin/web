<?php

namespace app\home\controller;

use think\Controller;
use think\Request;
use app\common\model\User as UserModel;
use think\facade\Session;
use app\common\unity\Unity;

class Login extends Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->assign('APP', ['version'=>Unity::version,'devMark'=>Unity::devMark]);
    }
    /**
     * 用户登录页面
     *
     * @route('/login' ,'get')->name('login_panel')
     */
    public function index()
    {
        $hasLogin = $this->app->session->get('user');
        if ($hasLogin) {
            return $this->display('<script>window.location.href="/console"</script>');
        }
        return $this->fetch();
    }

    /**
     * 用户登陆
     *
     * @route('/login' ,'post')->name('login')
     */
    public function logIn(Request $request, UserModel $user)
    {
        $data = $request->param();
        $valid= Unity::valid($data, 'UserLogin');
        if ($valid !== true) {
            return Unity::error($valid);
        }
        $condition['password'] = $user->crypto($data['name'], $data['password']);
        $condition['name']     = $data['name'];
        $u = $user->where($condition)->find();
        if (empty($u)) {
            return Unity::error('用户信息错误');
        }
        Session::set('user', $u->toArray());
        return Unity::success('正在登录','_console');
    }

    /**
     * 用户注销
     * @param Request $request
     * @param User $user
     *
     * @route('/logout','post')->name('logout')
     */
    public function logOut(Request $request)
    {
        Session::delete('user');
        return Unity::success('已注销', 'homepage');
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
