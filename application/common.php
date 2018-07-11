<?php
// +----------------------------------------------------------------------
// | ThinkPHP [ WE CAN DO IT JUST THINK ]
// +----------------------------------------------------------------------
// | Copyright (c) 2006-2016 http://thinkphp.cn All rights reserved.
// +----------------------------------------------------------------------
// | Licensed ( http://www.apache.org/licenses/LICENSE-2.0 )
// +----------------------------------------------------------------------
// | Author: 流年 <liu21st@gmail.com>
// +----------------------------------------------------------------------
use Symfony\Component\Filesystem\Filesystem;
// 应用公共文件
function visit($uri,$method='get',$option=[])
{
    $method = strtoupper($method);
    $jar = new \GuzzleHttp\Cookie\CookieJar();
    $req = new \GuzzleHttp\Client();
    $defOption = [
        'headers' => [
            'User-Agent' => 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/67.0.3396.99 Safari/537.36',
            'Accept'=>'text/html,application/xhtml+xml,application/xml;q=0.9,image/webp,image/apng,*/*;q=0.8',
            'Accept-Encoding'=>'gzip, deflate',
            'Accept-Language'=>'zh-CN,zh;q=0.9',
        ],
        'cookies' => $jar,
    ];
    $option = array_merge($defOption,$option);
    $res = $req->request($method,$uri,$option);
    if ($res->getStatusCode()==200) {
        return $res->getBody()->getContents();
    }
    return false;
}
function visit_remote_img($uri)
{
    $body = visit($uri);
    if($body){
        $ext = substr($uri,strpos($uri,'.',-4));
        $dir = app()->getRootPath();
        $dir.= 'public/data/remote/';
        if(!is_dir($dir)){
            mkdir($dir);
        }
        $file = md5(time()).rand(0,999);
        $file.=$ext;
        $fs = new Filesystem();
        $fs->dumpFile($dir.$file,$body);
        return $dir.$file;
    }
    return false;
}