@section('title', '配置编辑')
@section('content')
    <div class="layui-form-item">
        <label class="layui-form-label">会员账号：</label>
        <div class="layui-input-block">
            <input type="text" value="{{$info['user_account'] or ''}}" name="user_account" placeholder="请填写会员账号" lay-verify="required" autocomplete="off" class="layui-input">
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