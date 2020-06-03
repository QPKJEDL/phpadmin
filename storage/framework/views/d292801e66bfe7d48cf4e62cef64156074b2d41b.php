<?php $__env->startSection('title', '更改费率'); ?>
<?php $__env->startSection('content'); ?>
    <div class="layui-form-item">
        <label class="layui-form-label">商户：</label>
        <div class="layui-input-block">
            <input type="text" value="<?php echo e(isset($info['nickname']) ? $info['nickname'] : ''); ?>" disabled class="layui-input">
        </div>
    </div>

    <div class="layui-form-item">
        <label class="layui-form-label">账号：</label>
        <div class="layui-input-block">
            <input type="text" value="<?php echo e(isset($info['account']) ? $info['account'] : ''); ?>" disabled class="layui-input">
        </div>
    </div>

    <div class="layui-form-item">
        <label class="layui-form-label">商户费率：</label>
        <div class="layui-input-block">
            <input type="text" value="<?php echo e(isset($info['fee']) ? $info['fee'] : ''); ?>" name="fee" lay-verify="fee" class="layui-input">
        </div>
    </div>

    <div class="layui-form-item">
        <label class="layui-form-label">一级代理：</label>
        <div class="layui-input-inline">
            <input type="text" value="<?php echo e(isset($fee['agent1_id']) ? $fee['agent1_id'] : ''); ?>" name="agent1_id"    placeholder="请输入一级代理ID" autocomplete="off" class="layui-input">
        </div>
        <label class="layui-form-label">一级费率：</label>
        <div class="layui-input-inline">
            <input type="text" value="<?php echo e(isset($fee['agent1_fee']) ? $fee['agent1_fee'] : ''); ?>" name="agent1_fee"  placeholder="请输入一级费率" autocomplete="off" class="layui-input">
        </div>
    </div>

    <div class="layui-form-item">
        <label class="layui-form-label">二级代理：</label>
        <div class="layui-input-inline">
            <input type="text" value="<?php echo e(isset($fee['agent2_id']) ? $fee['agent2_id'] : ''); ?>" name="agent2_id"   placeholder="请输入二级代理ID" autocomplete="off" class="layui-input">
        </div>
        <label class="layui-form-label">二级费率：</label>
        <div class="layui-input-inline">
            <input type="text" value="<?php echo e(isset($fee['agent2_fee']) ? $fee['agent2_fee'] : ''); ?>" name="agent2_fee"  placeholder="请输入二级费率" autocomplete="off" class="layui-input">
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

            form.on('submit(formDemo)', function(data) {

                $.ajax({
                    url:"<?php echo e(url('/admin/busnewfee')); ?>",
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