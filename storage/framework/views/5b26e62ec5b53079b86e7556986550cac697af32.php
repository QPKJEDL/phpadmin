<?php $__env->startSection('title', '公告管理'); ?>
<?php $__env->startSection('header'); ?>
    <div class="layui-inline">
        <button class="layui-btn layui-btn-small layui-btn-warm freshBtn"><i class="layui-icon">&#x1002;</i></button>
    </div>
    <div class="layui-inline">
        <select name="desk_id" lay-filter="desk_id">
            <option value="">请选择台桌</option>
            <?php $__currentLoopData = $desk; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $d): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <option value="<?php echo e($d['id']); ?>" <?php echo e(isset($input['desk_id'])&&$input['desk_id']==$d['id']?'selected':''); ?>><?php echo e($d['desk_name']); ?></option>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        </select>
    </div>
    <div class="layui-inline">
        <input class="layui-input" name="create_time" placeholder="操作时间" onclick="layui.laydate({elem: this, festival: true,min:'<?php echo e($min); ?>'})" value="<?php echo e(isset($input['create_time']) ? $input['create_time'] : ''); ?>" autocomplete="off">
    </div>
    <div class="layui-inline">
        <button class="layui-btn layui-btn-normal" lay-submit lay-filter="formDemo">搜索</button>
        <button class="layui-btn layui-btn-normal" id="reset">重置</button>
    </div>
<?php $__env->stopSection(); ?>
<?php $__env->startSection('table'); ?>
    <table class="layui-table" lay-even lay-skin="nob">
        <colgroup>
            <col class="hidden-xs" width="50">
            <col class="hidden-xs" width="100">
            <col class="hidden-xs" width="150">
            <col class="hidden-xs" width="150">
            <col class="hidden-xs" width="200">
        </colgroup>
        <thead>
        <tr>
            <th class="hidden-xs">序号</th>
            <th class="hidden-xs">被操作台桌</th>
            <th class="hidden-xs">操作动作</th>
            <th class="hidden-xs">操作人</th>
            <th class="hidden-xs">操作时间</th>
        </tr>
        </thead>
        <tbody>
        <?php $__currentLoopData = $list; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $info): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <tr>
                <td class="hidden-xs"><?php echo e($info['id']); ?></td>
                <td class="hidden-xs"><?php echo e($info['desk_name']); ?>[<?php echo e($info['game_name']); ?>]</td>
                <td class="hidden-xs"><?php echo e($info['action']); ?></td>
                <td class="hidden-xs"><?php echo e($info['create_by']); ?></td>
                <td class="hidden-xs"><?php echo e($info['create_time']); ?></td>
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
        layui.use(['form', 'jquery', 'layer','laydate'], function() {
            var form = layui.form(),
                $ = layui.jquery,
                laydate=layui.laydate,
                layer = layui.layer;
            laydate({istoday: true});
            form.render();
            $("#reset").click(function () {
                $("select[name='desk_id']").val('');
                $("input[name='create_time']").val('');
            });
            form.on('submit(formDemo)', function(data) {                
            });
            
        });
    </script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('common.list', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>