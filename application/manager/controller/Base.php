<?php

namespace app\manager\controller;

use think\Controller;
use app\common\unity\Unity;
use think\facade\Session;

class Base extends Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->view->share('APP' ,['version'=>Unity::version,'devMark'=>Unity::devMark]);
    }
    /**
     * 权限验证
     * @return bool
     */
    public function checkAuth()
    {
        $user = Session::get('user');
        return empty($user)?false:true;
    }
}
