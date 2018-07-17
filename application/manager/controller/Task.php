<?php

namespace app\manager\controller;

use think\Request;
use app\common\Valid;
use app\common\unity\Unity;
use app\common\model\TaskCollect;
use app\common\model\Task as TaskModel;
use app\common\model\Category;
use Symfony\Component\DomCrawler\Crawler;
use GuzzleHttp\Psr7\Uri as netURI;
class Task extends Base
{

    /**
     * 采集面板
     * @route('/console/task/collect/[:id]','get')->name('_taskCollect')
     */
    public function viewCollect(TaskModel $task, TaskCollect $collect, $id=0)
    {
        $categorys = Category::where('type','=',1)->select();
        $this->assign('categorys',$categorys);
        $list = $collect->all();
        $this->assign('list', $list);
        $data = $collect->get($id);
        $this->assign('data', $data);
        return $this->fetch();
    }
    /**
     * 采集任务 新增
     * @route('/console/task/collect/add','post')->name('_task_collect_add')
     */
    public function collectAdd(Request $request, TaskCollect $collect)
    {
        $data = $request->param();
        $valid = Unity::valid($data, 'TaskCollectAdd');
        if ($valid !==true) {
            return Unity::error($valid);
        }
        $detail->save($data);
        return Unity::success('任务已添加', '_taskCollect');
    }
    /**
     * 采集任务 更新
     * @route('/console/task/collect/update/:id','post')->name('_task_collect_update')
     */
    public function collectUpdate(Request $request, TaskCollect $collect, $id)
    {
        $data = $request->param();
        $valid = Unity::valid($data, 'TaskCollectUpdate');
        if ($valid !==true) {
            return Unity::error($valid);
        }
        $m = $collect->get($id);
        $m->save($data);
        return Unity::success('任务已更新', '_taskCollect');
    }
    /**
     * 采集任务 规则测试
     * @route('/console/task/collect/test','post')->name('_task_collect_test')
     */
    public function collectTest(Request $request)
    {
        $data = $request->param();
        // $valid= Unity::valid($data, 'TaskTest');
        // if ($valid !==true) {
        //     return json($valid);
        // }
        $headers = [
            'User-Agent'=>'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/67.0.3396.99 Safari/537.36',
        ];
        $url = new netURI($data['link']);
        $base_uri = $url->withPath('/')->__toString();
        $client = new \GuzzleHttp\Client([
            'base_uri'=> $base_uri,
            'headers' => $headers,
            'cookies' => true
        ]);
        // 开始捕获内页链接列表
        $body = $client->get($data['link'])->getBody()->getContents();
        $dom  = new \Symfony\Component\DomCrawler\Crawler($body);
        $parse = $br ='<br>';
        $URIs = [];
        $parse.= '捕获的内页链接' .$br;
        $dom->filterXPath($data['xpath_list'])->filter('a')->each(function(Crawler $crawler ,$i)use(&$URIs,&$parse,&$br){
            $link = $crawler->attr('href');
            $URIs[] = $link;
            $parse.= $link .$br;
        });
        // 解析内页
        if(count($URIs)==0){
            return '没有找到有效链接';
        }
        unset($body);
        unset($dom);
        $body = $client->get($URIs[0])->getBody()->getContents();
        $dom  = new \Symfony\Component\DomCrawler\Crawler($body);
        // 处理标题
        try {
            $title = $dom->filterXPath($data['xpath_title'])->text();
            $exp = explode('=>',$data['replace_title']);
        } catch (\Exception $error) {
            return '捕获标题失败！';
        };
        dump($exp);
        // if (strpos($data['replace_title'],'|')!==false) {
        //     list($sec,$rep) = 
        //     $title = str_replace($sec,$rep,$title);
        // }
        // $parse.= '捕获的标题' .$br;
        // $parse.= $title.$br;
        // // 处理正文
        // $css_content = $data['css_content'];
        // $content = $dom->filterXPath($css_content)->text();
        // if (strpos($data['replace_title'],'|') !==false) {
        //     list($sec,$rep) = explode('|',$data['replace_title']);
        //     $content = str_replace($sec,$rep,$content);
        // }
        // $parse.= '捕获的正文' .$br;
        // $parse.= $content;
        // return $parse;
    }
    /**
     * 采集任务 删除
     * @route('/console/task/collect/del/:id','post')->name('_task_collect_del')
     */
    public function collectDel($id, TaskDetail $detail)
    {
        $data = $detail->get($id);
        $data->delete();
        return Unity::success('已删除', '_taskCollect');
    }
    /**
     * @route('/test','get')
     */
    public function testas()
    {
        $br = new \Buzz\Browser();
        $req=$br->request('get', 'http://www.dytt8.net/');
        $body = $req->getBody()->getContents();
        $crawler = new \Symfony\Component\DomCrawler\Crawler($body);
        $crawler->filter('div.co_content8 table')->each(function (Crawler $node, $i) {
            dump($node->text());
        });
        // foreach ($crawler as $domElement) {
        //     dump($domElement->nodeName);
        // }
    }
}
