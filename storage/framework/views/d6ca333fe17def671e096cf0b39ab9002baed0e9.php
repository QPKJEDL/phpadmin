<?php $__env->startSection('title', '角色编辑'); ?>
<?php $__env->startSection('content'); ?>
    <div class="layui-form-item">
        <label class="layui-form-label">收款姓名：</label>
        <div class="layui-input-block">
            <input type="text" value="<?php echo e(isset($info['sk_name']) ? $info['sk_name'] : ''); ?>" name="sk_name" required lay-verify="sk_name" placeholder="请输入收款姓名" autocomplete="off" class="layui-input">
        </div>
    </div>

    <div class="layui-form-item">
        <label class="layui-form-label">收款卡号：</label>
        <div class="layui-input-block">
            <input type="text" value="<?php echo e(isset($info['sk_banknum']) ? $info['sk_banknum'] : ''); ?>" id="sk_banknum" name="sk_banknum" required lay-verify="sk_banknum" placeholder="请输入收款卡号" autocomplete="off" class="layui-input">
        </div>
    </div>

    <div class="layui-form-item">
        <label class="layui-form-label">收款银行：</label>
        <div class="layui-input-block">
            <input type="text" value="<?php echo e(isset($info['sk_bankname']) ? $info['sk_bankname'] : ''); ?>" id="sk_bankname" name="sk_bankname" required lay-verify="sk_bankname" placeholder="请输入收款银行" autocomplete="off" class="layui-input">
        </div>
    </div>
    <div class="layui-form-item">
        <label class="layui-form-label">通道：</label>
        <div class="layui-input-block">
            <input type="text" value="<?php echo e(isset($info['payway']) ? $info['payway'] : ''); ?>" name="payway" required lay-verify="payway" placeholder="请输入通道名称" autocomplete="off" class="layui-input">
        </div>
    </div>

    <div class="layui-form-item">
        <label class="layui-form-label">选择客服：</label>
        <div class="layui-input-block">
            <select name="admin_kefu_id" required lay-verify="kefu">
                <option value="">请选择客服</option>
                <?php $__currentLoopData = $kefu; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $call): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <option value="<?php echo e($call['id']); ?>" <?php if(isset($info['admin_kefu_id'])and$info['admin_kefu_id']==$call['id']): ?> selected <?php endif; ?>><?php echo e($call['username']); ?></option>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </select>
        </div>
    </div>
<?php $__env->stopSection(); ?>
<?php $__env->startSection('id',$id); ?>
<?php $__env->startSection('js'); ?>
    <script>
        layui.use(['form','jquery','laypage', 'layer'], function() {
            var form = layui.form(),
                $ = layui.jquery;
            var layer = layui.layer;
            form.render();
            var id = $("input[name='id']").val();
            var index = parent.layer.getFrameIndex(window.name);
            var banklist=<?php echo $banklist; ?>;//不转义字符
            //console.log(banklist);
            form.verify({
                sk_name:function (value) {
                    if(value==null||value==''){
                        return '请输入收款人姓名';
                    }                    
                },
                sk_banknum:function (value) {
                    if(value==null||value==''){
                        return '请输入收款卡号';
                    }                    
                },
                sk_bankname:function (value) {
                    if(value==null||value==''){
                        return '请输入收款银行';
                    }                   
                },
                payway:function (value) {
                    if(value==null||value==''){
                        return '请输入通道名称';
                    }                    
                },
                kefu:function (value) {
                    if(value==null||value==''){
                        return '请选择客服';
                    }                    
                },
            });
            $("#sk_banknum").blur(function(){
                var value=$(this).val();
                $.post("https://ccdcapi.alipay.com/validateAndCacheCardInfo.json",{cardNo:value,cardBinCheck:'true'},function(res){
                    //console.log(res); //不清楚返回值的打印出来看
                    //{"cardType":"DC","bank":"ICBC","key":"622200****412565805","messages":[],"validated":true,"stat":"ok"}
                    if(res.validated){
                        var name=banklist[res.bank];
                        //console.log(name);
                        $('#sk_bankname').val(name);
                        $('#sk_bankname').text(name);
                    }else{
                        layer.msg('银行卡号错误',{icon:5});
                        //setTimeout($("#deposit_card").focus(),1000); //获取焦点
                        $('#sk_bankname').val('');
                        $('#sk_bankname').text('');
                        return false;
                    }
                },'json');
            });
            
            if(id==0){
                form.on('submit(formDemo)', function(data) {
                    $.ajax({
                        url:"<?php echo e(url('/admin/recharge')); ?>",
                        data:$('form').serialize(),
                        type:'post',
                        dataType:'json',
                        success:function(res){
                            if(res.status == 1){
                                layer.msg(res.msg,{icon:6});
                                var index = parent.layer.getFrameIndex(window.name);
                                setTimeout('parent.layer.close('+index+')',2000);
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
                        url:"<?php echo e(url('/admin/rechargeUpdate')); ?>",
                        data:$('form').serialize(),
                        type:'post',
                        dataType:'json',
                        success:function(res){
                            if(res.status == 1){
                                layer.msg(res.msg,{icon:6});
                                var index = parent.layer.getFrameIndex(window.name);
                                setTimeout('parent.layer.close('+index+')',2000);
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