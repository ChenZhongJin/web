<?php
/**
 * 网站导航配置
 *
 * /                        首页
 * /article/12.html         访问文章
 * /product/21.html         访问产品
 *
 * /guonei/2.html           访问guonei文章栏目第2页
 * /guonei/ningxia/3.html   访问guonei栏目的ningxia子栏目的第3页
 * /xitong/3.html           访问xitong系列产品的第3页
 * /xitong/up/11.html       访问xitong系列产品的up子系列的第11页
 *
 *
 *
 *
 */
namespace app\home\controller;

use think\Controller;

use think\Request;
use app\common\model\Category as CategoryModel;
use app\common\model\Article as ArticleModel;
use app\common\model\Product as ProductModel;
use app\common\model\Site as SiteModel;
use think\facade\Config;
class Home extends Controller
{
    /**
     * 前端主题文件路径
     */
    private     $themePath;
    public function __construct(\think\App $app = null)
    {
        parent::__construct();
        $theme = Config::get('theme.theme');
        $this->themePath = \App::getRootPath() .'template'.DIRECTORY_SEPARATOR.$theme.DIRECTORY_SEPARATOR;
        // 定义视图目录
        $this->view->config('view_path',$this->themePath);
        $site    = new SiteModel();
        $siteMap = $site->map();
        // 全局
        $this->assign('site',$siteMap);
    }
    /**
     * 首页
     *
     */
    public function index()
    {
        return $this->fetch();
    }
    /**
     * 文章
     *
     */
    public function article()
    {
        return $this->fetch();
    }
    /**
     * 产品
     */
    public function product()
    {
        return $this->fetch();
    }
    /**
     * 栏目页
     *
     * @param Request $request
     * @param integer $page
     * @return void
     */
    public function senseRoute(Request $request, $page=0)
    {
        $path = $request->path();
        $pos  = strpos($path, '/');
        $pos && $path=substr($path,0,$pos);
        $cats = new CategoryModel();
        $data = $cats->getByPath($path);
        
        return $this->fetch();
    }
}
