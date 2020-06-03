<?php $__env->startSection('title', '配置列表'); ?>
<?php $__env->startSection('header'); ?>
    <div class="layui-inline">
        <a class="layui-btn layui-btn-small layui-btn-normal addBtn" data-desc="添加" data-url="<?php echo e(url('/admin/pay/0/edit')); ?>"><i class="layui-icon">&#xe654;</i></a>
        <button class="layui-btn layui-btn-small layui-btn-warm freshBtn"><i class="layui-icon">&#x1002;</i></button>
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
            <col class="hidden-xs" width="100">
            <col class="hidden-xs" width="100">
            <col class="hidden-xs" width="100">
            <col class="hidden-xs" width="100">
            <col class="hidden-xs" width="100">
            <col class="hidden-xs" width="100">
            <col class="hidden-xs" width="100">
            <col class="hidden-xs" width="100">
            <col class="hidden-xs" width="100">
        </colgroup>
        <thead>
        <tr>
            <th class="hidden-xs">序号</th>
            <th class="hidden-xs">商户id</th>
            <th class="hidden-xs">商户名称</th>
            <th class="hidden-xs">支付通道</th>
            <th class="hidden-xs">支付操作端</th>
            <th class="hidden-xs">最小充值限额</th>
            <th class="hidden-xs">最大充值限额</th>
            <th class="hidden-xs">服务名称</th>
            <th class="hidden-xs">支付平台</th>
            <th class="hidden-xs">页面通知地址</th>
            <th class="hidden-xs">异步通知地址</th>
            <th class="hidden-xs">密钥</th>
            <th class="hidden-xs">支付网关</th>
            <th class="hidden-xs">预支付链接</th>
            <th class="hidden-xs">是否直接跳转</th>
            <th class="hidden-xs">状态</th>
            <th class="hidden-xs">备注</th>
            <th class="hidden-xs">操作</th>
        </tr>
        </thead>
        <tbody>
        <?php $__currentLoopData = $list; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $info): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <td class="hidden-xs"><?php echo e($info['id']); ?></td>
            <td class="hidden-xs"><?php echo e($info['business_id']); ?></td>
            <td class="hidden-xs"><?php echo e($info['business_name']); ?></td>
            <td class="hidden-xs"><?php echo e($info['pay_aisle']); ?></td>
            <td class="hidden-xs"><?php echo e($info['operation_side']); ?></td>
            <td class="hidden-xs"><?php echo e($info['min_price']); ?></td>
            <td class="hidden-xs"><?php echo e($info['max_price']); ?></td>
            <td class="hidden-xs"><?php echo e($info['service_name']); ?></td>
            <td class="hidden-xs"><?php echo e($info['pay_type']); ?></td>
            <td class="hidden-xs"><?php echo e($info['page_notify_url']); ?></td>
            <td class="hidden-xs"><?php echo e($info['asyn_notify_url']); ?></td>
            <td class="hidden-xs"><?php echo e($info['access_key']); ?></td>
            <td class="hidden-xs"><?php echo e($info['pay_gateway']); ?></td>
            <td class="hidden-xs"><?php echo e($info['prepaid_link']); ?></td>
            <td class="hidden-xs">
                <?php if($info['is_jump']==0): ?>
                    是
                <?php else: ?>
                    否
                <?php endif; ?>
            </td>
            <td class="hidden-xs">
                <?php if($info['status']==0): ?>
                    正常
                <?php else: ?>
                    禁用
                <?php endif; ?>
            </td>
            <td class="hidden-xs"><?php echo e($info['remark']); ?></td>
            <td>
                <div class="layui-inline">
                    <button class="layui-btn layui-btn-small layui-btn-normal edit-btn" data-id="<?php echo e($info['id']); ?>" data-desc="修改配置" data-url="<?php echo e(url('/admin/pay/'. $info['id'] .'/edit')); ?>">编辑</button>
                    <button class="layui-btn layui-btn-small layui-btn-danger del-btn" data-id="<?php echo e($info['id']); ?>" data-url="<?php echo e(url('/admin/pay/'.$info['id'])); ?>">解禁</button>
                </div>
            </td>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        <?php if(!$list[0]): ?>
            <tr><td colspan="18" style="text-align: center;color: orangered;">暂无数据</td></tr>
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
            form.on('submit(formDemo)', function(data) {               
            });
            
        });
    </script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('common.list', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>