<?php /*a:3:{s:50:"C:\site\cms\application\home\view\login\index.html";i:1529278721;s:45:"C:\site\cms\application\home\view\layout.html";i:1529214025;s:45:"C:\site\cms\application\home\view\footer.html";i:1528973568;}*/ ?>
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

<div class="container">
    <form action="" class="w-50">
        <input type="hidden" name="login_token" value="<?php echo htmlentities(app('request')->token('login')); ?>">
        <div class="form-group">
            <label for="name">用户名</label>
            <input type="text" class="form-control" name="name" value="<?php echo htmlentities(app('session')->get('form.name')); ?>">
        </div>
        <div class="form-group">
            <label for="password">密码</label>
            <input type="password" class="form-control" name="password" value="<?php echo htmlentities(app('session')->get('form.password')); ?>">
        </div>
        <div class="form-group">
            <label for="code">验证码</label>
            <div class="input-group">
            <input type="text" class="form-control" name="code" >
                <span class="input-group-append">
                    <img src="<?php echo url('login_code'); ?>" id="code" alt="code">
                </span>

            </div>
        </div>
        <div class="form-group">
            <a href="<?php echo url('login'); ?>" class="btn btn-sm btn-outline-dark" id="login">登录</a>
        </div>
    </form>
</div>

<script type="text/javascript" src="/node_modules/jquery/dist/jquery.min.js"></script>
<script type="text/javascript" src="/node_modules/bootstrap/dist/js/bootstrap.bundle.min.js"></script>
<script type="text/javascript" src="/static/js/bundle.js"></script>


<script>
document.querySelector('#login').addEventListener('click',function(e){
    e.preventDefault();
    var data = jQuery('form').serialize();
    ajax(this.href,data);
});
document.querySelector('img#code').addEventListener('click',function(e){
    var url = "<?php echo url('login_code'); ?>";
    this.setAttribute('src' ,url+'?'+Date.now());
})
</script>

</body>
</html>