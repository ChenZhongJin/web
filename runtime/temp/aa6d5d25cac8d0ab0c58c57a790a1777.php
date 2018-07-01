<?php /*a:4:{s:55:"C:\site\cms\application\manager\view\console\index.html";i:1530470284;s:48:"C:\site\cms\application\manager\view\layout.html";i:1530455309;s:45:"C:\site\cms\application\manager\view\nav.html";i:1530281968;s:48:"C:\site\cms\application\manager\view\footer.html";i:1530281986;}*/ ?>
<!doctype html>
<html lang="zh_CN">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no"> <link rel="stylesheet" type="text/css" href="/static/css/bootstrap.min.css" /><link rel="stylesheet" type="text/css" href="/static/css/common.css" />
    <title><?php echo htmlentities((isset($page['title']) && ($page['title'] !== '')?$page['title']:"")); ?></title>
    <meta name="keywords" content="<?php echo htmlentities((isset($page['keywords']) && ($page['keywords'] !== '')?$page['keywords']:'')); ?>">
    <meta name="description" content="<?php echo htmlentities((isset($page['description']) && ($page['description'] !== '')?$page['description']:'')); ?>">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.1.0/css/all.css" integrity="sha384-lKuwvrZot6UHsBSfcMvOkWwlCMgc0TaWr+30HWe3a4ltaBwTZhyTEggF5tJv8tbt" crossorigin="anonymous">
</head>

<body>
    <?php if(app('session')->get('user')): ?>
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
<?php endif; ?> 
<div class="container">
    <div class="row">
        <div class="col-8 my-3">
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
                    <a href="<?php echo url('_site_save_all'); ?>" class="btn btn-sm btn-dark" id="send">保存</a>
                </div>
            </form>
            <form id="create">
                <div class="form-group">
                    <p>调整配置</p>
                    <input type="hidden" name="id">
                </div>
                <div class="form-group">
                    <small class="text-muted">
                        <code>调用名称</code>
                    </small>
                    <input type="text" name="name" class="form-control" placeholder="cc_phone">
                </div>
                <div class="form-group">
                    <small class="text-muted">
                        配置描述
                    </small>
                    <input type="text" name="cname" class="form-control" placeholder="cc的手机号">
                </div>
                <div class="form-group">
                    <small class="text-muted">
                        配置值
                    </small>
                    <input type="text" name="content" class="form-control" placeholder="13011112222">
                </div>
                <div class="form-group">
                    <a href="<?php echo url('_site_save'); ?>" class="btn btn-sm btn-dark" id="send">新增</a>
                    <a href="<?php echo url('_site_delete'); ?>" class="btn btn-sm btn-danger" id="delete" style="display:none">删除</a>
                </div>
            </form>
        </div>
        <div class="col-4 mt-5">
            <div class="card">
                <div class="card-body">
                    <p class="card-title mb-0">服务器信息</p>
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

 <script type="text/javascript" src="/static/js/jquery.min.js"></script> <script type="text/javascript" src="/static/js/bootstrap.bundle.min.js"></script>
    <script type="text/javascript" src="/static/js/bundle.js"></script> <footer class="w-100 mt-3">
    <div class="text-center">
        <p class="text-muted text-small">古都企业网站系统 version:<?php echo htmlentities($APP['version']); ?> .Develop Mark:<?php echo htmlentities($APP['devMark']); ?></p>
        <p class="text-muted text-small">
            <a href="https://github.com/ChenZhongJin/web" class="text-muted">GitHub 分支dev_s</a>
        </p>
    </div>
</footer>
<?php if(app('session')->get('user')): ?>
<script>
    (function () {
        document.querySelector('a#logout').addEventListener('click', function (event) { event.preventDefault(); ajax(event.target.href) })
    })()
</script> <?php endif; ?> 
<script>
    (function () {
        var nodeUpdate = document.querySelector('form#update');
        var nodeCreate = document.querySelector('form#create');
        // 配置列表更新
        nodeUpdate.querySelector('#send').addEventListener('click', function (event) {
            event.preventDefault();
            var data = jQuery(nodeUpdate).serialize();
            ajax(event.target.href, data);
        });
        // 查询1条配置
        nodeCreate.querySelector('input[name="name"]').addEventListener('blur', function (event) {
            $.post("<?php echo url('_site_find'); ?>", { name: event.target.value }, function (resp) {
                if (resp.data) {
                    nodeCreate.querySelector('input[name=id]').value = resp.data.id;
                    nodeCreate.querySelector('input[name=cname]').value = resp.data.cname;
                    nodeCreate.querySelector('input[name=content]').value = resp.data.content;
                    nodeCreate.querySelector('a#send').text = "更新";
                    nodeCreate.querySelector('a#delete').style = "display:inline-block";
                } else {
                    nodeCreate.querySelector('input[name=cname]').value = '';
                    nodeCreate.querySelector('input[name=content]').value = '';
                    nodeCreate.querySelector('a#send').text = "新增";
                    nodeCreate.querySelector('a#delete').style = "display:none";
                }
            })
        });
        // 增加或更新配置
        nodeCreate.querySelector('a#send').addEventListener('click', function (event) {
            event.preventDefault();
            ajax(event.target.href, jQuery(nodeCreate).serialize());
        })
        // 删除1条配置
        nodeCreate.querySelector('a#delete').addEventListener('click', function (event) {
            event.preventDefault();
            ajax(event.target.href, jQuery(nodeCreate).serialize());
        })
    })()
</script> 
</body>

</html>