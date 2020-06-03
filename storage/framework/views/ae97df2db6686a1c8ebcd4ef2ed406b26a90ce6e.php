<?php $__env->startSection('title', '公告编辑'); ?>
<?php $__env->startSection('content'); ?>
    <div class="layui-form-item">
        <label class="layui-form-label">桌号：</label>
        <div class="layui-input-inline">
            <input type="text" value="<?php echo e($info['desk']['desk_name']); ?>(<?php echo e($info['desk']['game_name']); ?>)" autocomplete="off" class="layui-input" readonly="readonly">
            <input type="hidden" value="<?php echo e($info['type']); ?>" name="type">
        </div>
    </div>
    <div class="layui-form-item">
        <label class="layui-form-label">靴号：</label>
        <div class="layui-input-inline">
            <input type="text" value="<?php echo e($info['boot_num']); ?>" autocomplete="off" class="layui-input" readonly="readonly">
        </div>
    </div>
    <div class="layui-form-item">
        <label class="layui-form-label">靴号：</label>
        <div class="layui-input-inline">
            <input type="text" value="<?php echo e($info['type']); ?>" autocomplete="off" class="layui-input" readonly="readonly">
        </div>
    </div>
    <div class="layui-form-item">
        <label class="layui-form-label">铺号：</label>
        <div class="layui-input-inline">
            <input type="text" value="<?php echo e($info['pave_num']); ?>" autocomplete="off" class="layui-input" readonly="readonly">
        </div>
    </div>
    <div class="layui-form-item">
        <label class="layui-form-label">结果：</label>
        <div class="layui-input-inline">
            <?php if($info['type']==1): ?><!-- 百家乐 -->
                <input type="text" value="<?php echo e($info['result']['game']); ?>&nbsp;<?php echo e($info['result']['playerPair']); ?>&nbsp;<?php echo e($info['result']['bankerPair']); ?>" autocomplete="off" class="layui-input" readonly="readonly">
            <?php elseif($info['type']==2): ?><!-- 龙虎 -->
                <input type="text" value="<?php echo e($info['result']); ?>" autocomplete="off" class="layui-input" readonly="readonly">
            <?php elseif($info['type']==3): ?><!-- 牛牛 -->
                <?php if($info['result']['bankernum']==""): ?>
                    <input type="text" value="<?php echo e($info['result']['x1result']); ?>&nbsp;<?php echo e($info['result']['x2result']); ?>&nbsp;<?php echo e($info['result']['x3result']); ?>" autocomplete="off" class="layui-input" readonly="readonly">
                <?php else: ?>
                    <input type="text" value="<?php echo e($info['result']['bankernum']); ?>" autocomplete="off" class="layui-input" readonly="readonly">
                <?php endif; ?>
            <?php endif; ?>
        </div>
    </div>
    <div class="layui-form-item">
        <label class="layui-form-label">时间：</label>
        <div class="layui-input-inline">
            <input type="text" value="<?php echo e($info['creatime']); ?>" name="time" autocomplete="off" class="layui-input" readonly="readonly">
        </div>
    </div>
    <div class="layui-form-item">
        <label class="layui-form-label">选择正确的结果：</label>
        <div class="layui-input-inline">
            <!-- 百家乐 -->
            <?php if($info['type']==1): ?>
                <!-- 循环单选 -->
                <?php $__currentLoopData = $info['gameResult']['radio']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $nfo): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <!--{"game":4,"playerPair":5,"bankerPair":2}-->
                    <input type="radio" name="<?php echo e($nfo['name']); ?>" lay-skin="primary" title="<?php echo e($nfo['label_text']); ?>" value="<?php echo e($nfo['label_value']); ?>">
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                <br/>
                <!-- 循环多选 -->
                <?php $__currentLoopData = $info['gameResult']['checkbox']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $nfo): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <input type="checkbox" name="<?php echo e($nfo['name']); ?>" lay-skin="primary" title="<?php echo e($nfo['label_text']); ?>" value="<?php echo e($nfo['label_value']); ?>">
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            <?php elseif($info['type']==2): ?><!-- 龙虎 -->
                <?php $__currentLoopData = $info['gameResult']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $nfo): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <input type="radio" name="winner" value="<?php echo e($nfo['label_value']); ?>" title="<?php echo e($nfo['label_text']); ?>">
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            <?php elseif($info['type']==3): ?><!-- 牛牛 -->
            <!-- 循环多选 -->
                <?php $__currentLoopData = $info['gameResult']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $nfo): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <input type="checkbox" id="<?php echo e($nfo['name']); ?>" class="checkboxs" lay-filter="<?php echo e($nfo['name']); ?>" name="<?php echo e($nfo['name']); ?>" lay-skin="primary" title="<?php echo e($nfo['label_text']); ?>" value="<?php echo e($nfo['label_value']); ?>">
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            <?php elseif($info['type']==4): ?><!-- A89 -->

            <?php elseif($info['type']==5): ?><!-- 三公 -->

            <?php endif; ?>
        </div>
    </div>
<?php $__env->stopSection(); ?>
<?php $__env->startSection('id',$id); ?>
<?php $__env->startSection('js'); ?>
    <script>
        layui.use(['form','jquery','layer','element'], function() {
            var form = layui.form(),
                $ = layui.jquery,
                laydate=layui.laydate,
                layer = layui.layer;
                var element = layui.element;
            form.render();
            form.on('submit(formDemo)', function(data) {
                var type = $("input[name='type']").val();
                if (type==1){//百家乐
                    var winner = $("input[name='game']").filter(':checked').val();
                    var playerPair = $("input[name='playerPair']").filter(':checked').val();
                    var bankerPair = $("input[name='bankerPair']").filter(':checked').val();
                    if (winner=='' || winner==null){
                        layer.msg('庄，闲，和 为必选！',{shift: 6,icon:5});
                    }else{
                        var str = '{"game":'+winner;
                        if(playerPair==null && bankerPair==null){
                            str = str + '}';
                        }else if(playerPair!=null && bankerPair==null){
                            str = str + ',"playerPair":'+playerPair + "}";
                        }else if(playerPair == null && bankerPair!=null){
                            str = str + ',"bankerPair":'+bankerPair + "}";
                        }else if(playerPair !=null && bankerPair !=null){
                            str = str + ',"playerPair":'+playerPair + ',"bankerPair":'+bankerPair+ "}";
                        }
                        $.ajax({
                            headers: {
                                'X-CSRF-TOKEN':$("input[name='_token']").val()
                            },
                            url:"<?php echo e(url('/admin/updateBaccaratResult')); ?>",
                            type:"post",
                            data:{
                                'id':$("input[name='id']").val(),
                                "result":str,
                                'time':$("input[name='time']").val()
                            },
                            dataType: "json",
                            success:function (res) {
                                if(res.status == 1){
                                    layer.msg(res.msg,{icon:6});
                                    var index = parent.layer.getFrameIndex(window.name);
                                    setTimeout('parent.layer.close('+index+')',2000);
                                }else{
                                    layer.msg(res.msg,{shift: 6,icon:5});
                                }
                            }
                        });
                    }
                }else if(type==2){//龙虎
                    var winner = $("input[name='winner']").filter(':checked').val();
                    var id = $("input[name='id']").val();
                    var time = $("input[name='time']").val();
                    $.ajax({
                        headers: {
                            'X-CSRF-TOKEN': $('input[name="_token"]').val()
                        },
                        url:"<?php echo e(url('/admin/updateDragonAndTigerResult')); ?>",
                        type:"post",
                        data:{
                            'id':id,
                            'result':winner,
                            'time':time
                        },
                        dataType:'json',
                        success:function (res) {
                            if(res.status == 1){
                                layer.msg(res.msg,{icon:6});
                                var index = parent.layer.getFrameIndex(window.name);
                                setTimeout('parent.layer.close('+index+')',2000);
                            }else{
                                layer.msg(res.msg,{shift: 6,icon:5});
                            }
                        }
                    });
                }else if(type==3){//牛牛
                    /*{"bankernum":"牛1","x1num":"牛牛","x1result":"","x2num":"牛2","x2result":"","x3num":"牛3","x3result":"win"}*/
                }
                return false;
            });
            //复选框的监听事件
            form.on('checkbox(banker)',function (data) {
                if(data.elem.checked==true){
                    $('.checkboxs').each(function () {
                        var that = $(this);
                        var name = that.attr('name');
                        if(name!='banker'){
                            that.attr('disabled','');
                        }
                    });
                }else{
                    $('.checkboxs').each(function () {
                        var that = $(this);
                        var name = that.attr('name');
                        if(name!='banker'){
                            that.removeAttr('disabled');
                        }
                    });
                }
            });
            form.on('checkbox',function (data) {
                var that = $(data.elem);
                var name = that.attr('name');
                if(data.elem.checked==true){
                    if(name!="banker"){
                        $('.checkboxs').each(function () {
                            var name = $(this).attr('name');
                            if(name=='banker'){
                                $(this).attr('disabled','');
                            }
                        });
                    }
                }else{
                    $('.checkboxs').each(function () {
                        var name = $(this).attr('name');
                        if(name=='banker'){
                            $(this).removeAttr('disabled');
                        }
                    });
                }
            });
        });
    </script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('common.edit', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>