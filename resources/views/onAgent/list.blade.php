@section('title', '代理列表')
@section('header')
    <div class="layui-inline">
    <button class="layui-btn layui-btn-small layui-btn-normal addBtn" id="addAgent" data-desc="添加代理" data-url="{{url('/admin/onAgent/0/edit')}}"><i class="layui-icon">&#xe654;</i></button>
    <button class="layui-btn layui-btn-small layui-btn-warm freshBtn"><i class="layui-icon">&#x1002;</i></button>
    </div>
@endsection
@section('table')
    <table class="layui-table" lay-even lay-skin="nob">
        <colgroup>
            <col class="hidden-xs" width="50">
            <col class="hidden-xs" width="200">
            <col class="hidden-xs" width="150">
            <col>
            <col class="hidden-xs" width="150">
            <col width="200">
        </colgroup>
        <thead>
        <tr>
            <th class="hidden-xs">ID</th>
            <th class="hidden-xs">用户名</th>
            <th class="hidden-xs">名称</th>
            <th class="hidden-xs">角色</th>
            <th class="hidden-xs">IP白名单</th>
            <th class="hidden-xs">状态</th>
            <th class="hidden-xs">创建时间</th>
            <th class="hidden-xs">操作</th>
        </tr>
        </thead>
        <tbody>
        @foreach($list as $info)
            <tr>
                <td class="hidden-xs">{{$info['id']}}</td>
                <td class="hidden-xs">{{$info['username']}}</td>
                <td class="hidden-xs">{{$info['nickname']}}</td>
                <td class="hidden-xs">{{$info['agent_roles'][0]['display_name'] or '已删除'}}</td>
                <td class="hidden-xs">{{$info['ip_config']}}</td>
                <td class="hidden-xs">
                    @if($info['status']==0)
                        <span class="layui-btn layui-btn-mini layui-btn-danger">正常</span>
                    @elseif($info['status']==1)
                        <span class="layui-btn layui-btn-mini layui-btn-warm">停用</span>
                    @endif
                </td>
                <td class="hidden-xs">{{$info['created_at']}}</td>
                <td>
                    <div class="layui-inline">
                        <button class="layui-btn layui-btn-small layui-btn-normal edit-btn" data-id="{{$info['id']}}" data-desc="修改代理" data-url="{{url('/admin/onAgent/'. $info['id'] .'/edit')}}">编辑</button>
                        @if($info['status']==0)
                            <button class="layui-btn layui-btn-small layui-btn-warm stop" data-id="{{$info['id']}}" data-desc="代理停用">停用</button>
                        @elseif($info['status']==1)
                            <button class="layui-btn layui-btn-small layui-btn start" data-id="{{$info['id']}}" data-desc="代理启用">启用</button>
                        @endif
                        <button class="layui-btn layui-btn-small layui-btn-danger del-btn" data-id="{{$info['id']}}" data-url="{{url('/admin/onAgent/'.$info['id'])}}">删除</button>
                    </div>
                </td>
            </tr>
        @endforeach
        {{--@if(!$list[0])--}}
            {{--<tr><td colspan="6" style="text-align: center;color: orangered;">暂无数据</td></tr>--}}
        {{--@endif--}}
        </tbody>
    </table>
    <input type="hidden" id="token" value="{{csrf_token()}}">
    {{--<div class="page-wrap">--}}
        {{--{{$list->render()}}--}}
    {{--</div>--}}
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
            form.on('submit(formDemo)', function(data) {
                console.log(data);
            });
            //停用
            $('.stop').click(function () {
                var that = $(this);
                var id=that.attr('data-id');
                layer.confirm('确定要停用吗？',{title:'提示'},function (index) {
                        $.ajax({
                            headers: {
                                'X-CSRF-TOKEN': $('#token').val()
                            },
                            url:"{{url('/admin/agentStop')}}",
                            data:{
                                "id":id,
                            },
                            type:"post",
                            dataType:"json",
                            success:function (res) {
                                if(res.status==1){
                                    layer.msg(res.msg,{icon:6,time:1000},function () {
                                        location.reload();
                                    });

                                }else{
                                    layer.msg(res.msg,{icon:5,time:1000},function(){
                                        location.reload();
                                    });

                                }
                            }
                        });
                    }
                );
            });
            //启用
            $('.start').click(function () {
                var that = $(this);
                var id=that.attr('data-id');
                layer.confirm('确定要启用吗？',{title:'提示'},function (index) {
                        $.ajax({
                            headers: {
                                'X-CSRF-TOKEN': $('#token').val()
                            },
                            url:"{{url('/admin/agentStart')}}",
                            data:{
                                "id":id,
                            },
                            type:"post",
                            dataType:"json",
                            success:function (res) {
                                if(res.status==1){
                                    layer.msg(res.msg,{icon:6,time:1000},function () {
                                        location.reload();
                                    });

                                }else{
                                    layer.msg(res.msg,{icon:5,time:1000},function(){
                                        location.reload();
                                    });

                                }
                            }
                        });
                    }
                );
            });
        });
    </script>
@endsection
@extends('common.list')