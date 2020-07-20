@section('title', '系统开关')
@section('header')
    <div class="layui-inline">
        <button class="layui-btn layui-btn-small layui-btn-warm freshBtn"><i class="layui-icon">&#x1002;</i></button>
    </div>
@endsection
@section('table')
    <form class="layui-form">
        <div class="layui-form-item">
            <label class="layui-form-label">系统维护</label>
            <div class="layui-input-inline">
                <input type="checkbox" name="sys" value="{{$system['id']}}" lay-skin="switch" lay-text="开启|关闭" lay-filter="sys" {{ $system['status'] == 0 ? 'checked' : '' }}>
            </div>
            <div class="layui-form-mid layui-word-aux">点击系统开关</div>
        </div>
        <div class="layui-form-item">
            <label class="layui-form-label">充提开关</label>
            <div class="layui-input-inline">
                <input type="checkbox" name="draw" value="{{$drawOpen['id']}}" lay-skin="switch" lay-text="开启|关闭" lay-filter="draw" {{ $drawOpen['status'] == 0 ? 'checked' : '' }}>
            </div>
            <div class="layui-form-mid layui-word-aux">会员在线充提</div>
        </div>
        <input type="hidden" id="token" value="{{csrf_token()}}">
    </form>
@endsection
@section('js')
    <script>
        layui.use(['form', 'jquery', 'layer','laydate'], function() {
            var form = layui.form(),
                $ = layui.jquery,
                laydate=layui.laydate,
                layer = layui.layer;
            laydate({istoday: true});
            form.render();

//系统维护
            form.on('switch(sys)', function(obj){
                var id=this.value,
                    status=obj.elem.checked;
                if(status==false){
                    var sys=1;
                }else if(status==true){
                    sys=0;
                }
                $.ajax({
                    headers: {
                        'X-CSRF-TOKEN': $('#token').val()
                    },
                    url:"{{url('/admin/maintain')}}",
                    data:{
                        id:id,
                        sys:sys
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
            //提现开关
            form.on('switch(draw)', function(obj){
                var id=this.value,
                    status=obj.elem.checked;
                if(status==false){
                    var draw=1;
                }else if(status==true){
                    draw=0;
                }
                $.ajax({
                    headers: {
                        'X-CSRF-TOKEN': $('#token').val()
                    },
                    url:"{{url('/admin/drawOpen')}}",
                    data:{
                        id:id,
                        draw:draw
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
@endsection
@extends('common.list')