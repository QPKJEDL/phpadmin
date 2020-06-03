@section('title', '订单管理')
@section('header')
    <div class="layui-inline">
        <button class="layui-btn layui-btn-small layui-btn-normal" id="addDesk" data-desc="添加桌台" data-url="{{url('/admin/desk/0/edit')}}"><i class="layui-icon">&#xe654;</i></button>
        <button class="layui-btn layui-btn-small layui-btn-warm freshBtn"><i class="layui-icon">&#x1002;</i></button>
    </div>
    <div class="layui-inline">
        <select name="game_id" lay-filter="game_id" lay-verify="game_id">
            <option value="">请选择游戏类型</option>
            @foreach($gameType as $game)
                <option value="{{$game['id']}}" {{isset($input['game_id'])&&$input['game_id']==$game['id']?'selected':''}}>{{$game['game_name']}}</option>
            @endforeach
        </select>
    </div>
    <div class="layui-inline">
        <select name="is_alive" lay-filter="is_alive" lay-verify="is_alive">
            <option value="">请选择房间类型</option>
            <option value="0" {{isset($input['is_alive'])&&$input['is_alive']==0?'selected':''}}>是</option>
            <option value="1" {{isset($input['is_alive'])&&$input['is_alive']==1?'selected':''}}>否</option>
        </select>
    </div>
    <div class="layui-inline">
        <select name="is_push" lay-filter="is_push" lay-verify="is_push">
            <option value="">是否推送</option>
            <option value="0" {{isset($input['is_push'])&&$input['is_push']==0?'selected':''}}>点击</option>
            <option value="1" {{isset($input['is_push'])&&$input['is_push']==1?'selected':''}}>电话</option>
        </select>
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
            <col class="hidden-xs" width="150">
            <col class="hidden-xs" width="150">
            <col class="hidden-xs" width="150">
            <col class="hidden-xs" width="150">
            <col class="hidden-xs" width="150">
            <col class="hidden-xs" width="150">
            <col class="hidden-xs" width="100">
            <col class="hidden-xs" width="100">
            <col class="hidden-xs" width="100">
            <col class="hidden-xs" width="250">
        </colgroup>
        <thead>
        <tr>
            <th class="hidden-xs">序号</th>
            <th class="hidden-xs">名称</th>
            <th class="hidden-xs">IP限制</th>
            <th class="hidden-xs">台桌推送</th>
            <td class="hidden-xs">视频状态</td>
            <th class="hidden-xs">最小限红<br/>(平倍最小限红)</th>
            <th class="hidden-xs">最大限红<br/>(平倍最大限红)</th>
            <th class="hidden-xs">最小和限红<br/>(翻倍最小限红)</th>
            <th class="hidden-xs">最大和限红<br/>(翻倍最大限红)</th>
            <th class="hidden-xs">最小对限红</th>0
            <th class="hidden-xs">最大对限红</th>
            <th class="hidden-xs">主播台</th>
            <th class="hidden-xs">倒计时</th>
            <th class="hidden-xs">待开牌时间</th>
            <th>操作</th>
        </tr>
        </thead>
        <tbody>
        @foreach($list as $info)
            <tr>
                <td class="hidden-xs">{{$info['id']}}</td>
                <td class="hidden-xs">{{$info['desk_name']}}[{{$info['game_name']}}]</td>
                <td class="hidden-xs">{{$info['ip_limit']}}</td>
                <td class="hidden-xs">
                    @if($info['is_push']==0)
                        <span class="layui-btn layui-btn-mini layui-btn-warm">点击</span>
                    @else
                        <span class="layui-btn layui-btn-mini layui-btn-normal">电话</span>
                    @endif
                </td>
                <td class="hidden-xs">
                    @if($info['status']==0)
                        <span class="layui-btn layui-btn-mini layui-btn">正常</span>
                    @else
                        <span class="layui-btn layui-btn-mini layui-btn-danger">异常</span>
                    @endif
                </td>
                <td class="hidden-xs">{{$info['min_limit']['c']}}/{{$info['min_limit']['cu']}}<br>{{$info['min_limit']['p']}}${{$info['min_limit']['pu']}}</td>
                <td class="hidden-xs">{{$info['max_limit']['c']}}/{{$info['max_limit']['cu']}}<br>{{$info['max_limit']['p']}}${{$info['max_limit']['pu']}}</td>
                <td class="hidden-xs">{{$info['min_tie_limit']['c']}}/{{$info['min_tie_limit']['cu']}}<br>{{$info['min_tie_limit']['p']}}${{$info['min_tie_limit']['pu']}}</td>
                <td class="hidden-xs">{{$info['max_tie_limit']['c']}}/{{$info['max_tie_limit']['cu']}}<br>{{$info['max_tie_limit']['p']}}${{$info['max_tie_limit']['pu']}}</td>
                <td class="hidden-xs">{{$info['min_pair_limit']['c']}}/{{$info['min_pair_limit']['cu']}}<br>{{$info['min_pair_limit']['p']}}${{$info['min_pair_limit']['pu']}}</td>
                <td class="hidden-xs">{{$info['max_pair_limit']['c']}}/{{$info['max_pair_limit']['cu']}}<br>{{$info['max_pair_limit']['p']}}${{$info['max_pair_limit']['pu']}}</td>
                <td class="hidden-xs">
                    @if($info['is_alive']==0)
                        <span class="layui-btn layui-btn-mini layui-btn">是</span>
                    @else
                        <span class="layui-btn layui-btn-mini layui-btn-warm">否</span>
                    @endif</td>
                <td class="hidden-xs">{{$info['count_down']}}</td>
                <td class="hidden-xs">{{$info['wait_down']}}</td>
                <td>
                    <div class="layui-inline">
                        <button class="layui-btn layui-btn-small layui-btn-normal update" data-id="{{$info['id']}}" data-desc="修改" data-url="{{url('/admin/desk/'. $info['id'] .'/edit')}}">编辑</button>
                        <button class="layui-btn layui-btn-small layui-btn-danger changeStatus" data-id="{{$info['id']}}" data-v="1">停用</button>
                        @if($info['video_status']==0)
                            <button class="layui-btn layui-btn-small layui-btn-danger" data-id="{{$info['id']}}" data-v="1">关视频</button>
                        @else
                            <button class="layui-btn layui-btn-small layui-btn-danger" data-id="{{$info['id']}}" data-v="0">开视频</button>
                        @endif
                        <button class="layui-btn layui-btn-small resetpwd" data-id="{{$info['id']}}">修改密码</button>
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
                $("input[name='game_id']").val('');
                $("input[name='is_alive']").val('');
                $("input[name='is_push']").val('');
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
            //添加台桌
            $("#addDesk").click(function () {
                var url = $(this).attr("data-url");
                var index = layer.open({
                    type :2,
                    title:'添加台桌',
                    fix: false,
                    id:'TWork',
                    content:url,
                    area: ['800px', '600px'],//宽高不影响最大化
                    //不固定
                    maxmin: true,
                    shade:0.3,
                    time:0,
                    //弹层外区域关闭
                    shadeClose:true,
                })
                layer.full(index);
                return false
            });
            $(".update").click(function () {
                var url = $(this).attr("data-url");
                var index = layer.open({
                    type :2,
                    title:'修改台桌',
                    fix: false,
                    id:'TWor1k',
                    content:url,
                    area: ['800px', '600px'],//宽高不影响最大化
                    //不固定
                    maxmin: true,
                    shade:0.3,
                    time:0,
                    //弹层外区域关闭
                    shadeClose:true,
                })
                layer.full(index);
                return false
            });
            $(".resetpwd").click(function () {
                var id = $(this).attr('data-id');
                layer.prompt({title: '请输入密码', formType: 1}, function(pass, index){
                    layer.close(index);
                    layer.prompt({title: '请再输入密码', formType: 1}, function(pwd, index){
                        layer.close(index);
                        if(pass!=pwd){
                            layer.msg('两次密码输入不同！');
                        }else{
                            $.ajaxSetup({
                                headers: {
                                    'X-CSRF-TOKEN': $('input[name="_token"]').val()
                                }
                            });
                            $.ajax({
                                url:"{{url('/admin/resetPassword')}}",
                                data:{
                                    "id":id,
                                    "password":pwd
                                },
                                type:"post",
                                dataType:"json",
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
                        }
                    });
                });
            });
        });
    </script>
@endsection
@extends('common.list')
