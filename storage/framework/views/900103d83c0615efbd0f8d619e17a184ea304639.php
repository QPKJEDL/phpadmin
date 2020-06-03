<?php $__env->startSection('title', '用户编辑'); ?>
<?php $__env->startSection('content'); ?>
    <div class="layui-form-item">
        <label class="layui-form-label">用户名：</label>
        <div class="layui-input-block">
            <input type="text" value="<?php echo e(isset($info['username']) ? $info['username'] : ''); ?>" name="username" required lay-verify="user_name" placeholder="请输入用户名(请不要出现汉字)" autocomplete="off" class="layui-input">
        </div>
    </div>
    <div class="layui-form-item">
        <label class="layui-form-label">名称：</label>
        <div class="layui-input-block">
            <input type="text" value="<?php echo e(isset($info['nickname']) ? $info['nickname'] : ''); ?>" name="nickname" required lay-verify="required" placeholder="请输入名称" autocomplete="off" class="layui-input">
        </div>
    </div>
    <div class="layui-form-item">
        <label class="layui-form-label">角色：</label>
        <div class="layui-input-block">
            <select name="user_role" lay-verify="required">
                <option value=""></option>
                <?php $__currentLoopData = $roles; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $role): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <option
                            value="<?php echo e($role->id); ?>" <?php echo e(isset($userRole['role_id'])&&$userRole['role_id']==$role->id?'selected':''); ?>><?php echo e($role->display_name); ?>

                    </option>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </select>
        </div>
    </div>
    <div class="layui-form-item">
        <label class="layui-form-label">状态：</label>
        <div class="layui-input-block">
            <input type="radio" name="status" value="0" title="正常"
                   <?php if(!isset($info['status'])): ?>
                   checked
                   <?php elseif(isset($info['status'])&&$info['status']): ?>
                   checked
            <?php else: ?>
                    <?php endif; ?>>
            <input type="radio" name="status" value="1" title="停用" <?php echo e(isset($info['status'])&&!$info['status']?'checked':''); ?>>
        </div>
    </div>
    <?php if($info==null): ?>
        <div class="layui-form-item">
            <label class="layui-form-label">密码：</label>
            <div class="layui-input-block">
                <input type="password" name="pwd" lay-verify="pwd" placeholder="请输入6-12位数字加字母密码" autocomplete="off" class="layui-input">
            </div>
        </div>
        <div class="layui-form-item">
            <label class="layui-form-label">确认密码：</label>
            <div class="layui-input-block">
                <input type="password" name="pwd_confirmation" lay-verify="pwd_confirmation" placeholder="请确认密码" autocomplete="off" class="layui-input">
            </div>
        </div>
    <?php endif; ?>
    <div class="layui-form-item">
        <label class="layui-form-label">IP白名单：</label>
        <div class="layui-input-block">
            <textarea placeholder="请填写IP白名单（非必填）" name="ip_config" class="layui-textarea"><?php echo e(isset($info['ip_config']) ? $info['ip_config'] : ''); ?></textarea>
        </div>
    </div>
    <?php if($info!=null): ?>
        <div class="layui-form-item">
            <label class="layui-form-label">抽水权限：</label>
            <div class="layui-input-block">
                <input type="checkbox" id="baccarat" name="baccarat" lay-skin="primary" title="百家乐" <?php echo e(isset($info['baccarat'])&&$info['baccarat']==1?'checked':''); ?>>
                <input type="checkbox" id="dragon_tiger" name="dragon_tiger" lay-skin="primary" title="龙虎" <?php echo e(isset($info['dragon_tiger'])&&$info['dragon_tiger']==1?'checked':''); ?>>
                <input type="checkbox" id="niuniu" name="niuniu" lay-skin="primary" title="牛牛" <?php echo e(isset($info['niuniu'])&&$info['niuniu']==1?'checked':''); ?>>
                <input type="checkbox" id="sangong" name="sangong" lay-skin="primary" title="三公" <?php echo e(isset($info['sangong'])&&$info['sangong']==1?'checked':''); ?>>
                <input type="checkbox" id="A89" name="A89" lay-skin="primary" title="A89" <?php echo e(isset($info['A89'])&&$info['A89']==1?'checked':''); ?>>
            </div>
        </div>
    <?php else: ?>
        <div class="layui-form-item">
            <label class="layui-form-label">抽水权限：</label>
            <div class="layui-input-block">
                <input type="checkbox" name="baccarat" id="baccarat" lay-skin="primary" title="百家乐">
                <input type="checkbox" name="dragon_tiger" id="dragon_tiger" lay-skin="primary" title="龙虎">
                <input type="checkbox" name="niuniu" id="niuniu" lay-skin="primary" title="牛牛">
                <input type="checkbox" name="sangong" id="sangong" lay-skin="primary" title="三公">
                <input type="checkbox" name="A89" id="A89" lay-skin="primary" title="A89">
            </div>
        </div>
    <?php endif; ?>
    <div class="layui-form-item">
        <div class="layui-inline">
            <label class="layui-form-label">最小限红</label>
            <div class="layui-input-inline" style="width: 100px;">
                <input type="number" lay-verify="minLimit" value="10" disabled="disabled" placeholder="￥" autocomplete="off" class="layui-input">
            </div>
            <div class="layui-form-mid">最大限红</div>
            <div class="layui-input-inline" style="width: 100px;">
                <input type="number" lay-verify="maxLimit" value="50000" disabled="disabled" placeholder="￥" autocomplete="off" class="layui-input">
            </div>
        </div>
    </div>
    <div class="layui-form-item">
        <div class="layui-inline">
            <label class="layui-form-label">最小和限红</label>
            <div class="layui-input-inline" style="width: 100px;">
                <input type="number" lay-verify="minPairLimit" value="10" disabled="disabled" placeholder="￥" autocomplete="off" class="layui-input">
            </div>
            <div class="layui-form-mid">最大和限红</div>
            <div class="layui-input-inline" style="width: 100px;">
                <input type="number" lay-verify="maxPairLimit" value="5000" disabled="disabled" placeholder="￥" autocomplete="off" class="layui-input">
            </div>
        </div>
    </div>
    <div class="layui-form-item">
        <div class="layui-inline">
            <label class="layui-form-label">最小对限红</label>
            <div class="layui-input-inline" style="width: 100px;">
                <input type="number" lay-verify="minTieLimit" value="10" disabled="disabled" placeholder="￥" autocomplete="off" class="layui-input">
            </div>
            <div class="layui-form-mid">最大对限红</div>
            <div class="layui-input-inline" style="width: 100px;">
                <input type="number" lay-verify="maxTieLimit" value="5000" disabled="disabled" placeholder="￥" autocomplete="off" class="layui-input">
            </div>
        </div>
    </div>
    <div class="layui-form-item">
        <label class="layui-form-label">状态：</label>
        <div class="layui-input-block">
            <input type="radio" name="data_permission" value="2" title="本人及以下权限"
                   <?php if(!isset($info['data_permission'])): ?>
                   checked
                   <?php elseif(isset($info['data_permission'])&&$info['data_permission']): ?>
                   checked
            <?php else: ?>
                    <?php endif; ?>>
            <input type="radio" name="data_permission" value="1" title="所有数据权限" <?php echo e(isset($info['data_permission'])&&!$info['data_permission']?'checked':''); ?>>
        </div>
    </div>
    <div class="layui-form-item">
        <label class="layui-form-label">百家乐洗码率：</label>
        <div class="layui-input-inline">
            <input type="number" name="fee[baccarat]" value="0.9" required lay-verify="required" placeholder="请输入百家乐洗码率" autocomplete="off" class="layui-input">
        </div>
    </div>
    <div class="layui-form-item">
        <label class="layui-form-label">龙虎洗码率：</label>
        <div class="layui-input-inline">
            <input type="number" name="fee[dragonTiger]" value="0.9" required lay-verify="required" placeholder="请输入龙虎洗码率" autocomplete="off" class="layui-input">
        </div>
    </div>
    <div class="layui-form-item">
        <label class="layui-form-label">牛牛洗码率：</label>
        <div class="layui-input-inline">
            <input type="number" name="fee[niuniu]" value="0.9" required lay-verify="required" placeholder="请输入牛牛洗码率" autocomplete="off" class="layui-input">
        </div>
    </div>
    <div class="layui-form-item">
        <label class="layui-form-label">三公洗码率：</label>
        <div class="layui-input-inline">
            <input type="number" name="fee[sangong]" value="0.9" required lay-verify="required" placeholder="请输入三公洗码率" autocomplete="off" class="layui-input">
        </div>
    </div><div class="layui-form-item">
        <label class="layui-form-label">A89洗码率：</label>
        <div class="layui-input-inline">
            <input type="number" name="fee[A89]" value="0.9" required lay-verify="required" placeholder="请输入A89洗码率" autocomplete="off" class="layui-input">
        </div>
    </div>
<?php $__env->stopSection(); ?>
<?php $__env->startSection('id',$id); ?>
<?php $__env->startSection('js'); ?>
    <script>
        window.onload=function(){
            var id = $("input[name='id']").val();
            if (id!=0){
                var baccarat = document.getElementById("baccarat");
                var dragonTiger = document.getElementById('dragon_tiger');
                var niuniu = document.getElementById('niuniu');
                var sangong = document.getElementById('sangong');
                var A89 = document.getElementById('A89');
                if (baccarat.checked){
                    baccarat.setAttribute("disabled","");
                }
                if (dragonTiger.checked){
                    dragonTiger.setAttribute("disabled","");
                }
                if (niuniu.checked){
                    niuniu.setAttribute("disabled","");
                }
                if (sangong.checked){
                    sangong.setAttribute("disabled","");
                }
                if (A89.checked){
                    A89.setAttribute("disabled","");
                }
            }
        }

        layui.use(['form','jquery','laypage', 'layer'], function() {
            var form = layui.form(),
                $ = layui.jquery;
            form.render();
            var layer = layui.layer;
            form.verify({
                user_name: function (value) {
                    if(value.length<5){
                        return '长度不能小于5';
                    }
                    if(value.length>12){
                        return '长度不能大于10';
                    }
                },
                pwd:function(value){
                    if(value&&!/^(?!([a-zA-Z]+|\d+)$)[a-zA-Z\d]{6,12}$/.test(value)){
                        return '密码必须6到12位数字加字母';
                    }
                },
                pwd_confirmation: function(value) {
                    if($("input[name='pwd']").val() && $("input[name='pwd']").val() != value) {
                        return '两次输入密码不一致';
                    }
                },
            });
            form.on('submit(formDemo)', function(data) {
                var id = $("input[name='id']").val();
                if(id==0){
                    var data = $('form').serializeArray();
                    //获取dom元素
                    //百家乐
                    var baccarat = document.getElementById('baccarat');
                    if (baccarat.checked){
                        data.push({"name":"baccarat","value":"1"});
                    }else{
                        data.push({"name":"baccarat","value":"0"});
                    }
                    //龙虎
                    var dragonTiger = document.getElementById('dragon_tiger');
                    if (dragonTiger.checked){
                        data.push({"name":"dragon_tiger","value":"1"});
                    }else{
                        data.push({"name":"dragon_tiger","value":"0"});
                    }
                    //牛牛
                    var niuniu = document.getElementById('niuniu');
                    if(niuniu.checked){
                        data.push({"name":"niuniu","value":"1"});
                    }else{
                        data.push({"name":"niuniu","value":"0"});
                    }
                    //三公
                    var sanGong = document.getElementById('sangong');
                    if(sanGong.checked){
                        data.push({"name":"sangong","value":"1"});
                    }else{
                        data.push({"name":"sangong","value":"0"});
                    }
                    //A89
                    var A89 = document.getElementById('A89');
                    if(A89.checked){
                        data.push({"name":"A89","value":"1"});
                    }else{
                        data.push({"name":"A89","value":"0"});
                    }
                    console.log(data)
                    $.ajax({
                        url:"<?php echo e(url('/admin/agent')); ?>",
                        data:data,
                        type:'post',
                        dataType:'json',
                        success:function(res){
                            if(res.status == 1){
                                layer.msg(res.msg,{icon:6});
                                var index = parent.layer.getFrameIndex(window.name);
                                setTimeout('parent.layer.close('+index+')',2000);
                            }else{
                                layer.msg(res.msg,{shift: 6,icon:5});
                            }
                        },
                        error : function(XMLHttpRequest, textStatus, errorThrown) {
                            layer.msg('网络失败', {time: 1000});
                        }
                    });
                    return false;
                }else{

                }
            });
        });
    </script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('common.edit', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>