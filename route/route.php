<?php
// +----------------------------------------------------------------------
// | ThinkPHP [ WE CAN DO IT JUST THINK ]
// +----------------------------------------------------------------------
// | Copyright (c) 2006~2018 http://thinkphp.cn All rights reserved.
// +----------------------------------------------------------------------
// | Licensed ( http://www.apache.org/licenses/LICENSE-2.0 )
// +----------------------------------------------------------------------
// | Author: liu21st <liu21st@gmail.com>
// +----------------------------------------------------------------------

Route::get('think', function () {
    return 'hello,ThinkPHP5!';
});

Route::get('hello/:name', 'index/hello');

Route::rule(
    '/unity/pinyin/[:words]',
    '\\app\\common\\unity\\Unity@pinyin'
)->name('unity_getpinyin');
Route::rule(
    '/console/upimg',
    '\\app\\common\\unity\\Unity@upimg',
    'post'
)->name('_unity_upimg');
Route::rule(
    '/console/upfile',
    '\\app\\common\\unity\\Unity@upfile',
    'post'
)->name('_unity_upfile');



return [

];
