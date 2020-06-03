<?php $__env->startSection('title', '订单管理'); ?>
<?php $__env->startSection('header'); ?>
    <div class="layui-inline">
        <button class="layui-btn layui-btn-small layui-btn-warm freshBtn"><i class="layui-icon">&#x1002;</i></button>
    </div>
    <div class="layui-inline">
        <input type="text"  value="<?php echo e(isset($input['business_code']) ? $input['business_code'] : ''); ?>" name="business_code" placeholder="请输入商户号" autocomplete="off" class="layui-input">
    </div>
    <div class="layui-inline">
        <input type="text"  value="<?php echo e(isset($input['order_sn']) ? $input['order_sn'] : ''); ?>" name="order_sn" placeholder="请输入平台订单号" autocomplete="off" class="layui-input">
    </div>
    <div class="layui-inline">
        <input type="text"  value="<?php echo e(isset($input['out_order_sn']) ? $input['out_order_sn'] : ''); ?>" name="out_order_sn" placeholder="请输入商户订单号" autocomplete="off" class="layui-input">
    </div>
    <div class="layui-inline">
        <input type="text"  value="<?php echo e(isset($input['user_id']) ? $input['user_id'] : ''); ?>" name="user_id" placeholder="请输入码商号" autocomplete="off" class="layui-input">
    </div>









    <div class="layui-inline">
        <input type="text"  value="<?php echo e(isset($input['creatime']) ? $input['creatime'] : ''); ?>" name="creatime" placeholder="创建时间" onclick="layui.laydate({elem: this, festival: true,min:'<?php echo e($min); ?>'})" autocomplete="off" class="layui-input">
    </div>
    <div class="layui-inline">
        <button class="layui-btn layui-btn-normal" lay-submit lay-filter="formDemo">搜索</button>
        <button id="res" class="layui-btn layui-btn-primary">重置</button>
    </div>
    <div class="layui-inline">
        <button class="layui-btn layui-btn-warm" name="excel" value="excel" lay-submit lay-filter="formDemo">导出EXCEL</button>
    </div>
<?php $__env->stopSection(); ?>
<?php $__env->startSection('table'); ?>
    <table class="layui-table" lay-even lay-skin="nob">
        <colgroup>
            <col class="hidden-xs" width="100">
            <col class="hidden-xs" width="200">
            <col class="hidden-xs" width="100">
            <col class="hidden-xs" width="100">
            <col class="hidden-xs" width="100">
            <col class="hidden-xs" width="150">
            <col class="hidden-xs" width="150">
            <col class="hidden-xs" width="150">
            <col class="hidden-xs" width="150">
            <col class="hidden-xs" width="100">
            <col class="hidden-xs" width="100">
            <col class="hidden-xs" width="100">
            <col class="hidden-xs" width="100">
            <col class="hidden-xs" width="100">
            <col class="hidden-xs" width="250">
            <col class="hidden-xs" width="300">
        </colgroup>
        <thead>
        <tr>
            <th class="hidden-xs">序号</th>
            <th class="hidden-xs">商户标识</th>
            <th class="hidden-xs">平台订单号</th>
            <th class="hidden-xs">商户订单号</th>
            <th class="hidden-xs">码商ID</th>
            <th class="hidden-xs">码商状态</th>            
            <th class="hidden-xs">码商收款</th>
            <th class="hidden-xs">二维码ID</th>
            <th class="hidden-xs">订单金额</th>
            <th class="hidden-xs">收款金额</th>            
            <th class="hidden-xs">支付类型</th>
            <th class="hidden-xs">支付状态</th>
            <th class="hidden-xs">回调次数</th>
            <th class="hidden-xs">回调状态</th>
            <th class="hidden-xs">创建时间</th>
            <th class="hidden-xs" style="text-align: center">操作</th>
        </tr>
        </thead>
        <tbody>
        <?php $__currentLoopData = $list; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $info): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <tr>
                <td class="hidden-xs"><?php echo e($info['id']); ?></td>
                <td class="hidden-xs"><?php echo e($info['business_code']); ?></td>
                <td class="hidden-xs"><?php echo e($info['order_sn']); ?></td>
                <td class="hidden-xs"><?php echo e($info['out_order_sn']); ?></td>
                <td class="hidden-xs"><?php echo e($info['user_id']); ?></td>
                <td class="hidden-xs">
                    <?php if($info['dj_status']==0): ?><span class="layui-btn layui-btn-small layui-btn-danger">资金冻结</span>
                    <?php elseif($info['dj_status']==1): ?><span class="layui-btn layui-btn-small layui-btn-warm">资金解冻</span>
                    <?php elseif($info['dj_status']==2): ?><span span class="layui-btn layui-btn-small layui-btn">资金扣除</span>
                    <?php endif; ?>
                </td>                  
                <td class="hidden-xs">
                    <?php if($info['sk_status']==0): ?><span class="layui-btn layui-btn-small layui-btn-danger">未收款</span>
                    <?php elseif($info['sk_status']==1): ?><span class="layui-btn layui-btn-small">手动收款</span>
                    <?php elseif($info['sk_status']==2): ?><span span class="layui-btn layui-btn-small layui-btn-warm">自动收款</span>
                    <?php endif; ?></td>
                <td class="hidden-xs"><?php echo e($info['erweima_id']); ?></td>               
                <td class="hidden-xs"><?php echo e($info['tradeMoney']/100); ?></td>
                <td class="hidden-xs"><?php echo e($info['sk_money']/100); ?></td>
                <td class="hidden-xs">
                    <?php if($info['payType']==0): ?><span class="layui-btn layui-btn-small layui-btn-primary">默认</span>
                    <?php elseif($info['payType']==1): ?><span class="layui-btn layui-btn-small">微信</span>
                    <?php elseif($info['payType']==2): ?><span class="layui-btn layui-btn-small layui-btn-normal">支付宝</span>
                    <?php endif; ?></td>
                <td class="hidden-xs">
                    <span class="layui-btn layui-btn-small layui-btn-danger">异常</span>
                </td>
                <td class="hidden-xs"><span class="layui-btn layui-btn-small layui-btn-warm">回调<?php echo e($info['callback_num']); ?>次</span></td>    
                <td class="hidden-xs">
                    <?php if($info['callback_status']==0): ?><span class="layui-btn layui-btn-small layui-btn-primary">未处理</span><?php elseif($info['callback_status']==1): ?><span span class="layui-btn layui-btn-small layui-btn-warm">推送成功</span><?php elseif($info['callback_status']==2): ?><span class="layui-btn layui-btn-small layui-btn-danger">推送失败</span>
                    <?php endif; ?>
                </td>
                <td class="hidden-xs"><?php echo e($info['creatime']); ?></td>
                <td style="text-align: center">
                    <div class="layui-inline">
                        <button class="layui-btn layui-btn-small layui-btn-normal edits-btn1" data-id="<?php echo e($info['order_sn']); ?>" data-desc="补单">补单</button>
                    </div>
                    <div class="layui-inline">
                        <button class="layui-btn layui-btn-small layui-btn-warm edits-btn2" data-id="<?php echo e($info['order_sn']); ?>" data-desc="手动冻结">手动冻结</button>
                    </div>
                </td>                
            </tr>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        <?php if(!$list[0]): ?>
            <tr><td colspan="6" style="text-align: center;color: orangered;">暂无数据</td></tr>
        <?php endif; ?>
        </tbody>
        <input type="hidden" id="token" value="<?php echo e(csrf_token()); ?>">
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
            $('#res').click(function () {
                $("input[name='business_code']").val('');
                $("input[name='order_sn']").val('');
                $("input[name='user_id']").val('');
                $("input[name='creatime']").val('');
                $("select[name='status']").val('');
                $('form').submit();
            });
            //补单
            $('.edits-btn1').click(function () {
                var that = $(this);
                var order_sn=that.attr('data-id');
                //console.log(order_sn);
                layer.confirm('确定要补单吗？',{title:'提示'},function (index) {
                        $.ajax({
                            headers: {
                                'X-CSRF-TOKEN': $('#token').val()
                            },
                            url:"<?php echo e(url('/admin/order/falsebudan')); ?>",
                            data:{
                                "order_sn":order_sn,
                            },
                            type:"post",
                            dataType:"json",
                            success:function (res) {
                                if(res.status==1){
                                    layer.msg(res.msg,{icon:6,time:1000},function () {
                                        location.reload();
                                    });
                                   
                                }else{
                                    layer.msg(res.msg,{icon:5,time:1000},function(){
                                         location.reload();
                                    });
                                   
                                }
                            }
                        });
                    }
                );
            });
            //手动冻结
            $('.edits-btn2').click(function () {
                var that = $(this);
                var order_sn=that.attr('data-id');
                //console.log(order_sn);
                layer.confirm('确定要补单吗？',{title:'提示'},function (index) {
                        $.ajax({
                            headers: {
                                'X-CSRF-TOKEN': $('#token').val()
                            },
                            url:"<?php echo e(url('/admin/order/jiedong')); ?>",
                            data:{
                                "order_sn":order_sn,
                            },
                            type:"post",
                            dataType:"json",
                            success:function (res) {
                                if(res.status==1){
                                    layer.msg(res.msg,{icon:6,time:1000},function () {
                                        location.reload();
                                    });
                                   
                                }else{
                                    layer.msg(res.msg,{icon:5,time:1000},function(){
                                         location.reload();
                                    });
                                   
                                }
                            }
                        });
                    }
                );
            });
        });
    </script>
<?php $__env->stopSection(); ?>


<?php echo $__env->make('common.list', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>