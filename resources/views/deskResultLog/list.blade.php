@section('title', '公告管理')
@section('header')
    <div class="layui-inline">
        <button class="layui-btn layui-btn-small layui-btn-warm freshBtn"><i class="layui-icon">&#x1002;</i></button>
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
        <div class="layui-input-inline" style="width: 100px;">
            <input type="text" name="bootNum" placeholder="靴号" autocomplete="off" class="layui-input">
        </div>
    </div>
    <div class="layui-inline">
        <div class="layui-input-inline" style="width: 100px;">
            <input type="text" name="paveNum" placeholder="铺号" autocomplete="off" class="layui-input">
        </div>
    </div>
    <div class="layui-inline">
        <input class="layui-input" name="create_time" placeholder="操作时间" onclick="layui.laydate({elem: this, festival: true,min:'{{$min}}'})" value="{{$input['create_time'] or '' }}" autocomplete="off">
    </div>
    <div class="layui-inline">
        <input class="layui-input" name="bootTime" placeholder="主靴日期" onclick="layui.laydate({elem: this, festival: true,min:'{{$min}}'})" value="{{$input['boot_time'] or '' }}" autocomplete="off">
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
        </colgroup>
        <thead>
        <tr>
            <th class="hidden-xs">序号</th>
            <th class="hidden-xs">被修改台桌</th>
            <th class="hidden-xs">靴号</th>
            <th class="hidden-xs">铺号</th>
            <th class="hidden-xs">结果</th>
            <th class="hidden-xs">修改前的结果</th>
            <th class="hidden-xs">修改人</th>
            <th class="hidden-xs">操作时间</th>
            <th class="hidden-xs">主靴日期</th>
        </tr>
        </thead>
        <tbody>
        @foreach($list as $info)
            <tr>
                <td class="hidden-xs">{{$info['id']}}</td>
                <td class="hidden-xs">{{$info['desk_name']}}[{{$info['game_name']}}]</td>
                <td class="hidden-xs">{{$info['boot_num']}}</td>
                <td class="hidden-xs">{{$info['pave_num']}}</td>
                <td class="hidden-xs">
                    @if($info['game_id']==1)<!-- 百家乐 -->
                        {{$info['result']['game']}}&nbsp;{{$info['result']['playerPair']}} {{$info['result']['bankerPair']}}
                    @elseif($info['game_id']==2)<!-- 龙虎 -->
                        {{$info['result']}}
                    @elseif($info['game_id']==3)<!-- 牛牛 -->
                        @if($info['result']['bankernum']=="")
                            {{$info['result']['x1result']}}&nbsp;{{$info['result']['x2result']}}&nbsp;{{$info['result']['x3result']}}
                        @else
                            {{$info['result']['bankernum']}}
                        @endif
                    @endif
                </td>
                <td class="hidden-xs">
                @if($info['game_id']==1)<!-- 百家乐 -->
                    {{$info['afterResult']['game']}}&nbsp;{{$info['afterResult']['playerPair']}} {{$info['afterResult']['bankerPair']}}
                    @elseif($info['game_id']==2)<!-- 龙虎 -->
                    {{$info['afterResult']}}
                    @elseif($info['game_id']==3)<!-- 牛牛 -->
                    @if($info['afterResult']['bankernum']=="")
                        {{$info['afterResult']['x1result']}}&nbsp;{{$info['afterResult']['x2result']}}&nbsp;{{$info['afterResult']['x3result']}}
                    @else
                        {{$info['afterResult']['bankernum']}}
                    @endif
                    @endif
                </td>
                <td class="hidden-xs">{{$info['create_by']}}</td>
                <td class="hidden-xs">{{$info['create_time']}}</td>
                <td class="hidden-xs">{{$info['boot_time']}}</td>
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
                $("select[name='desk_id']").val('');
                $("input[name='create_time']").val('');
            });
            form.on('submit(formDemo)', function(data) {                
            });
            
        });
    </script>
@endsection
@extends('common.list')