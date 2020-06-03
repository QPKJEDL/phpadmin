<?php $__env->startSection('title', '配置列表'); ?>
<?php $__env->startSection('header'); ?>
    <div class="layui-inline">
        <a class="layui-btn layui-btn-small layui-btn-normal addBtn" data-desc="添加封禁IP" data-url="<?php echo e(url('/admin/ipBlacklist/0/edit')); ?>"><i class="layui-icon">&#xe654;</i></a>
        <button class="layui-btn layui-btn-small layui-btn-warm freshBtn"><i class="layui-icon">&#x1002;</i></button>
    </div>
    <div class="layui-inline">
        <input type="text"  value="<?php echo e(isset($input['ip_address']) ? $input['ip_address'] : ''); ?>" name="ip_address" placeholder="代理账号" autocomplete="off" class="layui-input">
    </div>
    <div class="layui-inline">
        <button class="layui-btn layui-btn-normal" lay-submit lay-filter="formDemo">搜索</button>
        <button class="layui-btn layui-btn-normal" id="reset">重置</button>
    </div>
<?php $__env->stopSection(); ?>
<?php $__env->startSection('table'); ?>
    <table class="layui-table" lay-even lay-skin="nob">
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
            <th class="hidden-xs">序号</th>
            <th class="hidden-xs">会员账号</th>
            <th class="hidden-xs">开始时间</th>
            <th class="hidden-xs">结束时间</th>
            <th class="hidden-xs">创建者</th>
            <th class="hidden-xs">状态</th>
            <th class="hidden-xs">最后修改时间</th>
            <th class="hidden-xs">最后修改人</th>
            <th class="hidden-xs">操作</th>
        </tr>
        </thead>
        <tbody>
        <?php $__currentLoopData = $list; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $info): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <tr>
                <td class="hidden-xs"><?php echo e($info['']); ?></td>
                <td class="hidden-xs"><?php echo e($info['']); ?></td>
                <td class="hidden-xs"><?php echo e($info['']); ?></td>
                <td class="hidden-xs"><?php echo e($info['']); ?></td>
                <td class="hidden-xs"><?php echo e($info['']); ?></td>
                <td class="hidden-xs"></td>
                <td class="hidden-xs"><?php echo e($info['']); ?></td>
                <td class="hidden-xs"><?php echo e($info['']); ?></td>
                <td>
                    <div class="layui-inline">
                        <button class="layui-btn layui-btn-small layui-btn-normal edit-btn" data-id="<?php echo e($info['id']); ?>" data-desc="修改配置" data-url="<?php echo e(url('/admin/ipBlacklist/'. $info['id'] .'/edit')); ?>">编辑</button>
                        <button class="layui-btn layui-btn-small layui-btn-danger del-btn" data-id="<?php echo e($info['id']); ?>" data-url="<?php echo e(url('/admin/ipBlacklist/'.$info['id'])); ?>">解禁</button>
                    </div>
                </td>
            </tr>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        <?php if(!$list[0]): ?>
            <tr><td colspan="9" style="text-align: center;color: orangered;">暂无数据</td></tr>
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
                layer = layui.layer
            ;
            laydate({istoday: true});
            form.render();
            //搜索
            form.on('submit(formDemo)', function(data) {
               
            });
            //重置
            $("#reset").click(function () {
                $("input[name='ip_address']").val('');
            });
        });
    </script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('common.list', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>