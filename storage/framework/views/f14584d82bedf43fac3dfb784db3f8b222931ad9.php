<?php $__env->startSection('title', '添加商户'); ?>
<?php $__env->startSection('content'); ?>
    <div class="layui-form layui-form-pane">
    <div class="layui-form-item">
        <label class="layui-form-label">代理商名：</label>
        <div class="layui-input-inline">
            <input type="text" value="<?php echo e(isset($info['agent_name']) ? $info['agent_name'] : ''); ?>" class="layui-input" disabled>
        </div>
    </div>

    <div class="layui-form-item">
        <label class="layui-form-label">账号：</label>
        <div class="layui-input-inline">
            <input type="text" value="<?php echo e(isset($info['account']) ? $info['account'] : ''); ?>" class="layui-input" disabled>
        </div>
    </div>
        <blockquote class="layui-elem-quote layui-text"></blockquote>
    <?php $__currentLoopData = $bank; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $list): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
        <div class="layui-form-item">
            <label class="layui-form-label">姓名：</label>
            <div class="layui-input-inline">
                <input type="text" value="<?php echo e(isset($list['name']) ? $list['name'] : ''); ?>" class="layui-input" disabled>
            </div>
        </div>
        <div class="layui-form-item">
            <label class="layui-form-label">银行卡号：</label>
            <div class="layui-input-inline">
                <input type="text" value="<?php echo e(isset($list['deposit_card']) ? $list['deposit_card'] : ''); ?>" class="layui-input" disabled>
            </div>
        </div>
        <div class="layui-form-item">
            <label class="layui-form-label">银行名称：</label>
            <div class="layui-input-inline">
                <input type="text" value="<?php echo e(isset($list['deposit_name']) ? $list['deposit_name'] : ''); ?>" class="layui-input" disabled>
            </div>
        </div>
        <blockquote class="layui-elem-quote layui-text"></blockquote>
    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
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
        });
    </script>
<?php $__env->stopSection(); ?>


<?php echo $__env->make('common.edit', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>