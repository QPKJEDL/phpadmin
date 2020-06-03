<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta name="renderer" content="webkit">
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
    <meta name="viewport" content="width=device-width,initial-scale=1,minimum-scale=1,maximum-scale=1,user-scalable=no" />
    <title><?php echo $__env->yieldContent('title'); ?> | <?php echo e(Config::get('app.name')); ?></title>
    <link rel="stylesheet" type="text/css" href="/static/admin/layui/css/layui.css" />
    <link rel="stylesheet" type="text/css" href="/static/admin/css/admin.css" />
    <script src="/static/admin/layui/layui.js" type="text/javascript" charset="utf-8"></script>
    <script src="/static/admin/js/common.js" type="text/javascript" charset="utf-8"></script>
    <script src="http://apps.bdimg.com/libs/jquery/2.1.4/jquery.min.js"></script>

</head>
<body>
<div class="wrap-container">
    <form class="layui-form" style="width: 90%;padding-top: 20px;">
        <?php echo e(csrf_field()); ?>

        
        
        <input name="id" type="hidden" value="<?php echo $__env->yieldContent('id'); ?>">
        <div class="layui-container">
            <div class="layui-row">
                <div class="layui-col-xs6">
                    <div class="grid-demo grid-demo-bg1">6/12</div>
                </div>
                <div class="layui-col-xs6">
                    <div class="grid-demo">6/12</div>
                </div>
            </div>
        </div>
    </form>
</div>
<?php echo $__env->yieldContent('js'); ?>
</body>
</html>