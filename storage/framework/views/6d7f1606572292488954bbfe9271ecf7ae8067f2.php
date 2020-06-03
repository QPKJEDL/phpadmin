<?php $__env->startSection('title', '码商银行'); ?>
<?php $__env->startSection('header'); ?>
    <div class="layui-inline">
    <button class="layui-btn layui-btn-small layui-btn-warm freshBtn"><i class="layui-icon">&#x1002;</i></button>
    </div>
    <div class="layui-inline">
        <input type="text"  value="<?php echo e(isset($input['agent_id']) ? $input['agent_id'] : ''); ?>" name="agent_id" placeholder="请输入代理商ID" autocomplete="off" class="layui-input">
    </div>
    <div class="layui-inline">
        <input type="text"  value="<?php echo e(isset($input['name']) ? $input['name'] : ''); ?>" name="name" placeholder="请输入姓名" autocomplete="off" class="layui-input">
    </div>
    <div class="layui-inline">
        <input type="text"  value="<?php echo e(isset($input['deposit_card']) ? $input['deposit_card'] : ''); ?>" name="deposit_card" placeholder="请输入银行卡号" autocomplete="off" class="layui-input">
    </div>
    <div class="layui-inline">
        <input type="text"  value="<?php echo e(isset($input['creatime']) ? $input['creatime'] : ''); ?>" name="creatime" placeholder="创建时间" onclick="layui.laydate({elem: this, festival: true,min:'<?php echo e($min); ?>' })" autocomplete="off" class="layui-input">
    </div>
    <div class="layui-inline">
        <button class="layui-btn layui-btn-normal" lay-submit lay-filter="formDemo">搜索</button>
    </div>
<?php $__env->stopSection(); ?>
<?php $__env->startSection('table'); ?>
    <table class="layui-table" lay-even lay-skin="nob">
        <colgroup>
            <col class="hidden-xs" width="50">
            <col class="hidden-xs" width="150">
            <col class="hidden-xs" width="150">
            <col class="hidden-xs" width="150">
            <col class="hidden-xs" width="150">
            <col class="hidden-xs" width="150">
            <col class="hidden-xs" width="200">
        </colgroup>
        <thead>
        <tr>
            <th class="hidden-xs">序号</th>
            <th class="hidden-xs">代理商ID</th>
            <th class="hidden-xs">姓名</th>
            <th class="hidden-xs">开户银行</th>
            <th class="hidden-xs">收款卡号</th>
            <th class="hidden-xs">状态</th>
            <th class="hidden-xs">添加时间</th>
        </tr>
        </thead>
        <tbody>
        <?php $__currentLoopData = $list; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $info): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <tr>
                <td class="hidden-xs"><?php echo e($info['id']); ?></td>
                <td class="hidden-xs"><?php echo e($info['agent_id']); ?></td>
                <td class="hidden-xs"><?php echo e($info['name']); ?></td>
                <td class="hidden-xs"><?php echo e($info['deposit_name']); ?></td>
                <td class="hidden-xs"><?php echo e($info['deposit_card']); ?></td>
                <td class="hidden-xs"><?php if($info['status']==0): ?><span class="layui-btn layui-btn-small layui-btn-warm">正常</span><?php elseif($info['status']==1): ?><span class="layui-btn layui-btn-small layui-btn-danger">不正常</span><?php endif; ?></td>
                <td class="hidden-xs"><?php echo e($info['creatime']); ?></td>
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
        layui.use(['form', 'jquery','laydate', 'layer'], function() {
            var form = layui.form(),
                $ = layui.jquery,
                laydate = layui.laydate,
                layer = layui.layer;

            form.render();
            form.on('submit(formDemo)', function(data) {
            });
        });
    </script>
<?php $__env->stopSection(); ?>


<?php echo $__env->make('common.list', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>