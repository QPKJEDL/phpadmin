@section('title', '配置列表')
@section('header')
    <div class="layui-inline">
        {{--<a class="layui-btn layui-btn-small layui-btn-normal addBtn" data-desc="添加" data-url="{{url('/admin/forbidden/0/edit')}}"><i class="layui-icon">&#xe654;</i></a>--}}
        <button class="layui-btn layui-btn-small layui-btn-warm freshBtn"><i class="layui-icon">&#x1002;</i></button>
    </div>
    <div class="layui-inline">
        <input type="text"  value="{{ $input['account'] or '' }}" name="account" placeholder="会员账号" autocomplete="off" class="layui-input">
    </div>
    <div class="layui-inline">
        <button class="layui-btn layui-btn-normal" lay-submit lay-filter="formDemo">搜索</button>
        <button class="layui-btn layui-btn-primary" id="reset">重置</button>
    </div>
@endsection
@section('table')
    <table class="layui-table" lay-even lay-skin="nob">
        <colgroup>
            <col class="hidden-xs" width="100">
            <col class="hidden-xs" width="150">
            <col class="hidden-xs" width="150">
            <col width="200">
        </colgroup>
        <thead>
        <tr>
            <th class="hidden-xs">序号</th>
            <th class="hidden-xs">账号</th>
            <th class="hidden-xs">操作</th>
        </tr>
        </thead>
        <tbody>
        @foreach($list as $info)
            <tr>
                <td class="hidden-xs">{{$info['user_id']}}</td>
                <td class="hidden-xs">{{$info['account']}}</td>
                <td>
                    <div class="layui-inline">
                        {{--<button class="layui-btn layui-btn-small layui-btn-normal edit-btn" data-id="{{$info['id']}}" data-desc="修改配置" data-url="{{url('/admin/forbidden/'. $info['id'] .'/edit')}}">编辑</button>--}}
                        <button class="layui-btn layui-btn-small layui-btn-danger open_over" data-id="{{$info['user_id']}}" >解禁</button>
                    </div>
                </td>
            </tr>
        @endforeach
        @if(!$list[0])
            <tr><td colspan="9" style="text-align: center;color: orangered;">暂无数据</td></tr>
        @endif
        <input type="hidden" id="token" value="{{csrf_token()}}">
        </tbody>
    </table>
    <div class="page-wrap">
        {{$list->render()}}
    </div>
@endsection
@section('js')
    <script>

        layui.use(['form', 'jquery','laydate', 'layer'], function() {
            var form = layui.form(),
                $ = layui.jquery,
                laydate = layui.laydate,
                layer = layui.layer
            ;
            laydate({istoday: true});
            form.render();
            //搜索
            form.on('submit(formDemo)', function(data) {
            });
            //重置
            $("#reset").click(function () {
                $("input[name='account']").val('');
            });
            //解禁
            $(".open_over").click(function () {
                var id = $(this).attr('data-id');
                layer.confirm('确定要解禁吗？',function (index) {
                    $.ajax({
                        headers: {
                            'X-CSRF-TOKEN': $("#token").val()
                        },
                        url:"{{url('/admin/forbiddenOpen')}}",
                        type:'post',
                        dataType:"json",
                        data:{
                            'id':id,
                        },
                        success:function (res) {
                            if(res.status == 1){
                                layer.msg(res.msg,{icon:6},function () {
                                    /*parent.layer.close(index);
                                    window.parent.frames[1].location.reload();*/
                                    window.location.reload();
                                });

                            }else{
                                layer.msg(res.msg,{shift: 6,icon:5});
                            }
                        }
                    });
                });
            });
        });
    </script>
@endsection
@extends('common.list')