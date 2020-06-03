<?php $__env->startSection('title', '支付密码'); ?>
<?php $__env->startSection('content'); ?>
    <div class="layui-form-item">
        <label class="layui-form-label">代理商：</label>
        <div class="layui-input-block">
            <input type="text" value="<?php echo e(isset($info['agent_name']) ? $info['agent_name'] : ''); ?>" name="agent_name" disabled class="layui-input">
        </div>
    </div>

    <div class="layui-form-item">
        <label class="layui-form-label">账号：</label>
        <div class="layui-input-block">
            <input type="text" value="<?php echo e(isset($info['account']) ? $info['account'] : ''); ?>" name="account" disabled class="layui-input">
        </div>
    </div>

    <div class="layui-form-item">
        <label class="layui-form-label">支付密码：</label>
        <div class="layui-input-block">
            <input type="password"  name="pay_pass" required placeholder="请输入支付密码（6位纯数字）" autocomplete="off" class="layui-input">
        </div>
    </div>

    <div class="layui-form-item">
        <label class="layui-form-label">确认密码：</label>
        <div class="layui-input-block">
            <input type="password" required lay-verify="confirmPass" placeholder="请确认支付密码" autocomplete="off" class="layui-input">
        </div>
    </div>

<?php $__env->stopSection(); ?>
<?php $__env->startSection('id',$id); ?>
<?php $__env->startSection('js'); ?>
    <script>
        layui.use(['form','jquery','laypage', 'layer'], function() {
            var form = layui.form(),
                layer = layui.layer,
                $ = layui.jquery;
            form.render();
            var id = $("input[name='id']").val();
            var index = parent.layer.getFrameIndex(window.name);

            form.verify({
                confirmPass:function(value){
                    if($('input[name=pay_pass]').val() !== value)
                        return '两次密码输入不一致！';
                    var reg1 = new RegExp("^\\d{6}$");
                    if(!reg1.test(value)){
                        return '密码为6位纯数字';
                    }
                },
            });

            form.on('submit(formDemo)', function(data) {
                $.ajax({
                    url:"<?php echo e(url('/admin/changepayword')); ?>",
                    data:$('form').serialize(),
                    type:'post',
                    dataType:'json',
                    success:function(res){
                        if(res.status == 1){
                            layer.msg(res.msg,{icon:6},function () {
                                parent.layer.close(index);
                                window.parent.frames[1].location.reload();
                            });

                        }else{
                            layer.msg(res.msg,{shift: 6,icon:5});
                        }
                    },
                    error : function(XMLHttpRequest, textStatus, errorThrown) {
                        layer.msg('网络失败', {time: 1000});
                    }
                });
                return false;
            });

        });
    </script>
<?php $__env->stopSection(); ?>


<?php echo $__env->make('common.edit', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>