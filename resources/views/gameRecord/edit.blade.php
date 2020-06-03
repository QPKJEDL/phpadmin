@section('title', '公告编辑')
@section('content')
    <div class="layui-form-item">
        <label class="layui-form-label">桌号：</label>
        <div class="layui-input-inline">
            <input type="text" value="{{$info['desk']['desk_name']}}({{$info['desk']['game_name']}})" autocomplete="off" class="layui-input" readonly="readonly">
            <input type="hidden" value="{{$info['type']}}" name="type">
        </div>
    </div>
    <div class="layui-form-item">
        <label class="layui-form-label">靴号：</label>
        <div class="layui-input-inline">
            <input type="text" value="{{$info['boot_num']}}" autocomplete="off" class="layui-input" readonly="readonly">
        </div>
    </div>
    <div class="layui-form-item">
        <label class="layui-form-label">靴号：</label>
        <div class="layui-input-inline">
            <input type="text" value="{{$info['type']}}" autocomplete="off" class="layui-input" readonly="readonly">
        </div>
    </div>
    <div class="layui-form-item">
        <label class="layui-form-label">铺号：</label>
        <div class="layui-input-inline">
            <input type="text" value="{{$info['pave_num']}}" autocomplete="off" class="layui-input" readonly="readonly">
        </div>
    </div>
    <div class="layui-form-item">
        <label class="layui-form-label">结果：</label>
        <div class="layui-input-inline">
            @if($info['type']==1)<!-- 百家乐 -->
                <input type="text" value="{{$info['result']['game']}}&nbsp;{{$info['result']['playerPair']}}&nbsp;{{$info['result']['bankerPair']}}" autocomplete="off" class="layui-input" readonly="readonly">
            @elseif($info['type']==2)<!-- 龙虎 -->
                <input type="text" value="{{$info['result']}}" autocomplete="off" class="layui-input" readonly="readonly">
            @elseif($info['type']==3)<!-- 牛牛 -->
                @if($info['result']['bankernum']=="")
                    <input type="text" value="{{$info['result']['x1result']}}&nbsp;{{$info['result']['x2result']}}&nbsp;{{$info['result']['x3result']}}" autocomplete="off" class="layui-input" readonly="readonly">
                @else
                    <input type="text" value="{{$info['result']['bankernum']}}" autocomplete="off" class="layui-input" readonly="readonly">
                @endif
            @endif
        </div>
    </div>
    <div class="layui-form-item">
        <label class="layui-form-label">时间：</label>
        <div class="layui-input-inline">
            <input type="text" value="{{$info['creatime']}}" name="time" autocomplete="off" class="layui-input" readonly="readonly">
        </div>
    </div>
    <div class="layui-form-item">
        <label class="layui-form-label">选择正确的结果：</label>
        <div class="layui-input-inline">
            <!-- 百家乐 -->
            @if($info['type']==1)
                <!-- 循环单选 -->
                @foreach($info['gameResult']['radio'] as $nfo)
                    <!--{"game":4,"playerPair":5,"bankerPair":2}-->
                    <input type="radio" name="{{$nfo['name']}}" lay-skin="primary" title="{{$nfo['label_text']}}" value="{{$nfo['label_value']}}">
                @endforeach
                <br/>
                <!-- 循环多选 -->
                @foreach($info['gameResult']['checkbox'] as $nfo)
                    <input type="checkbox" name="{{$nfo['name']}}" lay-skin="primary" title="{{$nfo['label_text']}}" value="{{$nfo['label_value']}}">
                @endforeach
            @elseif($info['type']==2)<!-- 龙虎 -->
                @foreach($info['gameResult'] as $nfo)
                    <input type="radio" name="winner" value="{{$nfo['label_value']}}" title="{{$nfo['label_text']}}">
                @endforeach
            @elseif($info['type']==3)<!-- 牛牛 -->
            <!-- 循环多选 -->
                @foreach($info['gameResult'] as $nfo)
                    <input type="checkbox" id="{{$nfo['name']}}" class="checkboxs" lay-filter="{{$nfo['name']}}" name="{{$nfo['name']}}" lay-skin="primary" title="{{$nfo['label_text']}}" value="{{$nfo['label_value']}}">
                @endforeach
            @elseif($info['type']==4)<!-- A89 -->

            @elseif($info['type']==5)<!-- 三公 -->

            @endif
        </div>
    </div>
@endsection
@section('id',$id)
@section('js')
    <script>
        layui.use(['form','jquery','layer','element'], function() {
            var form = layui.form(),
                $ = layui.jquery,
                laydate=layui.laydate,
                layer = layui.layer;
                var element = layui.element;
            form.render();
            form.on('submit(formDemo)', function(data) {
                var type = $("input[name='type']").val();
                if (type==1){//百家乐
                    var winner = $("input[name='game']").filter(':checked').val();
                    var playerPair = $("input[name='playerPair']").filter(':checked').val();
                    var bankerPair = $("input[name='bankerPair']").filter(':checked').val();
                    if (winner=='' || winner==null){
                        layer.msg('庄，闲，和 为必选！',{shift: 6,icon:5});
                    }else{
                        var str = '{"game":'+winner;
                        if(playerPair==null && bankerPair==null){
                            str = str + '}';
                        }else if(playerPair!=null && bankerPair==null){
                            str = str + ',"playerPair":'+playerPair + "}";
                        }else if(playerPair == null && bankerPair!=null){
                            str = str + ',"bankerPair":'+bankerPair + "}";
                        }else if(playerPair !=null && bankerPair !=null){
                            str = str + ',"playerPair":'+playerPair + ',"bankerPair":'+bankerPair+ "}";
                        }
                        $.ajax({
                            headers: {
                                'X-CSRF-TOKEN':$("input[name='_token']").val()
                            },
                            url:"{{url('/admin/updateBaccaratResult')}}",
                            type:"post",
                            data:{
                                'id':$("input[name='id']").val(),
                                "result":str,
                                'time':$("input[name='time']").val()
                            },
                            dataType: "json",
                            success:function (res) {
                                if(res.status == 1){
                                    layer.msg(res.msg,{icon:6});
                                    var index = parent.layer.getFrameIndex(window.name);
                                    setTimeout('parent.layer.close('+index+')',2000);
                                }else{
                                    layer.msg(res.msg,{shift: 6,icon:5});
                                }
                            }
                        });
                    }
                }else if(type==2){//龙虎
                    var winner = $("input[name='winner']").filter(':checked').val();
                    var id = $("input[name='id']").val();
                    var time = $("input[name='time']").val();
                    $.ajax({
                        headers: {
                            'X-CSRF-TOKEN': $('input[name="_token"]').val()
                        },
                        url:"{{url('/admin/updateDragonAndTigerResult')}}",
                        type:"post",
                        data:{
                            'id':id,
                            'result':winner,
                            'time':time
                        },
                        dataType:'json',
                        success:function (res) {
                            if(res.status == 1){
                                layer.msg(res.msg,{icon:6});
                                var index = parent.layer.getFrameIndex(window.name);
                                setTimeout('parent.layer.close('+index+')',2000);
                            }else{
                                layer.msg(res.msg,{shift: 6,icon:5});
                            }
                        }
                    });
                }else if(type==3){//牛牛
                    /*{"bankernum":"牛1","x1num":"牛牛","x1result":"","x2num":"牛2","x2result":"","x3num":"牛3","x3result":"win"}*/
                }
                return false;
            });
            //复选框的监听事件
            form.on('checkbox(banker)',function (data) {
                if(data.elem.checked==true){
                    $('.checkboxs').each(function () {
                        var that = $(this);
                        var name = that.attr('name');
                        if(name!='banker'){
                            that.attr('disabled','');
                        }
                    });
                }else{
                    $('.checkboxs').each(function () {
                        var that = $(this);
                        var name = that.attr('name');
                        if(name!='banker'){
                            that.removeAttr('disabled');
                        }
                    });
                }
            });
            form.on('checkbox',function (data) {
                var that = $(data.elem);
                var name = that.attr('name');
                if(data.elem.checked==true){
                    if(name!="banker"){
                        $('.checkboxs').each(function () {
                            var name = $(this).attr('name');
                            if(name=='banker'){
                                $(this).attr('disabled','');
                            }
                        });
                    }
                }else{
                    $('.checkboxs').each(function () {
                        var name = $(this).attr('name');
                        if(name=='banker'){
                            $(this).removeAttr('disabled');
                        }
                    });
                }
            });
        });
    </script>
@endsection
@extends('common.edit')