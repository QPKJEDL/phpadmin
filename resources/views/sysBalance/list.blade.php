@section('title', '角色列表')
@section('header')
@endsection
@section('table')
    <table class="layui-table" lay-even lay-skin="nob">
        <colgroup>
            <col class="hidden-xs" width="150">
            <col class="hidden-xs" width="150">
            <col width="200">
        </colgroup>
        <thead>
        <tr>
            <th class="hidden-xs">当前剩余余额</th>
            <th class="hidden-xs">上次修改时间</th>
            <th>操作</th>
        </tr>
        </thead>
        <tbody>
            <tr>
                <td class="hidden-xs">{{number_format($data['balance']/100,2)}}</td>
                <td class="hidden-xs">{{$data['update_time']}}</td>
                <td>
                    <div class="layui-inline">
                        <button class="layui-btn layui-btn-small layui-btn-normal addBtn" data-url="{{url('/admin/balance/0/edit')}}" data-desc="添加余额"><i class="layui-icon">添加余额</i></button>
                    </div>
                </td>
            </tr>
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
