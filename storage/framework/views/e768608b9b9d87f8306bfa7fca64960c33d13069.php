<?php $__env->startSection('title', '客服编辑'); ?>
<?php $__env->startSection('content'); ?>

    <div class="layui-form-item">
        <label class="layui-form-label" style="width: 100px">客服昵称：</label>
        <div class="layui-input-inline">
            <input type="text" value="<?php echo e(isset($info['content']) ? $info['content'] : ''); ?>" id="name" name="content" placeholder="请填写标题" lay-verify="required" lay-reqText="请填写标题" autocomplete="off" class="layui-input">
        </div>
    </div>
    <div class="layui-form-item">
        <label class="layui-form-label" style="width: 100px">二维码上传：</label>
        <div class="layui-input-inline">
            <input type="file" id="url" name="url">
            <img src="<?php echo e(isset($info['url']) ? $info['url'] : ''); ?>" style="width:200px;height:200px;">
            <input type="hidden" id="token" value="<?php echo e(csrf_token()); ?>">
        </div>
    </div>
<?php $__env->stopSection(); ?>
<?php $__env->startSection('id',$id); ?>
<?php $__env->startSection('js'); ?>
    <script>
        layui.use(['form','jquery','layer'], function() {
            var form = layui.form()
                ,layer = layui.layer
                ,$ = layui.jquery;
            form.render();
            var id = $("input[name='id']").val();
            var index = parent.layer.getFrameIndex(window.name);

            form.on('submit(formDemo)', function(data) {
                var formData = new FormData();
                formData.append('url',$('#url').prop('files')[0]);
                formData.append('content',$('#name').val());
                $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': $('#token').val(),
                    }
                });
                if(id==0){
                    $.ajax({
                        url:'<?php echo e(url('/admin/callcenter')); ?>',
                        data:formData,
                        type:'post',
                        dataType:'json',
                        contentType: false,
                        processData: false,
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
                }else{
                    formData.append('id',id);
                    $.ajax({
                        url:"<?php echo e(url('/admin/callcenterUpdate')); ?>",
                        data:formData,
                        type:'post',
                        dataType:'json',
                        contentType: false,
                        processData: false,
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
                }
                return false;
            });
        });
    </script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('common.edit', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>