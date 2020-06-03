@section('title', '订单管理')
@section('header')
    <div class="layui-inline">
        <button class="layui-btn layui-btn-small layui-btn-warm freshBtn"><i class="layui-icon">&#x1002;</i></button>
    </div>
    <div class="layui-inline">
        <input type="text"  value="{{ $input['business_code'] or '' }}" name="business_code" placeholder="请输入商户号" autocomplete="off" class="layui-input">
    </div>
    <div class="layui-inline">
        <input type="text"  value="{{ $input['order_sn'] or '' }}" name="order_sn" placeholder="请输入平台订单号" autocomplete="off" class="layui-input">
    </div>
    <div class="layui-inline">
        <input type="text"  value="{{ $input['out_order_sn'] or '' }}" name="out_order_sn" placeholder="请输入商户订单号" autocomplete="off" class="layui-input">
    </div>
    <div class="layui-inline">
        <input type="text"  value="{{ $input['user_id'] or '' }}" name="user_id" placeholder="请输入码商号" autocomplete="off" class="layui-input">
    </div>
    <div class="layui-inline">
        <select name="status">
            <option value="">请选择支付状态</option>
            <option value="0" {{isset($input['status'])&&$input['status']==0?'selected':''}}>未支付</option>
            <option value="1" {{isset($input['status'])&&$input['status']==1?'selected':''}}>支付成功</option>
            <option value="2" {{isset($input['status'])&&$input['status']==2?'selected':''}}>过期</option>
            <option value="3" {{isset($input['status'])&&$input['status']==3?'selected':''}}>取消</option>
        </select>
    </div>
    <div class="layui-inline">
        <select name="payType">
            <option value="">请选择支付类型</option>
            <option value="1" {{isset($input['payType'])&&$input['payType']==1?'selected':''}}>微信</option>
            <option value="2" {{isset($input['payType'])&&$input['payType']==2?'selected':''}}>支付宝</option>
        </select>
    </div>
    <div class="layui-inline">
        <input type="text"  value="{{ $input['creatime'] or '' }}" name="creatime" placeholder="创建时间" onclick="layui.laydate({elem: this, festival: true})" autocomplete="off" class="layui-input">
    </div>
    <div class="layui-inline" style="padding-top: 10px;float: right;padding-right: 95px;">
        <button class="layui-btn layui-btn-normal" lay-submit lay-filter="formDemo">搜索</button>
        <button id="res" class="layui-btn layui-btn-primary">重置</button>
        <button class="layui-btn layui-btn-warm" name="excel" value="excel">导出EXCEL</button>
    </div>
@endsection
@section('table')
    <table class="layui-table" lay-even lay-skin="nob">
        <colgroup>
            <col class="hidden-xs" width="100">
            <col class="hidden-xs" width="200">
            <col class="hidden-xs" width="100">
            <col class="hidden-xs" width="100">
            <col class="hidden-xs" width="100">
            <col class="hidden-xs" width="150">
            <col class="hidden-xs" width="150">
            <col class="hidden-xs" width="150">
            <col class="hidden-xs" width="150">
            <col class="hidden-xs" width="100">
            <col class="hidden-xs" width="100">
            <col class="hidden-xs" width="100">
            <col class="hidden-xs" width="100">
            <col class="hidden-xs" width="100">
            <col class="hidden-xs" width="250">
            <col class="hidden-xs" width="250">
        </colgroup>
        <thead>
        <tr>
            <th class="hidden-xs">序号</th>
            <th class="hidden-xs">用户id</th>
            <th class="hidden-xs">下注单号</th>
            <th class="hidden-xs">台桌id</th>
            <th class="hidden-xs">台桌名称</th>
            <th class="hidden-xs">靴次</th>
            <th class="hidden-xs">铺次</th>
            <th class="hidden-xs">投注金额</th>
            <th class="hidden-xs">结算金额</th>
            <th class="hidden-xs">下注状态</th>
            <th class="hidden-xs">创建时间</th>
            <th class="hidden-xs">结算时间</th>
            <th class="hidden-xs" style="text-align: center">操作</th>
        </tr>
        </thead>
        <tbody>
        @foreach($list as $info)
            <tr>
                <td class="hidden-xs">{{$info['id']}}</td>
                <td class="hidden-xs">{{$info['user_id']}}</td>
                <td class="hidden-xs">{{$info['order_sn']}}</td>
                <td class="hidden-xs">{{$info['desk_id']}}</td>
                <td class="hidden-xs">{{$info['desk_name']}}</td>
                <td class="hidden-xs">{{$info["boot_num"]}}</td>
                <td class="hidden-xs">{{$info["pave_num"]}}</td>
                <td class="hidden-xs">{{$info['bet_money']}}</td>
                <td class="hidden-xs">{{$info['get_money']/100}}</td>
                <td class="hidden-xs">{{$info['status']}}</td>
                <td class="hidden-xs">{{$info['creatime']}}</td>
                <td class="hidden-xs">{{$info['paytime']}}</td>
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
                $("select[name='payType']").val('');
                $('form').submit();
            });
        });
    </script>
@endsection
@extends('common.list')
