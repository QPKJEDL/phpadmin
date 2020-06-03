<?php $__env->startSection('title', '二维码列表'); ?>
<?php $__env->startSection('header'); ?>
    <div class="layui-inline">
        <button class="layui-btn layui-btn-small layui-btn-warm freshBtn"><i class="layui-icon">&#x1002;</i></button>
    </div>
    <div class="layui-inline">
        <input type="text"  value="<?php echo e(isset($input['user_id']) ? $input['user_id'] : ''); ?>" name="user_id" placeholder="请输入码商ID" autocomplete="off" class="layui-input">
    </div>
    <div class="layui-inline">
        <input type="text"  value="<?php echo e(isset($input['name']) ? $input['name'] : ''); ?>" name="name" placeholder="请输入姓名" autocomplete="off" class="layui-input">
    </div>
    <div class="layui-inline">
        <input type="text"  value="<?php echo e(isset($input['id']) ? $input['id'] : ''); ?>" name="id" placeholder="请输入二维码ID" autocomplete="off" class="layui-input">
    </div>
    <div class="layui-inline">
        <input type="text"  value="<?php echo e(isset($input['creatime']) ? $input['creatime'] : ''); ?>" name="creatime" placeholder="创建时间" onclick="layui.laydate({elem: this, festival: true,min:'<?php echo e($min); ?>'})" autocomplete="off" class="layui-input">
    </div>
    <div class="layui-inline">
        <button class="layui-btn layui-btn-normal" lay-submit lay-filter="formDemo">搜索</button>
    </div>
<?php $__env->stopSection(); ?>
<?php $__env->startSection('table'); ?>
    <table class="layui-table" lay-even lay-skin="nob">
        <colgroup>
            <col class="hidden-xs" width="100">
            <col class="hidden-xs" width="100">
            <col class="hidden-xs" width="100">
            <col class="hidden-xs" width="100">
            <col class="hidden-xs" width="200">
            <col class="hidden-xs" width="150">
            <col class="hidden-xs" width="150">
            <col class="hidden-xs" width="150">
            <col class="hidden-xs" width="200">
        </colgroup>
        <thead>
        <tr>
            <th class="hidden-xs">二维码ID</th>
            <th class="hidden-xs">码商ID</th>
            <th class="hidden-xs">姓名</th>
            <th class="hidden-xs">类型</th>
            <th class="hidden-xs">二维码</th>
            <th class="hidden-xs">总跑分</th>
            <th class="hidden-xs">是否删除</th>
            <th class="hidden-xs">状态</th>
            <th class="hidden-xs">创建时间</th>
        </tr>
        </thead>
        <tbody>
        <?php $__currentLoopData = $list; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $info): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <tr>
                <td class="hidden-xs"><?php echo e($info['id']); ?></td>
                <td class="hidden-xs"><?php echo e($info['user_id']); ?></td>
                <td class="hidden-xs"><?php echo e($info['name']); ?></td>
                <td class="hidden-xs"><?php if($info['type']==1): ?><span class="layui-btn layui-btn-small">微信</span><?php elseif($info['type']==2): ?><span class="layui-btn layui-btn-small layui-btn-normal">支付宝</span><?php endif; ?></td>
                <td>
                    <img src="<?php echo e($info['erweima']); ?>" width="50px" onclick="previewImg(this)">
                </td>
                <td class="hidden-xs"><?php echo e($info['sumscore']/100); ?></td>
                <td class="hidden-xs"><?php if($info['status']==0): ?><span class="layui-btn layui-btn-small layui-btn-default">未删除</span><?php elseif($info['status']==1): ?><span class="layui-btn layui-btn-small layui-btn-danger">已删除</span><?php endif; ?></td>
                <td class="hidden-xs"><?php if($info['code_status']==0): ?><span class="layui-btn layui-btn-small layui-btn-normal">开启</span><?php elseif($info['code_status']==1): ?><span class="layui-btn layui-btn-small layui-btn-danger">关闭</span><?php endif; ?></td>
                <td><?php echo e($info['creatime']); ?></td>

            </tr>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        <?php if(!$list[0]): ?>
            <tr><td colspan="6" style="text-align: center;color: orangered;">暂无数据</td></tr>
        <?php endif; ?>
        </tbody>
    </table>
    <div class="page-wrap">
        <?php echo e($list->render()); ?>

    </div>
<?php $__env->stopSection(); ?>
<?php $__env->startSection('js'); ?>
    <script>
        layui.use(['form', 'jquery', 'layer'], function() {
            var form = layui.form(),
                $ = layui.jquery,
                layer = layui.layer;

            form.render();
            form.on('submit(formDemo)', function(data) {                
            });
            
        });

        function previewImg(obj) {
            var img = new Image();
            img.src=obj.src;
            var imgHtml = "<img src='" + obj.src + "' width='400px' height='700px'/>";
            //弹出层
            layer.open({
                type:1,
                shade:0.8,
                area:['400px','700px'],
                offset:'auto',
                shadeClose:true,
                scrollbar:false,
                title:"图片预览",
                content:imgHtml,
                cancel:function () {

                }
            });
        }
    </script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('common.list', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>