<?php /*a:4:{s:54:"C:\site\cms\application\manager\view\article\edit.html";i:1530035274;s:48:"C:\site\cms\application\manager\view\layout.html";i:1530034941;s:45:"C:\site\cms\application\manager\view\nav.html";i:1529738175;s:48:"C:\site\cms\application\manager\view\footer.html";i:1530033920;}*/ ?>
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
        <div class="w-100">
            <form action="" id="article">
                <div class="form-group">
                    <?php echo token(); ?>
                    <input type="hidden" name="id" value="<?php echo htmlentities($data['id']); ?>">
                    <label for="title">文章标题</label>
                    <input type="text" name="title" class="form-control" value="<?php echo htmlentities($data['title']); ?>">
                </div>
                <div class="form-group">
                    <label for="category">所属分类</label>
                    <select class="form-control" id="category">
                        <?php foreach($categorys as $cat): ?>
                        <option value="<?php echo htmlentities($cat['id']); ?>" <?php if($data['category_id'] == $cat['id']): ?>selected<?php endif; ?>><?php echo htmlentities($cat['cname']); ?></option>
                        <?php endforeach; ?>
                    </select>
                </div>
                <div class="form-group">
                    <label for="title">文章内容</label>
                    <textarea class="form-control" id="edit"><?php echo htmlentities($data['content']); ?></textarea>
                </div>
                <div class="form-group">
                    <label for="keywords">页面关键词</label>
                    <input type="text" class="form-control" value="<?php echo htmlentities($data['keywords']); ?>">
                </div>
                <div class="form-group">
                    <label for="description">页面描述</label>
                    <textarea name="description" class="form-control"><?php echo htmlentities($data['description']); ?></textarea>
                </div>

                <div class="form-group">
                    <?php if($data['id']): ?>
                    <a href="<?php echo url('_article_update'); ?>" class="btn btn-sm btn-dark rounded-0" id="send">更新</a>
                    <?php else: ?>
                    <a href="<?php echo url('_article_save'); ?>" class="btn btn-sm btn-dark rounded-0" id="send">保存</a>
                    <?php endif; ?>
                </div>
            </form>
        </div>
    </div>
</div>  <script type="text/javascript" src="/node_modules/jquery/dist/jquery.min.js"></script> <script type="text/javascript" src="/node_modules/bootstrap/dist/js/bootstrap.bundle.min.js"></script>
    <script type="text/javascript" src="/static/js/bundle.js"></script> <footer class="w-100 mt-3">
    <div class="text-center">
        <p class="text-muted text-small">古都企业网站系统 version:<?php echo htmlentities($APP['version']); ?> .Develop Mark:<?php echo htmlentities($APP['devMark']); ?></p>
    </div>
</footer> 
<script src="/static/tinymce/tinymce.min.js"></script>
<script>
    tinymce.init({
        selector: 'textarea#edit',
        height: 300,
        menubar: false,
        plugins: [
            'advlist autolink lists link image charmap print preview anchor textcolor',
            'searchreplace visualblocks code fullscreen',
            'insertdatetime media table contextmenu paste code help wordcount'
        ],
        toolbar: 'insert | code | undo redo |  formatselect | bold italic backcolor  | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | removeformat | help',
        language: 'zh_CN',
        relative_urls: false,
        image_dimensions: false,
        images_upload_url: '<?php echo url("_unity_upimg"); ?>',
    });
    document.querySelector('form#article a#send').addEventListener('click', function (event) {
        event.preventDefault();
        var data = jQuery('form#article').serializeArray();
        data.push({name:'content',value: tinymce.get('edit').getContent()});
        data.push({name:'content_text',value: tinymce.get('edit').getContent({format:'text'})});
        document.querySelector('form#article').querySelector('select').querySelectorAll('option').forEach(function(k){
            if(k.selected){data.push({name:'category_id',value:k.value});return;}
        })
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