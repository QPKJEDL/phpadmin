@section('title', '配置编辑')
@section('content')
    <div class="layui-form-item">
        <label class="layui-form-label">IP地址：</label>
        <div class="layui-input-block">
            <input type="text" value="{{$info['ip_address'] or ''}}" name="ip_address" placeholder="请填写IP地址" lay-verify="required" autocomplete="off" class="layui-input">
        </div>
    </div>
    <div class="layui-form-item">
        <label class="layui-form-label">封禁日期：</label>
        <div class="layui-input-inline" style="width: 100px;">
            <input class="layui-input" name="start_date" placeholder="开始日期" onclick="layui.laydate({elem: this, festival: true})" value="{{ $info['start_date'] or '' }}" autocomplete="off">
        </div>
        <div class="layui-form-mid">-</div>
        <div class="layui-input-inline" style="width: 100px;">
            <input class="layui-input" name="end_date" placeholder="开始日期" onclick="layui.laydate({elem: this, festival: true})" value="{{ $info['end_date'] or '' }}" autocomplete="off">
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
            $("input[name='ip_address']").on('blur',function () {
                var ip = $(this).val();
                var reg = /^(\d{1,2}|1\d\d|2[0-4]\d|25[0-5])\.(\d{1,2}|1\d\d|2[0-4]\d|25[0-5])\.(\d{1,2}|1\d\d|2[0-4]\d|25[0-5])\.(\d{1,2}|1\d\d|2[0-4]\d|25[0-5])$/;
                if (reg.test(ip)){
                    $.ajax({
                        headers: {
                            'X-CSRF-TOKEN': $('input[name="_token"]').val()
                        },
                        url:"{{url('/admin/checkUniqueIp')}}",
                        type:"post",
                        data:{
                            'id':$("input[name='id']").val(),
                            'ip_address':ip
                        },
                        dataType:"json",
                        success:function (res) {
                            if (res.status==0){
                                layer.msg(res.msg,{shift: 6,icon:5});
                            }
                        }
                    });
                }else{
                    layer.msg('IP格式不对',{shift: 6,icon:5});
                }
            });
            if(id==0){
                form.on('submit(formDemo)', function(data) {
                    var ip = $("input[name='ip_address']").val();
                    var start = getDateTime($("input[name='start_date']").val());
                    var end = getDateTime($("input[name='end_date']").val());
                    var reg = /^(\d{1,2}|1\d\d|2[0-4]\d|25[0-5])\.(\d{1,2}|1\d\d|2[0-4]\d|25[0-5])\.(\d{1,2}|1\d\d|2[0-4]\d|25[0-5])\.(\d{1,2}|1\d\d|2[0-4]\d|25[0-5])$/;
                    if (!reg.test(ip)){
                        layer.msg('ip格式不对！',{shift:6,icon:5});
                        return false;
                    }
                    if (end<start){
                        layer.msg('结束日期不能小于开始日期',{shift: 6,icon:5});
                        return  false;
                    }
                    if(start==end){
                        layer.msg('结束日期于开始日期不能为同一天',{shift: 6,icon:5});
                        return false;
                    }
                    $.ajax({
                        url:"{{url('/admin/ipBlacklist')}}",
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
                    var ip = $("input[name='ip_address']").val();
                    var start = getDateTime($("input[name='start_date']").val());
                    var end = getDateTime($("input[name='end_date']").val());
                    var reg = /^(\d{1,2}|1\d\d|2[0-4]\d|25[0-5])\.(\d{1,2}|1\d\d|2[0-4]\d|25[0-5])\.(\d{1,2}|1\d\d|2[0-4]\d|25[0-5])\.(\d{1,2}|1\d\d|2[0-4]\d|25[0-5])$/;
                    if (!reg.test(ip)){
                        layer.msg('ip格式不对！',{shift:6,icon:5});
                        return false;
                    }
                    if (end<start){
                        layer.msg('结束日期不能小于开始日期',{shift: 6,icon:5});
                        return  false;
                    }
                    if(start==end){
                        layer.msg('结束日期于开始日期不能为同一天',{shift: 6,icon:5});
                        return false;
                    }
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