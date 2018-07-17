<?php

namespace app\common\unity;

use Overtrue\Pinyin\Pinyin;
use think\Request;
use think\facade\Route;
use app\common\Valid;
use think\facade\Url;
class Unity
{
    const version = '1.07';
    const devMark = '带刺的牙签';
    /**
     * 汉字转拼音
     *
     * @param string $words
     * @param Request $request
     * @return string
     */
    public function pinyin($words='', Request $request)
    {
        $words = $request->param('words');
        $pinyin = new Pinyin;
        return $pinyin->permalink($words, '');
    }
    /**
     * 图片上传
     *
     * @param Request $request
     * @return void
     */
    public function upimg(Request $request)
    {
        $file = $request->file('file');
        if (!$file) {
            $msg = '上传错误！[error:'
                    .$_FILES['file']['error']
                    .']是否上传文件大于'
                    .ini_get('upload_max_filesize');
            return self::error($msg);
        }
        $info = $file->validate([
            'size'=>2*pow(1024, 2) ,
            'ext'=>'jpg,jpeg,png,bmp'])
            ->move('data');
        if ($info) {
            return json([
                'location'  =>  '/' .str_replace('\\', '/', $info->getPathname()),
                'name'      =>  $file->getInfo('name'),
                'code'    => 1,
                ]);
        } else {
            return self::error($file->getError());
        }
    }

    /**
     * 封装JSON返回
     *
     * @param integer $code 状态码 0:danger 1:success 2:primary 3:info 4:warning 5:dark
     * @param string $msg
     * @param think\URL $url
     * @param array $more
     * @return void
     */
    public static function response($code = 0, $msg = '', $url = null, $more=[])
    {
        if (is_array($url)) {
            // 支持数组
            list($uri,$param) = $url;
            $url = Url::build($uri,$param);
        } else if(is_string($url)) {
            $url = Url::build($url);
        } else {
            // 不解析URL
            $url = null;
        }
        $response = [
            'code'  =>$code,
            'msg'   =>$msg,
            'url'   =>$url,
            'wait'  =>1,
        ];
        return json(array_merge($response, $more));
    }
    public static function success($msg = '', $url = null, $options=[])
    {
        return self::response(1, '完成:'.$msg, $url, $options);
    }
    public static function error($msg = '', $url = null, $options=[])
    {
        !array_key_exists('wait',$options) && $options['wait']=3;
        return self::response(0, '失败:'.$msg, $url, $options);
    }
    /**
     * 数据验证
     *
     * @param array $data 要验证的数据
     * @param string $scene 场景
     * @return void
     */
    public static function valid($data, $scene)
    {
        $v = new Valid;
        $v->scene($scene);
        if (!$v->check($data)) {
            return $v->getError();
        }
        return true;
    }
    /**
     * 去掉HTML的标签
     *
     * @param string $html 即将转换的HTML
     * @param int   $len    要保留的文本长度
     * @return string
     */
    public static function html2text($html='' ,$start=0 ,$end=0):string
    {
        $html = strip_tags($html);
        $html = preg_replace('/[\s]+/is','',$html);
        if($end > 0){
            return substr($html,$start,$len);
        }
        return $html;
    }
}
