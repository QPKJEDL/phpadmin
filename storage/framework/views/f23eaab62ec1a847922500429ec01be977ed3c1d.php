<?php $__env->startSection('title', '代理商'); ?>
<?php $__env->startSection('header'); ?>
    <div class="layui-inline">
    <button class="layui-btn layui-btn-small layui-btn-warm freshBtn"><i class="layui-icon">&#x1002;</i></button>
    </div>
    <div class="layui-inline">
        <input type="text" value="<?php echo e(isset($input['agent_id']) ? $input['agent_id'] : ''); ?>" name="agent_id" placeholder="请输入代理商ID" autocomplete="off" class="layui-input">
    </div>
    <div class="layui-inline">
        <input type="text" value="<?php echo e(isset($input['order_sn']) ? $input['order_sn'] : ''); ?>" name="order_sn" placeholder="请输入提现单号" autocomplete="off" class="layui-input">
    </div>
    <div class="layui-inline">
        <input class="layui-input" name="creatime" placeholder="申请日期" onclick="layui.laydate({elem: this, festival: true})" value="<?php echo e(isset($input['creatime']) ? $input['creatime'] : ''); ?>" autocomplete="off">
    </div>
    <div class="layui-inline">
        <input class="layui-input" name="endtime" placeholder="审批日期" onclick="layui.laydate({elem: this, festival: true})" value="<?php echo e(isset($input['endtime']) ? $input['endtime'] : ''); ?>" autocomplete="off">
    </div>
    <div class="layui-inline">
        <button class="layui-btn layui-btn-normal" lay-submit lay-filter="formDemo">搜索</button>
    </div>
<?php $__env->stopSection(); ?>
<?php $__env->startSection('table'); ?>
    <table class="layui-table" lay-even lay-skin="nob">
        <input type="hidden" id="token" value="<?php echo e(csrf_token()); ?>">
        <colgroup>
            <col class="hidden-xs" width="50">
            <col class="hidden-xs" width="100">
            <col class="hidden-xs" width="100">
            <col class="hidden-xs" width="100">
            <col class="hidden-xs" width="100">
            <col class="hidden-xs" width="100">
            <col class="hidden-xs" width="100">
            <col class="hidden-xs" width="200">
            <col class="hidden-xs" width="200">
            <col class="hidden-xs" width="100">
            <col class="hidden-xs" width="100">
            <col class="hidden-xs" width="300">
        </colgroup>
        <thead>
        <tr>
            <th class="hidden-xs">序号</th>
            <th class="hidden-xs">代理商编号</th>
            <th class="hidden-xs">提现单号</th>
            <th class="hidden-xs">提现额度</th>
            <th class="hidden-xs">开户人</th>
            <th class="hidden-xs">开户行</th>
            <th class="hidden-xs">卡号</th>
            <th class="hidden-xs">申请时间</th>
            <th class="hidden-xs">审批时间</th>
            <th class="hidden-xs">状态</th>
            <th class="hidden-xs">备注</th>
            <th class="hidden-xs">操作</th>
        </tr>
        </thead>
        <tbody>
        <?php $__currentLoopData = $list; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $info): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <tr>
                <td class="hidden-xs"><?php echo e($info['id']); ?></td>
                <td class="hidden-xs"><?php echo e($info['agent_id']); ?></td>
                <td class="hidden-xs"><?php echo e($info['order_sn']); ?></td>
                <td class="hidden-xs"><?php echo e($info['money']/100); ?></td>
                <td class="hidden-xs"><?php echo e($info['name']); ?></td>
                <td class="hidden-xs"><?php echo e($info['deposit_name']); ?></td>
                <td class="hidden-xs"><?php echo e($info['deposit_card']); ?></td>
                <td class="hidden-xs"><?php echo e($info['creatime']); ?></td>
                <td class="hidden-xs"><?php echo e($info['endtime']); ?></td>
                <td class="hidden-xs">
                    <?php if($info['status']==0): ?><span class="layui-btn layui-btn-small layui-btn-default">已驳回</span>
                    <?php elseif($info['status']==1): ?><span class="layui-btn layui-btn-small layui-btn-warm">已打款</span>
                    <?php elseif($info['status']==2): ?><span class="layui-btn layui-btn-small layui-btn-danger">确认驳回</span>
                    <?php endif; ?>
                </td>
                <td class="hidden-xs"><?php echo e(isset($info['remark']) ? $info['remark'] : '无备注'); ?></td>
                <td>
                    <div class="layui-inline">
                        <a class="layui-btn layui-btn-small layui-btn-normal"  onclick="edit(<?php echo e($info['id']); ?>)">编辑</a>
                        <?php if($info['status']==0): ?>
                            <button class="layui-btn layui-btn-small layui-btn-warm edits-btn1" data-id="<?php echo e($info['order_sn']); ?>" data-desc="确认打款">确认打款</button>
                            <button class="layui-btn layui-btn-small layui-btn-danger edits-btn2" data-id="<?php echo e($info['order_sn']); ?>" data-desc="确认驳回">确认驳回</button>
                        <?php endif; ?>
                    </div>
                </td>
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
            laydate({istoday: true});
            form.render();
            form.on('submit(formDemo)', function(data) {
            });
            //通过
            $('.edits-btn1').click(function () {
                var that = $(this);
                var order_sn=$(this).attr('data-id');
                layer.confirm('确定要打款？',{title:'提示'},function (index) {
                        $.ajax({
                            headers: {
                                'X-CSRF-TOKEN': $('#token').val()
                            },
                            url:"<?php echo e(url('/admin/agentdrawreject/pass')); ?>",
                            data:{
                                "order_sn":order_sn,
                            },
                            type:"post",
                            dataType:"json",
                            success:function (res) {
                                if(res.status==1){
                                    layer.msg(res.msg,{icon:6});
                                    location.reload();
                                }else{
                                    layer.msg(res.msg,{shift: 6,icon:5});
                                    location.reload();
                                }
                            }
                        });
                    }
                );
            });
            //驳回
            $('.edits-btn2').click(function () {
                var that = $(this);
                var order_sn=$(this).attr('data-id');
                layer.confirm('确定要驳回吗？',{title:'提示'},function (index) {
                        $.ajax({
                            headers: {
                                'X-CSRF-TOKEN': $('#token').val()
                            },
                            url:"<?php echo e(url('/admin/agentdrawreject/reject')); ?>",
                            data:{
                                "order_sn":order_sn,
                            },
                            type:"post",
                            dataType:"json",
                            success:function (res) {
                                if(res.status==1){
                                    layer.msg(res.msg,{icon:6});
                                    location.reload();
                                }else{
                                    layer.msg(res.msg,{shift: 6,icon:5});
                                    location.reload();
                                }
                            }
                        });
                    }
                );
            });
        });
        function edit(id) {
            var id=id;
            layer.open({
                type: 2,
                title: '提现驳回',
                closeBtn: 1,
                area: ['500px','700px'],
                shadeClose: false, //点击遮罩关闭
                content: ['/admin/agentdrawreject/editreject/'+id],
                end:function(){

                }
            });
        }
    </script>
<?php $__env->stopSection(); ?>


<?php echo $__env->make('common.list', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>