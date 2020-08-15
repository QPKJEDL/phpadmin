@section('title', '角色列表')
@section('header')
@endsection
@section('table')
    <table class="layui-table" lay-even lay-skin="nob">
        <colgroup>
            <col class="hidden-xs" width="50">
            <col class="hidden-xs" width="150">
            <col class="hidden-xs" width="150">
        </colgroup>
        <thead>
        <tr>
            <th class="hidden-xs">ID</th>
            <th class="hidden-xs">用户账号</th>
            <th class="hidden-xs">添加的余额</th>
            <th class="hidden-xs">操作前</th>
            <th class="hidden-xs">操作后</th>
            <th class="hidden-xs">操作时间</th>
        </tr>
        </thead>
        <tbody>
            @foreach($list as $info)
                <tr>
                    <td class="hidden-xs">{{$info['id']}}</td>
                    <td class="hidden-xs">{{$info['user_id']}}</td>
                    <td class="hidden-xs">{{number_format($info['balance']/100,2)}}</td>
                    <td class="hidden-xs">{{number_format($info['be_bal']/100,2)}}</td>
                    <td class="hidden-xs">{{number_format($info['after_bal']/100,2)}}</td>
                    <td class="hidden-xs">{{$info['create_time']}}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
@endsection
@section('js')
    <script>
        layui.use(['form', 'jquery','laydate', 'layer'], function() {
            var form = layui.form(),
                $ = layui.jquery,
                laydate = layui.laydate,
                layer = layui.layer
            ;
            $(".addBalance").click(function () {

            });
            form.render();
            form.on('submit(formDemo)', function(data) {
            });
        });
    </script>
@endsection
@extends('common.list')
