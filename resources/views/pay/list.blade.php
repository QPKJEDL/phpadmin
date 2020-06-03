@section('title', '配置列表')
@section('header')
    <div class="layui-inline">
        <a class="layui-btn layui-btn-small layui-btn-normal addBtn" data-desc="添加" data-url="{{url('/admin/pay/0/edit')}}"><i class="layui-icon">&#xe654;</i></a>
        <button class="layui-btn layui-btn-small layui-btn-warm freshBtn"><i class="layui-icon">&#x1002;</i></button>
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
            <th class="hidden-xs">商户id</th>
            <th class="hidden-xs">商户名称</th>
            <th class="hidden-xs">支付通道</th>
            <th class="hidden-xs">支付操作端</th>
            <th class="hidden-xs">最小充值限额</th>
            <th class="hidden-xs">最大充值限额</th>
            <th class="hidden-xs">服务名称</th>
            <th class="hidden-xs">支付平台</th>
            <th class="hidden-xs">页面通知地址</th>
            <th class="hidden-xs">异步通知地址</th>
            <th class="hidden-xs">密钥</th>
            <th class="hidden-xs">支付网关</th>
            <th class="hidden-xs">预支付链接</th>
            <th class="hidden-xs">是否直接跳转</th>
            <th class="hidden-xs">状态</th>
            <th class="hidden-xs">备注</th>
            <th class="hidden-xs">操作</th>
        </tr>
        </thead>
        <tbody>
        @foreach($list as $info)
            <td class="hidden-xs">{{$info['id']}}</td>
            <td class="hidden-xs">{{$info['business_id']}}</td>
            <td class="hidden-xs">{{$info['business_name']}}</td>
            <td class="hidden-xs">{{$info['pay_aisle']}}</td>
            <td class="hidden-xs">{{$info['operation_side']}}</td>
            <td class="hidden-xs">{{$info['min_price']}}</td>
            <td class="hidden-xs">{{$info['max_price']}}</td>
            <td class="hidden-xs">{{$info['service_name']}}</td>
            <td class="hidden-xs">{{$info['pay_type']}}</td>
            <td class="hidden-xs">{{$info['page_notify_url']}}</td>
            <td class="hidden-xs">{{$info['asyn_notify_url']}}</td>
            <td class="hidden-xs">{{$info['access_key']}}</td>
            <td class="hidden-xs">{{$info['pay_gateway']}}</td>
            <td class="hidden-xs">{{$info['prepaid_link']}}</td>
            <td class="hidden-xs">
                @if($info['is_jump']==0)
                    是
                @else
                    否
                @endif
            </td>
            <td class="hidden-xs">
                @if($info['status']==0)
                    正常
                @else
                    禁用
                @endif
            </td>
            <td class="hidden-xs">{{$info['remark']}}</td>
            <td>
                <div class="layui-inline">
                    <button class="layui-btn layui-btn-small layui-btn-normal edit-btn" data-id="{{$info['id']}}" data-desc="修改配置" data-url="{{url('/admin/pay/'. $info['id'] .'/edit')}}">编辑</button>
                    <button class="layui-btn layui-btn-small layui-btn-danger del-btn" data-id="{{$info['id']}}" data-url="{{url('/admin/pay/'.$info['id'])}}">解禁</button>
                </div>
            </td>
        @endforeach
        @if(!$list[0])
            <tr><td colspan="18" style="text-align: center;color: orangered;">暂无数据</td></tr>
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
            form.on('submit(formDemo)', function(data) {               
            });
            
        });
    </script>
@endsection
@extends('common.list')