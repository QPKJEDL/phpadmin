<?php $__env->startSection('title', '全统计'); ?>
<?php $__env->startSection('header'); ?>
    <div class="layui-inline" style="padding-left: 30px">
    <button class="layui-btn layui-btn-small layui-btn-warm freshBtn"><i class="layui-icon">&#x1002;</i></button>
    </div>
<?php $__env->stopSection(); ?>
<?php $__env->startSection('table'); ?>   
    <div class="layui-inline" style="width: 30%;margin-left: 30px">
        <fieldset class="layui-elem-field site-demo-button">
            <legend>订单统计</legend>
            <br>
            <blockquote class="layui-elem-quote layui-text" style="veritical-align:middle;">
                <div class="layui-form-item">
                    <label style="font-size: 15px;">成功订单额</label>
                    <span class="layui-btn layui-btn-small layui-btn-danger" style="margin-left: 105px"><?php echo e($data['order']['tol_sore']); ?>元</span>
                </div>

                <div class="layui-form-item">
                    <label style="font-size: 15px;">成功资金额(扣除费率)</label>
                    <span class="layui-btn layui-btn-small layui-btn-danger" style="margin-left: 35px"><?php echo e($data['order']['sore_balance']); ?>元</span>
                </div>

                <div class="layui-form-item">
                    <label style="font-size: 15px;">成功总盈利</label>
                    <span class="layui-btn layui-btn-small layui-btn-danger" style="margin-left: 105px"><?php echo e($data['order']['order_profit']); ?>元</span>
                </div>

                <div class="layui-form-item">
                    <label style="font-size: 15px;">码商跑分佣金</label>
                    <span class="layui-btn layui-btn-small layui-btn-danger" style="margin-left: 90px"><?php echo e($data['code']['tol_brokerage']); ?>元</span>
                </div>

                <div class="layui-form-item">
                    <label style="font-size: 15px;">代理跑分佣金</label>
                    <span class="layui-btn layui-btn-small layui-btn-danger" style="margin-left: 90px"><?php echo e($data['agent']['tol_brokerage']); ?>元</span>
                </div>
            </blockquote>
            <br>
        </fieldset>
    </div>

    <div class="layui-inline" style="width: 30%;margin-left: 30px">
        <fieldset class="layui-elem-field site-demo-button">
            <legend>商户提现</legend>
            <br>
            <blockquote class="layui-elem-quote layui-text" style="veritical-align:middle;">
                <div class="layui-form-item">
                    <label style="font-size: 15px;">商户总提现</label>
                    <span class="layui-btn layui-btn-small layui-btn-danger" style="margin-left: 105px"><?php echo e($data['bus']['drawdone']); ?>元</span>
                </div>

                <div class="layui-form-item">
                    <label style="font-size: 15px;">商户未提现</label>
                    <span class="layui-btn layui-btn-small layui-btn-danger" style="margin-left: 105px"><?php echo e($data['bus']['balance']); ?>元</span>
                </div>

                <div class="layui-form-item">
                    <label style="font-size: 15px;">商户提现中</label>
                    <span class="layui-btn layui-btn-small layui-btn-danger" style="margin-left: 105px"><?php echo e($data['bus']['drawnone']); ?>元</span>
                </div>

                <div class="layui-form-item">
                    <label style="font-size: 15px;">商户提现总手续费</label>
                    <span class="layui-btn layui-btn-small layui-btn-danger" style="margin-left: 60px"><?php echo e($data['bus']['feemoney']); ?>元</span>
                </div>
            </blockquote>
            <br>
        </fieldset>
    </div>

    <div class="layui-inline" style="width: 30%;margin-left: 30px">
        <fieldset class="layui-elem-field site-demo-button">
            <legend>代理提现</legend>
            <br>
            <blockquote class="layui-elem-quote layui-text" style="veritical-align:middle;">
                <div class="layui-form-item">
                    <label style="font-size: 15px;">代理总提现</label>
                    <span class="layui-btn layui-btn-small layui-btn-danger" style="margin-left: 105px"><?php echo e($data['agent']['drawdone']); ?>元</span>
                </div>

                <div class="layui-form-item">
                    <label style="font-size: 15px;">代理未提现</label>
                    <span class="layui-btn layui-btn-small layui-btn-danger" style="margin-left: 105px"><?php echo e($data['agent']['balance']); ?>元</span>
                </div>

                <div class="layui-form-item">
                    <label style="font-size: 15px;">代理提现中</label>
                    <span class="layui-btn layui-btn-small layui-btn-danger" style="margin-left: 105px"><?php echo e($data['agent']['drawnone']); ?>元</span>
                </div>

                <div class="layui-form-item">
                    <label style="font-size: 15px;">代理提现总手续费</label>
                    <span class="layui-btn layui-btn-small layui-btn-danger" style="margin-left: 60px"><?php echo e($data['agent']['feemoney']); ?>元</span>
                </div>
            </blockquote>
            <br>
        </fieldset>
    </div>

    <div class="layui-inline" style="width: 30%;margin-left: 30px">
        <fieldset class="layui-elem-field site-demo-button">
            <legend>码商提现</legend>
            <br>
            <blockquote class="layui-elem-quote layui-text" style="veritical-align:middle;">
                <div class="layui-form-item">
                    <label style="font-size: 15px;">码商总提现</label>
                    <span class="layui-btn layui-btn-small layui-btn-danger" style="margin-left: 105px"><?php echo e($data['code']['drawdone']); ?>元</span>
                </div>

                <div class="layui-form-item">
                    <label style="font-size: 15px;">码商未提现</label>
                    <span class="layui-btn layui-btn-small layui-btn-danger" style="margin-left: 105px"><?php echo e($data['code']['balance']); ?>元</span>
                </div>

                <div class="layui-form-item">
                    <label style="font-size: 15px;">码商提现中</label>
                    <span class="layui-btn layui-btn-small layui-btn-danger" style="margin-left: 105px"><?php echo e($data['code']['drawnone']); ?>元</span>
                </div>

                <div class="layui-form-item">
                    <label style="font-size: 15px;">码商提现总手续费</label>
                    <span class="layui-btn layui-btn-small layui-btn-danger" style="margin-left: 60px"><?php echo e($data['code']['feemoney']); ?>元</span>
                </div>
            </blockquote>
            <br>
        </fieldset>
    </div>

    <div class="layui-inline" style="width: 30%;margin-left: 30px">
        <fieldset class="layui-elem-field site-demo-button">
            <legend>码商激活</legend>
            <br>
            <blockquote class="layui-elem-quote layui-text" style="veritical-align:middle;">
                <div class="layui-form-item">
                    <label style="font-size: 15px;">码商激活费用</label>
                    <span class="layui-btn layui-btn-small layui-btn-danger" style="margin-left: 90px"><?php echo e($data['code']['active_money']); ?>元</span>
                </div>

                <div class="layui-form-item">
                    <label style="font-size: 15px;">码商激活佣金</label>
                    <span class="layui-btn layui-btn-small layui-btn-danger" style="margin-left: 90px"><?php echo e($data['code']['active_brokerage']); ?>元</span>
                </div>

                <div class="layui-form-item">
                    <label style="font-size: 15px;">码商激活盈利</label>
                    <span class="layui-btn layui-btn-small layui-btn-danger" style="margin-left: 90px"><?php echo e($data['code']['active_profit']); ?>元</span>
                </div>
            </blockquote>
            <br>
        </fieldset>
    </div>

    <div class="layui-inline" style="width: 30%;margin-left: 30px">
        <fieldset class="layui-elem-field site-demo-button">
            <legend>码商充值</legend>
            <br>
            <blockquote class="layui-elem-quote layui-text" style="veritical-align:middle;">
                <div class="layui-form-item">
                    <label style="font-size: 15px;">码商线上充值</label>
                    <span class="layui-btn layui-btn-small layui-btn-danger" style="margin-left: 90px"><?php echo e($data['code']['tol_recharge']); ?>元</span>
                </div>

                <div class="layui-form-item">
                    <label style="font-size: 15px;">码商上分</label>
                    <span class="layui-btn layui-btn-small layui-btn-danger" style="margin-left: 120px"><?php echo e($data['code']['shangfen']); ?>元</span>
                </div>

                <div class="layui-form-item">
                    <label style="font-size: 15px;">码商下分</label>
                    <span class="layui-btn layui-btn-small layui-btn-danger" style="margin-left: 120px"><?php echo e($data['code']['xiafen']); ?>元</span>
                </div>
            </blockquote>
            <br>
        </fieldset>
    </div>

    <div class="layui-inline" style="width: 30%;margin-left: 30px">
        <fieldset class="layui-elem-field site-demo-button">
            <legend>码商统计</legend>
            <br>
            <blockquote class="layui-elem-quote layui-text" style="veritical-align:middle;">
                <div class="layui-form-item">
                    <label style="font-size: 15px;">码商注册人数</label>
                    <span class="layui-btn layui-btn-small layui-btn-danger" style="margin-left: 90px"><?php echo e($data['codeuser']['codenum']); ?>人</span>
                </div>

                <div class="layui-form-item">
                    <label style="font-size: 15px;">码商激活人数</label>
                    <span class="layui-btn layui-btn-small layui-btn-danger" style="margin-left: 90px"><?php echo e($data['codeuser']['active']); ?>人</span>
                </div>

                <div class="layui-form-item">
                    <label style="font-size: 15px;">二维码可用数</label>
                    <span class="layui-btn layui-btn-small layui-btn-danger" style="margin-left: 90px"><?php echo e($data['codeuser']['erweima']); ?>个</span>
                </div>

                <div class="layui-form-item">
                    <label style="font-size: 15px;">码商冻结中金额</label>
                    <span class="layui-btn layui-btn-small layui-btn-danger" style="margin-left: 75px"><?php echo e($data['code']['freeze_money']); ?>元</span>
                </div>
            </blockquote>
            <br>
        </fieldset>
    </div>

    <div class="layui-inline" style="width: 30%;margin-left: 30px">
        <fieldset class="layui-elem-field site-demo-button">
            <legend>账单核算</legend>
            <br>
            <blockquote class="layui-elem-quote layui-text" style="veritical-align:middle;">
                <div class="layui-form-item">
                    <label style="font-size: 15px;">卡上余额</label>
                    <span class="layui-btn layui-btn-small layui-btn-danger" style="margin-left: 120px"><?php echo e($data['plat']['card_balance']); ?>元</span>
                </div>

                <div class="layui-form-item">
                    <label style="font-size: 15px;">平台盈利</label>
                    <span class="layui-btn layui-btn-small layui-btn-danger" style="margin-left: 120px"><?php echo e($data['plat']['plat_profit']); ?>元</span>
                </div>

                <div class="layui-form-item">
                    <label style="font-size: 15px;">总沉淀资金</label>
                    <span class="layui-btn layui-btn-small layui-btn-danger" style="margin-left: 105px"><?php echo e($data['plat']['down_money']); ?>元</span>
                </div>
            </blockquote>
            <br>
        </fieldset>
    </div>

<?php $__env->stopSection(); ?>
<?php $__env->startSection('js'); ?>
    <script>
        layui.use(['form', 'jquery','laydate', 'layer'], function() {
            var form = layui.form(),
                $ = layui.jquery,
                laydate = layui.laydate,
                layer = layui.layer
            ;
            laydate({istoday: true});
            form.render();
            form.on('submit(formDemo)', function(data) {
            });
        });
    </script>
<?php $__env->stopSection(); ?>


<?php echo $__env->make('common.list', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>