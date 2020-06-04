@section('title', '代理列表')
@section('header')
    <div class="layui-inline">
    <button class="layui-btn layui-btn-small layui-btn-normal addBtn" id="addAgent" data-desc="添加代理" data-url="{{url('/admin/agent/0/edit')}}"><i class="layui-icon">&#xe654;</i></button>
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
                        <button class="layui-btn layui-btn-small layui-btn-normal edit-btn" data-id="{{$info['id']}}" data-desc="修改用户" data-url="{{url('/admin/agent/'. $info['id'] .'/edit')}}"><i class="layui-icon">&#xe642;</i></button>
                        <button class="layui-btn layui-btn-small layui-btn-danger del-btn" data-id="{{$info['id']}}" data-url="{{url('/admin/agent/'.$info['id'])}}"><i class="layui-icon">&#xe640;</i></button>
                    </div>
                </td>
            </tr>
        @endforeach
        {{--@if(!$list[0])--}}
            {{--<tr><td colspan="6" style="text-align: center;color: orangered;">暂无数据</td></tr>--}}
        {{--@endif--}}
        </tbody>
    </table>
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
        });
    </script>
@endsection
@extends('common.list')