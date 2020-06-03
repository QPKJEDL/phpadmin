<?php $__env->startSection('title', '主播账号'); ?>
<?php $__env->startSection('header'); ?>
    <div class="layui-inline">
        <button class="layui-btn layui-btn-small layui-btn-normal addBtn" data-desc="添加主播" data-url="<?php echo e(url('/admin/anchor/0/edit')); ?>"><i class="layui-icon">&#xe654;</i></button>
        <button class="layui-btn layui-btn-small layui-btn-warm freshBtn"><i class="layui-icon">&#x1002;</i></button>
    </div>
<?php $__env->stopSection(); ?>
<?php $__env->startSection('table'); ?>
    <table class="layui-table" lay-even lay-skin="nob">
        <colgroup>
            <col class="hidden-xs" width="60">
            <col class="hidden-xs" width="100">
            <col class="hidden-xs" width="100">
            <col class="hidden-xs" width="100">
            <col class="hidden-xs" width="100">
            <col class="hidden-xs" width="100">
            <col class="hidden-xs" width="100">
            <col class="hidden-xs" width="100">
            <col class="hidden-xs" width="200">
        </colgroup>
        <thead>
        <tr>
            <th class="hidden-xs">序号</th>
            <th class="hidden-xs">账号</th>
            <th class="hidden-xs">名称</th>
            <th class="hidden-xs">余额</th>
            <th class="hidden-xs">状态</th>
            <th class="hidden-xs">创建者</th>
            <th class="hidden-xs">创建时间</th>
            <th class="hidden-xs">备注</th>
            <th class="hidden-xs" style="text-align: center">操作</th>
        </tr>
        </thead>
        <tbody>
        <?php $__currentLoopData = $list; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $info): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <tr>
                <td class="hidden-xs"><?php echo e($info['id']); ?></td>
                <td class="hidden-xs"><?php echo e($info['account']); ?></td>
                <td class="hidden-xs"><?php echo e($info['nick_name']); ?></td>
                <td class="hidden-xs"><?php echo e($info['balance']); ?></td>
                <td class="hidden-xs">
                    <?php if($info['status']==0): ?>
                        <input type="checkbox" checked="" name="close" lay-skin="switch" data-id="<?php echo e($info['id']); ?>" lay-filter="switchTest" data-v="1" lay-text="正常|停用">
                    <?php elseif($info['status']==1): ?>
                        <input type="checkbox" name="close" lay-skin="switch" lay-filter="stop" data-id="<?php echo e($info['id']); ?>" data-v="0" lay-text="正常|停用">
                    <?php endif; ?>
                </td>
                <td class="hidden-xs"><?php echo e($info['create_by']); ?></td>
                <td class="hidden-xs"><?php echo e($info['create_time']); ?></td>
                <td class="hidden-xs"><?php echo e($info['remark']); ?></td>
                <td style="text-align: center">
                    <div class="layui-inline">
                        <button class="layui-btn layui-btn-small layui-btn-normal edit-btn" data-id="<?php echo e($info['id']); ?>" data-desc="修改公告" data-url="<?php echo e(url('/admin/anchor/'. $info['id'] .'/edit')); ?>">编辑</button>
                        <button class="layui-btn layui-btn-small layui-btn-danger del-btn" data-id="<?php echo e($info['id']); ?>" data-url="<?php echo e(url('/admin/anchor/'.$info['id'])); ?>">删除</button>
                    </div>
                </td>
            </tr>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        <?php if(!$list[0]): ?>
            <tr><td colspan="6" style="text-align: center;color: orangered;">暂无数据</td></tr>
        <?php endif; ?>
        </tbody>
    </table>
    <input type="hidden" name="_token" value="<?php echo csrf_token(); ?>">
    <div class="page-wrap">
        <?php echo e($list->render()); ?>

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
            form.on('switch(switchTest)',function (data) {
                //获取当前元素
                var that = $(data.elem);
                //获取id
                var id = that.attr('data-id');
                //获取要修改的值
                var status = that.attr('data-v');
                $.ajax({
                    headers:{
                        'X-CSRF-TOKEN':$("input[name='_token']").val()
                    },
                    url:"<?php echo e(url('/admin/changeStatus')); ?>",
                    type:'post',
                    data:{
                        'id':id,
                        "status":status
                    },
                    dataType:"json",
                    success:function (res) {
                        if(res.status==1){
                            layer.msg(res.msg,{icon:6});
                        }else{
                            layer.msg(res.msg,{shift: 6,icon:5});
                        }
                    }
                });
            });
            form.on('switch(stop)',function (data) {
                //获取当前元素
                var that = $(data.elem);
                //获取id
                var id = that.attr('data-id');
                var status = that.attr('data-v');
                $.ajax({
                    headers:{
                        'X-CSRF-TOKEN':$("input[name='_token']").val()
                    },
                    url:"<?php echo e(url('/admin/changeStatus')); ?>",
                    type:'post',
                    data:{
                        'id':id,
                        "status":status
                    },
                    dataType:"json",
                    success:function (res) {
                        if(res.status==1){
                            layer.msg(res.msg,{icon:6});
                        }else{
                            layer.msg(res.msg,{shift: 6,icon:5});
                        }
                    }
                });
            });
            form.on('submit(formDemo)', function(data) {
            });
        });
    </script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('common.list', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>