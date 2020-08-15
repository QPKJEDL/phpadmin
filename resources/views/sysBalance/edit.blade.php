@section('title', '角色编辑')
@section('content')
    <div class="layui-form-item">
        <label class="layui-form-label">余额：</label>
        <div class="layui-input-block">
            <input type="text" name="balance" required onkeyup="this.value=this.value.replace(/\D/g,'')" lay-verify="balance" placeholder="请输入余额" autocomplete="off" class="layui-input">
        </div>
    </div>
@endsection
@section('id',$id)
@section('js')
    <script>
        layui.use(['form','jquery','laypage', 'layer','tree'], function() {
            var tree = layui.tree;
            var form = layui.form(),
                $ = layui.jquery;
            form.render();
            var layer = layui.layer;
            form.on('submit(formDemo)', function(data) {
                $.ajax({
                    url:"{{url('/admin/balance')}}",
                    data:$('form').serialize(),
                    type:'post',
                    dataType:'json',
                    success:function(res){
                        if(res.status == 1){
                            layer.msg(res.msg,{icon:6});
                            var index = parent.layer.getFrameIndex(window.name);
                            setTimeout('parent.layer.close('+index+')',2000);
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
        });
    </script>
@endsection
@extends('common.edit')
