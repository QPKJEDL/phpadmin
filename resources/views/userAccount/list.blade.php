@section('title', '订单管理')
@section('header')
    <div class="layui-inline">
        <button class="layui-btn layui-btn-small layui-btn-warm freshBtn"><i class="layui-icon">&#x1002;</i></button>
    </div>
    <div class="layui-inline">
        <input type="text"  value="{{ $input['account'] or '' }}" name="account" placeholder="登录账号" autocomplete="off" class="layui-input">
    </div>
    <div class="layui-inline">
        <button class="layui-btn layui-btn-normal" lay-submit lay-filter="formDemo">搜索</button>
        <button id="res" class="layui-btn layui-btn-primary">重置</button>
    </div>
@endsection
@section('table')
    <table class="layui-table" lay-even lay-skin="nob">
        <colgroup>
            <col class="hidden-xs" width="100">
            <col class="hidden-xs" width="200">
            <col class="hidden-xs" width="200">
            <col class="hidden-xs" width="150">
            <col class="hidden-xs" width="150">
            <col class="hidden-xs" width="200">
            <col class="hidden-xs" width="150">
            <col class="hidden-xs" width="100">
            <col class="hidden-xs" width="200">
            <col class="hidden-xs" width="200">
            <col class="hidden-xs" width="200">
        </colgroup>
        <thead>
        <tr>
            <th class="hidden-xs">序号</th>
            <th class="hidden-xs">登录账号[昵称]</th>
            <th class="hidden-xs">登录时间</th>
            <th class="hidden-xs">登录ip</th>
            <th class="hidden-xs">服务器ip</th>
            <th class="hidden-xs">登录地址</th>
            <th class="hidden-xs">所在台桌</th>
            <th class="hidden-xs">登录端</th>
            <th class="hidden-xs">直属上级[账号]</th>
            <th class="hidden-xs">直属一级[账号]</th>
            <th class="hidden-xs" style="text-align: center">操作</th>
        </tr>
        </thead>
        <tbody>
        @foreach($list as $info)
            <tr>
                <td class="hidden-xs">{{$info['user_id']}}</td>
                <td class="hidden-xs">{{$info['account']}}[{{$info['nickname']}}]</td>
                <td class="hidden-xs">{{$info['savetime']}}</td>
                <td class="hidden-xs">{{$info['last_ip']}}</td>
                <td class="hidden-xs">{{$info["server_ip"]}}</td>
                <td class="hidden-xs">{{$info['logaddr']}}</td>
                <td class="hidden-xs">
                    @if($info['desk_name']=="")
                        未入台
                    @else
                        {{$info["desk_name"]}}
                    @endif
                </td>
                <td class="hidden-xs">
                    @if($info['online_type']==1)
                        电脑
                    @elseif($info['online_type']==2)
                        苹果
                    @elseif($info['online_type']==3)
                        安卓
                    @elseif($info['online_type']==4)
                        网页
                    @endif
                </td>
                <td class="hidden-xs">{{$info['par_agent_nickname']}}[{{$info['agent_id']}}]</td>
                <td class="hidden-xs">{{$info['dir_agent_nickname']}}[{{$info['dir_agent_id']}}]</td>
                <td style="text-align: center">
                    <div class="layui-inline">
                        <button class="layui-btn layui-btn-small layui-btn-danger kick" data-id="{{$info['user_id']}}" data-status="1">踢下线</button>
                    </div>
                </td>
            </tr>
        @endforeach
        @if(!$list[0])
            <tr><td colspan="6" style="text-align: center;color: orangered;">暂无数据</td></tr>
        @endif
        </tbody>
        <input type="hidden" id="token" value="{{csrf_token()}}">
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
                layer = layui.layer;
            laydate({istoday: true});
            form.render();
            form.on('submit(formDemo)', function(data) {
            });
            //重置
            $("#reset").click(function () {
                $("input[name='account']").val('');
            });
            //踢下线
            $(".kick").click(function () {
                var userId = $(this).attr('data-id');
                layer.confirm('确定要封禁吗？',function (index) {
                    $.ajax({
                        headers: {
                            'X-CSRF-TOKEN': $("#token").val()
                        },
                        url:"{{url('/admin/userAccountOffline')}}",
                        data:{
                            "userId":userId,
                        },
                        type:'post',
                        dataType: "json",
                        success:function (res) {
                            if(res.status==1){
                                layer.msg(res.msg,{icon:6},function () {
                                    parent.layer.close(index);
                                    window.parent.frames[1].location.reload();
                                });
                            }else{
                                layer.msg(res.msg,{shift: 6,icon:5});
                            }
                        }
                    });
                    layer.close(index);
                });
            });
        });
    </script>
@endsection
@extends('common.list')
