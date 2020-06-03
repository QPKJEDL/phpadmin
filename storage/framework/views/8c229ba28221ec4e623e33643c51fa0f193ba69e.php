<?php $__env->startSection('title', '订单管理'); ?>
<?php $__env->startSection('header'); ?>
    <div class="layui-inline">
        <button class="layui-btn layui-btn-small layui-btn-warm freshBtn"><i class="layui-icon">&#x1002;</i></button>
    </div>
    
<?php $__env->stopSection(); ?>
<?php $__env->startSection('table'); ?>
    <table class="layui-table" lay-even lay-skin="nob">
        <input type="hidden" name="_token" value="<?php echo csrf_token(); ?>">
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
        </colgroup>
        <thead>
        <tr>
            <th class="hidden-xs">序号</th>
            <th class="hidden-xs">登录账号</th>
            <th class="hidden-xs">真实姓名</th>
            <th class="hidden-xs">手机号</th>
            <th class="hidden-xs">状态</th>
            <th class="hidden-xs">银行卡名称</th>
            <th class="hidden-xs">银行卡号</th>
             <th class="hidden-xs">注册IP</th>
            <th class="hidden-xs">上次登录IP</th>
            <th class="hidden-xs">创建时间</th>
            <th class="hidden-xs">修改时间</th>
            <th class="hidden-xs" style="text-align: center">操作</th>
        </tr>
        </thead>
        <tbody>
        <?php $__currentLoopData = $list; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $info): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <tr>
                <td class="hidden-xs"><?php echo e($info['user_id']); ?></td>
                <td class="hidden-xs"><?php echo e($info['account']); ?></td>
                <td class="hidden-xs"><?php echo e($info['nickname']); ?></td>
                <td class="hidden-xs"><?php echo e($info["mobile"]); ?></td>
                <td class="hidden-xs"><?php echo e($info['is_over']); ?></td>
                <td class="hidden-xs"><?php echo e($info['bank_name']); ?></td>
                <td class="hidden-xs"><?php echo e($info['bank_card']); ?></td>
                <td class="hidden-xs"><?php echo e($info['reg_ip']); ?></td>
                <td class="hidden-xs"><?php echo e($info['last_ip']); ?></td>
                <td class="hidden-xs"><?php echo e($info['creatime']); ?></td>
                <td class="hidden-xs"><?php echo e($info['savetime']); ?></td>
                <td style="text-align: center">
                    <div class="layui-inline">
                        <button class="layui-btn layui-btn-small layui-btn-normal restPwd" data-id="<?php echo e($info['user_id']); ?>" data-desc="修改密码">修改密码</button>

                        <?php if($info['is_over']==0): ?>
                            <button class="layui-btn layui-btn-small layui-btn-danger seal" data-id="<?php echo e($info['user_id']); ?>" data-status="1">封禁</button>
                        <?php else: ?>
                            <button class="layui-btn layui-btn-small layui-btn-danger solution" data-id="<?php echo e($info['user_id']); ?>" data-status="0">解除</button>
                        <?php endif; ?>
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
            //修改密码
            $(".restPwd").click(function () {
                var userId = $(this).attr('data-id');
                layer.prompt({title: '请输入密码', formType: 1}, function(pass, index){
                    layer.close(index);
                    layer.prompt({title: '请再输入密码', formType: 1}, function(pwd, index){
                        layer.close(index);
                        if(pass!=pwd){
                            layer.msg('两次密码输入不同！');
                        }else{
                            $.ajaxSetup({
                                headers: {
                                    'X-CSRF-TOKEN': $('input[name="_token"]').val()
                                }
                            });
                            $.ajax({
                                url:"<?php echo e(url('/admin/resetPwd')); ?>",
                                data:{
                                    "user_id":userId,
                                    "pwd":pwd
                                },
                                type:"post",
                                dataType:"json",
                                success:function (res) {
                                    if(res.status==1){
                                        layer.msg(res.msg,{icon:6},function () {
                                            parent.layer.close(index);
                                            window.parent.frames[1].location.reload();
                                        });
                                    }else{
                                        layer.msg(res.msg,{shift: 6,icon:5});
                                    }
                                }
                            });
                        }
                    });
                });
            });
            //封禁
            $(".seal").click(function () {
                var userId = $(this).attr('data-id');
                var status = $(this).attr('data-status');
                layer.confirm('确定要封禁吗？',function (index) {
                    $.ajaxSetup({
                        headers: {
                            'X-CSRF-TOKEN': $('input[name="_token"]').val()
                        }
                    });
                    $.ajax({
                        url:"<?php echo e(url('/admin/isLogin')); ?>",
                        data:{
                            "userId":userId,
                            "status":status
                        },
                        type:'post',
                        dataType: "json",
                        success:function (res) {
                            if(res.status==1){
                                layer.msg(res.msg,{icon:6},function () {
                                    parent.layer.close(index);
                                    window.parent.frames[1].location.reload();
                                });
                            }else{
                                layer.msg(res.msg,{shift: 6,icon:5});
                            }
                        }
                    });
                    layer.close(index);
                });
            });
            //解禁
            $('.solution').click(function () {
                var userId = $(this).attr('data-id');
                var status = $(this).attr('data-status');
                layer.confirm('确定要封禁吗？',function (index) {
                    $.ajaxSetup({
                        headers: {
                            'X-CSRF-TOKEN': $('input[name="_token"]').val()
                        }
                    });
                    $.ajax({
                        url:"<?php echo e(url('/admin/isLogin')); ?>",
                        data:{
                            "userId":userId,
                            "status":status
                        },
                        type:'post',
                        dataType: "json",
                        success:function (res) {
                            if(res.status==1){
                                layer.msg(res.msg,{icon:6},function () {
                                    parent.layer.close(index);
                                    window.parent.frames[1].location.reload();
                                });
                            }else{
                                layer.msg(res.msg,{shift: 6,icon:5});
                            }
                        }
                    });
                    layer.close(index);
                });
            });
        });
    </script>
<?php $__env->stopSection(); ?>


<?php echo $__env->make('common.list', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>