<?php /*a:4:{s:55:"C:\site\cms\application\manager\view\console\index.html";i:1529305689;s:48:"C:\site\cms\application\manager\view\layout.html";i:1529787075;s:45:"C:\site\cms\application\manager\view\nav.html";i:1529738175;s:48:"C:\site\cms\application\manager\view\footer.html";i:1529279786;}*/ ?>
<!doctype html>
<html lang="zh_CN">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="stylesheet" type="text/css" href="/node_modules/bootstrap/dist/css/bootstrap.min.css" />
    <link rel="stylesheet" type="text/css" href="/static/css/common.css" />
    <title><?php echo htmlentities((isset($page['title']) && ($page['title'] !== '')?$page['title']:"")); ?></title>
    <meta name="keywords" content="<?php echo htmlentities((isset($page['keywords']) && ($page['keywords'] !== '')?$page['keywords']:'')); ?>">
    <meta name="description" content="<?php echo htmlentities((isset($page['description']) && ($page['description'] !== '')?$page['description']:'')); ?>">
</head>
<body>
<nav class="navbar navbar-expand navbar-light bg-light">
    <div class="nav navbar-nav mr-auto">
        <a class="nav-item nav-link active" href="<?php echo url('console_panel'); ?>">概览</a>
        <a class="nav-item nav-link" href="<?php echo url('_article'); ?>">文章</a>
        <a class="nav-item nav-link" href="<?php echo url('_productListImg'); ?>">产品</a>
        <a class="nav-item nav-link" href="<?php echo url('_category'); ?>">栏目</a>
        <a class="nav-item nav-link" href="<?php echo url('console_website'); ?>">站点</a>
    </div>
    <div class="nav navbar-nav">
        <a class="nav-item nav-link" href="<?php echo url('logout'); ?>" id="logout"><?php echo htmlentities(app('session')->get('user.name')); ?></a>
    </div>
</nav>

<div class="container">
    <div class="row">
        <div class="col-sm">
            <div class="card">
                <div class="card-header">
                    <p class="card-title mb-0">WEB配置信息</p>
                </div>
                <div class="card-body">
                    <p class="card-text">服务系统：<code><?php echo htmlentities(PHP_OS); ?></code></p>
                    <p class="card-text">WEB代理：<code><?php echo htmlentities($_SERVER['SERVER_SOFTWARE']); ?></code></p>
                    <p class="card-text">上传文件限制：<code><?php echo get_cfg_var("upload_max_filesize"); ?></code></p>
                    <p class="card-text">脚本运行时间：<code><?php echo get_cfg_var("max_execution_time"); ?>s</code></p>
                    <p class="card-text">脚本运行内存：<code><?php echo get_cfg_var("memory_limit"); ?></code></p>
                    <p class="card-text">中国时间：<code><?php date_default_timezone_set('PRC'); echo date('Y/m/d G:i:s') ?></code></p>
                    <p class="card-text">开放模块：<code><?php echo join(' ',get_loaded_extensions()); ?></code></p>
                </div>
            </div>
        </div>
        <div class="col-sm">
            <div class="card">
                <div class="card-body">
                    <h4 class="card-title">Title</h4>
                    <p class="card-text">Text</p>
                </div>
                <ul class="list-group list-group-flush">
                    <li class="list-group-item">Item 1</li>
                    <li class="list-group-item">Item 2</li>
                    <li class="list-group-item">Item 3</li>
                </ul>
            </div>
        </div>
        <div class="col-sm">
            <div class="card">
                <div class="card-body">
                    <h4 class="card-title">Title</h4>
                    <p class="card-text">Text</p>
                </div>
                <ul class="list-group list-group-flush">
                    <li class="list-group-item">Item 1</li>
                    <li class="list-group-item">Item 2</li>
                    <li class="list-group-item">Item 3</li>
                </ul>
            </div>
        </div>
    </div>
</div>

<script type="text/javascript" src="/node_modules/jquery/dist/jquery.min.js"></script>
<script type="text/javascript" src="/node_modules/bootstrap/dist/js/bootstrap.bundle.min.js"></script>
<script type="text/javascript" src="/static/js/bundle.js"></script>



<script>
document.querySelector('a#logout').addEventListener('click' ,function(event){event.preventDefault();ajax(event.target.href)})
</script>

</body>
</html>