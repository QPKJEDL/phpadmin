@section('title', '配置列表')
@section('header')
    <div class="layui-inline">
        <a class="layui-btn layui-btn-small layui-btn-normal addBtn" data-desc="添加封禁IP" data-url="{{url('/admin/ipBlacklist/0/edit')}}"><i class="layui-icon">&#xe654;</i></a>
        <button class="layui-btn layui-btn-small layui-btn-warm freshBtn"><i class="layui-icon">&#x1002;</i></button>
    </div>
    <div class="layui-inline">
        <input type="text"  value="{{ $input['agent_id'] or '' }}" name="agent_id" placeholder="代理账号" autocomplete="off" class="layui-input">
    </div>
    <div class="layui-inline">
        <button class="layui-btn layui-btn-normal" lay-submit lay-filter="formDemo">搜索</button>
        <button class="layui-btn layui-btn-normal" id="reset">重置</button>
    </div>
@endsection
@section('table')
    <table class="layui-table" lay-even lay-skin="nob">
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
            <th class="hidden-xs">序号</th>
            <th class="hidden-xs">代理账号</th>
            <th class="hidden-xs">开始时间</th>
            <th class="hidden-xs">结束时间</th>
            <th class="hidden-xs">创建者</th>
            <th class="hidden-xs">状态</th>
            <th class="hidden-xs">最后修改时间</th>
            <th class="hidden-xs">最后修改人</th>
            <th class="hidden-xs">操作</th>
        </tr>
        </thead>
        <tbody>
        @foreach($list as $info)
            <tr>
                <td class="hidden-xs">{{$info['id']}}</td>
                <td class="hidden-xs">{{$info['agent_id']}}</td>
                <td class="hidden-xs">{{$info['start_date']}}</td>
                <td class="hidden-xs">{{$info['end_date']}}</td>
                <td class="hidden-xs">{{$info['create_by']}}</td>
                <td class="hidden-xs">禁止</td>
                <td class="hidden-xs">{{$info['update_time']}}</td>
                <td class="hidden-xs">{{$info['update_by']}}</td>
                <td>
                    <div class="layui-inline">
                        <button class="layui-btn layui-btn-small layui-btn-normal edit-btn" data-id="{{$info['id']}}" data-desc="修改代理黑名单" data-url="{{url('/admin/ipBlacklist/'. $info['id'] .'/edit')}}">编辑</button>
                        <button class="layui-btn layui-btn-small layui-btn-danger del-btn" data-id="{{$info['id']}}" data-url="{{url('/admin/ipBlacklist/'.$info['id'])}}">解禁</button>
                    </div>
                </td>
            </tr>
        @endforeach
        @if(!$list[0])
            <tr><td colspan="9" style="text-align: center;color: orangered;">暂无数据</td></tr>
        @endif
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
                $("input[name='agent_id']").val('');
            });
        });
    </script>
@endsection
@extends('common.list')