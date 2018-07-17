<?php

namespace app\command\task;

use think\console\Command;
use think\console\Input;
use think\console\input\Argument;
use think\console\input\Option;
use think\console\Output;
use app\common\model\TaskDetail;
use app\common\model\Article;
use GuzzleHttp\Client;
use think\Log;
use Symfony\Component\DomCrawler\Crawler;
// >php think task:collect
class Collect extends Command
{
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
        $detail = TaskDetail::where('type','=','collect')->select();
        
        foreach ($detail as $item) {
            $eu = $this->player($item->uri,$item->css);
        }
        $output->writeln($eu);
    }
    protected function player($uri,$css)
    {
        // 初始化客户端
        preg_match('/https?:\/\/.*?\//',$uri,$match);
        $base_uri = $match[0];
        $client = new \GuzzleHttp\Client([
            'base_uri'=> $base_uri,
            'cookies' => true,
            'headers' => [
                'User-Agent' => 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/67.0.3396.99 Safari/537.36',
            ],
        ]);
        $response = $client->get($uri);
        if($response->getStatusCode()!=200) {
            \Log::write('采集任务失败！URI:'.$uri.'StatusCode:'.$response->getStatusCode(),'notice');
        }
        // 解析列表页链接
        $body = $response->getBody()->getContents();
        $dom = new \Symfony\Component\DomCrawler\Crawler($body);
        preg_match_all('/(.*?)(?: |:(\d+?))/', $css, $matches);
        foreach ($matches[1] as $i => $match) {
            if (!empty($match)) {
                $eq = $matches[2][$i]?:0;
                $dom = $dom->filter($match)->eq($eq);
            }
        }
        // 获取即将采集的URIs列表
        $URIs = [];
        $dom->filter('a')->each(function(Crawler $el ,$i) use (&$URIs){
            if($i < 5){
                $href = $el->attr('href');
                $atc = Article::where('origin','=',$href)->find();
                if (empty($atc)) {
                    $URIs[] = $href;
                }
            }
        });
        unset($uri);
        unset($body);
        unset($dom);
        // 采集内页
        foreach ($URIs as $uri) {
            $body = $client->get($uri)->getBody()->getContents();
            $dom = new \Symfony\Component\DomCrawler\Crawler($body);
            $title = $dom->filter('title')->text();
            $content = $dom->filter($content)->text();
        }
        // return ;
    }
}