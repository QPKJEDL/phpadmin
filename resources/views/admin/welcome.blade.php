<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta name="renderer" content="webkit">
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
    <meta name="viewport" content="width=device-width,initial-scale=1,minimum-scale=1,maximum-scale=1,user-scalable=no" />
    <title>网站后台管理系统</title>
    <link rel="stylesheet" type="text/css" href="/static/admin/layui/css/layui.css"/>
    <link rel="stylesheet" type="text/css" href="/static/admin/css/admin.css"/>
    <link href="/static/admin/summernote/summernote.min.css">
    <link rel="stylesheet" href="/static/admin/css/zTreeStyle/zTreeStyle.css"/>
</head>
<body>
<div class="wrap-container welcome-container">
    <div class="row">
        <div class="welcome-left-container col-lg-9">
            {{--<div class="data-show">--}}
                {{--<ul class="clearfix">--}}
                    {{--<li class="col-sm-12 col-md-4 col-xs-12">--}}
                        {{--<a href="javascript:;" class="clearfix">--}}
                            {{--<div class="icon-bg bg-org f-l">--}}
                                {{--<span class="iconfont">&#xe600;</span>--}}
                            {{--</div>--}}
                            {{--<div class="right-text-con">--}}
                                {{--<p class="name">今日订单数</p>--}}
                                {{--<p><span class="color-org">0单</span></p>--}}
                            {{--</div>--}}
                        {{--</a>--}}
                    {{--</li>--}}
                    {{--<li class="col-sm-12 col-md-4 col-xs-12">--}}
                        {{--<a href="javascript:;" class="clearfix">--}}
                            {{--<div class="icon-bg bg-blue f-l">--}}
                                {{--<span class="iconfont">&#xe602;</span>--}}
                            {{--</div>--}}
                            {{--<div class="right-text-con">--}}
                                {{--<p class="name">今日成功订单</p>--}}
                                {{--<p><span class="color-blue">0单</span></p>--}}
                            {{--</div>--}}
                        {{--</a>--}}
                    {{--</li>--}}
                    {{--<li class="col-sm-12 col-md-4 col-xs-12">--}}
                        {{--<a href="javascript:;" class="clearfix">--}}
                            {{--<div class="icon-bg bg-green f-l">--}}
                                {{--<span class="iconfont">&#xe605;</span>--}}
                            {{--</div>--}}
                            {{--<div class="right-text-con">--}}
                                {{--<p class="name">今日未付订单</p>--}}
                                {{--<p><span class="color-green">0单</span></p>--}}
                            {{--</div>--}}
                        {{--</a>--}}
                    {{--</li>--}}
                {{--</ul>--}}
            {{--</div>--}}
            <!--服务器信息-->
            <div class="server-panel panel panel-default">
                <div class="panel-header">服务器信息:</div>
                <div class="panel-body clearfix">
                    <div class="col-md-2">
                        <p class="title">服务器环境</p>
                        <span class="info">{{$sysinfo['web_server']}}</span>
                    </div>
                    <div class="col-md-2">
                        <p class="title">服务器IP地址</p>
                        <span class="info">{{$sysinfo['ip']}}</span>
                    </div>
                    <div class="col-md-2">
                        <p class="title">服务器域名</p>
                        <span class="info">{{$sysinfo['domain']}}</span>
                    </div>
                    <div class="col-md-2">
                        <p class="title"> PHP版本</p>
                        <span class="info">{{$sysinfo['phpv']}}</span>
                    </div>
                    <div class="col-md-2">
                        <p class="title">数据库信息</p>
                        <span class="info">{{$sysinfo['mysql_version']}}</span>
                    </div>
                    <div class="col-md-2">
                        <p class="title">服务器当前时间</p>
                        <span class="info">{{$sysinfo['time']}}</span>
                    </div>
                </div>
            </div>
        </div>




    </div>
</div>
<script src="/static/admin/layui/layui.js" type="text/javascript" charset="utf-8"></script>
<script src="/static/admin/layui/layui.all.js" type="text/javascript" charset="utf-8"></script>
<script src="/static/admin/js/jquery-2.1.1.js" type="text/javascript" charset="utf-8"></script>
<script src="/static/admin/js/Chart.min.js" type="text/javascript" charset="utf-8"></script>
<script src="/static/admin/lib/echarts/echarts.js"></script>
<script src="/static/admin/summernote/summernote.min.js" type="text/javascript" charset="utf-8"></script>
<script src="/static/admin/js/jquery.ztree.all.js" type="text/javascript"></script>
</body>
</html>