<?php /*a:4:{s:55:"C:\site\cms\application\manager\view\category\edit.html";i:1530035233;s:48:"C:\site\cms\application\manager\view\layout.html";i:1530034941;s:45:"C:\site\cms\application\manager\view\nav.html";i:1530105506;s:48:"C:\site\cms\application\manager\view\footer.html";i:1530035442;}*/ ?>
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
        <form action="" id="cat" class="w-50">
            <div class="form-group">
                <input type="hidden" name="id" value="<?php echo htmlentities($data['id']); ?>">
                <label for="cname">名称(汉)</label>
                <input type="text" class="form-control" name="cname" value="<?php echo htmlentities($data['cname']); ?>">
            </div>
            <div class="form-group">
                <label for="path">路径名称</label>
                <div class="input-group">
                    <input type="text" class="form-control" name="path" value="<?php echo htmlentities($data['path']); ?>">
                    <span class="input-group-append">
                        <a href="<?php echo url('unity_getpinyin'); ?>" class="btn btn-dark" id="pinyin">拼音</a>
                    </span>
                </div>
            </div>
            <?php if(!$parent): ?>
            <div class="form-group">
                <label for="type">所属模型<code>*</code></label>
                <select name="type" class="form-control">
                    <option value="1">文章</option>
                    <option value="2">产品</option>
                </select>
                <small class="text-muted">为此栏目选择所使用的模型，一旦确定不可更改。<br>若与上级栏目的模型不一致，将以上级栏目所用模型为准，顶级栏目除外。</small>
            </div><?php endif; ?>
            <div class="form-group">
                <label for="parent">上级栏目</label>
                <select name="parent" id="parent" class="form-control">
                    <option value="0">顶级</option>
                    <?php foreach($list as $item): ?>
                    <option value="<?php echo htmlentities($item['id']); ?>" <?php if($item['id']==$parent['id']): ?>selected<?php endif; ?>><?php echo htmlentities($item['cname']); ?></option>
                    <?php endforeach; ?>
                </select>
            </div>
            <div class="form-group">
                <?php if($data['id']): ?>
                <a href="<?php echo url('_category_update'); ?>" class="btn btn-sm btn-dark" id="send">更新</a>
                <?php else: ?>
                <a href="<?php echo url('_category_save'); ?>" class="btn btn-sm btn-dark" id="send">保存</a>
                <?php endif; ?>
            </div>

        </form>
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
    // 取拼音
    document.querySelector('a#pinyin').addEventListener('click', function (event) {
        event.preventDefault();
        var words = document.querySelector('input[name=cname]').value;
        $.post(event.target.href, { words: words }, function (resp) {
            if (resp) { document.querySelector('input[name=path]').value = resp }
        })
    })
    // 新增与更新
    document.querySelector('a#send').addEventListener('click', function (event) {
        event.preventDefault();
        var data = jQuery('form#cat').serialize();
        ajax(event.target.href, data);
    })
</script>  
    <script>
        (function () {
            document.querySelector('a#logout').addEventListener('click', function (event) { event.preventDefault(); ajax(event.target.href) })
        })()
    </script> 
</body>

</html>