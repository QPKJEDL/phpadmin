<?php $__env->startSection('title', '添加商户'); ?>
<?php $__env->startSection('content'); ?>
    <div class="layui-form-item">
        <label class="layui-form-label">商户ID：</label>
        <div class="layui-input-block">
            <input type="text" value="<?php echo e(isset($info['business_code']) ? $info['business_code'] : ''); ?>"class="layui-input" disabled>
        </div>
    </div>

    <div class="layui-form-item">
        <label class="layui-form-label">姓名：</label>
        <div class="layui-input-block">
            <input type="text" value="<?php echo e(isset($info['name']) ? $info['name'] : ''); ?>" class="layui-input" disabled>
        </div>
    </div>

    <div class="layui-form-item">
        <label class="layui-form-label">银行卡号：</label>
        <div class="layui-input-block">
            <input type="text" value="<?php echo e(isset($info['deposit_card']) ? $info['deposit_card'] : ''); ?>" class="layui-input" disabled>
        </div>
    </div>

    <div class="layui-form-item">
        <label class="layui-form-label">银行名称：</label>
        <div class="layui-input-block">
            <input type="text" value="<?php echo e(isset($info['deposit_name']) ? $info['deposit_name'] : ''); ?>" class="layui-input" disabled>
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
            var id = $("input[name='id']").val();
            var index = parent.layer.getFrameIndex(window.name);


        });
    </script>
<?php $__env->stopSection(); ?>


<?php echo $__env->make('common.edit', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>