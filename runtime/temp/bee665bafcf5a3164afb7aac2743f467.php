<?php /*a:4:{s:54:"C:\site\cms\application\manager\view\article\list.html";i:1529648969;s:48:"C:\site\cms\application\manager\view\layout.html";i:1529787075;s:45:"C:\site\cms\application\manager\view\nav.html";i:1529738175;s:48:"C:\site\cms\application\manager\view\footer.html";i:1529279786;}*/ ?>
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
        <div class="w-100">
            <a href="<?php echo url('_articleEdit'); ?>" class="btn btn-dark rounded-0 float-right">新增</a>
        </div>
        <div class="w-100">
            <table class="table">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>标题</th>
                        <th>所属分类</th>
                        <th>作者</th>
                        <th>发布</th>
                        <th>创建时间</th>
                        <th></th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach($list as $item): ?>
                    <tr>
                        <td><?php echo htmlentities($item['id']); ?></td>
                        <td><?php echo htmlentities($item['title']); ?></td>
                        <td><?php echo htmlentities($item->category->cname); ?></td>
                        <td><?php echo htmlentities($item->user->name); ?></td>
                        <td><?php echo htmlentities($item['publish']); ?></td>
                        <td><?php echo htmlentities(date("Y/m/d",!is_numeric($item['create_time'])? strtotime($item['create_time']) : $item['create_time'])); ?></td>
                        <td>
                            <a href="<?php echo url('_articleEdit',['id'=>$item['id']]); ?>" class="btn btn-sm btn-outline-secondary">编辑</a>
                            <a href="<?php echo url('_article_delete',['id'=>$item['id']]); ?>" class="btn btn-sm btn-danger">删除</a>
                        </td>
                    </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    </div>
</div>

<script type="text/javascript" src="/node_modules/jquery/dist/jquery.min.js"></script>
<script type="text/javascript" src="/node_modules/bootstrap/dist/js/bootstrap.bundle.min.js"></script>
<script type="text/javascript" src="/static/js/bundle.js"></script>


<script>

</script> 

<script>
document.querySelector('a#logout').addEventListener('click' ,function(event){event.preventDefault();ajax(event.target.href)})
</script>

</body>
</html>