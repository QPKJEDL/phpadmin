@section('title', '配置编辑')
@section('content')
    <div class="layui-form-item">
        <label class="layui-form-label">缓存类型：</label>
        <div class="layui-input-block">
            <select name="type" lay-filter="type">
                <option value="">请选择</option>
                <option value="0">数据缓存</option>
                <option value="1">摄像头播放地址</option>
            </select>
        </div>
    </div>
    <div id="data">
        <div class="layui-form-item">
            <label class="layui-form-label">key：</label>
            <div class="layui-input-block">
                <input type="text" value="{{$info['key'] or ''}}" id="key1" name="key" placeholder="请填写key值" autocomplete="off" class="layui-input">
            </div>
        </div>
        <div class="layui-form-item">
            <label class="layui-form-label">value：</label>
            <div class="layui-input-block">
                <input type="text" value="{{$info['value'] or ''}}" id="value1" name="value"  placeholder="请填写value值" autocomplete="off" class="layui-input">
            </div>
        </div>
        <div class="layui-form-item">
            <label class="layui-form-label">备注：</label>
            <div class="layui-input-block">
                <input type="text" value="{{$info['remark'] or ''}}" id="remark1" name="remark"  placeholder="请填写备注" autocomplete="off" class="layui-input">
            </div>
        </div>
    </div>
    <div id="camera">
        <div class="layui-form-item">
            <label class="layui-form-label">缓存名称：</label>
            <div class="layui-input-block">
                <input type="text" value="{{$info['key'] or ''}}" id="key2" name="key" placeholder="请填写摄像头名称（唯一标识）"autocomplete="off" class="layui-input">
            </div>
        </div>
        <div class="layui-form-item">
            <label class="layui-form-label">播放地址：</label>
            <div class="layui-input-block">
                <input type="text" value="{{$info['value'] or ''}}" id="value2" name="value"  placeholder="请填写摄像头播放地址"autocomplete="off" class="layui-input">
            </div>
        </div>
        <div class="layui-form-item">
            <label class="layui-form-label">备注：</label>
            <div class="layui-input-block">
                <input type="text" value="{{$info['remark'] or ''}}" id="remark2" name="remark"  placeholder="请填写备注"autocomplete="off" class="layui-input">
            </div>
        </div>
    </div>
@endsection
@section('id',$id)
@section('js')
    <script>
        window.onload=function(){
            $("#data").hide();
            $("#camera").hide();
        }
        layui.use(['form','jquery','layer'], function() {
            var form = layui.form()
                ,layer = layui.layer
                ,$ = layui.jquery;
            form.render();
            var id = $("input[name='id']").val();
            var index = parent.layer.getFrameIndex(window.name);
            if(id==0){
                form.on('submit(formDemo)', function(data) {
                    var type = $("select[name='type']").val();
                    if(type==0){
                        var data = {
                            "type":type,
                            "key": $("#key1").val(),
                            "value":$("#value1").val(),
                            "remark":$("#remark1").val()
                        }
                        $.ajax({
                            headers: {
                                'X-CSRF-TOKEN':$("input[name='_token']").val()
                            },
                            url:"{{url('/admin/options')}}",
                            data:data,
                            type:'post',
                            dataType:'json',
                            success:function(res){
                                if(res.status == 1){
                                    layer.msg(res.msg,{icon:6},function () {
                                        parent.layer.close(index);
                                        parent.location.reload();
                                    });

                                }else{
                                    layer.msg(res.msg,{shift: 6,icon:5});
                                }
                            },
                            error : function(XMLHttpRequest, textStatus, errorThrown) {
                                layer.msg('网络失败', {time: 1000});
                            }
                        });
                    }else if(type==1){
                        var data = {
                            "type":type,
                            "key": $("#key2").val(),
                            "value":$("#value2").val(),
                            "remark":$("#remark2").val()
                        }
                        $.ajax({
                            headers: {
                                'X-CSRF-TOKEN':$("input[name='_token']").val()
                            },
                            url:"{{url('/admin/options')}}",
                            data:data,
                            type:'post',
                            dataType:'json',
                            success:function(res){
                                if(res.status == 1){
                                    layer.msg(res.msg,{icon:6},function () {
                                        parent.layer.close(index);
                                        parent.location.reload();
                                    });

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
            }else{
                form.on('submit(formDemo)', function(data) {
                    $.ajax({
                        url:"{{url('/admin/optionsUpdate')}}",
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
            form.on('select(type)',function (data) {
                var that = $(data.elem);
                var value = that.val();

                if(value==0){
                    $("#data").show();
                    $("#camera").hide();
                }else if(value==1){
                    $("#data").hide();
                    $("#camera").show();
                }
            });
        });
    </script>
@endsection
@extends('common.edit')