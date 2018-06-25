<?php /*a:4:{s:63:"C:\site\cms\application\manager\view\category\create_panel.html";i:1529479663;s:48:"C:\site\cms\application\manager\view\layout.html";i:1529301932;s:45:"C:\site\cms\application\manager\view\nav.html";i:1529479436;s:48:"C:\site\cms\application\manager\view\footer.html";i:1529279786;}*/ ?>
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
        <a class="nav-item nav-link" href="<?php echo url('article_panel'); ?>">文章</a>
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
        <form action="" class="w-50">
            <div class="form-group">
                <label for="cname">名称(汉)</label>
                <input type="text" class="form-control" name="cname">
            </div>
            <div class="form-group">
                <label for="path">路径名称</label>
                <div class="input-group">
                    <input type="text" class="form-control" name="path">
                    <span class="input-group-append">
                        <a href="<?php echo url('unity_getpinyin'); ?>" class="btn btn-dark" id="pinyin">拼音</a>
                    </span>
                </div>
            </div>
            <div class="form-group">
                <label for="parent">上一级</label>
                <select name="parent" id="parent" class="form-control">
                    <option value="0">顶级</option>
                    <?php foreach($data as $item): ?>
                    <option value="<?php echo htmlentities($item['id']); ?>"><?php echo htmlentities($item['cname']); ?></option>
                    <?php endforeach; ?>
                </select>
            </div>
            <div class="form-group">
                <a href="<?php echo url('_category_create'); ?>" class="btn btn-dark" id="send">保存</a>
            </div>

        </form>
    </div>
</div>

<script type="text/javascript" src="/node_modules/jquery/dist/jquery.min.js"></script>
<script type="text/javascript" src="/node_modules/bootstrap/dist/js/bootstrap.bundle.min.js"></script>
<script type="text/javascript" src="/static/js/bundle.js"></script>


<script>
    function selecked(){
        var ss =0;
        document.querySelector('select#parent').querySelectorAll('option').forEach(function(k){
            if(k.selected){ss=k.value}
        })
        return ss;
    }
    // 取拼音
    document.querySelector('a#pinyin').addEventListener('click',function(event){
        event.preventDefault();
        var words = document.querySelector('input[name=cname]').value;
        $.post(event.target.href,{words:words},function(resp){
            if(resp){document.querySelector('input[name=path]').value=resp}
        })
    })
    // 新增与更新
    document.querySelector('a#send').addEventListener('click',function(event){
        event.preventDefault();
        var data = jQuery('form#cate').serialize();
        ajax(event.target.href,data);
    })
</script> 

<script>
document.querySelector('a#logout').addEventListener('click' ,function(event){event.preventDefault();ajax(this.href)})
</script>

</body>
</html>