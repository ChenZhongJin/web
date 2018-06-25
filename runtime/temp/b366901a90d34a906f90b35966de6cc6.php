<?php /*a:4:{s:59:"C:\site\cms\application\manager\view\article\add_panel.html";i:1529504984;s:48:"C:\site\cms\application\manager\view\layout.html";i:1529301932;s:45:"C:\site\cms\application\manager\view\nav.html";i:1529503887;s:48:"C:\site\cms\application\manager\view\footer.html";i:1529279786;}*/ ?>
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
        <a class="nav-item nav-link" href="<?php echo url('protoduct_panel'); ?>">产品</a>
        <a class="nav-item nav-link" href="<?php echo url('_category'); ?>">类别</a>
        <a class="nav-item nav-link" href="<?php echo url('console_website'); ?>">站点</a>
    </div>
    <div class="nav navbar-nav">
        <a class="nav-item nav-link" href="<?php echo url('logout'); ?>" id="logout"><?php echo htmlentities(app('session')->get('user.name')); ?></a>
    </div>
</nav>

<div class="container">
    <div class="row">
        <div class="w-100">
            <form action="" id="article">
                <div class="form-group">
                    <label for="title">文章标题</label>
                    <input type="text" class="form-control" value="<?php echo htmlentities($data['title']); ?>">
                </div>
                <div class="form-group">
                    <label for="keywords">页面关键词</label>
                    <input type="text" class="form-control" value="<?php echo htmlentities($data['keywords']); ?>">
                </div>
                <div class="form-group">
                    <label for="description">页面描述</label>
                    <input type="text" class="form-control" value="<?php echo htmlentities($data['description']); ?>">
                </div>
                <div class="form-group">
                    <label for="title">文章内容</label>
                    <input type="text" class="form-control" value="<?php echo htmlentities($data['content']); ?>">
                </div>
                
                <div class="form-group">
                    <?php if($data['id']): ?>
                    <a href="<?php echo url('_article_update'); ?>" class="btn btn-sm btn-outline-dark rounded-0" id="send">更新</a>
                    <?php else: ?>
                    <a href="<?php echo url('_article_save'); ?>" class="btn btn-sm btn-outline-dark rounded-0" id="send">保存</a>
                    <?php endif; ?>
                </div>

            </form>
        </div>
    </div>
</div>

<script type="text/javascript" src="/node_modules/jquery/dist/jquery.min.js"></script>
<script type="text/javascript" src="/node_modules/bootstrap/dist/js/bootstrap.bundle.min.js"></script>
<script type="text/javascript" src="/static/js/bundle.js"></script>



<script>

</script> 

<script>
document.querySelector('a#logout').addEventListener('click' ,function(event){event.preventDefault();ajax(this.href)})
</script>

</body>
</html>