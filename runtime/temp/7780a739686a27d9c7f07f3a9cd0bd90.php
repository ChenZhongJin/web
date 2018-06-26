<?php /*a:4:{s:56:"C:\site\cms\application\manager\view\category\index.html";i:1530035202;s:48:"C:\site\cms\application\manager\view\layout.html";i:1530034941;s:45:"C:\site\cms\application\manager\view\nav.html";i:1529738175;s:48:"C:\site\cms\application\manager\view\footer.html";i:1530033920;}*/ ?>
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
            <a href="<?php echo url('_categoryEdit',['parent'=>$parent['id'],'id'=>0]); ?>" class="btn btn-sm btn-dark rounded-0">新增栏目</a>
            <?php if($parent['id']): ?>
            <a href="<?php echo url('_category',['parent'=>$parent['parent']]); ?>" class="btn btn-sm btn-dark rounded-0"><?php echo htmlentities($parent['cname']); ?></a>
            <?php endif; ?>
        </div>
        <div class="col-12">
            <table class="table">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>分类</th>
                        <th>模块</th>
                        <th>路径</th>
                        <th></th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach($list as $item): ?>
                    <tr>
                        <td><?php echo htmlentities($item['id']); ?></td>
                        <td>
                            <a href="<?php echo url('_category',['parent'=>$item['id']]); ?>"><?php echo htmlentities($item['cname']); ?></a>
                        </td>
                        <td><?php echo htmlentities($item['type_name']); ?></td>
                        <td><?php echo htmlentities($item['path']); ?></td>
                        <td>
                            <a href="<?php echo url('_categoryEdit',['id'=>$item['id'],'parent'=>$parent['id']]); ?>" class="btn btn-sm btn-dark rounded-0">修改</a>
                            <a href="<?php echo url('_category_delete',['id'=>$item['id']]); ?>" class="btn btn-sm btn-outline-danger rounded-0" id="delete">删除</a>
                        </td>
                    </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    </div>
</div> <script type="text/javascript" src="/node_modules/jquery/dist/jquery.min.js"></script> <script type="text/javascript" src="/node_modules/bootstrap/dist/js/bootstrap.bundle.min.js"></script>
    <script type="text/javascript" src="/static/js/bundle.js"></script> <footer class="w-100 mt-3">
    <div class="text-center">
        <p class="text-muted text-small">古都企业网站系统 version:<?php echo htmlentities($APP['version']); ?> .Develop Mark:<?php echo htmlentities($APP['devMark']); ?></p>
    </div>
</footer> 
<script>
document.querySelectorAll('a#delete').forEach(function(i){
    i.addEventListener('click',function(event){
    event.preventDefault();
    ajax(event.target.href);
})
})
</script>  
    <script>
        (function () {
            document.querySelector('a#logout').addEventListener('click', function (event) { event.preventDefault(); ajax(event.target.href) })
        })()
    </script> 
</body>

</html>