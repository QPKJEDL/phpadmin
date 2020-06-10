@section('title', '代理登录日志')
@section('header')
    <div class="layui-inline">
        <button class="layui-btn layui-btn-small layui-btn-warm freshBtn"><i class="layui-icon">&#x1002;</i></button>
    </div>
    <div class="layui-inline">
        <input type="text"  value="{{ $input['username'] or '' }}" name="username" placeholder="代理账号" autocomplete="off" class="layui-input">
    </div>

    <div class="layui-inline">
        <input type="text"  value="{{ $input['log_ip'] or '' }}" name="log_ip" placeholder="登录IP" autocomplete="off" class="layui-input">
    </div>

    <div class="layui-inline">
        <input type="text"  value="{{ $input['log_time'] or '' }}" name="log_time" placeholder="登录时间" onclick="layui.laydate({elem: this, festival: true})" autocomplete="off" class="layui-input">
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
            <col class="hidden-xs" width="200">
            <col class="hidden-xs" width="200">
            <col class="hidden-xs" width="200">
            <col class="hidden-xs" width="200">
            <col class="hidden-xs" width="150">
        </colgroup>
        <thead>
        <tr>
            <th class="hidden-xs">序号</th>
            <th class="hidden-xs">登录账号</th>
            <th class="hidden-xs">登录时间</th>
            <th class="hidden-xs">登录IP</th>
            <th class="hidden-xs">登录地址</th>
            <th class="hidden-xs">登录结果</th>
        </tr>
        </thead>
        <tbody>
        @foreach($list as $info)
            <tr>
                <td class="hidden-xs">{{$info['id']}}</td>
                <td class="hidden-xs">{{$info['username']}}</td>
                <td class="hidden-xs">{{$info['log_time']}}</td>
                <td class="hidden-xs">{{$info['log_ip']}}</td>
                <td class="hidden-xs">{{$info['login_addr']}}</td>
                <td class="hidden-xs">
                    @if($info['type']==1)
                        登录成功
                    @else
                        登录失败
                    @endif
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
                $("input[name='account']").val('');
                $("input[name='login_ip']").val('');
                $("input[name='creatime']").val('');
            });
        });
    </script>
@endsection
@extends('common.list')