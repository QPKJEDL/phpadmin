@section('title', '主播编辑')
@section('content')

    <div class="layui-form-item">
        <label class="layui-form-label">账号：</label>
        <div class="layui-input-inline">
            <input type="text" value="{{$info['account'] or ''}}" name="account"  placeholder="请输入登录账号" lay-verify="account" lay-reqText="请输入账号" autocomplete="off" class="layui-input">
        </div>
    </div>
    <div class="layui-form-item">
        <label class="layui-form-label">密码：</label>
        <div class="layui-input-inline">
            <input type="password" value="{{$info['password'] or ''}}" name="password"  placeholder="请输入密码" lay-verify="password" lay-reqText="请输入密码" autocomplete="off" class="layui-input">
            <label>不输入密码 就是不修改密码</label>
        </div>
    </div>
    <div class="layui-form-item">
        <label class="layui-form-label">名称：</label>
        <div class="layui-input-inline">
            <input type="text" value="{{$info['nickname'] or ''}}" name="nickname"  placeholder="名称" autocomplete="off" class="layui-input">
        </div>
    </div>
    {{--<div class="layui-form-item">--}}
        {{--<label class="layui-form-label">头像：</label>--}}
        {{--<div class="layui-input-inline">--}}
            {{--<input type="text" value="{{$info['avatar'] or ''}}" name="avatar"  placeholder="头像" autocomplete="off" class="layui-input">--}}
        {{--</div>--}}
    {{--</div>--}}
    <div class="layui-form-item">
        <label class="layui-form-label">备注：</label>
        <div class="layui-input-inline">
            <input type="text" value="{{$info['remark'] or ''}}" name="remark"  placeholder="备注" autocomplete="off" class="layui-input">
        </div>
    </div>
@endsection
@section('id',$id)
@section('js')
    <script>
        layui.use(['form','jquery','layer'], function() {
            var form = layui.form()
                ,layer = layui.layer
                ,$ = layui.jquery;
            form.render();
            form.verify({
                account: function (value, item) {
                    if(value.length==0 || value.length<6){
                        return '账号不能为空，并且长度不能小于6';
                    }
                }
            });
            var id = $("input[name='id']").val();
            var index = parent.layer.getFrameIndex(window.name);
            if(id==0){
                form.on('submit(formDemo)', function(data) {
                    $.ajax({
                        url:"{{url('/admin/anchor')}}",
                        data:$('form').serialize(),
                        type:'post',
                        dataType:'json',
                        success:function(res){
                            if(res.status == 1){
                                layer.msg(res.msg,{icon:6},function () {
                                    parent.layer.close(index);
                                    window.parent.frames[1].location.reload();
                                });
                            }else{
                                layer.msg(res.msg,{shift: 6,icon:5});
                            }
                        },
                        error : function(XMLHttpRequest, textStatus, errorThrown) {
                            layer.msg('网络失败', {time: 1000});
                        }
                    });
                    return false;
                });
            }else{
                form.on('submit(formDemo)', function(data) {
                    $.ajax({
                        url:"{{url('/admin/gameUpdate')}}",
                        data:$('form').serialize(),
                        type:'post',
                        dataType:'json',
                        success:function(res){
                            if(res.status == 1){
                                layer.msg(res.msg,{icon:6},function () {
                                    parent.layer.close(index);
                                    window.parent.frames[1].location.reload();
                                });
                            }else{
                                layer.msg(res.msg,{shift: 6,icon:5});
                            }
                        },
                        error : function(XMLHttpRequest, textStatus, errorThrown) {
                            layer.msg('网络失败', {time: 1000});
                        }
                    });
                    return false;
                });
            }

        });
    </script>
@endsection
@extends('common.edit')