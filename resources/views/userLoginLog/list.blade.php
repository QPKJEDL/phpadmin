@section('title', '会员登录日志')
@section('header')
    <div class="layui-inline">
        <button class="layui-btn layui-btn-small layui-btn-warm freshBtn"><i class="layui-icon">&#x1002;</i></button>
    </div>
    <div class="layui-inline">
        <input type="text"  value="{{ $input['account'] or '' }}" name="account" placeholder="会员账号" autocomplete="off" class="layui-input">
    </div>

    <div class="layui-inline">
        <input type="text"  value="{{ $input['login_ip'] or '' }}" name="login_ip" placeholder="登录IP" autocomplete="off" class="layui-input">
    </div>

    <div class="layui-inline">
        <input type="text"  value="{{ $input['creatime'] or '' }}" name="creatime" placeholder="登录时间" onclick="layui.laydate({elem: this, festival: true})" autocomplete="off" class="layui-input">
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
                <td class="hidden-xs">{{$info['account']}}</td>
                <td class="hidden-xs">{{$info['creatime']}}</td>
                <td class="hidden-xs">{{$info['login_ip']}}</td>
                <td class="hidden-xs">{{$info['login_addr']}}</td>
                <td class="hidden-xs">
                    @if($info['status']==1)
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