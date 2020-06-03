<?php $__env->startSection('title', '代理商列表'); ?>
<?php $__env->startSection('header'); ?>
    <div class="layui-inline">
    <button class="layui-btn layui-btn-small layui-btn-normal addBtn" data-desc="添加代理商" data-url="<?php echo e(url('/admin/agent/0/edit')); ?>"><i class="layui-icon">&#xe654;</i></button>
    <button class="layui-btn layui-btn-small layui-btn-warm freshBtn"><i class="layui-icon">&#x1002;</i></button>
    </div>
    <div class="layui-inline">
        <input type="text"  value="<?php echo e(isset($input['id']) ? $input['id'] : ''); ?>" name="id" placeholder="请输入代理商ID" autocomplete="off" class="layui-input">
    </div>
    <div class="layui-inline">
        <input type="text"  value="<?php echo e(isset($input['account']) ? $input['account'] : ''); ?>" name="account" placeholder="请输入代理商账号" autocomplete="off" class="layui-input">
    </div>
    <div class="layui-inline">
        <input type="text"  value="<?php echo e(isset($input['agent_name']) ? $input['agent_name'] : ''); ?>" name="agent_name" placeholder="请输入代理商昵称" autocomplete="off" class="layui-input">
    </div>
    <div class="layui-inline">
        <input type="text"  value="<?php echo e(isset($input['creatime']) ? $input['creatime'] : ''); ?>" name="creatime" placeholder="创建时间" onclick="layui.laydate({elem: this, festival: true,min:'<?php echo e($min); ?>'})" autocomplete="off" class="layui-input">
    </div>
    <div class="layui-inline">
        <button class="layui-btn layui-btn-normal" lay-submit lay-filter="formDemo1">搜索</button>
    </div>
<?php $__env->stopSection(); ?>
<?php $__env->startSection('table'); ?>
    <table class="layui-table" lay-even lay-skin="nob">
        <colgroup>
            <col class="hidden-xs" width="50">
            <col class="hidden-xs" width="100">
            <col class="hidden-xs" width="100">
            <col class="hidden-xs" width="100">    
            <col class="hidden-xs" width="150">
            <col class="hidden-xs" width="150">
            <col class="hidden-xs" width="150">
            <col class="hidden-xs" width="250">
        </colgroup>
        <thead>
        <tr>
            <th class="hidden-xs">ID</th>
            <th class="hidden-xs">帐号</th>
            <th class="hidden-xs">代理商昵称</th>
            <th class="hidden-xs">联系电话</th>
            <th class="hidden-xs">登录</th>
            <th class="hidden-xs">创建时间</th>
            <th class="hidden-xs">更新时间</th>
            <th class="hidden-xs" style="text-align: center">操作</th>
        </tr>
        </thead>
        <tbody>
        <?php $__currentLoopData = $list; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $info): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <tr>
                <td class="hidden-xs"><?php echo e($info['id']); ?></td>
                <td class="hidden-xs"><?php echo e($info['account']); ?></td>
                <td class="hidden-xs"><?php echo e($info['agent_name']); ?></td>
                <td class="hidden-xs"><?php echo e($info['mobile']); ?></td>
                <td class="hidden-xs">
                    <input type="checkbox" name="is_login" value="<?php echo e($info['id']); ?>" lay-skin="switch" lay-text="允许|禁止" lay-filter="is_login" <?php echo e($info['is_login'] == 1 ? 'checked' : ''); ?>>
                </td>
                <td class="hidden-xs"><?php echo e($info['creatime']); ?></td>
                <td class="hidden-xs"><?php echo e($info['updatetime']); ?></td>
                <td style="text-align: center">
                    <div class="layui-inline">
                        <button class="layui-btn layui-btn-small layui-btn-normal edit-btn" data-id="<?php echo e($info['id']); ?>" data-desc="编辑代理商" data-url="<?php echo e(url('/admin/agent/'. $info['id'] .'/edit')); ?>">编辑</button>
                        <a class="layui-btn layui-btn-small layui-btn-normal" onclick="bank(<?php echo e($info['id']); ?>)">银行</a>
                        <a class="layui-btn layui-btn-small layui-btn-danger" onclick="editpwd(<?php echo e($info['id']); ?>)">登录密码</a>
                        <a class="layui-btn layui-btn-small layui-btn-warm" onclick="editpayword(<?php echo e($info['id']); ?>)">支付密码</a>
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
            //监听开关操作
            form.on('switch(status)', function(obj){
                //layer.tips(this.value + ' ' + this.name + '：'+ obj.elem.checked, obj.othis);
                var id=this.value,
                    status=obj.elem.checked;
                if(status==false){
                    var aswitch=0;
                }else if(status==true){
                    aswitch=1;
                }
                $.ajax({
                    headers: {
                        'X-CSRF-TOKEN': $('#token').val()
                    },
                    url:"<?php echo e(url('/admin/agent_switch')); ?>",
                    data:{
                        id:id,
                        aswitch:aswitch
                    },
                    type:'post',
                    dataType:'json',
                    success:function(res){
                        if(res.status == 1){
                            layer.msg(res.msg,{icon:6,time:1000},function () {
                                location.reload();
                            });

                        }else{
                            layer.msg(res.msg,{icon:5,time:1000});
                        }
                    },
                    error : function(XMLHttpRequest, textStatus, errorThrown) {
                        layer.msg('网络失败', {time: 1000});
                    }
                });
            });
            //允许登录
            form.on('switch(is_login)', function(obj){
                //layer.tips(this.value + ' ' + this.name + '：'+ obj.elem.checked, obj.othis);
                var id=this.value,
                    status=obj.elem.checked;
                if(status==false){
                    var login=0;
                }else if(status==true){
                    login=1;
                }
                $.ajax({
                    headers: {
                        'X-CSRF-TOKEN': $('#token').val()
                    },
                    url:"<?php echo e(url('/admin/agent_islogin')); ?>",
                    data:{
                        id:id,
                        login:login
                    },
                    type:'post',
                    dataType:'json',
                    success:function(res){
                        if(res.status == 1){
                            layer.msg(res.msg,{icon:6,time:1000},function () {
                                location.reload();
                            });

                        }else{
                            layer.msg(res.msg,{icon:5,time:1000});
                        }
                    },
                    error : function(XMLHttpRequest, textStatus, errorThrown) {
                        layer.msg('网络失败', {time: 1000});
                    }
                });
            });
        });
        function bank(id) {
            var id=id;
            layer.open({
                type: 2,
                title: '银行信息',
                closeBtn: 1,
                area: ['500px','600px'],
                shadeClose: false, //点击遮罩关闭
                content: ['/admin/agent/agentbankinfo/'+id],
                end:function(){

                }
            });
        }

        function editpwd(id) {
            var id=id;
            layer.open({
                type: 2,
                title: '修改登录密码',
                closeBtn: 1,
                area: ['500px','500px'],
                shadeClose: false, //点击遮罩关闭
                resize:false,
                content: ['/admin/agent/editpwd/'+id,'no'],
                end:function(){

                }
            });
        }
        function editpayword(id) {
            var id=id;
            layer.open({
                type: 2,
                title: '修改支付密码',
                closeBtn: 1,
                area: ['500px','500px'],
                shadeClose: false, //点击遮罩关闭
                resize:false,
                content: ['/admin/agent/editpayword/'+id,'no'],
                end:function(){

                }
            });
        }
    </script>
<?php $__env->stopSection(); ?>


<?php echo $__env->make('common.list', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>