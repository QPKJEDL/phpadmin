@section('title', '订单管理')
@section('header')
    <div class="layui-inline">
        <button class="layui-btn layui-btn-small layui-btn-warm freshBtn"><i class="layui-icon">&#x1002;</i></button>
    </div>
    <div class="layui-inline">
        <input type="text"  value="{{ $input['desk_name'] or '' }}" name="desk_name" placeholder="请输入台桌名称" autocomplete="off" class="layui-input">
    </div>
    <div class="layui-inline">
        <button class="layui-btn layui-btn-normal" lay-submit lay-filter="formDemo">搜索</button>
    </div>
@endsection
@section('table')
    <table class="layui-table" lay-even lay-skin="nob">
        <colgroup>
            <col class="hidden-xs" width="100">
            <col class="hidden-xs" width="100">
            <col class="hidden-xs" width="100">
            <col class="hidden-xs" width="100">
            <col class="hidden-xs" width="100">
            <col class="hidden-xs" width="100">
            <col class="hidden-xs" width="100">
            <col class="hidden-xs" width="100">
            <col class="hidden-xs" width="100">
            <col class="hidden-xs" width="100">
            <col class="hidden-xs" width="100">
            <col class="hidden-xs" width="100">
            <col class="hidden-xs" width="100">
            <col class="hidden-xs" width="100">
            <col class="hidden-xs" width="100">
        </colgroup>
        <thead>
        <tr>
            <th class="hidden-xs">序号</th>
            <th class="hidden-xs">名称</th>
            <th class="hidden-xs">IP限制</th>
            <th class="hidden-xs">台桌推送</th>
            <th class="hidden-xs">最小限红</th>
            <th class="hidden-xs">最小和限红</th>
            <th class="hidden-xs">最小对限红</th>
            <th class="hidden-xs">最大限红</th>
            <th class="hidden-xs">最大和限红</th>
            <th class="hidden-xs">最大对限红</th>
            <th class="hidden-xs">主播台</th>
            <th class="hidden-xs">倒计时</th>
            <th class="hidden-xs">待开牌时间</th>
            <th class="hidden-xs" style="text-align: center">操作</th>
        </tr>
        </thead>
        <tbody>
        @foreach($list as $info)
            <tr>
                <td class="hidden-xs">{{$info['id']}}</td>
                <td class="hidden-xs">{{$info['desk_name']}}[{{$info['game_name']}}]</td>
                <td class="hidden-xs">{{$info['ip_limit']}}</td>
                <td class="hidden-xs">
                    @if($info['video_status']==0)
                        正常
                    @else
                        关闭
                    @endif
                </td>
                <td class="hidden-xs">{{$info['min_limit']['c']}}/{{$info['min_limit']['cu']}}<br>{{$info['min_limit']['p']}}${{$info['min_limit']['pu']}}</td>
                <td class="hidden-xs">{{$info['min_tie_limit']['c']}}/{{$info['min_tie_limit']['cu']}}<br>{{$info['min_tie_limit']['p']}}${{$info['min_tie_limit']['pu']}}</td>
                <td class="hidden-xs">{{$info['min_pair_limit']['c']}}/{{$info['min_pair_limit']['cu']}}<br>{{$info['min_pair_limit']['p']}}${{$info['min_pair_limit']['pu']}}</td>
                <td class="hidden-xs">{{$info['max_limit']['c']}}/{{$info['max_limit']['cu']}}<br>{{$info['max_limit']['p']}}${{$info['max_limit']['pu']}}</td>
                <td class="hidden-xs">{{$info['max_tie_limit']['c']}}/{{$info['max_tie_limit']['cu']}}<br>{{$info['max_tie_limit']['p']}}${{$info['max_tie_limit']['pu']}}</td>
                <td class="hidden-xs">{{$info['max_pair_limit']['c']}}/{{$info['max_pair_limit']['cu']}}<br>{{$info['max_pair_limit']['p']}}${{$info['max_pair_limit']['pu']}}</td>
                <td class="hidden-xs">
                    @if($info['is_alive']==0)
                        <button type="button" class="layui-btn layui-btn-xs layui-btn-normal">是</button>
                    @else
                        <button type="button" class="layui-btn layui-btn-xs layui-btn-normal">否</button>
                    @endif</td>
                <td class="hidden-xs">{{$info['count_down']}}</td>
                <td class="hidden-xs">{{$info['wait_down']}}</td>
                <td style="text-align: center">
                    <div class="layui-inline">
                        <button class="layui-btn layui-btn-small layui-btn-danger changeStatus" data-id="{{$info['id']}}" data-v="0">启用</button>
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
            $('#res').click(function () {
                $("input[name='business_code']").val('');
                $("input[name='order_sn']").val('');
                $("input[name='user_id']").val('');
                $("input[name='creatime']").val('');
                $("select[name='status']").val('');
                $('form').submit();
            });
            //台桌停用
            $(".changeStatus").click(function () {
                var id = $(this).attr('data-id');
                var value= $(this).attr('data-v');
                layer.confirm('确定要操作吗？',function (index) {
                    $.ajax({
                        headers: {
                            'X-CSRF-TOKEN': $("#token").val()
                        },
                        url:"{{url('/admin/changStatus')}}",
                        type:'post',
                        dataType:"json",
                        data:{
                            'id':id,
                            'status':value
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
