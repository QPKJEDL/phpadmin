<?php $__env->startSection('title', '公告管理'); ?>
<?php $__env->startSection('header'); ?>
    <div class="layui-inline">
        
        <button class="layui-btn layui-btn-small layui-btn-warm freshBtn"><i class="layui-icon">&#x1002;</i></button>
    </div>
<?php $__env->stopSection(); ?>
<?php $__env->startSection('table'); ?>
    <form class="layui-form">
        <div class="layui-form-item">
            <label class="layui-form-label">系统开关</label>
            <div class="layui-input-inline">
                <?php if($system==1): ?>
                <input type="checkbox" checked id="systemOpen" lay-skin="switch"  lay-filter="systemOpen" lay-text="正常|维护">
                <?php else: ?>
                <input type="checkbox" id="systemOpen" lay-skin="switch"  lay-filter="systemOpen" lay-text="正常|维护">
                <?php endif; ?>
            </div>
            <div class="layui-form-mid layui-word-aux">点击系统开关</div>
        </div>
        <div class="layui-form-item">
            <label class="layui-form-label">充提开关</label>
            <div class="layui-input-inline">
                <?php if($drawOpen==1): ?>
                <input type="checkbox" checked name="close" lay-skin="switch" lay-filter="TopUp" lay-text="开启|关闭">
                <?php else: ?>
                <input type="checkbox" id="systemOpen" lay-skin="switch"  lay-filter="TopUp" lay-text="正常|维护">
                <?php endif; ?>
            </div>
            <div class="layui-form-mid layui-word-aux">会员在线充提</div>
        </div>
    </form>
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
            form.on('switch(systemOpen)', function(data) {
                var check = this.checked;
                var value = 0;
                if(check==true){
                    value = 1;
                }else{
                    value = 2;
                }
                $.ajax({
                    headers:{
                        'X-CSRF-TOKEN':$("input[name='_token']").val()
                    },
                    url:"<?php echo e(url('/admin/maintain')); ?>",
                    type:"post",
                    data:{
                        "checked":value
                    },
                    dataType:"json",
                    success:function (res) {
                        layer.msg(res.msg,{icon:6});
                    }
                });
            });

            form.on('switch(TopUp)',function (data) {
                var check = this.checked;
                var value = 0;
                if(check==true){
                    value=1;
                }else{
                    value=2;
                }
                $.ajax({
                    headers:{
                        'X-CSRF-TOKEN':$("input[name='_token']").val()
                    },
                    url:"<?php echo e(url('/admin/drawOpen')); ?>",
                    type:"post",
                    data:{
                        "checked":value
                    },
                    dataType:"json",
                    success:function (res) {
                        layer.msg(res.msg,{icon:6});
                    }
                });
            });
        });
    </script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('common.list', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>