<?php $__env->startSection('title', '配置列表'); ?>
<?php $__env->startSection('header'); ?>
    <div class="layui-inline">
        <a class="layui-btn layui-btn-small layui-btn-normal addBtn" data-desc="添加封禁IP" data-url="<?php echo e(url('/admin/ipBlacklist/0/edit')); ?>"><i class="layui-icon">&#xe654;</i></a>
        <button class="layui-btn layui-btn-small layui-btn-warm freshBtn"><i class="layui-icon">&#x1002;</i></button>
    </div>
<?php $__env->stopSection(); ?>
<?php $__env->startSection('table'); ?>
    <table class="layui-table" id="treeTable" lay-even lay-skin="nob">
        <colgroup>
            <col class="hidden-xs" width="100">
            <col class="hidden-xs" width="150">
            <col class="hidden-xs" width="150">
            <col class="hidden-xs" width="150">
            <col class="hidden-xs" width="150">
            <col class="hidden-xs" width="150">
            <col class="hidden-xs" width="150">
            <col class="hidden-xs" width="150">
            <col width="200">
        </colgroup>
        <thead>
        <tr>
            <th class="hidden-xs">编号</th>
            <th class="hidden-xs">上级菜单</th>
            <th class="hidden-xs">菜单名称</th>
        </tr>
        </thead>
        <tbody>
        <?php $__currentLoopData = $list; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $info): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <tr data-tt-id="<?php echo e($info['id']); ?>" data-tt-parent-id="<?php echo e($info['parent_id']); ?>">
                <td class="hidden-xs"><?php echo e($info['id']); ?></td>
                <td class="hidden-xs"><?php echo e($info['parent_id']); ?></td>
                <td class="hidden-xs"><?php echo e($info['title']); ?></td>
            </tr>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        </tbody>
    </table>
<?php $__env->stopSection(); ?>
<?php $__env->startSection('js'); ?>
    <script>
        $("#treeTable").treetable({ expandable: true });
    </script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('common.list', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>