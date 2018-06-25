<?php /*a:4:{s:54:"C:\site\cms\application\manager\view\product\edit.html";i:1529903430;s:48:"C:\site\cms\application\manager\view\layout.html";i:1529787075;s:45:"C:\site\cms\application\manager\view\nav.html";i:1529738175;s:48:"C:\site\cms\application\manager\view\footer.html";i:1529279786;}*/ ?>
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
        <form action="" class="w-100 my-2" id="product">
            <div class="form-row">
                <div class="col-6">
                    <div class="form-group">
                        <label for="">产品名称</label>
                        <input type="text" name="name" class="form-control" value="<?php echo htmlentities($data['name']); ?>">
                    </div>
                </div>
                <div class="col-6">
                    <div class="form-group">
                        <label for="model">产品型号</label>
                        <input type="text" name="model" class="form-control" value="<?php echo htmlentities($data['model']); ?>">
                    </div>
                </div>
                <div class="col-6">
                    <div class="form-group">
                        <label for="category_id">所属系列</label>
                        <select name="category_id" class="form-control">
                            <?php foreach($list as $item): ?>
                            <option value="<?php echo htmlentities($item['id']); ?>" <?php if($data['category_id']==$item['id']): ?>selected<?php endif; ?>><?php echo htmlentities($item['cname']); ?></option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                </div>
                <div class="col-6">
                    <div class="form-group">
                        <label for="serial_number">产品序列号</label>
                        <input type="text" name="serial_number" class="form-control" value="<?php echo htmlentities($data['serial_number']); ?>">
                    </div>
                </div>
                <div class="col-6" id="previews">
                    <?php if($data): foreach($data['preview'] as $img): ?>
                    <div class="preview">
                        <img src="<?php echo htmlentities($img); ?>" class="img-fluid" alt="">
                        <input type="hidden" name="preview[]" value="<?php echo htmlentities($img); ?>">
                    </div>
                    <?php endforeach; endif; ?>
                    <div class="preview">
                        <img src="/2.jpg" class="img-fluid" alt="">
                        <input type="hidden" name="preview[]" value="/2.jpg">
                    </div>
                    <div class="preview">
                        <img src="/2.jpg" class="img-fluid" alt="">
                        <input type="hidden" name="preview[]" value="/2.jpg">
                    </div>
                    <div class="preview">
                        <img src="/2.jpg" class="img-fluid" alt="">
                        <input type="hidden" name="preview[]" value="/2.jpg">
                    </div>
                    <div class="preview">
                        <img src="/2.jpg" class="img-fluid" alt="">
                        <input type="hidden" name="preview[]" value="/2.jpg">
                    </div>

                    <div class="product-upimg">
                        <label for="upimg" class="btn btn-sm">上传图片</label>
                        <div class="progress-bar progress-bar-striped bg-warning" role="progressbar"></div>
                        <input type="file" class="d-none" id="upimg" accept="image/*">
                    </div>
                </div>
                <div class="col-6" id="preview_show">
                </div>
            </div>
        </form>
    </div>
</div>

<script type="text/javascript" src="/node_modules/jquery/dist/jquery.min.js"></script>
<script type="text/javascript" src="/node_modules/bootstrap/dist/js/bootstrap.bundle.min.js"></script>
<script type="text/javascript" src="/static/js/bundle.js"></script>


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
            var tip  = Date.now();
            var node = `<div class="preview tip-${tip}"><img src="${imgURL}" class="img-fluid"><input type="hidden" name="preview[${imgName}]" value="${imgURL}"></div>`
            document.querySelector('div.product-upimg').insertAdjacentHTML('beforeBegin', node);
            var newNode = document.querySelector('div.tip-'+tip);
            eventLister(newNode);
        }
        // 图片预览
        document.querySelectorAll('div.preview').forEach(function (k) {
            eventLister(k);
        })
        // 图片上传
        document.querySelector('input#upimg').addEventListener('change', function (event) {
            formData = new FormData();
            formData.append('file', event.target.files[0]);
            axios({
                url: "<?php echo url('_unity_upimg'); ?>",
                method: 'POST',
                data: formData,
                onUploadProgress: function (progressEvent) {
                    var bar = document.querySelector('div.product-upimg').children[1];
                    bar.style.width = ((progressEvent.loaded / progressEvent.total) * 100 + '%');
                },
            }).then(function (resp) {
                if (resp.data.status == 1) {
                    updateImg(resp.data.location, resp.data.name);
                    notify({ status: 1, msg: resp.data.name });
                } else { notify({msg:resp.data}) }
                // 重置进度条
                document.querySelector('div.product-upimg').children[1].style.width = '0%';
            })
        })
    })()
// var data = jQuery('form#product').serializeArray();
// ajax('<?php echo url("_product_save"); ?>',data);
</script> 

<script>
document.querySelector('a#logout').addEventListener('click' ,function(event){event.preventDefault();ajax(event.target.href)})
</script>

</body>
</html>