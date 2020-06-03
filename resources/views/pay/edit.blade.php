@section('title', '配置编辑')
@section('content')
    <div class="layui-form-item">
        <label class="layui-form-label">商户id：</label>
        <div class="layui-input-block">
            <input type="text" value="{{$info['business_id'] or ''}}" name="business_id" placeholder="请填写商户id" lay-verify="required" autocomplete="off" class="layui-input">
        </div>
    </div>
    <div class="layui-form-item">
        <label class="layui-form-label">商户名称：</label>
        <div class="layui-input-block">
            <input type="text" value="{{$info['business_name'] or ''}}" name="business_name" placeholder="请填写商户名称" lay-verify="required" autocomplete="off" class="layui-input">
        </div>
    </div>
    <div class="layui-form-item">
        <label class="layui-form-label">支付通道：</label>
        <div class="layui-input-block">
            <input type="text" value="{{$info['pay_aisle'] or ''}}" name="pay_aisle" placeholder="请填写支付通道" lay-verify="required" autocomplete="off" class="layui-input">
        </div>
    </div>
    <div class="layui-form-item">
        <label class="layui-form-label">支付操作端：</label>
        <div class="layui-input-block">
            <input type="text" value="{{$info['operation_side'] or ''}}" name="operation_side" placeholder="请填写支付操作端" lay-verify="required" autocomplete="off" class="layui-input">
        </div>
    </div>
    <div class="layui-form-item">
        <label class="layui-form-label">最小充值限额：</label>
        <div class="layui-input-block">
            <input type="text" value="{{$info['min_price'] or ''}}" name="min_price" placeholder="请填写最小充值限额" lay-verify="required" autocomplete="off" class="layui-input">
        </div>
    </div>
    <div class="layui-form-item">
        <label class="layui-form-label">最大充值限额：</label>
        <div class="layui-input-block">
            <input type="text" value="{{$info['max_price'] or ''}}" name="max_price" placeholder="请填写最大充值限额" lay-verify="required" autocomplete="off" class="layui-input">
        </div>
    </div>
    <div class="layui-form-item">
        <label class="layui-form-label">服务名称：</label>
        <div class="layui-input-block">
            <input type="text" value="{{$info['service_name'] or ''}}" name="service_name" placeholder="请填写服务名称" lay-verify="required" autocomplete="off" class="layui-input">
        </div>
    </div>
    <div class="layui-form-item">
        <label class="layui-form-label">支付平台：</label>
        <div class="layui-input-block">
            <input type="text" value="{{$info['pay_type'] or ''}}" name="pay_type" placeholder="请填写支付平台" lay-verify="required" autocomplete="off" class="layui-input">
        </div>
    </div>
    <div class="layui-form-item">
        <label class="layui-form-label">支付通知地址：</label>
        <div class="layui-input-block">
            <input type="text" value="{{$info['page_notify_url'] or ''}}" name="page_notify_url" placeholder="青填写支付通知地址" lay-verify="required" autocomplete="off" class="layui-input">
        </div>
    </div>
    <div class="layui-form-item">
        <label class="layui-form-label">异步通知地址：</label>
        <div class="layui-input-block">
            <input type="text" value="{{$info['asyn_notify_url'] or ''}}" name="asyn_notify_url" placeholder="请填写异步通知地址" lay-verify="required" autocomplete="off" class="layui-input">
        </div>
    </div>
    <div class="layui-form-item">
        <label class="layui-form-label">密钥：</label>
        <div class="layui-input-block">
            <input type="text" value="{{$info['access_key'] or ''}}" name="access_key" placeholder="请填写密钥" lay-verify="required" autocomplete="off" class="layui-input">
        </div>
    </div>
    <div class="layui-form-item">
        <label class="layui-form-label">支付网关：</label>
        <div class="layui-input-block">
            <input type="text" value="{{$info['pay_gateway'] or ''}}" name="pay_gateway" placeholder="请填写支付网关" lay-verify="required" autocomplete="off" class="layui-input">
        </div>
    </div>
    <div class="layui-form-item">
        <label class="layui-form-label">预支付链接：</label>
        <div class="layui-input-block">
            <input type="text" value="{{$info['prepaid_link'] or ''}}" name="prepaid_link" placeholder="请填写预支付链接" lay-verify="required" autocomplete="off" class="layui-input">
        </div>
    </div>
    <div class="layui-form-item">
        <label class="layui-form-label">是否直接跳转：</label>
        <div class="layui-input-block">
            <input type="radio" name="is_jump" value="0" title="是" {{isset($info['is_jump'])&&$info['is_jump']==0?'checked':''}}>
            <input type="radio" name="is_jump" value="1" title="否" {{isset($info['is_jump'])&&$info['is_jump']==1?'checked':''}}>
        </div>
    </div>
    <div class="layui-form-item">
        <label class="layui-form-label">备注：</label>
        <div class="layui-input-block">
            <input type="text" value="{{$info['remark'] or ''}}" name="remark" placeholder="请填写备注" lay-verify="required" autocomplete="off" class="layui-input">
        </div>
    </div>
@endsection
@section('id',$id)
@section('js')
    <script>
        layui.use(['form','jquery','layer','laydate'], function() {
            var form = layui.form()
                ,layer = layui.layer
                ,laydate = layui.laydate
                ,$ = layui.jquery;

            form.render();
            laydate({istoday: true});
            var id = $("input[name='id']").val();
            var index = parent.layer.getFrameIndex(window.name);
            if(id==0){
                form.on('submit(formDemo)', function(data) {
                    $.ajax({
                        url:"{{url('/admin/pay')}}",
                        data:$('form').serialize(),
                        type:"post",
                        success:function(res){
                            if(res.status == 1){
                                layer.msg(res.msg,{icon:6});
                                var index = parent.layer.getFrameIndex(window.name);
                                setTimeout('parent.layer.close('+index+')',2000);
                                //parent.layer.close(index);
                            }else{
                                layer.msg(res.msg,{shift: 6,icon:5});
                            }
                        }
                    });
                    return false;
                });
            }else{
                form.on('submit(formDemo)', function(data) {

                    $.ajax({
                        url:"{{url('/admin/updateIp')}}",
                        data:$('form').serialize(),
                        type:"post",
                        success:function(res){
                            if(res.status == 1){
                                layer.msg(res.msg,{icon:6});
                                var index = parent.layer.getFrameIndex(window.name);
                                setTimeout('parent.layer.close('+index+')',2000);
                                //parent.layer.close(index);
                            }else{
                                layer.msg(res.msg,{shift: 6,icon:5});
                            }
                        }
                    });
                    return false;
                });
            }

        });
        //获取时间戳
        function getDateTime(time) {
            var timeDate = new Date(time);
            return timeDate.getTime();
        }
    </script>
@endsection
@extends('common.edit')