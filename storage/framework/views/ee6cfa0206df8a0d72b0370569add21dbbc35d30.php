<?php $__env->startSection('title', '提现驳回'); ?>
<?php $__env->startSection('content'); ?>
    <div class="layui-form-item">
        <label class="layui-form-label" style="width: 100px">码商ID：</label>
        <div class="layui-input-inline">
            <input type="text" value="<?php echo e($info['user_id']); ?>" class="layui-input" disabled >
        </div>
    </div>


    <div class="layui-form-item">
        <label class="layui-form-label" style="width: 100px">提现单号：</label>
        <div class="layui-input-inline">
            <input type="text" value="<?php echo e($info['order_sn']); ?>" class="layui-input" disabled>
        </div>
    </div>

    <div class="layui-form-item">
        <label class="layui-form-label" style="width: 100px">提现额度：</label>
        <div class="layui-input-inline">
            <input type="text" value="<?php echo e($info['money']/100); ?>" class="layui-input" disabled>
        </div>
    </div>

    <div class="layui-form-item">
        <label class="layui-form-label" style="width: 100px">手机号：</label>
        <div class="layui-input-inline">
            <input type="text" value="<?php echo e($info['mobile']); ?>" class="layui-input" disabled>
        </div>
    </div>

    <div class="layui-form-item">
        <label class="layui-form-label" style="width: 100px">微信昵称：</label>
        <div class="layui-input-inline">
            <input type="text" value="<?php echo e($info['wx_name']); ?>" class="layui-input" disabled>
        </div>
    </div>
    <div class="layui-form-item">
        <label class="layui-form-label" style="width: 100px">开户人：</label>
        <div class="layui-input-inline">
            <input type="text" value="<?php echo e($info['name']); ?>" class="layui-input" disabled>
        </div>
    </div>


    <div class="layui-form-item">
        <label class="layui-form-label" style="width: 100px">开户行：</label>
        <div class="layui-input-inline">
            <input type="text" value="<?php echo e($info['deposit_name']); ?>" class="layui-input" disabled>
        </div>
    </div>

    <div class="layui-form-item">
        <label class="layui-form-label" style="width: 100px">卡号：</label>
        <div class="layui-input-inline">
            <input type="text" value="<?php echo e($info['deposit_card']); ?>" class="layui-input" disabled>
        </div>
    </div>
    <div class="layui-form-item">
        <label class="layui-form-label" style="width: 100px">申请时间：</label>
        <div class="layui-input-inline">
            <input type="text"  value="<?php echo e($info['creatime']); ?>" class="layui-input" disabled>
        </div>
    </div>
    <div class="layui-form-item">
        <label class="layui-form-label" style="width: 100px">驳回原因：</label>
        <div class="layui-input-inline">
            <input type="text" name="remark" placeholder="请输入驳回原因" autocomplete="off" class="layui-input">
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

            form.on('submit(formDemo)', function(data) {
                var index = layer.load(0, {shade: [0.1,'#fff']});
                $.ajax({
                    url:"<?php echo e(url('/admin/codedrawnonereject')); ?>",
                    data:$('form').serialize(),
                    type:'post',
                    dataType:'json',
                    success:function(res){
                        if(res.status == 1){
                            layer.msg(res.msg,{icon:6},function () {
                                parent.layer.close(index);
                                parent.location.reload();
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