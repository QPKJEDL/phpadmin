<?php $__env->startSection('title', '公告管理'); ?>
<?php $__env->startSection('header'); ?>
    <div class="layui-inline">
        <button class="layui-btn layui-btn-small layui-btn-warm freshBtn"><i class="layui-icon">&#x1002;</i></button>
    </div>
    <div class="layui-inline">
        <select name="desk_id" lay-filter="desk_id">
            <option value="">请选择台桌</option>
            <?php $__currentLoopData = $desk; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $d): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <option value="<?php echo e($d['id']); ?>" <?php echo e(isset($input['desk_id'])&&$input['desk_id']==$d['id']?'selected':''); ?>><?php echo e($d['desk_name']); ?></option>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        </select>
    </div>
    <div class="layui-inline">
        <div class="layui-input-inline" style="width: 100px;">
            <input type="text" name="bootNum" placeholder="靴号" autocomplete="off" class="layui-input">
        </div>
    </div>
    <div class="layui-inline">
        <div class="layui-input-inline" style="width: 100px;">
            <input type="text" name="paveNum" placeholder="铺号" autocomplete="off" class="layui-input">
        </div>
    </div>
    <div class="layui-inline">
        <input class="layui-input" name="create_time" placeholder="操作时间" onclick="layui.laydate({elem: this, festival: true,min:'<?php echo e($min); ?>'})" value="<?php echo e(isset($input['create_time']) ? $input['create_time'] : ''); ?>" autocomplete="off">
    </div>
    <div class="layui-inline">
        <input class="layui-input" name="bootTime" placeholder="主靴日期" onclick="layui.laydate({elem: this, festival: true,min:'<?php echo e($min); ?>'})" value="<?php echo e(isset($input['boot_time']) ? $input['boot_time'] : ''); ?>" autocomplete="off">
    </div>
    <div class="layui-inline">
        <button class="layui-btn layui-btn-normal" lay-submit lay-filter="formDemo">搜索</button>
        <button class="layui-btn layui-btn-normal" id="reset">重置</button>
    </div>
<?php $__env->stopSection(); ?>
<?php $__env->startSection('table'); ?>
    <table class="layui-table" lay-even lay-skin="nob">
        <colgroup>
            <col class="hidden-xs" width="50">
            <col class="hidden-xs" width="100">
            <col class="hidden-xs" width="100">
            <col class="hidden-xs" width="100">
            <col class="hidden-xs" width="100">
            <col class="hidden-xs" width="100">
            <col class="hidden-xs" width="100">
            <col class="hidden-xs" width="100">
            <col class="hidden-xs" width="100">
        </colgroup>
        <thead>
        <tr>
            <th class="hidden-xs">序号</th>
            <th class="hidden-xs">被修改台桌</th>
            <th class="hidden-xs">靴号</th>
            <th class="hidden-xs">铺号</th>
            <th class="hidden-xs">结果</th>
            <th class="hidden-xs">修改前的结果</th>
            <th class="hidden-xs">修改人</th>
            <th class="hidden-xs">操作时间</th>
            <th class="hidden-xs">主靴日期</th>
        </tr>
        </thead>
        <tbody>
        <?php $__currentLoopData = $list; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $info): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <tr>
                <td class="hidden-xs"><?php echo e($info['id']); ?></td>
                <td class="hidden-xs"><?php echo e($info['desk_name']); ?>[<?php echo e($info['game_name']); ?>]</td>
                <td class="hidden-xs"><?php echo e($info['boot_num']); ?></td>
                <td class="hidden-xs"><?php echo e($info['pave_num']); ?></td>
                <td class="hidden-xs">
                    <?php if($info['game_id']==1): ?><!-- 百家乐 -->
                        <?php echo e($info['result']['game']); ?>&nbsp;<?php echo e($info['result']['playerPair']); ?> <?php echo e($info['result']['bankerPair']); ?>

                    <?php elseif($info['game_id']==2): ?><!-- 龙虎 -->
                        <?php echo e($info['result']); ?>

                    <?php elseif($info['game_id']==3): ?><!-- 牛牛 -->
                        <?php if($info['result']['bankernum']==""): ?>
                            <?php echo e($info['result']['x1result']); ?>&nbsp;<?php echo e($info['result']['x2result']); ?>&nbsp;<?php echo e($info['result']['x3result']); ?>

                        <?php else: ?>
                            <?php echo e($info['result']['bankernum']); ?>

                        <?php endif; ?>
                    <?php endif; ?>
                </td>
                <td class="hidden-xs">
                <?php if($info['game_id']==1): ?><!-- 百家乐 -->
                    <?php echo e($info['afterResult']['game']); ?>&nbsp;<?php echo e($info['afterResult']['playerPair']); ?> <?php echo e($info['afterResult']['bankerPair']); ?>

                    <?php elseif($info['game_id']==2): ?><!-- 龙虎 -->
                    <?php echo e($info['afterResult']); ?>

                    <?php elseif($info['game_id']==3): ?><!-- 牛牛 -->
                    <?php if($info['afterResult']['bankernum']==""): ?>
                        <?php echo e($info['afterResult']['x1result']); ?>&nbsp;<?php echo e($info['afterResult']['x2result']); ?>&nbsp;<?php echo e($info['afterResult']['x3result']); ?>

                    <?php else: ?>
                        <?php echo e($info['afterResult']['bankernum']); ?>

                    <?php endif; ?>
                    <?php endif; ?>
                </td>
                <td class="hidden-xs"><?php echo e($info['create_by']); ?></td>
                <td class="hidden-xs"><?php echo e($info['create_time']); ?></td>
                <td class="hidden-xs"><?php echo e($info['boot_time']); ?></td>
            </tr>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        <?php if(!$list[0]): ?>
            <tr><td colspan="6" style="text-align: center;color: orangered;">暂无数据</td></tr>
        <?php endif; ?>
        </tbody>
    </table>
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
            $("#reset").click(function () {
                $("select[name='desk_id']").val('');
                $("input[name='create_time']").val('');
            });
            form.on('submit(formDemo)', function(data) {                
            });
            
        });
    </script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('common.list', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>