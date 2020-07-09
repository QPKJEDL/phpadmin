@section('title', '公告管理')
@section('header')
    <div class="layui-inline">
        {{--<button class="layui-btn layui-btn-small layui-btn-normal addBtn" data-desc="添加游戏" data-url="{{url('/admin/game/0/edit')}}"><i class="layui-icon">&#xe654;</i></button>--}}
        <button class="layui-btn layui-btn-small layui-btn-warm freshBtn"><i class="layui-icon">&#x1002;</i></button>
    </div>
@endsection
@section('table')
    <input type="hidden" id="token" value="{{csrf_token()}}">
    <input type="hidden" id="id" value="{{$info['id']}}">
    <div class="layui-form-item">
        <label class="layui-form-label">标题：</label>
        <div class="layui-input-inline">
            <input type="text" name="title" lay-verify="title" value="{{$info['title']}}" autocomplete="off" readonly class="layui-input" style="width: 300px;">
        </div>
    </div>
    <div class="layui-form-item">
        <label class="layui-form-label">语言：</label>
        <div class="layui-input-inline" style="width: 300px;">
            <select name="language" lay-filter="aihao">
                <option value="1"{{isset($info['language'])&&$info['language']==1?'selected':''}}>中文</option>
                <option value="2" {{isset($info['language'])&&$info['language']==2?'selected':''}}>英文</option>
            </select>
        </div>
    </div>
    <div class="layui-form-item layui-form-text">
        <label class="layui-form-label">公告内容：</label>
        <div class="layui-input-inline">
            <textarea placeholder="请输入内容" id="content" name="content" class="layui-textarea" style="resize: none;width: 300px;height: 200px;overflow-y:visible">{{$info['content']}}</textarea>
        </div>
    </div>
    <div class="layui-form-item">
        <div class="layui-input-block">
            <button type="submit" class="layui-btn" lay-submit="formDemo" lay-filter="demo1">立即提交</button>
        </div>
    </div>
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
            form.on('submit(demo1)', function(data) {
                $.ajax({
                    headers:{
                        'X-CSRF-TOKEN': $("#token").val()
                    },
                    url:"{{url('/admin/webnotice')}}",
                    type:"post",
                    data:{
                        "id":$("#id").val(),
                        "language":$("select[name='language']").val(),
                        "content":$("#content").val()
                    },
                    dataType:"json",
                    success:function (res) {
                        if(res.status==1){
                            layer.msg(res.msg,{icon:6,time:2000},function () {
                                window.location.reload();
                            });
                        }else{
                            layer.msg(res.msg,{shift: 6,icon:5});
                        }
                    }
                });
            });
            
        });
    </script>
@endsection
@extends('common.list')