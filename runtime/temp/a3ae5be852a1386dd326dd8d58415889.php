<?php /*a:4:{s:58:"C:\site\cms\application\manager\view\product\list_img.html";i:1529739550;s:48:"C:\site\cms\application\manager\view\layout.html";i:1529787075;s:45:"C:\site\cms\application\manager\view\nav.html";i:1529738175;s:48:"C:\site\cms\application\manager\view\footer.html";i:1529279786;}*/ ?>
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
        <div class="col-12 py-2">
            <a href="<?php echo url('_productEdit'); ?>" class="btn btn-sm btn-dark rounded-0">添加产品</a>
        </div>
        <?php foreach($list as $item): ?>
        <div class="col-4">
            <div class="card rounded-0">
              <img class="card-img-top" src="">
              <div class="card-body">
                <h4 class="card-title">Title</h4>
                <p class="card-text">Text</p>
                <a href="<?php echo url('_productEdit',['id'=>$item['id']]); ?>" class="btn btn-sm btn-outline-secondary rounded-0">修改</a>
                <a href="" class="btn btn-sm btn-danger rounded-0">删除</a>
              </div>
            </div>
        </div>
        <?php endforeach; ?>
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