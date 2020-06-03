<?php $__env->startSection('title', '增加二维码'); ?>
<?php $__env->startSection('content'); ?>
    <div class="layui-form-item">
        <label class="layui-form-label" style="width: 100px">账号：</label>
        <div class="layui-input-inline">
            <input type="text" value="<?php echo e(isset($info['account']) ? $info['account'] : ''); ?>" disabled class="layui-input">
        </div>
    </div>

    <div class="layui-form-item">
        <label class="layui-form-label" style="width: 100px">二维码数量：</label>
        <div class="layui-input-inline">
            <input type="number"  value="<?php echo e(isset($info['imsi_num']) ? $info['imsi_num'] : ''); ?>" name="imsi_num"  placeholder="请输入二维码数量" autocomplete="off" class="layui-input">
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
                $.ajax({
                    url:"<?php echo e(url('/admin/codeaddqr')); ?>",
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