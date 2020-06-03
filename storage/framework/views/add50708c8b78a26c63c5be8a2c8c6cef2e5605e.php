<?php $__env->startSection('title', '激活佣金'); ?>
<?php $__env->startSection('header'); ?>
    <div class="layui-inline">
        <button class="layui-btn layui-btn-small layui-btn-warm freshBtn"><i class="layui-icon">&#x1002;</i></button>
    </div>
<?php $__env->stopSection(); ?>
<?php $__env->startSection('table'); ?>
    <table class="layui-table" lay-even lay-skin="nob">
        <colgroup>
            <col class="hidden-xs" width="150">
            <col class="hidden-xs" width="150">
            <col class="hidden-xs" width="150">
            <col class="hidden-xs" width="150">
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
            <th class="hidden-xs">激活佣金</th>
            <th class="hidden-xs">1级返佣</th>
            <th class="hidden-xs">2级返佣</th>
            <th class="hidden-xs">3级返佣</th>
            <th class="hidden-xs">4级返佣</th>
            <th class="hidden-xs">5级返佣</th>
            <th class="hidden-xs">6级返佣</th>
            <th class="hidden-xs">7级返佣</th>
            <th class="hidden-xs">8级返佣</th>
            <th class="hidden-xs">9级返佣</th>
            <th class="hidden-xs">10级返佣</th>
            <th class="hidden-xs">时间</th>
            <th>操作</th>
        </tr>
        </thead>
        <tbody>
        <?php $__currentLoopData = $list; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $info): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <tr>

                <td class="hidden-xs"><?php echo e($info['jhmoney']/100); ?></td>
                <td class="hidden-xs"><?php echo e($info['fymoney1']/100); ?></td>
                <td class="hidden-xs"><?php echo e($info['fymoney2']/100); ?></td>
                <td class="hidden-xs"><?php echo e($info['fymoney3']/100); ?></td>
                <td class="hidden-xs"><?php echo e($info['fymoney4']/100); ?></td>
                <td class="hidden-xs"><?php echo e($info['fymoney5']/100); ?></td>
                <td class="hidden-xs"><?php echo e($info['fymoney6']/100); ?></td>
                <td class="hidden-xs"><?php echo e($info['fymoney7']/100); ?></td>
                <td class="hidden-xs"><?php echo e($info['fymoney8']/100); ?></td>
                <td class="hidden-xs"><?php echo e($info['fymoney9']/100); ?></td>
                <td class="hidden-xs"><?php echo e($info['fymoney10']/100); ?></td>
                <td class="hidden-xs"><?php echo e($info['creatime']); ?></td>
                <td>
                    <div class="layui-inline">
                        <a class="layui-btn layui-btn-small layui-btn-normal" onclick="edit(<?php echo e($info['id']); ?>)">编辑</a>
                    </div>
                </td>
            </tr>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        </tbody>
    </table>

<?php $__env->stopSection(); ?>
<?php $__env->startSection('js'); ?>
    <script>
        layui.use(['form', 'jquery', 'layer'], function() {
            var form = layui.form(),
                $ = layui.jquery,
                layer = layui.layer;
            form.render();
            form.on('submit(formDemo)', function(data) {
                console.log(data);
            });
            //layer.msg(layui.v);
        });
        function edit(id) {
            var id=id;
            layer.open({
                type: 2,
                title: '激活佣金',
                closeBtn: 1,
                area: ['500px','700px'],
                shadeClose: false, //点击遮罩关闭
                resize:false,
                content: ['/admin/coderakemoney/'+id+'/edit','no'],
                end:function(){

                }
            });
        }
    </script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('common.list', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>