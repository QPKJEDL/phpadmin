@section('title', '公告管理')
@section('header')
    <div class="layui-inline">
        <button class="layui-btn layui-btn-small layui-btn-warm freshBtn"><i class="layui-icon">&#x1002;</i></button>
    </div>
    <div class="layui-inline">
        <select name="type" lay-filter="type">
            <option value="">请选择推送类型</option>
        </select>
    </div>
    <div class="layui-inline">
        <select name="desk_id" lay-filter="desk_id">
            <option value="">请选择台桌</option>
            @foreach($desk as $d)
                <option value="{{$d['id']}}" {{isset($input['desk_id'])&&$input['desk_id']==$d['id']?'selected':''}}>{{$d['desk_name']}}</option>
            @endforeach
        </select>
    </div>
    <div class="layui-inline">
        <input type="text"  value="{{ $input['boot_num'] or '' }}" name="boot_num" placeholder="靴号" autocomplete="off" class="layui-input">
    </div>
    <div class="layui-inline">
        <input type="text"  value="{{ $input['pave_num'] or '' }}" name="pave_num" placeholder="铺号" autocomplete="off" class="layui-input">
    </div>
    <div class="layui-inline">
        <input class="layui-input" name="create_time" placeholder="操作时间" onclick="layui.laydate({elem: this, festival: true,min:'{{$min}}'})" value="{{$input['create_time'] or '' }}" autocomplete="off">
    </div>
    <div class="layui-inline">
        <button class="layui-btn layui-btn-normal" lay-submit lay-filter="formDemo">搜索</button>
        <button class="layui-btn layui-btn-normal" id="reset">重置</button>
    </div>
@endsection
@section('table')
    <table class="layui-table" lay-even lay-skin="nob">
        <colgroup>
            <col class="hidden-xs" width="50">
            <col class="hidden-xs" width="100">
            <col class="hidden-xs" width="100">
            <col class="hidden-xs" width="100">
            <col class="hidden-xs" width="100">
            <col class="hidden-xs" width="100">
            <col class="hidden-xs" width="100">
            <col class="hidden-xs" width="100">
            <col class="hidden-xs" width="100">
            <col class="hidden-xs" width="100">
            <col class="hidden-xs" width="200">
        </colgroup>
        <thead>
        <tr>
            <th class="hidden-xs">序号</th>
            <th class="hidden-xs">桌号</th>
            <th class="hidden-xs" style="text-align: center">台桌推送</th>
            <th class="hidden-xs" style="text-align: center">靴号</th>
            <th class="hidden-xs" style="text-align: center">铺号</th>
            <th class="hidden-xs" style="text-align: center">创建时间</th>
            <th class="hidden-xs" style="text-align: center">结果</th>
            <th class="hidden-xs" style="text-align: center">修改前结果</th>
            <th class="hidden-xs" style="text-align: center">修改时间</th>
            <th class="hidden-xs" style="text-align: center">修改人</th>
            <th class="hidden-xs" style="text-align: center">操作</th>
        </tr>
        </thead>
        <tbody>
        @foreach($list as $info)
            <tr>
                <td class="hidden-xs">{{$info['id']}}</td>
                <td class="hidden-xs">{{$info['desk']['desk_name']}}[{{$info['desk']['game_name']}}]</td>
                <td class="hidden-xs">{{$info['']}}</td>
                <td class="hidden-xs">{{$info['boot_num']}}</td>
                <td class="hidden-xs">{{$info['pave_num']}}</td>
                <td class="hidden-xs">{{$info['creatime']}}</td>
                <td class="hidden-xs">
                    @if($info['type']==1)
                        {{$info['result']['game']}}&nbsp;{{$info['result']['playerPair']}} {{$info['result']['bankerPair']}}
                    @elseif($info['type']==2)
                        {{$info['result']}}
                    @elseif($info['type']==3)
                        @if($info['result']['bankernum']=="")
                            {{$info['result']['x1result']}}&nbsp;{{$info['result']['x2result']}}&nbsp;{{$info['result']['x3result']}}
                        @else
                            {{$info['result']['bankernum']}}
                        @endif
                    @endif
                </td>
                <td class="hidden-xs">
                    @if($info['type']==1)
                        {{$info['afterResult']['game']}}&nbsp;{{$info['afterResult']['playerPair']}} {{$info['afterResult']['bankerPair']}}
                    @elseif($info['type']==2)
                        {{$info['afterResult']}}
                    @elseif($info['type']==3)
                        @if($info['afterResult']['bankernum']=="")
                            {{$info['afterResult']['x1result']}}&nbsp;{{$info['afterResult']['x2result']}}&nbsp;{{$info['afterResult']['x3result']}}
                        @else
                            {{$info['afterResult']['bankernum']}}
                        @endif
                    @endif
                </td>
                <td class="hidden-xs">{{$info['update_time']}}</td>
                <td class="hidden-xs">{{$info['update_by']}}</td>
                <td>
                    <div class="layui-inline">
                        <button class="layui-btn layui-btn-small layui-btn-danger updateGameResult" data-id="{{$info['id']}}" data-time="{{$info['creatime']}}">修改游戏结果</button>
                    </div>
                </td>
            </tr>
        @endforeach
        @if(!$list[0])
            <tr><td colspan="6" style="text-align: center;color: orangered;">暂无数据</td></tr>
        @endif
        </tbody>
    </table>
    <div class="page-wrap">
        {{$list->render()}}
    </div>
@endsection
@section('js')
    <script>
        layui.use(['form', 'jquery', 'layer','laydate'], function() {
            var form = layui.form(),
                $ = layui.jquery,
                laydate=layui.laydate,
                layer = layui.layer;
            laydate({istoday: true});
            form.render();
            $("#reset").click(function () {
                $("select[name='type']").val('');
                $("select[name='desk_id']").val('');
                $("input[name='boot_num']").val('');
                $("input[name='pave_num']").val('');
                $("input[name='create_time']").val('');
            });
            $(".updateGameResult").click(function () {
                var id = $(this).attr('data-id');
                var time = $(this).attr('data-time');
                var url = window.location.protocol+"//"+window.location.host+'/admin/edit?id='+id+'&time='+time;
                layer.prompt({title: '请输入密码', formType: 1}, function(pass, index){
                    $.ajax({
                        headers: {
                            'X-CSRF-TOKEN': $('input[name="_token"]').val()
                        },
                        url:"{{url('/admin/checkUpdateResultPassword')}}",
                        type:"post",
                        dataType:'json',
                        data:{
                            "password":pass
                        },
                        success:function (res) {
                            if(res.status!=1){
                                layer.msg(res.msg,{shift: 6,icon:5});
                            }else{
                                //关闭当前页面
                                layer.close(index);
                                layer.open({
                                    type: 2,
                                    title: '修改游戏结果',
                                    closeBtn: 1,
                                    area: ['700px','620px'],
                                    shadeClose: true, //点击遮罩关闭
                                    resize:false,
                                    content: [url,'no'],
                                    end:function(){
                                        window.location.reload();
                                    }
                                });
                            }
                        }
                    })
                });
            });
            form.on('submit(formDemo)', function(data) {                
            });
            
        });
    </script>
@endsection
@extends('common.list')