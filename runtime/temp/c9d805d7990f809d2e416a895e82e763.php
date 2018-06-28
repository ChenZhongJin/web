<?php /*a:5:{s:54:"C:\site\cms\application\manager\view\product\edit.html";i:1530035295;s:48:"C:\site\cms\application\manager\view\layout.html";i:1530034941;s:45:"C:\site\cms\application\manager\view\nav.html";i:1530105506;s:48:"C:\site\cms\application\manager\view\footer.html";i:1530035442;s:48:"C:\site\cms\application\manager\view\editor.html";i:1529937295;}*/ ?>
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
        <form action="" class="w-100 my-2" id="product">
            <?php echo token(); ?>
            <input type="hidden" name="id" value="<?php echo htmlentities($data['id']); ?>">
            <div class="form-row">
                <div class="col-6">
                    <div class="form-group">
                        <small >产品名称</small>
                        <input type="text" name="name" class="form-control" value="<?php echo htmlentities($data['name']); ?>">
                    </div>
                </div>
                <div class="col-6">
                    <div class="form-group">
                        <small >产品型号</small>
                        <input type="text" name="model" class="form-control" value="<?php echo htmlentities($data['model']); ?>">
                    </div>
                </div>
                <div class="col-6">
                    <div class="form-group">
                        <small >所属系列</small>
                        <select name="category_id" class="form-control">
                            <?php foreach($list as $item): ?>
                            <option value="<?php echo htmlentities($item['id']); ?>" <?php if($data['category_id']==$item['id']): ?>selected<?php endif; ?>><?php echo htmlentities($item['cname']); ?></option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                </div>
                <div class="col-6">
                    <div class="form-group">
                        <small >产品序列号</small>
                        <input type="text" name="serial_number" class="form-control" value="<?php echo htmlentities($data['serial_number']); ?>">
                    </div>
                </div>
                <div class="col-6" id="previews">
                    <p>产品预览图</p>
                    <?php if($data): foreach($data['preview'] as $img): ?>
                    <div class="preview">
                        <img src="<?php echo htmlentities($img['src']); ?>" class="img-fluid">
                        <input type="hidden" name="preview[<?php echo htmlentities($img['alt']); ?>]" value="<?php echo htmlentities($img['src']); ?>">
                    </div>
                    <?php endforeach; endif; ?>
                    <div class="product-upimg">
                        <label for="upimg" class="btn btn-sm">上传图片</label>
                        <div class="progress-bar progress-bar-striped bg-warning" role="progressbar"></div>
                        <input type="file" class="d-none" id="upimg" accept="image/*">
                    </div>
                </div>
                <div class="col-6" id="preview_show">
                </div>
                <div class="col-12 mb-2">
                    <small>产品页面内容</small>
                    <textarea id="edit" class="form-control"><?php echo htmlentities($data['content']); ?></textarea>
                </div>
                <div class="col-12">
                    <?php if($data): ?>
                    <a href="<?php echo url('_product_update'); ?>" class="btn btn-sm btn-dark rounded-0" id="send">更新</a>
                    <?php else: ?>
                    <a href="<?php echo url('_product_save'); ?>" class="btn btn-sm btn-dark rounded-0" id="send">保存</a>
                    <?php endif; ?>
                </div>
                <div class="col-6">
                    <div class="form-group">
                        <small >页面标题</small>
                        <input type="text" class="form-control" name="title" value="<?php echo htmlentities($data['title']); ?>">
                    </div>
                </div>
                <div class="col-6">
                    <div class="form-group">
                        <small >页面关键字</small>
                        <input type="text" class="form-control" name="keywords" value="<?php echo htmlentities($data['keywords']); ?>">
                    </div>
                </div>
                <div class="col-12">
                    <div class="form-group">
                        <small >页面描述</small>
                        <textarea name="description" id="description" class="form-control"><?php echo htmlentities($data['description']); ?></textarea>
                    </div>
                </div>
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
</footer> <script src="/static/tinymce/tinymce.min.js"></script>
<script>
    (function () {
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
    })()
</script>
<script src="/static/axios.min.js"></script>
<script>
    (function () {
        // 注册预览事件
        function eventLister(element) {
            // 预览事件
            element.addEventListener("mouseenter", function (event) {
                var show = document.querySelector('div#preview_show img');
                if (show) {
                    show.src = element.querySelector('img').src;
                } else {
                    var nodeImg = document.createElement('img');
                    nodeImg.classList.add('img-fluid');
                    nodeImg.src = element.querySelector('img').src;
                    document.querySelector('div#preview_show').insertAdjacentElement('afterbegin', nodeImg);
                }
            });
            // 删除事件
            element.addEventListener('click', function (event) {
                document.querySelector('div#previews').removeChild(element);
                var previewShow = document.querySelector('div#preview_show');
                previewShow.removeChild(previewShow.querySelector('img'));
            })
        }
        // 更新图片列表
        function updateImg(imgURL, imgName) {
            var tip = Date.now();
            var node = `<div class="preview tip-${tip}"><img src="${imgURL}" class="img-fluid"><input type="hidden" name="preview[${imgName}]" value="${imgURL}"></div>`
            document.querySelector('div.product-upimg').insertAdjacentHTML('beforeBegin', node);
            // 为新节点注册事件
            var newNode = document.querySelector('div.tip-' + tip);
            eventLister(newNode);
        }
        // 图片预览
        document.querySelectorAll('div.preview').forEach(function (k) {
            eventLister(k);
        })
        // 图片上传
        document.querySelector('input#upimg').addEventListener('change', function (event) {
            var file = event.target.files[0];
            var formData = new FormData();
            formData.append('file', file);
            if (file) {
                axios({
                    url: "<?php echo url('_unity_upimg'); ?>",
                    method: 'POST',
                    data: formData,
                    onUploadProgress: function (progressEvent) {
                        var bar = document.querySelector('div.product-upimg').children[1];
                        bar.style.width = ((progressEvent.loaded / progressEvent.total) * 100 + '%');
                    },
                }).then(function (resp) {
                    if (resp.data.code == 1) {
                        updateImg(resp.data.location, resp.data.name);
                        notify({ code: 1, msg: resp.data.name });
                    } else { notify(resp.data) }
                    // 重置进度条
                    document.querySelector('div.progress-bar').style.width = '0%';
                })
            }
        });
        // 更新资源
        document.querySelector('a#send').addEventListener('click' ,function(event){
            event.preventDefault();
            var data = jQuery('form#product').serializeArray();
            data.push({name:'content',value: tinymce.get('edit').getContent()});
            ajax(event.target.href,data);
        })
    })()
</script>  
    <script>
        (function () {
            document.querySelector('a#logout').addEventListener('click', function (event) { event.preventDefault(); ajax(event.target.href) })
        })()
    </script> 
</body>

</html>