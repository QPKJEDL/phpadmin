<?php $__env->startSection('title', '商户账单'); ?>
<?php $__env->startSection('header'); ?>
    <div class="layui-inline">
    <button class="layui-btn layui-btn-small layui-btn-warm freshBtn"><i class="layui-icon">&#x1002;</i></button>
    </div>
    <div class="layui-inline">
        <input type="text"  value="<?php echo e(isset($input['business_code']) ? $input['business_code'] : ''); ?>" name="business_code" placeholder="请输入商户标识" autocomplete="off" class="layui-input">
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
            <col class="hidden-xs" width="150">
            <col class="hidden-xs" width="150">
            <col class="hidden-xs" width="150">
            <col class="hidden-xs" width="150">
            <col class="hidden-xs" width="150">
            <col class="hidden-xs" width="150">
        </colgroup>
        <thead>
        <tr>
            <th class="hidden-xs">序号</th>
            <th class="hidden-xs">商户标识</th>
            <th class="hidden-xs">商户昵称</th>
            <th class="hidden-xs">商户电话</th>
            <th class="hidden-xs">商户费率</th>
            <th class="hidden-xs">商户余额</th>
            <th class="hidden-xs">成功率</th>
            <th class="hidden-xs">收款总额</th>
            <th class="hidden-xs">实收金额(扣除费率)</th>
            <th class="hidden-xs">提现总额</th>
            <th class="hidden-xs">提现实际到账总额</th>
            <th class="hidden-xs">收获盈利</th>            
        </tr>
        </thead>
        <tbody>
        <?php $__currentLoopData = $list; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $info): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <tr>
                <td class="hidden-xs"><?php echo e($info['id']); ?></td>
                <td class="hidden-xs"><?php echo e($info['business_code']); ?></td>
                <td class="hidden-xs"><?php echo e($info['nickname']); ?></td>
                <td class="hidden-xs"><?php echo e($info['mobile']); ?></td>
                <td class="hidden-xs"><?php echo e($info['fee']*100); ?>%</td>
                <td class="hidden-xs"><?php echo e($info['balance']/100); ?></td>
                <td class="hidden-xs"><?php echo e($info['sucrate']); ?>%</td>
                <td class="hidden-xs"><?php echo e($info['tol_sore']/100); ?></td>
                <td class="hidden-xs"><?php echo e($info['sore_balance']/100); ?></td>
                <td class="hidden-xs"><?php echo e($info['drawMoney']/100); ?></td>
                <td class="hidden-xs"><?php echo e($info['tradeMoney']/100); ?></td>
                <td class="hidden-xs"><?php echo e(($info['tol_sore']-$info['sore_balance'])/100); ?></td>               
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