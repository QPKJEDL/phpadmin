@section('title', '配置编辑')
@section('content')
    <div class="layui-form-item">
        <label class="layui-form-label">会员账号：</label>
        <div class="layui-input-block">
            <input type="text" value="{{$info['user_account'] or ''}}" name="user_account" placeholder="请填写会员账号" lay-verify="required" autocomplete="off" class="layui-input">
        </div>
    </div>
    <div class="layui-form-item">
        <label class="layui-form-label">封禁日期：</label>
        <div class="layui-input-inline" style="width: 100px;">
            <input class="layui-input" name="start_date" placeholder="开始日期" onclick="layui.laydate({elem: this, festival: true})" value="{{ $info['start_date'] or '' }}" autocomplete="off">
        </div>
        <div class="layui-form-mid">-</div>
        <div class="layui-input-inline" style="width: 100px;">
            <input class="layui-input" name="end_date" placeholder="结束日期" onclick="layui.laydate({elem: this, festival: true})" value="{{ $info['end_date'] or '' }}" autocomplete="off">
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
                    var ip = $("input[name='ip_address']").val();
                    var start = getDateTime($("input[name='start_date']").val());
                    var end = getDateTime($("input[name='end_date']").val());
                    if (end<start){
                        layer.msg('结束日期不能小于开始日期',{shift: 6,icon:5});
                        return  false;
                    }
                    if(start==end){
                        layer.msg('结束日期于开始日期不能为同一天',{shift: 6,icon:5});
                        return false;
                    }
                    $.ajax({
                        url:"{{url('/admin/forbidden')}}",
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
                    if (end<start){
                        layer.msg('结束日期不能小于开始日期',{shift: 6,icon:5});
                        return  false;
                    }
                    if(start==end){
                        layer.msg('结束日期于开始日期不能为同一天',{shift: 6,icon:5});
                        return false;
                    }
                    $.ajax({
                        url:"{{url('/admin/forbiddenUpdate')}}",
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