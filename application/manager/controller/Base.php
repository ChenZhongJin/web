<?php

namespace app\manager\controller;

use think\Controller;
use app\common\unity\Unity;

class Base extends Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->view->share('APP' ,['version'=>Unity::version,'devMark'=>Unity::devMark]);
    }
}
