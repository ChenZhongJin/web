<?php

namespace app\common\unity;

use Overtrue\Pinyin\Pinyin;
use think\Request;
use think\facade\Route;

class Unity
{
    public function pinyin($words='', Request $request)
    {
        $words = $request->param('words');
        $pinyin = new Pinyin;
        return $pinyin->permalink($words, '');
    }
    /**
     * 文件上传
     *
     * @param Request $request
     * @return void
     */
    public function upimg(Request $request)
    {
        $file = $request->file('file');
        if (!$file) {
            return json('上传错误！[error:'.$_FILES['file']['error'].']是否上传文件大于'
            .ini_get('upload_max_filesize'));
        }
        $info = $file->validate([
            'size'=>2*pow(1024, 2) ,
            'ext'=>'jpg,jpeg,png,bmp'
            ])->move('data');
        if ($info) {
            return json([
                'location'  =>  '/' .str_replace('\\','/',$info->getPathname()),
                'name'      =>  $file->getFilename(),
                'code'    => 1,
                ]);
        } else {
            return json($file->getError());
        }
    }
}
