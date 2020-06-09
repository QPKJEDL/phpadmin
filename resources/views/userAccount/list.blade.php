@section('title', '订单管理')
@section('header')
    <div class="layui-inline">
        <button class="layui-btn layui-btn-small layui-btn-warm freshBtn"><i class="layui-icon">&#x1002;</i></button>
    </div>
    {{--<div class="layui-inline">
        <input type="text"  value="{{ $input['business_code'] or '' }}" name="business_code" placeholder="请输入商户号" autocomplete="off" class="layui-input">
    </div>
    <div class="layui-inline">
        <input type="text"  value="{{ $input['order_sn'] or '' }}" name="order_sn" placeholder="请输入平台订单号" autocomplete="off" class="layui-input">
    </div>
    <div class="layui-inline">
        <input type="text"  value="{{ $input['out_order_sn'] or '' }}" name="out_order_sn" placeholder="请输入商户订单号" autocomplete="off" class="layui-input">
    </div>
    <div class="layui-inline">
        <input type="text"  value="{{ $input['user_id'] or '' }}" name="user_id" placeholder="请输入码商号" autocomplete="off" class="layui-input">
    </div>
    <div class="layui-inline">
        <select name="status">
            <option value="">请选择支付状态</option>
            <option value="0" {{isset($input['status'])&&$input['status']==0?'selected':''}}>未支付</option>
            <option value="1" {{isset($input['status'])&&$input['status']==1?'selected':''}}>支付成功</option>
            <option value="2" {{isset($input['status'])&&$input['status']==2?'selected':''}}>过期</option>
            <option value="3" {{isset($input['status'])&&$input['status']==3?'selected':''}}>取消</option>
        </select>
    </div>
    <div class="layui-inline">
        <select name="payType">
            <option value="">请选择支付类型</option>
            <option value="1" {{isset($input['payType'])&&$input['payType']==1?'selected':''}}>微信</option>
            <option value="2" {{isset($input['payType'])&&$input['payType']==2?'selected':''}}>支付宝</option>
        </select>
    </div>
    <div class="layui-inline">
        <input type="text"  value="{{ $input['creatime'] or '' }}" name="creatime" placeholder="创建时间" onclick="layui.laydate({elem: this, festival: true})" autocomplete="off" class="layui-input">
    </div>
    <div class="layui-inline" style="padding-top: 10px;float: right;padding-right: 95px;">
        <button class="layui-btn layui-btn-normal" lay-submit lay-filter="formDemo">搜索</button>
        <button id="res" class="layui-btn layui-btn-primary">重置</button>
        <button class="layui-btn layui-btn-warm" name="excel" value="excel">导出EXCEL</button>
    </div>--}}
@endsection
@section('table')
    <table class="layui-table" lay-even lay-skin="nob">
        <input type="hidden" name="_token" value="<?php echo csrf_token(); ?>">
        <colgroup>
            <col class="hidden-xs" width="100">
            <col class="hidden-xs" width="200">
            <col class="hidden-xs" width="100">
            <col class="hidden-xs" width="100">
            <col class="hidden-xs" width="100">
            <col class="hidden-xs" width="150">
            <col class="hidden-xs" width="150">
            <col class="hidden-xs" width="150">
            <col class="hidden-xs" width="150">
            <col class="hidden-xs" width="100">
            <col class="hidden-xs" width="100">
            <col class="hidden-xs" width="100">
            <col class="hidden-xs" width="100">
        </colgroup>
        <thead>
        <tr>
            <th class="hidden-xs">序号1</th>
            <th class="hidden-xs">登录账号</th>
            <th class="hidden-xs">真实姓名</th>
            <th class="hidden-xs">手机号</th>
            <th class="hidden-xs">状态</th>
            <th class="hidden-xs">银行卡名称</th>
            <th class="hidden-xs">银行卡号</th>
             <th class="hidden-xs">注册IP</th>
            <th class="hidden-xs">上次登录IP</th>
            <th class="hidden-xs">创建时间</th>
            <th class="hidden-xs">修改时间</th>
            <th class="hidden-xs" style="text-align: center">操作</th>
        </tr>
        </thead>
        <tbody>
        @foreach($list as $info)
            <tr>
                <td class="hidden-xs">{{$info['user_id']}}</td>
                <td class="hidden-xs">{{$info['account']}}</td>
                <td class="hidden-xs">{{$info['nickname']}}</td>
                <td class="hidden-xs">{{$info["mobile"]}}</td>
                <td class="hidden-xs">{{$info['is_over']}}</td>
                <td class="hidden-xs">{{$info['bank_name']}}</td>
                <td class="hidden-xs">{{$info['bank_card']}}</td>
                <td class="hidden-xs">{{$info['reg_ip']}}</td>
                <td class="hidden-xs">{{$info['last_ip']}}</td>
                <td class="hidden-xs">{{$info['creatime']}}</td>
                <td class="hidden-xs">{{$info['savetime']}}</td>
                <td style="text-align: center">
                    <div class="layui-inline">
                        <button class="layui-btn layui-btn-small layui-btn-normal restPwd" data-id="{{$info['user_id']}}" data-desc="修改密码">修改密码</button>

                        @if($info['is_over']==0)
                            <button class="layui-btn layui-btn-small layui-btn-danger seal" data-id="{{$info['user_id']}}" data-status="1">封禁</button>
                        @else
                            <button class="layui-btn layui-btn-small layui-btn-danger solution" data-id="{{$info['user_id']}}" data-status="0">解除</button>
                        @endif
                    </div>
                </td>
            </tr>
        @endforeach
        @if(!$list[0])
            <tr><td colspan="6" style="text-align: center;color: orangered;">暂无数据</td></tr>
        @endif
        </tbody>
        <input type="hidden" id="token" value="{{csrf_token()}}">
    </table>
    <div class="page-wrap">
        {{$list->render()}}
    </div>
@endsection
@section('js')
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
            //修改密码
            $(".restPwd").click(function () {
                var userId = $(this).attr('data-id');
                layer.prompt({title: '请输入密码', formType: 1}, function(pass, index){
                    layer.close(index);
                    layer.prompt({title: '请再输入密码', formType: 1}, function(pwd, index){
                        layer.close(index);
                        if(pass!=pwd){
                            layer.msg('两次密码输入不同！');
                        }else{
                            $.ajaxSetup({
                                headers: {
                                    'X-CSRF-TOKEN': $('input[name="_token"]').val()
                                }
                            });
                            $.ajax({
                                url:"{{url('/admin/resetPwd')}}",
                                data:{
                                    "user_id":userId,
                                    "pwd":pwd
                                },
                                type:"post",
                                dataType:"json",
                                success:function (res) {
                                    if(res.status==1){
                                        layer.msg(res.msg,{icon:6},function () {
                                            parent.layer.close(index);
                                            window.parent.frames[1].location.reload();
                                        });
                                    }else{
                                        layer.msg(res.msg,{shift: 6,icon:5});
                                    }
                                }
                            });
                        }
                    });
                });
            });
            //封禁
            $(".seal").click(function () {
                var userId = $(this).attr('data-id');
                var status = $(this).attr('data-status');
                layer.confirm('确定要封禁吗？',function (index) {
                    $.ajaxSetup({
                        headers: {
                            'X-CSRF-TOKEN': $('input[name="_token"]').val()
                        }
                    });
                    $.ajax({
                        url:"{{url('/admin/isLogin')}}",
                        data:{
                            "userId":userId,
                            "status":status
                        },
                        type:'post',
                        dataType: "json",
                        success:function (res) {
                            if(res.status==1){
                                layer.msg(res.msg,{icon:6},function () {
                                    parent.layer.close(index);
                                    window.parent.frames[1].location.reload();
                                });
                            }else{
                                layer.msg(res.msg,{shift: 6,icon:5});
                            }
                        }
                    });
                    layer.close(index);
                });
            });
            //解禁
            $('.solution').click(function () {
                var userId = $(this).attr('data-id');
                var status = $(this).attr('data-status');
                layer.confirm('确定要封禁吗？',function (index) {
                    $.ajaxSetup({
                        headers: {
                            'X-CSRF-TOKEN': $('input[name="_token"]').val()
                        }
                    });
                    $.ajax({
                        url:"{{url('/admin/isLogin')}}",
                        data:{
                            "userId":userId,
                            "status":status
                        },
                        type:'post',
                        dataType: "json",
                        success:function (res) {
                            if(res.status==1){
                                layer.msg(res.msg,{icon:6},function () {
                                    parent.layer.close(index);
                                    window.parent.frames[1].location.reload();
                                });
                            }else{
                                layer.msg(res.msg,{shift: 6,icon:5});
                            }
                        }
                    });
                    layer.close(index);
                });
            });
        });
    </script>
@endsection
@extends('common.list')
