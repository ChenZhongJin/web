<?php

namespace app\http\middleware;
use think\Request;
use think\facade\Session;
class Auth
{
    public function handle($request, \Closure $next)
    {
        if($request->module()==='manager') {
            $user = Session::get('user');
            if(empty($user)){
                return redirect('login');
            }    
        }
        return $next($request);
    }
}
