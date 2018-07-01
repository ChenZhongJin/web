<?php /*a:1:{s:50:"C:\site\cms\application\home\view\login\index.html";i:1530473314;}*/ ?>
<!doctype html>
<html lang="zh_CN">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no"> <link rel="stylesheet" type="text/css" href="/static/css/bootstrap.min.css" /><link rel="stylesheet" type="text/css" href="/static/css/common.css" />
    <title>后台登录</title>
</head>

<body>
    <div class="container">
        <form action="" class="w-50 my-3">
            <input type="hidden" name="token" value="<?php echo htmlentities(app('request')->token()); ?>">
            <div class="form-group">
                <small>用户名</small>
                <input type="text" class="form-control" name="name" value="<?php echo htmlentities(app('session')->get('form.name')); ?>">
            </div>
            <div class="form-group">
                <small>密码</small>
                <input type="password" class="form-control" name="password" value="<?php echo htmlentities(app('session')->get('form.password')); ?>">
            </div>
            <div class="form-group">
                <small>验证码</small>
                <div class="input-group">
                    <input type="text" class="form-control" name="captcha">
                    <span class="input-group-append">
                        <img src="<?php echo url('login_code'); ?>" id="code">
                    </span>
                </div>
            </div>
            <div class="form-group">
                <a href="<?php echo url('login'); ?>" class="btn btn-sm btn-outline-dark" id="send">登录</a>
            </div>
        </form>
    </div>
    <footer class="w-100 mt-3">
        <div class="text-center">
            <p class="text-muted text-small">古都企业网站系统 version:<?php echo htmlentities($APP['version']); ?> .Develop Mark:<?php echo htmlentities($APP['devMark']); ?></p>
            <p class="text-muted text-small">
                <a href="https://github.com/ChenZhongJin/web" class="text-muted">GitHub 分支dev_s</a>
            </p>
        </div>
    </footer>
    <script type="text/javascript" src="/static/js/jquery.min.js"></script> <script type="text/javascript" src="/static/js/bootstrap.bundle.min.js"></script> <script type="text/javascript" src="/static/js/bundle.js"></script>
    <script>
        (function () {
            document.querySelector('a#send').addEventListener('click', function (event) {
                event.preventDefault();
                var data = jQuery('form').serialize();
                ajax(event.target.href, data);
            });
            document.querySelector('img#code').addEventListener('click', function (e) {
                var url = "<?php echo url('login_code'); ?>";
                this.setAttribute('src', url + '?' + Date.now());
            })
        })()
    </script>
</body>

</html>