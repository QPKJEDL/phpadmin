@section('title', '配置列表')
@section('header')
    <div class="layui-inline">
        <a class="layui-btn layui-btn-small layui-btn-normal addBtn" data-desc="添加封禁IP" data-url="{{url('/admin/ipBlacklist/0/edit')}}"><i class="layui-icon">&#xe654;</i></a>
        <button class="layui-btn layui-btn-small layui-btn-warm freshBtn"><i class="layui-icon">&#x1002;</i></button>
    </div>
@endsection
@section('table')
    <table class="layui-table" id="treeTable" lay-even lay-skin="nob">
        <colgroup>
            <col class="hidden-xs" width="100">
            <col class="hidden-xs" width="150">
            <col class="hidden-xs" width="150">
            <col class="hidden-xs" width="150">
            <col class="hidden-xs" width="150">
            <col class="hidden-xs" width="150">
            <col class="hidden-xs" width="150">
            <col class="hidden-xs" width="150">
            <col width="200">
        </colgroup>
        <thead>
        <tr>
            <th class="hidden-xs">编号</th>
            <th class="hidden-xs">上级菜单</th>
            <th class="hidden-xs">菜单名称</th>
        </tr>
        </thead>
        <tbody>
        @foreach($list as $info)
            <tr data-tt-id="{{$info['id']}}" data-tt-parent-id="{{$info['parent_id']}}">
                <td class="hidden-xs">{{$info['id']}}</td>
                <td class="hidden-xs">{{$info['parent_id']}}</td>
                <td class="hidden-xs">{{$info['title']}}</td>
            </tr>
        @endforeach
        </tbody>
    </table>
@endsection
@section('js')
    <script>
        $("#treeTable").treetable({ expandable: true });
    </script>
@endsection
@extends('common.list')