@section('title', '公告管理')
@section('header')
    <div class="layui-inline">
        {{--<button class="layui-btn layui-btn-small layui-btn-normal addBtn" data-desc="添加游戏" data-url="{{url('/admin/game/0/edit')}}"><i class="layui-icon">&#xe654;</i></button>--}}
        <button class="layui-btn layui-btn-small layui-btn-warm freshBtn"><i class="layui-icon">&#x1002;</i></button>
    </div>
@endsection
@section('table')
    <input type="hidden" id="token" value="{{csrf_token()}}">
    @foreach($list as $info)
    <div class="layui-form-item">
        <label class="layui-form-label">{{$info['descript']}}</label>
        <div class="layui-input-inline">
            <input type="text" id="{{$info['id']}}" lay-verify="title" value="{{$info['url']}}"  autocomplete="off" placeholder="请输入{{$info['descript']}}" class="layui-input">
        </div>
    </div>
    @endforeach
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
                var id1 = $("#1").val();
                var id2 = $("#2").val();
                var id3 = $("#3").val();
                var id4 = $("#4").val();
                var json1 = {
                    "id":1,
                    "value":id1
                }
                var json2 ={
                    "id":2,
                    "value":id2
                }
                var json3 = {
                    "id":3,
                    "value":id3
                }
                var json4 = {
                    "id":4,
                    "value":id4
                }
                var arr = new Array();
                arr.push(json1)
                arr.push(json2)
                arr.push(json3)
                arr.push(json4)
                $.ajax({
                    headers:{
                        'X-CSRF-TOKEN': $("#token").val()
                    },
                    url:"{{url('/admin/camera')}}",
                    type:"post",
                    data:{
                        "data":JSON.stringify(arr)
                    },
                    dataType:"json",
                    success:function (res) {
                        if(res.status==1){
                            layer.msg(res.msg,{icon:6});
                            window.location.reload();
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