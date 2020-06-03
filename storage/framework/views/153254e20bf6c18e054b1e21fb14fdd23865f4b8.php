<?php $__env->startSection('title', '码商账单'); ?>
<?php $__env->startSection('header'); ?>
    <div class="layui-inline">
    <button class="layui-btn layui-btn-small layui-btn-warm freshBtn"><i class="layui-icon">&#x1002;</i></button>
    </div>
    <div class="layui-inline">
        <input type="text"  value="<?php echo e(isset($input['user_id']) ? $input['user_id'] : ''); ?>" name="user_id" placeholder="请输入码商ID" autocomplete="off" class="layui-input">
    </div>
    <div class="layui-inline">
        <input type="text"  value="<?php echo e(isset($input['creatime']) ? $input['creatime'] : ''); ?>" name="creatime" placeholder="创建时间" onclick="layui.laydate({elem: this, festival: true,min:'<?php echo e($min); ?>'})" autocomplete="off" class="layui-input">
    </div>
    <div class="layui-inline">
        <input type="text"  value="<?php echo e(isset($input['savetime']) ? $input['savetime'] : ''); ?>" name="savetime" placeholder="更新时间" onclick="layui.laydate({elem: this, festival: true,min:'<?php echo e($min); ?>'})" autocomplete="off" class="layui-input">
    </div>
    <div class="layui-inline">
        <button class="layui-btn layui-btn-normal" lay-submit lay-filter="formDemo">搜索</button>
    </div>
    <div class="layui-inline">
        <button class="layui-btn layui-btn-warm" name="excel" value="excel" lay-submit lay-filter="formDemo">导出EXCEL</button>
    </div>
<?php $__env->stopSection(); ?>
<?php $__env->startSection('table'); ?>
    <table class="layui-table" lay-even lay-skin="nob">
        <colgroup>
            <col class="hidden-xs" width="50">
            <col class="hidden-xs" width="100">
            <col class="hidden-xs" width="100">
            <col class="hidden-xs" width="100">
            <col class="hidden-xs" width="100">
            <col class="hidden-xs" width="100">
            <col class="hidden-xs" width="100">
            <col class="hidden-xs" width="150">
            <col class="hidden-xs" width="150">
            <col class="hidden-xs" width="150">
            <col class="hidden-xs" width="150">
            <col class="hidden-xs" width="150">
            <col class="hidden-xs" width="200">
            <col class="hidden-xs" width="200">
        </colgroup>
        <thead>
        <tr>
            <th class="hidden-xs">序号</th>
            <th class="hidden-xs">码商ID</th>
            <th class="hidden-xs">余额</th>
            <th class="hidden-xs">总跑分</th>
            <th class="hidden-xs">跑分佣金</th>
            <th class="hidden-xs">激活佣金</th>
            <th class="hidden-xs">冻结金额</th>
            <th class="hidden-xs">提现总金额</th>
            <th class="hidden-xs">提现实际到账总金额</th>
            <th class="hidden-xs">总充值</th>
            <th class="hidden-xs">总上分</th>
            <th class="hidden-xs">总下分</th>
            <th class="hidden-xs">创建时间</th>
            <th class="hidden-xs">更新时间</th>
        </tr>
        </thead>
        <tbody>
        <?php $__currentLoopData = $list; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $info): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <tr>
                <td class="hidden-xs"><?php echo e($info['id']); ?></td>
                <td class="hidden-xs"><?php echo e($info['user_id']); ?></td>
                <td class="hidden-xs"><?php echo e($info['balance']/100); ?></td>
                <td class="hidden-xs"><?php echo e($info['tol_sore']/100); ?></td>
                <td class="hidden-xs"><?php echo e($info['tol_brokerage']/100); ?></td>
                <td class="hidden-xs"><?php echo e($info['active_brokerage']/100); ?></td>
                <td class="hidden-xs"><?php echo e($info['freeze_money']/100); ?></td>
                <td class="hidden-xs"><?php echo e($info['drawMoney']/100); ?></td>
                <td class="hidden-xs"><?php echo e($info['tradeMoney']/100); ?></td>
                <td class="hidden-xs"><?php echo e($info['tol_recharge']/100); ?></td>
                <td class="hidden-xs"><?php echo e($info['shangfen']/100); ?></td>
                <td class="hidden-xs"><?php echo e($info['xiafen']/100); ?></td>
                <td class="hidden-xs"><?php echo e($info['creatime']); ?></td>
                <td class="hidden-xs"><?php echo e($info['savetime']); ?></td>
            </tr>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        <?php if(!$list[0]): ?>
            <tr><td colspan="6" style="text-align: center;color: orangered;">暂无数据</td></tr>
        <?php endif; ?>
        </tbody>
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
            laydate({istoday: true});
            form.render();
            form.on('submit(formDemo)', function(data) {
            });
        });
    </script>
<?php $__env->stopSection(); ?>


<?php echo $__env->make('common.list', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>