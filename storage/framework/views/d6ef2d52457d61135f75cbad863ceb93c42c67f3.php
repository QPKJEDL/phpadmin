<?php $__env->startSection('title', '配置编辑'); ?>
<?php $__env->startSection('content'); ?>
    <div class="layui-form-item">
        <label class="layui-form-label">商户id：</label>
        <div class="layui-input-block">
            <input type="text" value="<?php echo e(isset($info['business_id']) ? $info['business_id'] : ''); ?>" name="business_id" placeholder="请填写商户id" lay-verify="required" autocomplete="off" class="layui-input">
        </div>
    </div>
    <div class="layui-form-item">
        <label class="layui-form-label">商户名称：</label>
        <div class="layui-input-block">
            <input type="text" value="<?php echo e(isset($info['business_name']) ? $info['business_name'] : ''); ?>" name="business_name" placeholder="请填写商户名称" lay-verify="required" autocomplete="off" class="layui-input">
        </div>
    </div>
    <div class="layui-form-item">
        <label class="layui-form-label">支付通道：</label>
        <div class="layui-input-block">
            <input type="text" value="<?php echo e(isset($info['pay_aisle']) ? $info['pay_aisle'] : ''); ?>" name="pay_aisle" placeholder="请填写支付通道" lay-verify="required" autocomplete="off" class="layui-input">
        </div>
    </div>
    <div class="layui-form-item">
        <label class="layui-form-label">支付操作端：</label>
        <div class="layui-input-block">
            <input type="text" value="<?php echo e(isset($info['operation_side']) ? $info['operation_side'] : ''); ?>" name="operation_side" placeholder="请填写支付操作端" lay-verify="required" autocomplete="off" class="layui-input">
        </div>
    </div>
    <div class="layui-form-item">
        <label class="layui-form-label">最小充值限额：</label>
        <div class="layui-input-block">
            <input type="text" value="<?php echo e(isset($info['min_price']) ? $info['min_price'] : ''); ?>" name="min_price" placeholder="请填写最小充值限额" lay-verify="required" autocomplete="off" class="layui-input">
        </div>
    </div>
    <div class="layui-form-item">
        <label class="layui-form-label">最大充值限额：</label>
        <div class="layui-input-block">
            <input type="text" value="<?php echo e(isset($info['max_price']) ? $info['max_price'] : ''); ?>" name="max_price" placeholder="请填写最大充值限额" lay-verify="required" autocomplete="off" class="layui-input">
        </div>
    </div>
    <div class="layui-form-item">
        <label class="layui-form-label">服务名称：</label>
        <div class="layui-input-block">
            <input type="text" value="<?php echo e(isset($info['service_name']) ? $info['service_name'] : ''); ?>" name="service_name" placeholder="请填写服务名称" lay-verify="required" autocomplete="off" class="layui-input">
        </div>
    </div>
    <div class="layui-form-item">
        <label class="layui-form-label">支付平台：</label>
        <div class="layui-input-block">
            <input type="text" value="<?php echo e(isset($info['pay_type']) ? $info['pay_type'] : ''); ?>" name="pay_type" placeholder="请填写支付平台" lay-verify="required" autocomplete="off" class="layui-input">
        </div>
    </div>
    <div class="layui-form-item">
        <label class="layui-form-label">支付通知地址：</label>
        <div class="layui-input-block">
            <input type="text" value="<?php echo e(isset($info['page_notify_url']) ? $info['page_notify_url'] : ''); ?>" name="page_notify_url" placeholder="青填写支付通知地址" lay-verify="required" autocomplete="off" class="layui-input">
        </div>
    </div>
    <div class="layui-form-item">
        <label class="layui-form-label">异步通知地址：</label>
        <div class="layui-input-block">
            <input type="text" value="<?php echo e(isset($info['asyn_notify_url']) ? $info['asyn_notify_url'] : ''); ?>" name="asyn_notify_url" placeholder="请填写异步通知地址" lay-verify="required" autocomplete="off" class="layui-input">
        </div>
    </div>
    <div class="layui-form-item">
        <label class="layui-form-label">密钥：</label>
        <div class="layui-input-block">
            <input type="text" value="<?php echo e(isset($info['access_key']) ? $info['access_key'] : ''); ?>" name="access_key" placeholder="请填写密钥" lay-verify="required" autocomplete="off" class="layui-input">
        </div>
    </div>
    <div class="layui-form-item">
        <label class="layui-form-label">支付网关：</label>
        <div class="layui-input-block">
            <input type="text" value="<?php echo e(isset($info['pay_gateway']) ? $info['pay_gateway'] : ''); ?>" name="pay_gateway" placeholder="请填写支付网关" lay-verify="required" autocomplete="off" class="layui-input">
        </div>
    </div>
    <div class="layui-form-item">
        <label class="layui-form-label">预支付链接：</label>
        <div class="layui-input-block">
            <input type="text" value="<?php echo e(isset($info['prepaid_link']) ? $info['prepaid_link'] : ''); ?>" name="prepaid_link" placeholder="请填写预支付链接" lay-verify="required" autocomplete="off" class="layui-input">
        </div>
    </div>
    <div class="layui-form-item">
        <label class="layui-form-label">是否直接跳转：</label>
        <div class="layui-input-block">
            <input type="radio" name="is_jump" value="0" title="是" <?php echo e(isset($info['is_jump'])&&$info['is_jump']==0?'checked':''); ?>>
            <input type="radio" name="is_jump" value="1" title="否" <?php echo e(isset($info['is_jump'])&&$info['is_jump']==1?'checked':''); ?>>
        </div>
    </div>
    <div class="layui-form-item">
        <label class="layui-form-label">备注：</label>
        <div class="layui-input-block">
            <input type="text" value="<?php echo e(isset($info['remark']) ? $info['remark'] : ''); ?>" name="remark" placeholder="请填写备注" lay-verify="required" autocomplete="off" class="layui-input">
        </div>
    </div>
<?php $__env->stopSection(); ?>
<?php $__env->startSection('id',$id); ?>
<?php $__env->startSection('js'); ?>
    <script>
        layui.use(['form','jquery','layer','laydate'], function() {
            var form = layui.form()
                ,layer = layui.layer
                ,laydate = layui.laydate
                ,$ = layui.jquery;

            form.render();
            laydate({istoday: true});
            var id = $("input[name='id']").val();
            var index = parent.layer.getFrameIndex(window.name);
            if(id==0){
                form.on('submit(formDemo)', function(data) {
                    $.ajax({
                        url:"<?php echo e(url('/admin/pay')); ?>",
                        data:$('form').serialize(),
                        type:"post",
                        success:function(res){
                            if(res.status == 1){
                                layer.msg(res.msg,{icon:6});
                                var index = parent.layer.getFrameIndex(window.name);
                                setTimeout('parent.layer.close('+index+')',2000);
                                //parent.layer.close(index);
                            }else{
                                layer.msg(res.msg,{shift: 6,icon:5});
                            }
                        }
                    });
                    return false;
                });
            }else{
                form.on('submit(formDemo)', function(data) {
                    var ip = $("input[name='ip_address']").val();
                    var start = getDateTime($("input[name='start_date']").val());
                    var end = getDateTime($("input[name='end_date']").val());
                    var reg = /^(\d{1,2}|1\d\d|2[0-4]\d|25[0-5])\.(\d{1,2}|1\d\d|2[0-4]\d|25[0-5])\.(\d{1,2}|1\d\d|2[0-4]\d|25[0-5])\.(\d{1,2}|1\d\d|2[0-4]\d|25[0-5])$/;
                    if (!reg.test(ip)){
                        layer.msg('ip格式不对！',{shift:6,icon:5});
                        return false;
                    }
                    if (end<start){
                        layer.msg('结束日期不能小于开始日期',{shift: 6,icon:5});
                        return  false;
                    }
                    if(start==end){
                        layer.msg('结束日期于开始日期不能为同一天',{shift: 6,icon:5});
                        return false;
                    }
                    $.ajax({
                        url:"<?php echo e(url('/admin/updateIp')); ?>",
                        data:$('form').serialize(),
                        type:"post",
                        success:function(res){
                            if(res.status == 1){
                                layer.msg(res.msg,{icon:6});
                                var index = parent.layer.getFrameIndex(window.name);
                                setTimeout('parent.layer.close('+index+')',2000);
                                //parent.layer.close(index);
                            }else{
                                layer.msg(res.msg,{shift: 6,icon:5});
                            }
                        }
                    });
                    return false;
                });
            }

        });
        //获取时间戳
        function getDateTime(time) {
            var timeDate = new Date(time);
            return timeDate.getTime();
        }
    </script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('common.edit', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>