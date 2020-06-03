<?php $__env->startSection('title', '商户管理'); ?>
<?php $__env->startSection('header'); ?>
    <div class="layui-inline">
    <button class="layui-btn layui-btn-small layui-btn-normal addBtn" data-desc="添加商户" data-url="<?php echo e(url('/admin/business/0/edit')); ?>"><i class="layui-icon">&#xe654;</i></button>
    <button class="layui-btn layui-btn-small layui-btn-warm freshBtn"><i class="layui-icon">&#x1002;</i></button>
    </div>
    <div class="layui-inline">
        <input type="text"  value="<?php echo e(isset($input['business_code']) ? $input['business_code'] : ''); ?>" name="business_code" placeholder="请输入商户ID" autocomplete="off" class="layui-input">
    </div>
    <div class="layui-inline">
        <input type="text"  value="<?php echo e(isset($input['account']) ? $input['account'] : ''); ?>" name="account" placeholder="请输入商户账号" autocomplete="off" class="layui-input">
    </div>
    <div class="layui-inline">
        <input type="text"  value="<?php echo e(isset($input['mobile']) ? $input['mobile'] : ''); ?>" name="mobile" placeholder="请输入商户手机" autocomplete="off" class="layui-input">
    </div>
    <div class="layui-inline">
        <input type="text"  value="<?php echo e(isset($input['nickname']) ? $input['nickname'] : ''); ?>" name="nickname" placeholder="请输入商户昵称" autocomplete="off" class="layui-input">
    </div>
    <div class="layui-inline">
        <input type="text"  value="<?php echo e(isset($input['creatime']) ? $input['creatime'] : ''); ?>" name="creatime" placeholder="创建时间" onclick="layui.laydate({elem: this, festival: true,min:'<?php echo e($min); ?>'})" autocomplete="off" class="layui-input">
    </div>
    <div class="layui-inline">
        <button class="layui-btn layui-btn-normal" lay-submit lay-filter="formDemo">搜索</button>
    </div>
<?php $__env->stopSection(); ?>
<?php $__env->startSection('table'); ?>
    <table class="layui-table" lay-even lay-skin="nob">
        <colgroup>
            <col class="hidden-xs" width="100">
            <col class="hidden-xs" width="150">
            <col class="hidden-xs" width="150">
            <col class="hidden-xs" width="150">
            <col class="hidden-xs" width="150">
            <col class="hidden-xs" width="150">
            <col class="hidden-xs" width="150">
            <col class="hidden-xs" width="200">
            <col class="hidden-xs" width="200">
            <col class="hidden-xs" width="300">
        </colgroup>
        <thead>
        <tr>
            <th class="hidden-xs">ID</th>
            <th class="hidden-xs">帐号</th>
            <th class="hidden-xs">商户昵称</th>
            <th class="hidden-xs">联系电话</th>
            <th class="hidden-xs">费率</th>
            <th class="hidden-xs">类型</th>
            <th class="hidden-xs">状态</th>
            <th class="hidden-xs">创建时间</th>
            <th class="hidden-xs">更新时间</th>
            <th class="hidden-xs" style="text-align: center">操作</th>
        </tr>
        </thead>
        <tbody>
        <?php $__currentLoopData = $list; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $info): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <tr>
                <td class="hidden-xs"><?php echo e($info['business_code']); ?></td>
                <td class="hidden-xs"><?php echo e($info['account']); ?></td>
                <td class="hidden-xs"><?php echo e($info['nickname']); ?></td>
                <td class="hidden-xs"><?php echo e($info['mobile']); ?></td>
                <td class="hidden-xs"><?php echo e($info['fee']*100); ?>%</td>
                <td class="hidden-xs">
                    <?php if($info['paycode']==0): ?><span class="layui-btn layui-btn-small layui-btn-primary">默认</span>
                    <?php elseif(($info['paycode']==1)): ?><span class="layui-btn layui-btn-small layui-btn">微信</span>
                    <?php elseif(($info['paycode']==2)): ?><span class="layui-btn layui-btn-small layui-btn-normal">支付宝</span>
                    <?php endif; ?></td>
                <td class="hidden-xs">
                    <input type="checkbox" name="status" value="<?php echo e($info['business_code']); ?>" lay-skin="switch" lay-text="正常|停止" lay-filter="status" <?php echo e($info['status'] == 1 ? 'checked' : ''); ?>>
                </td>
                <td class="hidden-xs"><?php echo e($info['creatime']); ?></td>
                <td class="hidden-xs"><?php echo e($info['updatetime']); ?></td>
                <td>
                    <div class="layui-inline">
                        <button class="layui-btn layui-btn-small layui-btn-normal edit-btn" data-id="<?php echo e($info['business_code']); ?>" data-desc="编辑商户" data-url="<?php echo e(url('/admin/business/'. $info['business_code'] .'/edit')); ?>">编辑</button>
                        <a class="layui-btn layui-btn-small layui-btn-normal" onclick="bank(<?php echo e($info['business_code']); ?>)">银行</a>
                        <a class="layui-btn layui-btn-small layui-btn-danger" onclick="editpwd(<?php echo e($info['business_code']); ?>)">登录密码</a>
                        <a class="layui-btn layui-btn-small layui-btn-warm" onclick="editpayword(<?php echo e($info['business_code']); ?>)">支付密码</a>
                        <a class="layui-btn layui-btn-small layui-btn" onclick="editfee(<?php echo e($info['business_code']); ?>)">添加代理</a>
                    </div>
                </td>
            </tr>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        <?php if(!$list[0]): ?>
            <tr><td colspan="6" style="text-align: center;color: orangered;">暂无数据</td></tr>
        <?php endif; ?>
        </tbody>
        <input type="hidden" id="token" value="<?php echo e(csrf_token()); ?>">
    </table>
    <div class="page-wrap">
        <?php echo e($list->render()); ?>

    </div>
<?php $__env->stopSection(); ?>
<?php $__env->startSection('js'); ?>
    <script>
        layui.use(['form', 'jquery','laydate', 'layer'], function() {
            var form = layui.form(),
                $ = layui.jquery,
                laydate = layui.laydate,
                layer = layui.layer;
            laydate({istoday: true});
            form.render();
            form.on('submit(formDemo)', function(data) {
            });
            //监听开关操作
            form.on('switch(status)', function(obj){
                var id=this.value,
                    status=obj.elem.checked;
                if(status==false){
                    var aswitch=2;
                }else if(status==true){
                    aswitch=1;
                }
                $.ajax({
                    headers: {
                        'X-CSRF-TOKEN': $('#token').val()
                    },
                    url:"<?php echo e(url('/admin/bus_switch')); ?>",
                    data:{
                        id:id,
                        aswitch:aswitch
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
        function bank(id) {
            var id=id;
            layer.open({
                type: 2,
                title: '银行信息',
                closeBtn: 1,
                area: ['500px','600px'],
                shadeClose: false, //点击遮罩关闭
                content: ['/admin/business/bankinfo/'+id],
                end:function(){

                }
            });
        }
        function editpwd(id) {
            var id=id;
            layer.open({
                type: 2,
                title: '修改登录密码',
                closeBtn: 1,
                area: ['500px','500px'],
                shadeClose: false, //点击遮罩关闭
                resize:false,
                content: ['/admin/business/buspwd/'+id,'no'],
                end:function(){

                }
            });
        }
        function editpayword(id) {
            var id=id;
            layer.open({
                type: 2,
                title: '修改支付密码',
                closeBtn: 1,
                area: ['500px','500px'],
                shadeClose: false, //点击遮罩关闭
                resize:false,
                content: ['/admin/business/buspayword/'+id,'no'],
                end:function(){

                }
            });
        }
        function editfee(id) {
            var id=id;
            layer.open({
                type: 2,
                title: '添加代理',
                closeBtn: 1,
                area: ['700px','500px'],
                shadeClose: false, //点击遮罩关闭
                resize:false,
                content: ['/admin/business/busfee/'+id,'no'],
                end:function(){

                }
            });
        }
    </script>
<?php $__env->stopSection(); ?>


<?php echo $__env->make('common.list', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>