<?php $__env->startSection('title', '公告编辑'); ?>
<?php $__env->startSection('content'); ?>

    <div class="layui-form-item">
        <label class="layui-form-label">版本号：</label>
        <div class="layui-input-inline">
            <input type="text" name="version_no" value="<?php echo e(isset($info['version_no']) ? $info['version_no'] : ''); ?>"   placeholder="请输入版本号" lay-verify="required" autocomplete="off" class="layui-input">
        </div>
    </div>


    <div class="layui-form-item">
        <label class="layui-form-label">更新内容：</label>
        <div class="layui-input-inline">
            <textarea name="detail" placeholder="请填写更新内容" lay-verify="required" style="width: 260px;height: 160px;resize: none"><?php echo e(isset($info['detail']) ? $info['detail'] : ''); ?></textarea>
        </div>
    </div>

    <div class="layui-form-item">
        <label class="layui-form-label">更新类型：</label>
        <div class="layui-input-inline">
            <select name="force" lay-verify="required">
                <option value="">请选择类型</option>
                <option value="0" <?php if($info['force']==0): ?> selected <?php endif; ?>>非强制更新</option>
                <option value="1" <?php if($info['force']==1): ?> selected <?php endif; ?>>强制更新</option>
            </select>
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
            if(id==0){
                form.on('submit(formDemo)', function(data) {
                    $.ajax({
                        url:"<?php echo e(url('/admin/version')); ?>",
                        data:$('form').serialize(),
                        type:'post',
                        dataType:'json',
                        success:function(res){
                            if(res.status == 1){
                                layer.msg(res.msg,{icon:6,time:1000},function () {
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
                        url:"<?php echo e(url('/admin/versionUpdate')); ?>",
                        data:$('form').serialize(),
                        type:'post',
                        dataType:'json',
                        success:function(res){
                            if(res.status == 1){
                                layer.msg(res.msg,{icon:6,time:1000},function () {
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