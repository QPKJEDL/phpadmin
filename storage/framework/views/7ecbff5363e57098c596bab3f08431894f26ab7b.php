<?php $__env->startSection('title', '订单管理'); ?>
<?php $__env->startSection('header'); ?>
    <div class="layui-inline">
        <button class="layui-btn layui-btn-small layui-btn-normal" id="addDesk" data-desc="添加桌台" data-url="<?php echo e(url('/admin/desk/0/edit')); ?>"><i class="layui-icon">&#xe654;</i></button>
        <button class="layui-btn layui-btn-small layui-btn-warm freshBtn"><i class="layui-icon">&#x1002;</i></button>
    </div>
    <div class="layui-inline">
        <select name="game_id" lay-filter="game_id" lay-verify="game_id">
            <option value="">请选择游戏类型</option>
            <?php $__currentLoopData = $gameType; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $game): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <option value="<?php echo e($game['id']); ?>" <?php echo e(isset($input['game_id'])&&$input['game_id']==$game['id']?'selected':''); ?>><?php echo e($game['game_name']); ?></option>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        </select>
    </div>
    <div class="layui-inline">
        <select name="is_alive" lay-filter="is_alive" lay-verify="is_alive">
            <option value="">请选择房间类型</option>
            <option value="0" <?php echo e(isset($input['is_alive'])&&$input['is_alive']==0?'selected':''); ?>>是</option>
            <option value="1" <?php echo e(isset($input['is_alive'])&&$input['is_alive']==1?'selected':''); ?>>否</option>
        </select>
    </div>
    <div class="layui-inline">
        <select name="is_push" lay-filter="is_push" lay-verify="is_push">
            <option value="">是否推送</option>
            <option value="0" <?php echo e(isset($input['is_push'])&&$input['is_push']==0?'selected':''); ?>>点击</option>
            <option value="1" <?php echo e(isset($input['is_push'])&&$input['is_push']==1?'selected':''); ?>>电话</option>
        </select>
    </div>
    <div class="layui-inline">
        <button class="layui-btn layui-btn-normal" lay-submit lay-filter="formDemo">搜索</button>
    </div>
<?php $__env->stopSection(); ?>
<?php $__env->startSection('table'); ?>
    <table class="layui-table" lay-even lay-skin="nob">
        <colgroup>
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
            <col class="hidden-xs" width="100">
        </colgroup>
        <thead>
        <tr>
            <th class="hidden-xs">序号</th>
            <th class="hidden-xs">名称</th>
            <th class="hidden-xs">台桌登录ip限制</th>
            <th class="hidden-xs">台桌推送</th>
            <td class="hidden-xs">视频状态</td>
            <th class="hidden-xs">最小限红<br/>(平倍最小平倍)</th>
            <th class="hidden-xs">最小和限红</th>
            <th class="hidden-xs">最小对限红</th>
            <th class="hidden-xs">最大限红</th>
            <th class="hidden-xs">最大和限红</th>
            <th class="hidden-xs">最大对限红</th>
            <th class="hidden-xs">主播台</th>
            <th class="hidden-xs">倒计时</th>
            <th class="hidden-xs">待开牌时间</th>
            <th class="hidden-xs" style="text-align: center">操作</th>
        </tr>
        </thead>
        <tbody>
        <?php $__currentLoopData = $list; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $info): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <tr>
                <td class="hidden-xs"><?php echo e($info['id']); ?></td>
                <td class="hidden-xs"><?php echo e($info['desk_name']); ?>[<?php echo e($info['game_name']); ?>]</td>
                <td class="hidden-xs"><?php echo e($info['ip_limit']); ?></td>
                <td class="hidden-xs">
                    <?php if($info['is_push']==0): ?>
                        <button type="button" class="layui-btn layui-btn-xs layui-btn-normal">点击</button>
                    <?php else: ?>
                        <button type="button" class="layui-btn layui-btn-xs layui-btn-normal">电话</button>
                    <?php endif; ?>
                </td>
                <td class="hidden-xs">
                    <?php if($info['status']==0): ?>
                        正常
                    <?php else: ?>
                        关闭
                    <?php endif; ?>
                </td>
                <td class="hidden-xs"><?php echo e($info['min_limit']['c']); ?>/<?php echo e($info['min_limit']['cu']); ?><br><?php echo e($info['min_limit']['p']); ?>$<?php echo e($info['min_limit']['pu']); ?></td>
                <td class="hidden-xs"><?php echo e($info['min_tie_limit']['c']); ?>/<?php echo e($info['min_tie_limit']['cu']); ?><br><?php echo e($info['min_tie_limit']['p']); ?>$<?php echo e($info['min_tie_limit']['pu']); ?></td>
                <td class="hidden-xs"><?php echo e($info['min_pair_limit']['c']); ?>/<?php echo e($info['min_pair_limit']['cu']); ?><br><?php echo e($info['min_pair_limit']['p']); ?>$<?php echo e($info['min_pair_limit']['pu']); ?></td>
                <td class="hidden-xs"><?php echo e($info['max_limit']['c']); ?>/<?php echo e($info['max_limit']['cu']); ?><br><?php echo e($info['max_limit']['p']); ?>$<?php echo e($info['max_limit']['pu']); ?></td>
                <td class="hidden-xs"><?php echo e($info['max_tie_limit']['c']); ?>/<?php echo e($info['max_tie_limit']['cu']); ?><br><?php echo e($info['max_tie_limit']['p']); ?>$<?php echo e($info['max_tie_limit']['pu']); ?></td>
                <td class="hidden-xs"><?php echo e($info['max_pair_limit']['c']); ?>/<?php echo e($info['max_pair_limit']['cu']); ?><br><?php echo e($info['max_pair_limit']['p']); ?>$<?php echo e($info['max_pair_limit']['pu']); ?></td>
                <td class="hidden-xs">
                    <?php if($info['is_alive']==0): ?>
                        <button type="button" class="layui-btn layui-btn-xs layui-btn-normal">是</button>
                    <?php else: ?>
                        <button type="button" class="layui-btn layui-btn-xs layui-btn-normal">否</button>
                    <?php endif; ?></td>
                <td class="hidden-xs"><?php echo e($info['count_down']); ?></td>
                <td class="hidden-xs"><?php echo e($info['wait_down']); ?></td>
                <td style="text-align: center">
                    <div class="layui-inline">
                        <button class="layui-btn layui-btn-small layui-btn-normal update" data-id="<?php echo e($info['id']); ?>" data-desc="修改" data-url="<?php echo e(url('/admin/desk/'. $info['id'] .'/edit')); ?>">编辑</button>
                        <button class="layui-btn layui-btn-small layui-btn-danger changeStatus" data-id="<?php echo e($info['id']); ?>" data-v="1">停用</button>
                        <?php if($info['video_status']==0): ?>
                            <button class="layui-btn layui-btn-small layui-btn-danger" data-id="<?php echo e($info['id']); ?>" data-v="1">关视频</button>
                        <?php else: ?>
                            <button class="layui-btn layui-btn-small layui-btn-danger" data-id="<?php echo e($info['id']); ?>" data-v="0">开视频</button>
                        <?php endif; ?>
                        <button class="layui-btn layui-btn-small resetpwd" data-id="<?php echo e($info['id']); ?>">修改密码</button>
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
            //台桌停用
            $(".changeStatus").click(function () {
                var id = $(this).attr('data-id');
                var value= $(this).attr('data-v');
                layer.confirm('确定要操作吗？',function (index) {
                    $.ajax({
                        headers: {
                            'X-CSRF-TOKEN': $("#token").val()
                        },
                        url:"<?php echo e(url('/admin/changStatus')); ?>",
                        type:'post',
                        dataType:"json",
                        data:{
                            'id':id,
                            'status':value
                        },
                        success:function (res) {
                            if(res.status == 1){
                                layer.msg(res.msg,{icon:6},function () {
                                    /*parent.layer.close(index);
                                    window.parent.frames[1].location.reload();*/
                                    window.location.reload();
                                });

                            }else{
                                layer.msg(res.msg,{shift: 6,icon:5});
                            }
                        }
                    });
                });
            });
            //添加台桌
            $("#addDesk").click(function () {
                var url = $(this).attr("data-url");
                var index = layer.open({
                    type :2,
                    title:'添加台桌',
                    fix: false,
                    id:'TWork',
                    content:url,
                    area: ['800px', '600px'],//宽高不影响最大化
                    //不固定
                    maxmin: true,
                    shade:0.3,
                    time:0,
                    //弹层外区域关闭
                    shadeClose:true,
                })
                layer.full(index);
                return false
            });
            $(".update").click(function () {
                var url = $(this).attr("data-url");
                var index = layer.open({
                    type :2,
                    title:'修改台桌',
                    fix: false,
                    id:'TWor1k',
                    content:url,
                    area: ['800px', '600px'],//宽高不影响最大化
                    //不固定
                    maxmin: true,
                    shade:0.3,
                    time:0,
                    //弹层外区域关闭
                    shadeClose:true,
                })
                layer.full(index);
                return false
            });
            $(".resetpwd").click(function () {
                var id = $(this).attr('data-id');
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
                                url:"<?php echo e(url('/admin/resetPassword')); ?>",
                                data:{
                                    "id":id,
                                    "password":pwd
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
        });
    </script>
<?php $__env->stopSection(); ?>


<?php echo $__env->make('common.list', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>