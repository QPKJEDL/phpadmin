@section('title', '公告编辑')
@section('content')
    <div class="layui-form-item">
        <label class="layui-form-label">类型：</label>
        <div class="layui-input-inline">
            <select name="type" lay-filter="type">
                <option value="1" {{isset($info['type'])&&$info['type']==1?'selected':''}}>游戏</option>
                <option value="2" {{isset($info['type'])&&$info['type']==2?'selected':''}}>菜单</option>
            </select>
        </div>
    </div>
    <div class="layui-form-item">
        <label class="layui-form-label">游戏名称：</label>
        <div class="layui-input-inline">
            <input type="text" value="{{$info['game_name'] or ''}}" name="game_name"  placeholder="请输入游戏名称" lay-verify="required" lay-reqText="请输入游戏名称" autocomplete="off" class="layui-input">
        </div>
        <div class="layui-form-mid layui-word-aux" style="color: red;">该框是游戏名称或者是菜单名称 下面赔率填写 0.97赔率 填写97 这个数乘100</div>
    </div>
    @if($info['type']==1)
        @if($info['id']==1)<!--百家乐-->
        <div class="layui-form-item">
                <label class="layui-form-label">闲：</label>
                <div class="layui-input-inline" style="width: 100px;">
                    <input type="number" name="fee[player]" placeholder="" value="{{$info['fee']['player']}}"autocomplete="off" class="layui-input">
                </div>
                <div class="layui-form-label">闲对：</div>
                <div class="layui-input-inline" style="width: 100px;">
                    <input type="number" name="fee[playerPair]" placeholder="" value="{{$info['fee']['playerPair']}}"  autocomplete="off" class="layui-input">
                </div>
        </div>
        <div class="layui-form-item">
            <div class="layui-form-label">和：</div>
            <div class="layui-input-inline" style="width: 100px;">
                <input type="number" name="fee[tie]" placeholder="" value="{{$info['fee']['tie']}}"  autocomplete="off" class="layui-input">
            </div>
        </div>
        <div class="layui-form-item">
            <div class="layui-form-label">庄：</div>
            <div class="layui-input-inline" style="width: 100px;">
                <input type="number" name="fee[banker]" placeholder="" value="{{$info['fee']['banker']}}"  autocomplete="off" class="layui-input">
            </div>
            <div class="layui-form-label">庄对：</div>
            <div class="layui-input-inline" style="width: 100px;">
                <input type="number" name="fee[bankerPair]" placeholder="" value="{{$info['fee']['bankerPair']}}"  autocomplete="off" class="layui-input">
            </div>
        </div>
        @elseif($info['id']==2)<!-- 龙虎-->
        <div class="layui-form-item">
            <div class="layui-inline">
                <label class="layui-form-label">龙：</label>
                <div class="layui-input-inline" style="width: 100px;">
                    <input type="number" name="fee[dragon]" placeholder="" value="{{$info['fee']['dragon']}}"autocomplete="off" class="layui-input">
                </div>
                <div class="layui-form-mid">和：</div>
                <div class="layui-input-inline" style="width: 100px;">
                    <input type="number" name="fee[tie]" placeholder="" value="{{$info['fee']['tie']}}"  autocomplete="off" class="layui-input">
                </div>
                <div class="layui-form-mid">虎：</div>
                <div class="layui-input-inline" style="width: 100px;">
                    <input type="number" name="fee[tiger]" placeholder="" value="{{$info['fee']['tiger']}}"  autocomplete="off" class="layui-input">
                </div>
            </div>
        </div>
        @elseif($info['id']==3)<!--牛牛-->
        <div class="layui-form-item">
            <div class="layui-inline">
                <label class="layui-form-label">平倍：</label>
                <div class="layui-input-inline" style="width: 100px;">
                    <input type="number" name="fee[Equal]" placeholder="" value="{{$info['fee']['Equal']}}"autocomplete="off" class="layui-input">
                </div>
                <div class="layui-form-mid">翻倍：</div>
                <div class="layui-input-inline" style="width: 100px;">
                    <input type="number" name="fee[Double]" placeholder="" value="{{$info['fee']['Double']}}"  autocomplete="off" class="layui-input">
                </div>
                <div class="layui-form-mid">超倍：</div>
                <div class="layui-input-inline" style="width: 100px;">
                    <input type="number" name="fee[SuperDouble]" placeholder="" value="{{$info['fee']['SuperDouble']}}"  autocomplete="off" class="layui-input">
                </div>
            </div>
        </div>
        @endif
    @else
    @endif
@endsection
@section('id',$id)
@section('js')
    <script>
        window.onload=function(){
            var type = $("select[name='type']").val();
            if(type!=1){
                $("#fee").hide();
            }else{
                $("#fee").show();
            }
        }

        layui.use(['form','jquery','layer'], function() {
            var form = layui.form()
                ,layer = layui.layer
                ,$ = layui.jquery;
            form.render();
            form.on('select(type)',function (data) {
                var type = data.value;
                if(type==1){
                    $("#fee").show();
                }else{
                    $("#fee").hide();
                }
            });
            var id = $("input[name='id']").val();
            var index = parent.layer.getFrameIndex(window.name);
                form.on('submit(formDemo)', function(data) {
                    var data = $('form').serializeArray();
                    console.log(data);
                    $.ajax({
                        url:"{{url('/admin/gameUpdate')}}",
                        data:data,
                        type:'post',
                        dataType:'json',
                        success:function(res){
                            if(res.status == 1){
                                layer.msg(res.msg,{icon:6},function () {
                                    parent.layer.close(index);
                                    window.parent.frames[1].location.reload();
                                });
                            }else{
                                layer.msg(res.msg,{shift: 6,icon:5});
                            }
                        },
                        error : function(XMLHttpRequest, textStatus, errorThrown) {
                            layer.msg('网络失败', {time: 1000});
                        }
                    });
                    return false;
                });
        });
    </script>
@endsection
@extends('common.edit')