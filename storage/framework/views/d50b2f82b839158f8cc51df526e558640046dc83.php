<?php $__env->startSection('title', '版本控制'); ?>
<?php $__env->startSection('header'); ?>
    <div class="layui-inline">
        <button class="layui-btn layui-btn-small layui-btn-normal addBtn" data-desc="发布新版本" data-url="<?php echo e(url('/admin/version/0/edit')); ?>"><i class="layui-icon">&#xe654;</i></button>
        <button class="layui-btn layui-btn-small layui-btn-warm freshBtn"><i class="layui-icon">&#x1002;</i></button>
    </div>
    <div class="layui-inline">
        <input type="text"  value="<?php echo e(isset($input['version_no']) ? $input['version_no'] : ''); ?>" name="version_no" placeholder="请输入版本号" autocomplete="off" class="layui-input">
    </div>
    <div class="layui-inline">
        <input type="text"  value="<?php echo e(isset($input['creatime']) ? $input['creatime'] : ''); ?>" name="creatime" placeholder="发布时间" onclick="layui.laydate({elem: this, festival: true,min:'<?php echo e($min); ?>'})" autocomplete="off" class="layui-input">
    </div>
    <div class="layui-inline">
        <button class="layui-btn layui-btn-normal" lay-submit lay-filter="formDemo">搜索</button>
    </div>
<?php $__env->stopSection(); ?>
<?php $__env->startSection('table'); ?>
    <table class="layui-table" lay-even lay-skin="nob" style="table-layout: fixed">
        <colgroup>
            <col class="hidden-xs" width="100">
            <col class="hidden-xs" width="150">
            <col class="hidden-xs" width="200">
            <col class="hidden-xs" width="150">
            <col class="hidden-xs" width="100">
            <col class="hidden-xs" width="100">
            <col class="hidden-xs" width="200">
        </colgroup>
        <thead>
        <tr>
            <th class="hidden-xs">序号</th>
            <th class="hidden-xs">版本号</th>
            <th class="hidden-xs" style="text-align: center">更新内容</th>
            <th class="hidden-xs" style="text-align: center">类型</th>
            <th class="hidden-xs" style="text-align: center">状态</th>
            <th class="hidden-xs" style="text-align: center">创建时间</th>
            <th class="hidden-xs" style="text-align: center">操作</th>
        </tr>
        </thead>
        <tbody>
        <?php $__currentLoopData = $pager; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $info): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <tr>
                <td class="hidden-xs"><?php echo e($info['id']); ?></td>
                <td class="hidden-xs"><?php echo e($info['version_no']); ?></td>
                <td style="white-space:nowrap;overflow:hidden;text-overflow: ellipsis;"><?php echo e($info['detail']); ?></td>
                <td class="hidden-xs" style="text-align: center">
                    <?php if($info['force']==0): ?><span class="layui-btn layui-btn-small layui-btn">非强制更新</span>
                    <?php elseif($info['force']==1): ?><span class="layui-btn layui-btn-small layui-btn-danger">强制更新</span>
                    <?php endif; ?>
                </td>
                <td class="hidden-xs" style="text-align: center">
                    <input type="checkbox" name="is_open" value="<?php echo e($info['id']); ?>" lay-skin="switch" lay-text="开启|关闭" lay-filter="is_open" <?php echo e($info['is_open'] == 1 ? 'checked' : ''); ?>>
                </td>
                <td class="hidden-xs" style="text-align: center"><?php echo e($info['creatime']); ?></td>
                <td class="hidden-xs" style="text-align: center">
                    <div class="layui-inline">
                        <button class="layui-btn layui-btn-small layui-btn-normal edit-btn" data-id="<?php echo e($info['id']); ?>" data-desc="更改版本" data-url="<?php echo e(url('/admin/version/'. $info['id'] .'/edit')); ?>">编辑</button>
                        <button class="layui-btn layui-btn-small layui-btn-danger del-btn" data-id="<?php echo e($info['id']); ?>" data-url="<?php echo e(url('/admin/version/'.$info['id'])); ?>">删除</button>
                    </div>
                </td>
            </tr>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        <?php if(!$pager[0]): ?>
            <tr><td colspan="6" style="text-align: center;color: orangered;">暂无数据</td></tr>
        <?php endif; ?>
        </tbody>
        <input type="hidden" id="token" value="<?php echo e(csrf_token()); ?>">
    </table>
    <div class="page-wrap">
        <?php echo e($pager->render()); ?>

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
            form.on('submit(formDemo)', function(data) {                
            });
            //开关
            form.on('switch(is_open)', function(obj){
                //layer.tips(this.value + ' ' + this.name + '：'+ obj.elem.checked, obj.othis);
                var id=this.value,
                    status=obj.elem.checked;
                if(status==false){
                    var is_open=0;
                }else if(status==true){
                    is_open=1;
                }
                $.ajax({
                    headers: {
                        'X-CSRF-TOKEN': $('#token').val()
                    },
                    url:"<?php echo e(url('/admin/version_isopen')); ?>",
                    data:{
                        id:id,
                        is_open:is_open
                    },
                    type:'post',
                    dataType:'json',
                    success:function(res){
                        if(res.status == 1){
                            layer.msg(res.msg,{icon:6,time:1000},function () {
                                location.reload();
                            });

                        }else{
                            layer.msg(res.msg,{icon:5,time:1000});
                        }
                    },
                    error : function(XMLHttpRequest, textStatus, errorThrown) {
                        layer.msg('网络失败', {time: 1000});
                    }
                });
            });
        });
    </script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('common.list', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>