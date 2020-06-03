<?php $__env->startSection('title', '添加商户'); ?>
<?php $__env->startSection('content'); ?>
    <div class="layui-form-item">
        <label class="layui-form-label">商户名：</label>
        <div class="layui-input-block">
            <input type="text" value="<?php echo e(isset($info['nickname']) ? $info['nickname'] : ''); ?>" name="nickname" required lay-verify="nickname" placeholder="请输入商户名" autocomplete="off" class="layui-input" id="nickname">
        </div>
    </div>

    <div class="layui-form-item">
        <label class="layui-form-label">账号：</label>
        <div class="layui-input-block">
            <input type="text" value="<?php echo e(isset($info['account']) ? $info['account'] : ''); ?>" name="account" required lay-verify="account" placeholder="请输入账号(4-8位数字字母,字母开头)" autocomplete="off" class="layui-input" id="account">
        </div>
    </div>
    <?php if($id==0): ?>
    <div class="layui-form-item">
        <label class="layui-form-label">密码：</label>
        <div class="layui-input-block">
            <input type="password" value="<?php echo e(isset($info['password']) ? $info['password'] : ''); ?>" name="password" required placeholder="请输入密码(6-12数字字母)" autocomplete="off" class="layui-input">
        </div>
    </div>

    <div class="layui-form-item">
        <label class="layui-form-label">确认密码：</label>
        <div class="layui-input-block">
            <input type="password" value="<?php echo e(isset($info['password']) ? $info['password'] : ''); ?>" required lay-verify="confirmPass" placeholder="请确认密码" autocomplete="off" class="layui-input">
        </div>
    </div>
    <?php endif; ?>

    <div class="layui-form-item">
        <label class="layui-form-label">电话：</label>
        <div class="layui-input-block">
            <input type="text" value="<?php echo e(isset($info['mobile']) ? $info['mobile'] : ''); ?>" name="mobile" required lay-verify="tel" placeholder="请输入电话号码" autocomplete="off" class="layui-input">
        </div>
    </div>
    <div class="layui-form-item">
        <label class="layui-form-label">类型：</label>
        <div class="layui-input-block">
            <select name="paycode" lay-filter="status" lay-verify="status">
                <option value="">请选择一个内容</option>
                <option value="0" <?php echo e(isset($info['paycode'])&&$info['paycode']=='0'?'selected':''); ?>>默认</option>
                <option value="1" <?php echo e(isset($info['paycode'])&&$info['paycode']=='1'?'selected':''); ?>>微信商户</option>
                <option value="2" <?php echo e(isset($info['paycode'])&&$info['paycode']=='2'?'selected':''); ?>>支付宝商户</option>
            </select>
        </div>
    </div>
    <?php if($id==0): ?>
    <div class="layui-form-item">
        <label class="layui-form-label">商户费率：</label>
        <div class="layui-input-block">
            <input type="text" value="<?php echo e(isset($info['fee']) ? $info['fee'] : ''); ?>" name="fee" lay-verify="fee" placeholder="请输入商户费率" autocomplete="off" class="layui-input">
        </div>
    </div>
    <?php endif; ?>
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
                nickname:function(value){
                    if(value==null||value==''){
                        return '请填写昵称';
                    }
                    if(value.length>10){
                        return '昵称过长';
                    }
                },
                account:function(value){
                    if(value==null||value==''){
                        return '请填写账号';
                    }
                    var reg = new RegExp("^[A-Za-z][A-Za-z0-9]{3,7}$");
                    if(!reg.test(value)){
                        return '请正确填写账号';
                    }
                },
                confirmPass:function(value){
                    if($('input[name=password]').val() !== value)
                        return '两次密码输入不一致！';
                    var reg1 = new RegExp("^(?![0-9]+$)(?![a-zA-Z]+$)[0-9A-Za-z]{6,12}$");
                    if(!reg1.test(value)){
                        return '密码为6-12数字字母';
                    }
                },
                tel:function (value) {
                    if(value==null||value==''){
                        return '请填写正确手机号';
                    }
                    var reg = new RegExp("^1[34578]\\d{9}$");
                    if(!reg.test(value)){
                        return '请输入正确手机号';
                    }
                },

                fee:function (value) {
                    if(value==null||value==''){
                        return '请输入费率';
                    }
                    var reg = new RegExp("^[0-9]+(.?[0-9]{1,2})?$");
                    if(!reg.test(value)){
                        return '请输入正确费率';
                    }
                },
            });
            if(id==0){
                form.on('submit(formDemo)', function(data) {
                    $.ajax({
                        url:"<?php echo e(url('/admin/business')); ?>",
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
            }else{
                form.on('submit(formDemo)', function(data) {
                    $.ajax({
                        url:"<?php echo e(url('/admin/businessUpdate')); ?>",
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
            }

        });
    </script>
<?php $__env->stopSection(); ?>


<?php echo $__env->make('common.edit', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>