<?php

namespace app\manager\controller;

use think\Controller;
use think\facade\Url;

class Base extends Controller
{

    /**
     * json返回
     *
     * @param integer $code 状态码 0:danger 1:success 2:info 3:paimary 4:warning 5:dark
     * @param string $msg
     * @param think\URL $url
     * @param array $more
     * @return void
     */
    public static function info($code = 0, $msg = '', $url = null, $more=[])
    {
        $response = [
            'code'  =>$code,
            'msg'   =>$msg,
            'url'   =>empty($url)?null:Url::build($url),
            'wait'  =>3,
        ];
        return json(array_merge($response,$more));
    }
}
