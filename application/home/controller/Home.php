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
use app\common\unity\Unity;
use app\common\unity\Theme;
class Home extends Controller
{
    public function __construct()
    {
        parent::__construct();
        // 配置主题
        $theme = new Theme();
        $themeName = $theme->get('theme');
        $themePath = $theme->getThemePath($themeName);
        $this->view->config('view_path',$themePath);
        // 全局变量 模板内引用
        // 站点信息
        $site    = new SiteModel();
        $siteMap = $site->map();
        $this->view->share('site',$siteMap);
        // 栏目
        $categorys= new CategoryModel();
        $this->view->share('categorys',$categorys);
        // 文章
        $articles = new ArticleModel();
        $this->view->share('articles',$articles);
        // 产品
        $products = new ProductModel();
        $this->view->share('products',$products);
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
     * @route('/article/:id','get')->name('article')
     */
    public function article(ArticleModel $article,$id)
    {
        $data = $article->get($id);
        $this->assign('data',$data);
        return $this->fetch($data->category->type_view);
    }
    /**
     * 产品
     * @route('/product/:id','get')->name('product')
     */
    public function product(ProductModel $product,$id)
    {
        $data = $product->get($id);
        $this->assign('data',$data);
        return $this->fetch($data->category->type_view);
    }
    /**
     * 栏目页
     *
     * @param Request $request
     * @param integer $page
     * @return void
     */
    public function senseRoute(Request $request,CategoryModel $categorys, $page=0)
    {
        // 分页处理
        // category.type [1 = article,2=product]; 
        // 捕获分类路径
        preg_match('@(\w+)/?@',$request->path(),$path);
        $category = $categorys->getByPath($path[1]);
        $pageRows = 10;
        $pageOption = [
            'list_rows' => $pageRows,
            'path'      => '/'.$path[1].'/[PAGE].html'
        ];
        if($category->type==1) {
            $page = $category->article()->order('id','desc')->paginate($pageRows,false,$pageOption);
        } else if($category->type==2){
            $page = $category->product()->order('id','desc')->paginate($pageRows,false,$pageOption);
        }
        // 替换分页CSS样式
        $links = $page->render();
        $links = preg_replace('@<li class="(.*?)">@','<li class="page-item \1">',$links);
        $links = preg_replace('@<li>@','<li class="page-item">',$links);
        $links = preg_replace('@<a(.*?)>@','<a class="page-link"\1>',$links);
        $links = preg_replace('@<span>(.*?)</span>@','<a href="\1.html" class="page-link">\1</a>',$links);
        $links = preg_replace('@<ul.*?>@','<ul class="pagination pagination-sm justify-content-center">',$links);
        $this->assign('page',$page);
        $this->assign('paginate',$links);
        $data = $category;
        $this->assign('data',$data);
        return $this->fetch($category->view);
    }
    
}
