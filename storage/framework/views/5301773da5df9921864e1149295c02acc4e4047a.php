<?php $__env->startSection('title', '公告管理'); ?>
<?php $__env->startSection('header'); ?>
    <div class="layui-inline">
        
        <button class="layui-btn layui-btn-small layui-btn-warm freshBtn"><i class="layui-icon">&#x1002;</i></button>
    </div>
<?php $__env->stopSection(); ?>
<?php $__env->startSection('table'); ?>
    <input type="hidden" id="token" value="<?php echo e(csrf_token()); ?>">
    <input type="hidden" id="id" value="<?php echo e($info['id']); ?>">
    <div class="layui-form-item">
        <label class="layui-form-label">标题：</label>
        <div class="layui-input-block">
            <input type="text" name="title" lay-verify="title" value="<?php echo e($info['title']); ?>" autocomplete="off" readonly class="layui-input">
        </div>
    </div>
    <div class="layui-form-item">
        <label class="layui-form-label">语言：</label>
        <div class="layui-input-block">
            <select name="language" lay-filter="aihao">
                <option value="1"<?php echo e(isset($info['language'])&&$info['language']==1?'selected':''); ?>>中文</option>
                <option value="2" <?php echo e(isset($info['language'])&&$info['language']==2?'selected':''); ?>>英文</option>
            </select>
        </div>
    </div>
    <div class="layui-form-item layui-form-text">
        <label class="layui-form-label">公告内容：</label>
        <div class="layui-input-block">
            <textarea placeholder="请输入内容" id="content" name="content" class="layui-textarea"><?php echo e($info['content']); ?></textarea>
        </div>
    </div>
    <div class="layui-form-item">
        <div class="layui-input-block">
            <button type="submit" class="layui-btn" lay-submit="formDemo" lay-filter="demo1">立即提交</button>
        </div>
    </div>
<?php $__env->stopSection(); ?>
<?php $__env->startSection('js'); ?>
    <script>
        layui.use(['form', 'jquery', 'layer','laydate'], function() {
            var form = layui.form(),
                $ = layui.jquery,
                laydate=layui.laydate,
                layer = layui.layer;
            laydate({istoday: true});
            form.render();
            form.on('submit(demo1)', function(data) {
                $.ajax({
                    headers:{
                        'X-CSRF-TOKEN': $("#token").val()
                    },
                    url:"<?php echo e(url('/admin/webnotice')); ?>",
                    type:"post",
                    data:{
                        "id":$("#id").val(),
                        "language":$("select[name='language']").val(),
                        "content":$("#content").val()
                    },
                    dataType:"json",
                    success:function (res) {
                        if(res.status==1){
                            layer.msg(res.msg,{icon:6});
                            window.location.reload();
                        }else{
                            layer.msg(res.msg,{shift: 6,icon:5});
                        }
                    }
                });
            });
            
        });
    </script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('common.list', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>