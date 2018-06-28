<?php /*a:4:{s:58:"C:\site\cms\application\manager\view\product\list_img.html";i:1530024439;s:48:"C:\site\cms\application\manager\view\layout.html";i:1530034941;s:45:"C:\site\cms\application\manager\view\nav.html";i:1530105506;s:48:"C:\site\cms\application\manager\view\footer.html";i:1530035442;}*/ ?>
<!doctype html>
<html lang="zh_CN">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no"> <link rel="stylesheet" type="text/css" href="/node_modules/bootstrap/dist/css/bootstrap.min.css" /> <link rel="stylesheet" type="text/css" href="/static/css/common.css" />
    <title><?php echo htmlentities((isset($page['title']) && ($page['title'] !== '')?$page['title']:"")); ?></title>
    <meta name="keywords" content="<?php echo htmlentities((isset($page['keywords']) && ($page['keywords'] !== '')?$page['keywords']:'')); ?>">
    <meta name="description" content="<?php echo htmlentities((isset($page['description']) && ($page['description'] !== '')?$page['description']:'')); ?>">
</head>

<body>
    <nav class="navbar navbar-expand navbar-light bg-light">
    <div class="nav navbar-nav mr-auto">
        <a class="nav-item nav-link" href="<?php echo url('_console'); ?>">站点</a>
        <a class="nav-item nav-link" href="<?php echo url('_article'); ?>">文章</a>
        <a class="nav-item nav-link" href="<?php echo url('_productListImg'); ?>">产品</a>
        <a class="nav-item nav-link" href="<?php echo url('_category'); ?>">栏目</a>
        <a class="nav-item nav-link active" href="<?php echo url('_theme'); ?>">主题</a>
    </div>
    <div class="nav navbar-nav">
        <a class="nav-item nav-link" href="<?php echo url('logout'); ?>" id="logout"><?php echo htmlentities(app('session')->get('user.name')); ?></a>
    </div>
</nav> 
<div class="container">
    <div class="row">
        <div class="col-12 py-2">
            <a href="<?php echo url('_productEdit'); ?>" class="btn btn-sm btn-dark rounded-0">添加产品</a>
        </div>
        <div class="col-12">
            <div class="card-columns">
                <?php foreach($list as $item): ?>
                <div class="card">
                    <img class="card-img-top rounded-0" src="<?php if(count($item['preview'])>0): ?><?php echo htmlentities($item['preview'][0]['src']); endif; ?>">
                    <div class="card-body">
                        <p><?php echo htmlentities($item['name']); ?> - <?php echo htmlentities($item['model']); ?></p>
                        <p class="text-muted text-small"><?php echo htmlentities($item->category->cname); ?></p>
                        <a href="<?php echo url('_productEdit',['id'=>$item['id']]); ?>" class="btn btn-sm btn-dark rounded-0">修改</a>
                        <a href="<?php echo url('_product_delete',['id'=>$item['id']]); ?>" class="btn btn-sm btn-outline-danger rounded-0" id="delete">删除</a>
                    </div>
                </div>
                <?php endforeach; ?>
            </div>
            <?php echo $page; ?>
        </div>
    </div>
</div>

 <script type="text/javascript" src="/node_modules/jquery/dist/jquery.min.js"></script> <script type="text/javascript" src="/node_modules/bootstrap/dist/js/bootstrap.bundle.min.js"></script>
    <script type="text/javascript" src="/static/js/bundle.js"></script> <footer class="w-100 mt-3">
    <div class="text-center">
        <p class="text-muted text-small">古都企业网站系统 version:<?php echo htmlentities($APP['version']); ?> .Develop Mark:<?php echo htmlentities($APP['devMark']); ?></p>
        <p class="text-muted text-small"><a href="https://github.com/ChenZhongJin/web" class="text-muted">GitHub 分支dev_s</a></p>
    </div>
</footer> 
<script>
    (function () {
        document.querySelectorAll('a#delete').forEach(function (element) {
            element.addEventListener('click', function (event) {
                event.preventDefault();
                ajax(event.target.href);
            })
        })
    })()
</script>  
    <script>
        (function () {
            document.querySelector('a#logout').addEventListener('click', function (event) { event.preventDefault(); ajax(event.target.href) })
        })()
    </script> 
</body>

</html>