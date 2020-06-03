<?php $__env->startSection('title', '菜单编辑'); ?>
<?php $__env->startSection('content'); ?>
    <div class="layui-form-item">
        <label class="layui-form-label">台桌名称：</label>
        <div class="layui-input-block">
            <input type="text" value="<?php echo e(isset($info['desk_name']) ? $info['desk_name'] : ''); ?>" name="desk_name" required lay-verify="desk_name" placeholder="请输入名称" autocomplete="off" class="layui-input">
        </div>

    </div>
    <div class="layui-form-item">
        <label class="layui-form-label">台桌类型：</label>
        <div class="layui-input-inline">
            <select name="game_id" lay-verify="required" lay-filter="game">
                <option value="">请选择游戏</option>
                <?php $__currentLoopData = $gameType; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $nfo): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <option value="<?php echo e($nfo['id']); ?>" <?php echo e(isset($info['game_id'])&&$info['game_id']==$nfo['id']?'selected':''); ?>><?php echo e($nfo['game_name']); ?></option>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </select>
        </div>
    </div>
    <div class="layui-form-item">
        <label class="layui-form-label">倒计时：</label>
        <div class="layui-input-block">
            <input type="number" value="<?php echo e(isset($info['count_down']) ? $info['count_down'] : ''); ?>" name="count_down" required lay-verify="count_down" placeholder="请输入倒计时" autocomplete="off" class="layui-input">
        </div>
    </div>
    <div class="layui-form-item">
        <label class="layui-form-label">等待开牌时间：</label>
        <div class="layui-input-block">
            <input type="number" value="<?php echo e(isset($info['wait_down']) ? $info['wait_down'] : ''); ?>" name="wait_down" required lay-verify="wait_down" placeholder="请输入开牌时间" autocomplete="off" class="layui-input">
        </div>
    </div>
    <div class="layui-form-item">
        <label class="layui-form-label">全景1：</label>
        <div class="layui-input-block">
            <input type="text" value="<?php echo e(isset($info['all_scene1']) ? $info['all_scene1'] : ''); ?>" name="all_scene1" required lay-verify="all_scene1" placeholder="全景1" autocomplete="off" class="layui-input">
        </div>
    </div>
    <div class="layui-form-item">
        <label class="layui-form-label">h5全景1：</label>
        <div class="layui-input-block">
            <input type="text" value="<?php echo e(isset($info['h5_all_scene1']) ? $info['h5_all_scene1'] : ''); ?>" name="h5_all_scene1" required lay-verify="h5_all_scene1" placeholder="h5全景1" autocomplete="off" class="layui-input">
        </div>
    </div>
    <div class="layui-form-item">
        <label class="layui-form-label">全景2：</label>
        <div class="layui-input-block">
            <input type="text" value="<?php echo e(isset($info['all_scene2']) ? $info['all_scene2'] : ''); ?>" name="all_scene2" required lay-verify="all_scene2" placeholder="全景2" autocomplete="off" class="layui-input">
        </div>
    </div>
    <div class="layui-form-item">
        <label class="layui-form-label">h5全景2：</label>
        <div class="layui-input-block">
            <input type="text" value="<?php echo e(isset($info['h5_all_scene2']) ? $info['h5_all_scene2'] : ''); ?>" name="h5_all_scene2" required lay-verify="h5_all_scene2" placeholder="h5全景2" autocomplete="off" class="layui-input">
        </div>
    </div>
    <div class="layui-form-item">
        <label class="layui-form-label">左台播放地址：</label>
        <div class="layui-input-block">
            <input type="text" value="<?php echo e(isset($info['left_play']) ? $info['left_play'] : ''); ?>" name="left_play" required lay-verify="left_play" placeholder="左台播放地址" autocomplete="off" class="layui-input">
        </div>
    </div>
    <div class="layui-form-item">
        <label class="layui-form-label">左台播放备用地址：</label>
        <div class="layui-input-block">
            <input type="text" value="<?php echo e(isset($info['left_play_backup']) ? $info['left_play_backup'] : ''); ?>" name="left_play_backup" required lay-verify="left_play_backup" placeholder="左台播放备用地址" autocomplete="off" class="layui-input">
        </div>
    </div>
    <div class="layui-form-item">
        <label class="layui-form-label">右台播放地址：</label>
        <div class="layui-input-block">
            <input type="text" value="<?php echo e(isset($info['right_play']) ? $info['right_play'] : ''); ?>" name="right_play" required lay-verify="right_play" placeholder="右台播放地址" autocomplete="off" class="layui-input">
        </div>
    </div>
    <div class="layui-form-item">
        <label class="layui-form-label">右台播放备用地址：</label>
        <div class="layui-input-block">
            <input type="text" value="<?php echo e(isset($info['right_play_backup']) ? $info['right_play_backup'] : ''); ?>" name="right_play_backup" required lay-verify="right_play_backup" placeholder="右台播放备用地址" autocomplete="off" class="layui-input">
        </div>
    </div>
    <div class="layui-form-item">
        <label class="layui-form-label">H5左台地址：</label>
        <div class="layui-input-block">
            <input type="text" value="<?php echo e(isset($info['h5_left']) ? $info['h5_left'] : ''); ?>" name="h5_left" required lay-verify="h5_left" placeholder="H5左台地址" autocomplete="off" class="layui-input">
        </div>
    </div>
    <div class="layui-form-item">
        <label class="layui-form-label">H5左台备用地址：</label>
        <div class="layui-input-block">
            <input type="text" value="<?php echo e(isset($info['h5_left_backup']) ? $info['h5_left_backup'] : ''); ?>" name="h5_left_backup" required lay-verify="h5_left_backup" placeholder="H5左台备用地址" autocomplete="off" class="layui-input">
        </div>
    </div>
    <div class="layui-form-item">
        <label class="layui-form-label">H5右台地址：</label>
        <div class="layui-input-block">
            <input type="text" value="<?php echo e(isset($info['h5_right']) ? $info['h5_right'] : ''); ?>" name="h5_right" required lay-verify="h5_right" placeholder="H5右台地址" autocomplete="off" class="layui-input">
        </div>
    </div>
    <div class="layui-form-item">
        <label class="layui-form-label">H5右台备用地址：</label>
        <div class="layui-input-block">
            <input type="text" value="<?php echo e(isset($info['h5_right_backup']) ? $info['h5_right_backup'] : ''); ?>" name="h5_right_backup" required lay-verify="h5_right_backup" placeholder="H5右台备用地址" autocomplete="off" class="layui-input">
        </div>
    </div>
    <div class="layui-form-item">
        <label class="layui-form-label">最小限红：</label>
        <div class="layui-inline">
            <label class="layui-form-label">点击:</label>
            <div class="layui-input-inline" style="width: 100px;">
                <input type="number" name="min_limit[c]" value="<?php echo e(isset($minLimit['c']) ? $minLimit['c'] : ''); ?>" placeholder="" autocomplete="off" class="layui-input">
            </div>
            <div class="layui-form-mid">US:</div>
            <div class="layui-input-inline" style="width: 100px;">
                <input type="number" name="min_limit[cu]" value="<?php echo e(isset($minLimit['cu']) ? $minLimit['cu'] : ''); ?>" placeholder="" autocomplete="off" class="layui-input">
            </div>
        </div>
        <div class="layui-inline">
            <label class="layui-form-label">电话:</label>
            <div class="layui-input-inline" style="width: 100px;">
                <input type="number" name="min_limit[p]" value="<?php echo e(isset($minLimit['p']) ? $minLimit['p'] : ''); ?>" placeholder="" autocomplete="off" class="layui-input">
            </div>
            <div class="layui-form-mid">US:</div>
            <div class="layui-input-inline" style="width: 100px;">
                <input type="number" name="min_limit[pu]" value="<?php echo e(isset($minLimit['pu']) ? $minLimit['pu'] : ''); ?>" placeholder="" autocomplete="off" class="layui-input">
            </div>
        </div>
    </div>
    <div class="layui-form-item">
        <label class="layui-form-label">最大限红：</label>
        <div class="layui-inline">
            <label class="layui-form-label">点击:</label>
            <div class="layui-input-inline" style="width: 100px;">
                <input type="number" name="max_limit[c]" value="<?php echo e(isset($maxLimit['c']) ? $maxLimit['c'] : ''); ?>" placeholder="" autocomplete="off" class="layui-input">
            </div>
            <div class="layui-form-mid">US:</div>
            <div class="layui-input-inline" style="width: 100px;">
                <input type="number" name="max_limit[cu]" value="<?php echo e(isset($maxLimit['cu']) ? $maxLimit['cu'] : ''); ?>" placeholder="" autocomplete="off" class="layui-input">
            </div>
        </div>
        <div class="layui-inline">
            <label class="layui-form-label">电话:</label>
            <div class="layui-input-inline" style="width: 100px;">
                <input type="number" name="max_limit[p]" value="<?php echo e(isset($maxLimit['p']) ? $maxLimit['p'] : ''); ?>" placeholder="" autocomplete="off" class="layui-input">
            </div>
            <div class="layui-form-mid">US:</div>
            <div class="layui-input-inline" style="width: 100px;">
                <input type="number" name="max_limit[pu]" value="<?php echo e(isset($maxLimit['pu']) ? $maxLimit['pu'] : ''); ?>"  placeholder="" autocomplete="off" class="layui-input">
            </div>
        </div>
    </div>
    <div class="layui-form-item">
        <label class="layui-form-label">最小和限红：</label>
        <div class="layui-inline">
            <label class="layui-form-label">点击:</label>
            <div class="layui-input-inline" style="width: 100px;">
                <input type="number" name="min_tie_limit[c]" value="<?php echo e(isset($minTieLimit['c']) ? $minTieLimit['c'] : ''); ?>" placeholder="" autocomplete="off" class="layui-input">
            </div>
            <div class="layui-form-mid">US:</div>
            <div class="layui-input-inline" style="width: 100px;">
                <input type="number" name="min_tie_limit[cu]" value="<?php echo e(isset($minTieLimit['cu']) ? $minTieLimit['cu'] : ''); ?>" placeholder="" autocomplete="off" class="layui-input">
            </div>
        </div>
        <div class="layui-inline">
            <label class="layui-form-label">电话:</label>
            <div class="layui-input-inline" style="width: 100px;">
                <input type="number" name="min_tie_limit[p]" value="<?php echo e(isset($minTieLimit['p']) ? $minTieLimit['p'] : ''); ?>" placeholder="" autocomplete="off" class="layui-input">
            </div>
            <div class="layui-form-mid">US:</div>
            <div class="layui-input-inline" style="width: 100px;">
                <input type="number" name="min_tie_limit[pu]" value="<?php echo e(isset($minTieLimit['pu']) ? $minTieLimit['pu'] : ''); ?>" placeholder="" autocomplete="off" class="layui-input">
            </div>
        </div>
    </div>
    <div class="layui-form-item">
        <label class="layui-form-label">最大和限红：</label>
        <div class="layui-inline">
            <label class="layui-form-label">点击:</label>
            <div class="layui-input-inline" style="width: 100px;">
                <input type="number" name="max_tie_limit[c]" value="<?php echo e(isset($maxTieLimit['c']) ? $maxTieLimit['c'] : ''); ?>" placeholder="" autocomplete="off" class="layui-input">
            </div>
            <div class="layui-form-mid">US:</div>
            <div class="layui-input-inline" style="width: 100px;">
                <input type="number" name="max_tie_limit[cu]" value="<?php echo e(isset($maxTieLimit['cu']) ? $maxTieLimit['cu'] : ''); ?>" placeholder="" autocomplete="off" class="layui-input">
            </div>
        </div>
        <div class="layui-inline">
            <label class="layui-form-label">电话:</label>
            <div class="layui-input-inline" style="width: 100px;">
                <input type="number" name="max_tie_limit[p]" value="<?php echo e(isset($maxTieLimit['p']) ? $maxTieLimit['p'] : ''); ?>" placeholder="" autocomplete="off" class="layui-input">
            </div>
            <div class="layui-form-mid">US:</div>
            <div class="layui-input-inline" style="width: 100px;">
                <input type="number" name="max_tie_limit[pu]" value="<?php echo e(isset($maxTieLimit['pu']) ? $maxTieLimit['pu'] : ''); ?>" placeholder="" autocomplete="off" class="layui-input">
            </div>
        </div>
    </div>
    <div class="layui-form-item">
        <label class="layui-form-label">最小对子限红：</label>
        <div class="layui-inline">
            <label class="layui-form-label">点击:</label>
            <div class="layui-input-inline" style="width: 100px;">
                <input type="number" name="min_pair_limit[c]" value="<?php echo e(isset($minPairLimit['c']) ? $minPairLimit['c'] : ''); ?>" placeholder="" autocomplete="off" class="layui-input">
            </div>
            <div class="layui-form-mid">US:</div>
            <div class="layui-input-inline" style="width: 100px;">
                <input type="number" name="min_pair_limit[cu]" value="<?php echo e(isset($minPairLimit['cu']) ? $minPairLimit['cu'] : ''); ?>" placeholder="" autocomplete="off" class="layui-input">
            </div>
        </div>
        <div class="layui-inline">
            <label class="layui-form-label">电话:</label>
            <div class="layui-input-inline" style="width: 100px;">
                <input type="number" name="min_pair_limit[p]" value="<?php echo e(isset($minPairLimit['p']) ? $minPairLimit['p'] : ''); ?>" placeholder="" autocomplete="off" class="layui-input">
            </div>
            <div class="layui-form-mid">US:</div>
            <div class="layui-input-inline" style="width: 100px;">
                <input type="number" name="min_pair_limit[pu]" value="<?php echo e(isset($minPairLimit['pu']) ? $minPairLimit['pu'] : ''); ?>" placeholder="" autocomplete="off" class="layui-input">
            </div>
        </div>
    </div>
    <div class="layui-form-item">
        <label class="layui-form-label">最大对子限红：</label>
        <div class="layui-inline">
            <label class="layui-form-label">点击:</label>
            <div class="layui-input-inline" style="width: 100px;">
                <input type="number" name="max_pair_limit[c]" value="<?php echo e(isset($maxPairLimit['c']) ? $maxPairLimit['c'] : ''); ?>" placeholder="" autocomplete="off" class="layui-input">
            </div>
            <div class="layui-form-mid">US:</div>
            <div class="layui-input-inline" style="width: 100px;">
                <input type="number" name="max_pair_limit[cu]" value="<?php echo e(isset($maxPairLimit['cu']) ? $maxPairLimit['cu'] : ''); ?>" placeholder="" autocomplete="off" class="layui-input">
            </div>
        </div>
        <div class="layui-inline">
            <label class="layui-form-label">电话:</label>
            <div class="layui-input-inline" style="width: 100px;">
                <input type="number" name="max_pair_limit[p]" value="<?php echo e(isset($maxPairLimit['p']) ? $maxPairLimit['p'] : ''); ?>" placeholder="" autocomplete="off" class="layui-input">
            </div>
            <div class="layui-form-mid">US:</div>
            <div class="layui-input-inline" style="width: 100px;">
                <input type="number" name="max_pair_limit[pu]" value="<?php echo e(isset($maxPairLimit['pu']) ? $maxPairLimit['pu'] : ''); ?>" placeholder="" autocomplete="off" class="layui-input">
            </div>
        </div>
    </div>
    <div class="layui-form-item">
        <label class="layui-form-label">台桌登录IP限制：</label>
        <div class="layui-input-block">
            <input type="text" value="<?php echo e(isset($info['ip_limit']) ? $info['ip_limit'] : ''); ?>" name="ip_limit" required lay-verify="ip_limit" placeholder="请输入IP地址，样式如：192.168.0.1" autocomplete="off" class="layui-input">
        </div>
    </div>
    <div class="layui-form-item">
        <label class="layui-form-label">台桌顺序：</label>
        <div class="layui-input-inline">
            <input type="number" value="<?php echo e(isset($info['sort']) ? $info['sort'] : ''); ?>" name="sort" lay-verify="required|sort" autocomplete="off" class="layui-input">
        </div>
    </div>
    <div class="layui-form-item">
        <label class="layui-form-label">是否主播：</label>
        <div class="layui-input-block">
                <input type="radio" name="is_alive" value="0" title="否"
                       <?php if(!isset($info['is_alive'])): ?>
                       checked
                       <?php elseif(isset($info['is_alive'])&&$info['is_alive']): ?>
                       checked
                <?php else: ?>
                        <?php endif; ?>>
                <input type="radio" name="is_alive" value="1" title="是" <?php echo e(isset($info['is_alive'])&&!$info['is_alive']?'checked':''); ?>>
            </div>
    </div>
    <div class="layui-form-item">
        <label class="layui-form-label">台桌推送：</label>
        <div class="layui-input-block">
            <input type="radio" name="is_push" value="0" title="点击"
                   <?php if(!isset($info['is_push'])): ?>
                   checked
                   <?php elseif(isset($info['is_push'])&&$info['is_push']): ?>
                   checked
            <?php else: ?>
                    <?php endif; ?>>
            <input type="radio" name="is_push" value="1" title="电话" <?php echo e(isset($info['is_push'])&&!$info['is_push']?'checked':''); ?>>
        </div>
    </div>
    <?php if($info != null): ?>
        <?php if($info['game_id'] != 1 && $info['game_id'] != 2): ?>
            <div class="layui-form-item">
                <label class="layui-form-label">超倍开关：</label>
                <div class="layui-input-block">
                    <input type="radio" name="super" value="0" title="关"
                           <?php if(!isset($info['super'])): ?>
                           checked
                           <?php elseif(isset($info['super'])&&$info['super']): ?>
                           checked
                    <?php else: ?>
                            <?php endif; ?>>
                    <input type="radio" name="super" value="1" title="开" <?php echo e(isset($info['super'])&&!$info['super']?'checked':''); ?>>
                </div>
            </div>
        <?php endif; ?>
    <?php else: ?>
    <div class="layui-form-item" id="open">
        <label class="layui-form-label">超倍开关：</label>
        <div class="layui-input-block">
            <input type="radio" name="super" value="0" title="关" checked>
            <input type="radio" name="super" value="1" title="开">
        </div>
    </div>
    <?php endif; ?>
<?php $__env->stopSection(); ?>
<?php $__env->startSection('id',$id); ?>
<?php $__env->startSection('js'); ?>
    <script>
        window.onload=function(){
            var game = $("select[name='game_id']").val();
            if (game != 1 && game != 2){
                $("#open").show();
            }else{
                $("#open").hide();
            }
        }
        layui.use(['form','laypage', 'layer'], function() {
            var form = layui.form();
            form.render();
            var laypage = layui.laypage
                ,layer = layui.layer;
            form.verify({
                desk_name:function (value) {
                    if(value.length <2){
                        return '台桌名称最少2个字符'
                    }
                },
                count_down:function (value) {
                    if(value<20){
                        return '倒计时时间必须大于20秒'
                    }
                },
                wait_down:function (value) {
                    if(value < 20){
                        return '等待开牌时间必须大于20秒'
                    }
                },
                ip_limit:function (value) {
                    //效验ip正则表达式
                    var reg = /^(\d{1,2}|1\d\d|2[0-4]\d|25[0-5])\.(\d{1,2}|1\d\d|2[0-4]\d|25[0-5])\.(\d{1,2}|1\d\d|2[0-4]\d|25[0-5])\.(\d{1,2}|1\d\d|2[0-4]\d|25[0-5])$/;
                    if(reg.test(value)==false){
                        return 'IP格式不对'
                    }
                }
            });
            form.on('select(game)',function (data) {
                var v = data.value;
                if (v != "" && v != 1 && v != 2){
                    $("#open").show();
                }else{
                    $("#open").hide();
                }
            });
            form.on('submit(formDemo)', function(data) {
                var id = $("input[name='id']").val();
                if(id==0){
                    $.ajax({
                        url:"<?php echo e(url('/admin/desk')); ?>",
                        data:$('form').serialize(),
                        type:'post',
                        dataType:'json',
                        success:function(res){
                            if(res.status == 1){
                                layer.msg(res.msg,{icon:6});
                                var index = parent.layer.getFrameIndex(window.name);
                                setTimeout('parent.layer.close('+index+')',2000);
                                //parent.layer.close(index);
                            }else{
                                layer.msg(res.msg,{shift: 6,icon:5});
                            }
                        },
                        error : function(XMLHttpRequest, textStatus, errorThrown) {
                            layer.msg('网络失败', {time: 1000});
                        }
                    });
                }else{
                    $.ajax({
                        url:"<?php echo e(url('/admin/deskUpdate')); ?>",
                        data:$('form').serialize(),
                        type:'post',
                        dataType:'json',
                        success:function(res){
                            if(res.status == 1){
                                layer.msg(res.msg,{icon:6});
                                var index = parent.layer.getFrameIndex(window.name);
                                setTimeout('parent.layer.close('+index+')',2000);
                                //parent.layer.close(index);
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