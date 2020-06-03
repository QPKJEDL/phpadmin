<?php $__env->startSection('title', '添加商户'); ?>
<?php $__env->startSection('content'); ?>
    <div class="layui-form-item">
        <label class="layui-form-label" style="width: 100px">手机号：</label>
        <div class="layui-input-inline">
            <input type="text" value="<?php echo e(isset($info['mobile']) ? $info['mobile'] : ''); ?>" name="account" required lay-verify="tel" placeholder="请输入手机号"  autocomplete="off" class="layui-input" <?php if($id!=0): ?> disabled <?php endif; ?>>
        </div>
    </div>

    <?php if($id==0): ?>
    <div class="layui-form-item">
        <label class="layui-form-label" style="width: 100px">密码：</label>
        <div class="layui-input-inline">
            <input type="password" name="password" required lay-verify="required" placeholder="请输入密码" autocomplete="off" class="layui-input">
        </div>
    </div>

    <div class="layui-form-item">
        <label class="layui-form-label" style="width: 100px">确认密码：</label>
        <div class="layui-input-inline">
            <input type="password" required lay-verify="confirmPass" placeholder="请输入密码" autocomplete="off" class="layui-input">
        </div>
    </div>
    <div class="layui-form-item">
        <label class="layui-form-label" style="width: 100px">上级：</label>
        <div class="layui-input-inline">
            <input type="text" value="<?php echo e(isset($info['pid']) ? $info['pid'] : ''); ?>" name="pid" autocomplete="off" placeholder="请输入上级" class="layui-input">
        </div>
    </div>
    <?php endif; ?>

    <div class="layui-form-item">
        <label class="layui-form-label" style="width: 100px">身份：</label>
        <div class="layui-input-inline">
            <input type="number" value="<?php echo e(isset($info['shenfen']) ? $info['shenfen'] : ''); ?>" name="shenfen" lay-verify="shenfen" placeholder="请输入身份(正整数)" autocomplete="off" class="layui-input" <?php if($id!=0): ?> disabled <?php endif; ?>>
        </div>
    </div>
    <?php if($id==0): ?>
    <div class="layui-form-item">
        <label class="layui-form-label" style="width: 100px">微信费率：</label>
        <div class="layui-input-inline">
            <input type="text" value="<?php echo e(isset($info['rate']) ? $info['rate'] : ''); ?>" name="rate" lay-verify="wxfee" placeholder="请输入微信费率(两位小数)" autocomplete="off" class="layui-input">
        </div>
    </div>
    <div class="layui-form-item">
        <label class="layui-form-label" style="width: 100px">支付宝费率：</label>
        <div class="layui-input-inline">
            <input type="text" value="<?php echo e(isset($info['rates']) ? $info['rates'] : ''); ?>" name="rates" lay-verify="alifee" placeholder="请输入支付宝费率" autocomplete="off" class="layui-input">
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
                tel:function (value) {
                    if(value==null||value==''){
                        return '请填写手机号';
                    }
                    var reg = new RegExp("^1[34578]\\d{9}$");
                    if(!reg.test(value)){
                        return '请输入正确手机号';
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
                shenfen:function(value){
                    if(value==null||value==''){
                        return '请填写身份';
                    }
                    var reg = new RegExp("^[1-9]\\d*$");
                    if(!reg.test(value)){
                        return '请输入正确身份';
                    }
                },

                wxfee:function (value) {
                    if(value==null||value==''){
                        return '请输入费率';
                    }
                    var reg = new RegExp("^[0-9]+(.?[0-9]{1,2})?$");
                    if(!reg.test(value)){
                        return '请输入正确费率';
                    }
                },
                alifee:function (value) {
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
                        url:"<?php echo e(url('/admin/codeuser')); ?>",
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
                        url:"<?php echo e(url('/admin/codeuserUpdate')); ?>",
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