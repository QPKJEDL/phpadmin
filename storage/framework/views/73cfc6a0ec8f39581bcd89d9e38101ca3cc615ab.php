<?php $__env->startSection('title', '码商个人信息'); ?>
<?php $__env->startSection('content'); ?>
    <div class="layui-form layui-form-pane">
        <div class="layui-form-item">
            <label class="layui-form-label" style="width: 120px">帐号：</label>
            <div class="layui-input-inline">
                <input type="text" value="<?php echo e($info['account']); ?>" class="layui-input" disabled>
            </div>
        </div>

        <div class="layui-form-item">
            <label class="layui-form-label" style="width: 120px">上级：</label>
            <div class="layui-input-inline">
                <input type="text" value="<?php echo e($info['pid']); ?>" class="layui-input" disabled>
            </div>
        </div>


        <div class="layui-form-item">
            <label class="layui-form-label" style="width: 120px">身份：</label>
            <div class="layui-input-inline">
                <input type="number" value="<?php echo e($info['shenfen']); ?>" class="layui-input" disabled>
            </div>
        </div>

        <div class="layui-form-item">
            <label class="layui-form-label" style="width: 120px">微信费率：</label>
            <div class="layui-input-inline">
                <input type="text" value="<?php echo e($info['rate']); ?>" class="layui-input" disabled>
            </div>
        </div>
        <div class="layui-form-item">
            <label class="layui-form-label" style="width: 120px">支付宝费率：</label>
            <div class="layui-input-inline">
                <input type="text" value="<?php echo e($info['rates']); ?>" class="layui-input" disabled>
            </div>
        </div>
    </div>
<?php $__env->stopSection(); ?>
<?php $__env->startSection('id',$id); ?>
<?php $__env->startSection('js'); ?>
    <script>
        layui.use(['form','jquery','laypage', 'layer'], function() {
            var form = layui.form(),
                layer = layui.layer,
                $ = layui.jquery;
            form.render();
            $(".layui-btn").hide();
        });
    </script>
<?php $__env->stopSection(); ?>


<?php echo $__env->make('common.edit', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>