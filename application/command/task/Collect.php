<?php

namespace app\command\task;

use think\console\Command;
use think\console\Input;
use think\console\input\Argument;
use think\console\input\Option;
use think\console\Output;
use app\common\model\TaskCollect;
use app\common\model\Article;
use think\Log;
use Symfony\Component\DomCrawler\Crawler;
use GuzzleHttp\Client;
use GuzzleHttp\Psr7\Uri as netURI;
use Symfony\Component\Filesystem\Filesystem;
// >php think task:collect
class Collect extends Command
{
    private $headers = [
        'User-Agent'=>'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/67.0.3396.99 Safari/537.36',
    ];
    protected function configure()
    {
        $this->setName('task:collect')
            // 第一个参数
            // ->addArgument('name', Argument::OPTIONAL, '')
            // 指令
            // ->addOption('city', null, Option::VALUE_REQUIRED, 'city name')
            // 命令行描述
        	->setDescription('采集任务');
    }
    protected function execute(Input $input, Output $output )
    {
        $collects = TaskCollect::all();
        
        foreach ($collects as $collect) {
            $ins = $this->player($collect);
        }
        $output->writeln($ins);
    }
    protected function player(TaskCollect $collect)
    {
        // 初始化客户端
        $url = new netURI($collect->link);
        $base_uri = $url->withPath('/')->__toString();
        $client = new Client([
            'base_uri'=> $base_uri,
            'headers' => $this->headers,
            'cookies' => true
        ]);
        // 开始捕获内页链接列表
        $body = $client->get($collect->link)->getBody()->getContents();
        $dom  = new Crawler($body);
        $URIs = [];
        $dom->filterXPath($collect->xpath_list)->filter('a')->each(function(Crawler $crawler ,$i)use(&$URIs){
            $URIs[] = $crawler->attr('href');
        });
        unset($body);
        unset($dom);
        // 开始遍历
        foreach($URIs as $k => $link) {
            if($k >=5 ) {
                // 仅捕获前5条
                break;
            }
            $hasArtilce = Article::where('origin','=',$link)->find();
            if($hasArtilce) {
                // 仅捕获新数据
                break;
            }
            // 解析内页
            $articleData['origin'] = $link;
            $body = $client->get($link)->getBody()->getContents();
            $dom  = new Crawler($body);
            // 捕获标题
            $title = $dom->filterXPath($collect->xpath_title)->text();
            $articleData['title'] = $this->replace($collect->replace_title,$title);
            
            // 捕获内容
            $content = '';
            // 主区块
            if(!empty($collect->xpath_major)) {
                $major = $dom->filterXPath($collect->xpath_major)->html();
                if(!empty($collect->replace_major)) {
                    $major = preg_replace('@<('.$collect->replace_major.')[^>]*>.*</\1>@','',$major);
                }
                $content .= $major;
            }
            // 次区块
            if(!empty($collect->xpath_minor)) {
                $minor = $dom->filterXPath($collect->xpath_minor)->html();
                if(!empty($collect->replace_minor)){
                    $minor = preg_replace('@<('.$collect->replace_major.')[^>]*>.*</\1>@','',$minor);
                }
                $content.= $minor;
            }
            // 下载远程图片
            $content = $this->downImage($client,$content);
            $articleData['content'] = $content;
            // 保存文章
            $articleData['category_id'] = $collect->category_id;
            $articleData['user_id'] = 1;
            $atc = new Article();
            $atc->save($articleData);
        }
        return '完成任务';
    }
    /**
     * 格式化规则字符串
     * @param string $replaceString
     */
    private function formatInput($replaceString)
    {
        preg_match_all('@\[(.*?)\|(.*?)\]@',$replaceString,$matchs);
        if(count($matchs[1])>=1){ 
            return [ $matchs[1],$matchs[2] ];
        } else {
            return false;
        }
    }
    /**
     * 替换内容
     * @param string $rule 替换规则
     * @param string $data   内容
     */
    private function replace($rule ,$data)
    {
        $reps = $this->formatInput($rule);
        if($reps){
            foreach ($reps[0] as $key => $rep) {
                $data = str_replace($rep,$reps[1][$key],$data);
            }
        }
        return $data;
    }
    /**
     * 下载远程图片
     * @param \GuzzleHttp\Client $client
     * @param string $content
     * @return string $content
     */
    private function downImage(Client $client ,$content)
    {
        @preg_match_all('/<(img|image).*?src=\"(.*?)\"[^>]*>/',$content,$imgs);
        if(count($imgs[2]) > 0){
            foreach ($imgs[2] as $src) {
                // 获取文件后缀
                preg_match('@\.\w+$@',$src,$exts);
                $ext = $exts[0];
                // 配置文件名称
                $name= md5(time());
                $file= $name.$ext;
                // 访问图片
                $data = $client->get($src)->getBody()->getContents();
                $localPath = \App::getRootPath().'/public/data/remote/'.$file;
                $publicPath= '/data/remote/'.$file;
                // 保存图片到本地
                $fs = new Filesystem();
                $fs->dumpFile($localPath,$data);
                // 替换图片链接
                $content = str_replace($src,$publicPath,$content);
            }
        }
        return $content;
    }
}