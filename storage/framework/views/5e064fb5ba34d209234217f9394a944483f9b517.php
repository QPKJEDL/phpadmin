<?php $__env->startSection('title', '商户流水'); ?>
<?php $__env->startSection('header'); ?>
    <div class="layui-inline">
    <button class="layui-btn layui-btn-small layui-btn-warm freshBtn"><i class="layui-icon">&#x1002;</i></button>
    </div>   
    <div class="layui-inline">
        <input type="text"  value="<?php echo e(isset($input['business_code']) ? $input['business_code'] : ''); ?>" name="business_code" placeholder="请输入商户标识" autocomplete="off" class="layui-input">
    </div>
     <div class="layui-inline">
        <input type="text"  value="<?php echo e(isset($input['order_sn']) ? $input['order_sn'] : ''); ?>" name="order_sn" placeholder="请输入订单号" autocomplete="off" class="layui-input">
    </div>
    <div class="layui-inline">
        <input type="text"  value="<?php echo e(isset($input['creatime']) ? $input['creatime'] : ''); ?>" name="creatime" placeholder="创建时间" onclick="layui.laydate({elem: this, festival: true,min:'<?php echo e($min); ?>'})" autocomplete="off" class="layui-input">
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
            <col class="hidden-xs" width="150">
            <col class="hidden-xs" width="150">
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
             <th class="hidden-xs">商户标识</th>
            <th class="hidden-xs">订单号</th>         
            <th class="hidden-xs">实际积分</th>
            <th class="hidden-xs">扣除后积分</th>
            <th class="hidden-xs">状态</th>
            <th class="hidden-xs">类型</th>
            <th class="hidden-xs">备注</th>
            <th class="hidden-xs">创建时间</th>
        </tr>
        </thead>
        <tbody>
        <?php $__currentLoopData = $list; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $info): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <tr>
                <td class="hidden-xs"><?php echo e($info['id']); ?></td>
                <td class="hidden-xs"><?php echo e($info['business_code']); ?></td>
                <td class="hidden-xs"><?php echo e($info['order_sn']); ?></td>               
                <td class="hidden-xs"><?php echo e($info['tradeMoney']/100); ?></td>
                 <td class="hidden-xs"><?php echo e($info['score']/100); ?></td>
                <td class="hidden-xs"><?php if($info['status']==0): ?><span class="layui-btn layui-btn-small layui-btn-primary">默认</span><?php elseif($info['status']==1): ?><span class="layui-btn layui-btn-small layui-btn-warm">支付</span><?php elseif($info['status']==2): ?><span class="layui-btn layui-btn-small layui-btn-danger">利润</span><?php endif; ?></td>
                <td class="hidden-xs"><?php if($info['paycode']==0): ?><span class="layui-btn layui-btn-small layui-btn-primary">默认</span><?php elseif($info['paycode']==1): ?><span class="layui-btn layui-btn-small">微信</span><?php elseif($info['paycode']==2): ?><span class="layui-btn layui-btn-small layui-btn-normal">支付宝</span><?php endif; ?></td>
                <td class="hidden-xs"><?php echo e($info['remark']); ?></td>
                <td class="hidden-xs"><?php echo e($info['creatime']); ?></td>
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