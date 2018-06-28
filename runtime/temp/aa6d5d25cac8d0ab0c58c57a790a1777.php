<?php /*a:4:{s:55:"C:\site\cms\application\manager\view\console\index.html";i:1530133900;s:48:"C:\site\cms\application\manager\view\layout.html";i:1530034941;s:45:"C:\site\cms\application\manager\view\nav.html";i:1530133980;s:48:"C:\site\cms\application\manager\view\footer.html";i:1530035442;}*/ ?>
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
        <a class="nav-item nav-link" href="<?php echo url('_theme'); ?>">主题</a>
    </div>
    <div class="nav navbar-nav">
        <a class="nav-item nav-link" href="<?php echo url('logout'); ?>" id="logout"><?php echo htmlentities(app('session')->get('user.name')); ?></a>
    </div>
</nav> 
<div class="container">
    <div class="row">
        <div class="col-6 my-3">
            <form id="update">
                <div class="form-group">
                    <p>当前配置</p>
                </div>
                <?php foreach($data as $item): ?>
                <div class="form-group">
                    <small class="text-muted"><?php echo htmlentities($item['cname']); ?>
                        <code><?php echo htmlentities($item['name']); ?></code>
                    </small>
                    <input type="text" name="_<?php echo htmlentities($item['id']); ?>" class="form-control" value="<?php echo htmlentities($item['content']); ?>">
                </div>
                <?php endforeach; ?>
                <div class="form-group">
                    <a href="<?php echo url('_site_save'); ?>" class="btn btn-sm btn-dark" id="send">保存</a>
                </div>
            </form>
        </div>
        <div class="col-6">
            <form id="create">
                <div class="form-group">
                    <p>调整配置</p>
                    <input type="hidden" name="id">
                </div>
                <div class="form-group">
                    <small id="helpId" class="text-muted">
                        <code>调用名称</code>
                    </small>
                    <input type="text" name="name" class="form-control" placeholder="cc_phone">
                </div>
                <div class="form-group">
                    <small id="helpId" class="text-muted">
                        <code>描述</code>
                    </small>
                    <input type="text" name="cname" class="form-control" placeholder="cc的手机号">
                </div>
                <div class="form-group">
                    <small id="helpId" class="text-muted">
                        <code>内容</code>
                    </small>
                    <input type="text" name="content" class="form-control" placeholder="13011112222">
                </div>
                <div class="form-group">
                    <a href="javascript:;" class="btn btn-sm btn-dark" id="send">新增</a>
                    <a href="javascript:;" class="btn btn-sm btn-danger" id="delete" style="display:none">删除</a>
                </div>
            </form>
        </div>
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <p class="card-title mb-0">WEB配置信息</p>
                </div>
                <div class="card-body">
                    <p class="card-text">服务系统：
                        <code><?php echo htmlentities(PHP_OS); ?></code>
                    </p>
                    <p class="card-text">WEB代理：
                        <code><?php echo htmlentities($_SERVER['SERVER_SOFTWARE']); ?></code>
                    </p>
                    <p class="card-text">上传文件限制：
                        <code><?php echo get_cfg_var("upload_max_filesize"); ?></code>
                    </p>
                    <p class="card-text">脚本运行时间：
                        <code><?php echo get_cfg_var("max_execution_time"); ?>s</code>
                    </p>
                    <p class="card-text">脚本运行内存：
                        <code><?php echo get_cfg_var("memory_limit"); ?></code>
                    </p>
                    <p class="card-text">中国时间：
                        <code><?php date_default_timezone_set('PRC'); echo date('Y/m/d G:i:s') ?></code>
                    </p>
                    <p class="card-text">加载模块：
                        <code><?php echo join(' ',get_loaded_extensions()); ?></code>
                    </p>
                </div>
            </div>
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
    document.querySelector('form#update a#send').addEventListener('click', function (event) {
        event.preventDefault();
        ajax(event.target.href, jQuery('form#update').serialize());
    });
    // 查找
    document.querySelector('form#create input[name="name"]').addEventListener('blur', function () {
        $.post("<?php echo url('_site_find'); ?>", { name: this.value }, function (resp) {
            if (resp) {
                document.querySelectorAll('form#create input').forEach(function (el) {
                    if (el.getAttribute('name') === 'name') return;
                    el.value = resp[el.getAttribute('name')] || "";
                })
                document.querySelector('form#create a#send').text = "更新";
                document.querySelector('form#create a#delete').style = "display:inline-block";
            } else {
                document.querySelectorAll('form#create input').forEach(function (el) {
                    if (el.getAttribute('name') === 'name') return;
                    el.value = "";
                })
                document.querySelector('form#create a#send').text = "新增";
                document.querySelector('form#create a#delete').style = "display:none";
            }
        })
    });
    // 增加或更新配置
    document.querySelector('form#create a#send').addEventListener('click', function (element) {
        ajax("<?php echo url('_site_create'); ?>", jQuery('form#create').serialize());
    })
    // 删除1条配置
    document.querySelector('form#create a#delete').addEventListener('click', function (element) {
        ajax("<?php echo url('_site_delete'); ?>", jQuery('form#create').serialize());
    })
</script>  
    <script>
        (function () {
            document.querySelector('a#logout').addEventListener('click', function (event) { event.preventDefault(); ajax(event.target.href) })
        })()
    </script> 
</body>

</html>