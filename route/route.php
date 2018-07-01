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

Route::rule('/console/pinyin/[:words]','\\app\\common\\unity\\Unity@pinyin')->name('unity_getpinyin');
Route::rule('/console/upimg','\\app\\common\\unity\\Unity@upimg','post')->name('_unity_upimg');
Route::rule('/console/upfile','\\app\\common\\unity\\Unity@upfile','post')->name('_unity_upfile');


Route::get('/','home/Home/index')->name('homepage');
Route::get('/article/:id','home/Home/article')->name('article');
Route::get('/product/:id','home/Home/product')->name('product');

return [
    
];
