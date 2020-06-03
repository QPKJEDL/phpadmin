<?php $__env->startSection('title', '公告管理'); ?>
<?php $__env->startSection('header'); ?>
    <div class="layui-inline">
        
        <button class="layui-btn layui-btn-small layui-btn-warm freshBtn"><i class="layui-icon">&#x1002;</i></button>
    </div>
<?php $__env->stopSection(); ?>
<?php $__env->startSection('table'); ?>
    <input type="hidden" id="token" value="<?php echo e(csrf_token()); ?>">
    <?php $__currentLoopData = $list; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $info): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
    <div class="layui-form-item">
        <label class="layui-form-label"><?php echo e($info['descript']); ?></label>
        <div class="layui-input-block">
            <input type="text" id="<?php echo e($info['id']); ?>" lay-verify="title" value="<?php echo e($info['url']); ?>"  autocomplete="off" placeholder="请输入<?php echo e($info['descript']); ?>" class="layui-input">
        </div>
    </div>
    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
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
                var id1 = $("#1").val();
                var id2 = $("#2").val();
                var id3 = $("#3").val();
                var id4 = $("#4").val();
                var json1 = {
                    "id":1,
                    "value":id1
                }
                var json2 ={
                    "id":2,
                    "value":id2
                }
                var json3 = {
                    "id":3,
                    "value":id3
                }
                var json4 = {
                    "id":4,
                    "value":id4
                }
                var arr = new Array();
                arr.push(json1)
                arr.push(json2)
                arr.push(json3)
                arr.push(json4)
                $.ajax({
                    headers:{
                        'X-CSRF-TOKEN': $("#token").val()
                    },
                    url:"<?php echo e(url('/admin/camera')); ?>",
                    type:"post",
                    data:{
                        "data":JSON.stringify(arr)
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