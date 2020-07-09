@section('title', '菜单编辑')
@section('content')
    <div class="layui-form-item">
        <label class="layui-form-label">台桌名称：</label>
        <div class="layui-input-block">
            <input type="text" value="{{$info['desk_name'] or ''}}" name="desk_name" required lay-verify="desk_name" placeholder="请输入名称" autocomplete="off" class="layui-input" @if($id!=0) disabled @endif>
        </div>

    </div>
    <div class="layui-form-item">
        <label class="layui-form-label">台桌类型：</label>
        <div class="layui-input-inline">
            <select name="game_id" lay-verify="required" lay-filter="game">
                <option value="">请选择游戏</option>
                @foreach($gameType as $nfo)
                    <option value="{{$nfo['id']}}" {{isset($info['game_id'])&&$info['game_id']==$nfo['id']?'selected':''}}>{{$nfo['game_name']}}</option>
                @endforeach
            </select>
        </div>
    </div>
    <div class="layui-form-item">
        <label class="layui-form-label">倒计时：</label>
        <div class="layui-input-block">
            <input type="number" value="{{$info['count_down'] or ''}}" name="count_down" required lay-verify="count_down" placeholder="请输入倒计时" autocomplete="off" class="layui-input">
        </div>
    </div>
    <div class="layui-form-item">
        <label class="layui-form-label">等待开牌时间：</label>
        <div class="layui-input-block">
            <input type="number" value="{{$info['wait_down'] or ''}}" name="wait_down" required lay-verify="wait_down" placeholder="请输入开牌时间" autocomplete="off" class="layui-input">
        </div>
    </div>
    <div class="layui-form-item">
        <label class="layui-form-label">全景1：</label>
        <div class="layui-input-block">
            <input type="text" value="{{$info['all_scene1'] or ''}}" name="all_scene1" required lay-verify="all_scene1" placeholder="全景1" autocomplete="off" class="layui-input">
        </div>
    </div>
    <div class="layui-form-item">
        <label class="layui-form-label">h5全景1：</label>
        <div class="layui-input-block">
            <input type="text" value="{{$info['h5_all_scene1'] or ''}}" name="h5_all_scene1" required lay-verify="h5_all_scene1" placeholder="h5全景1" autocomplete="off" class="layui-input">
        </div>
    </div>
    <div class="layui-form-item">
        <label class="layui-form-label">全景2：</label>
        <div class="layui-input-block">
            <input type="text" value="{{$info['all_scene2'] or ''}}" name="all_scene2" required lay-verify="all_scene2" placeholder="全景2" autocomplete="off" class="layui-input">
        </div>
    </div>
    <div class="layui-form-item">
        <label class="layui-form-label">h5全景2：</label>
        <div class="layui-input-block">
            <input type="text" value="{{$info['h5_all_scene2'] or ''}}" name="h5_all_scene2" required lay-verify="h5_all_scene2" placeholder="h5全景2" autocomplete="off" class="layui-input">
        </div>
    </div>
    <div class="layui-form-item">
        <label class="layui-form-label">左台播放地址：</label>
        <div class="layui-input-block">
            <input type="text" value="{{$info['left_play'] or ''}}" name="left_play" required lay-verify="left_play" placeholder="左台播放地址" autocomplete="off" class="layui-input">
        </div>
    </div>
    <div class="layui-form-item">
        <label class="layui-form-label">左台播放备用地址：</label>
        <div class="layui-input-block">
            <input type="text" value="{{$info['left_play_backup'] or ''}}" name="left_play_backup" required lay-verify="left_play_backup" placeholder="左台播放备用地址" autocomplete="off" class="layui-input">
        </div>
    </div>
    <div class="layui-form-item">
        <label class="layui-form-label">右台播放地址：</label>
        <div class="layui-input-block">
            <input type="text" value="{{$info['right_play'] or ''}}" name="right_play" required lay-verify="right_play" placeholder="右台播放地址" autocomplete="off" class="layui-input">
        </div>
    </div>
    <div class="layui-form-item">
        <label class="layui-form-label">右台播放备用地址：</label>
        <div class="layui-input-block">
            <input type="text" value="{{$info['right_play_backup'] or ''}}" name="right_play_backup" required lay-verify="right_play_backup" placeholder="右台播放备用地址" autocomplete="off" class="layui-input">
        </div>
    </div>
    <div class="layui-form-item">
        <label class="layui-form-label">H5左台地址：</label>
        <div class="layui-input-block">
            <input type="text" value="{{$info['h5_left'] or ''}}" name="h5_left" required lay-verify="h5_left" placeholder="H5左台地址" autocomplete="off" class="layui-input">
        </div>
    </div>
    <div class="layui-form-item">
        <label class="layui-form-label">H5左台备用地址：</label>
        <div class="layui-input-block">
            <input type="text" value="{{$info['h5_left_backup'] or ''}}" name="h5_left_backup" required lay-verify="h5_left_backup" placeholder="H5左台备用地址" autocomplete="off" class="layui-input">
        </div>
    </div>
    <div class="layui-form-item">
        <label class="layui-form-label">H5右台地址：</label>
        <div class="layui-input-block">
            <input type="text" value="{{$info['h5_right'] or ''}}" name="h5_right" required lay-verify="h5_right" placeholder="H5右台地址" autocomplete="off" class="layui-input">
        </div>
    </div>
    <div class="layui-form-item">
        <label class="layui-form-label">H5右台备用地址：</label>
        <div class="layui-input-block">
            <input type="text" value="{{$info['h5_right_backup'] or ''}}" name="h5_right_backup" required lay-verify="h5_right_backup" placeholder="H5右台备用地址" autocomplete="off" class="layui-input">
        </div>
    </div>
    <div class="layui-form-item">
        <label class="layui-form-label">最小限红：</label>
        <div class="layui-inline">
            <label class="layui-form-label">点击:</label>
            <div class="layui-input-inline" style="width: 100px;">
                <input type="number" name="min_limit[c]" value="{{$minLimit['c'] or ''}}" placeholder="" autocomplete="off" class="layui-input">
            </div>
            <div class="layui-form-mid">US:</div>
            <div class="layui-input-inline" style="width: 100px;">
                <input type="number" name="min_limit[cu]" value="{{$minLimit['cu'] or ''}}" placeholder="" autocomplete="off" class="layui-input">
            </div>
        </div>
        <div class="layui-inline">
            <label class="layui-form-label">电话:</label>
            <div class="layui-input-inline" style="width: 100px;">
                <input type="number" name="min_limit[p]" value="{{$minLimit['p'] or ''}}" placeholder="" autocomplete="off" class="layui-input">
            </div>
            <div class="layui-form-mid">US:</div>
            <div class="layui-input-inline" style="width: 100px;">
                <input type="number" name="min_limit[pu]" value="{{$minLimit['pu'] or ''}}" placeholder="" autocomplete="off" class="layui-input">
            </div>
        </div>
    </div>
    <div class="layui-form-item">
        <label class="layui-form-label">最大限红：</label>
        <div class="layui-inline">
            <label class="layui-form-label">点击:</label>
            <div class="layui-input-inline" style="width: 100px;">
                <input type="number" name="max_limit[c]" value="{{$maxLimit['c'] or ''}}" placeholder="" autocomplete="off" class="layui-input">
            </div>
            <div class="layui-form-mid">US:</div>
            <div class="layui-input-inline" style="width: 100px;">
                <input type="number" name="max_limit[cu]" value="{{$maxLimit['cu'] or ''}}" placeholder="" autocomplete="off" class="layui-input">
            </div>
        </div>
        <div class="layui-inline">
            <label class="layui-form-label">电话:</label>
            <div class="layui-input-inline" style="width: 100px;">
                <input type="number" name="max_limit[p]" value="{{$maxLimit['p'] or ''}}" placeholder="" autocomplete="off" class="layui-input">
            </div>
            <div class="layui-form-mid">US:</div>
            <div class="layui-input-inline" style="width: 100px;">
                <input type="number" name="max_limit[pu]" value="{{$maxLimit['pu'] or ''}}"  placeholder="" autocomplete="off" class="layui-input">
            </div>
        </div>
    </div>
    <div class="layui-form-item">
        <label class="layui-form-label">最小和限红：</label>
        <div class="layui-inline">
            <label class="layui-form-label">点击:</label>
            <div class="layui-input-inline" style="width: 100px;">
                <input type="number" name="min_tie_limit[c]" value="{{$minTieLimit['c'] or ''}}" placeholder="" autocomplete="off" class="layui-input">
            </div>
            <div class="layui-form-mid">US:</div>
            <div class="layui-input-inline" style="width: 100px;">
                <input type="number" name="min_tie_limit[cu]" value="{{$minTieLimit['cu'] or ''}}" placeholder="" autocomplete="off" class="layui-input">
            </div>
        </div>
        <div class="layui-inline">
            <label class="layui-form-label">电话:</label>
            <div class="layui-input-inline" style="width: 100px;">
                <input type="number" name="min_tie_limit[p]" value="{{$minTieLimit['p'] or ''}}" placeholder="" autocomplete="off" class="layui-input">
            </div>
            <div class="layui-form-mid">US:</div>
            <div class="layui-input-inline" style="width: 100px;">
                <input type="number" name="min_tie_limit[pu]" value="{{$minTieLimit['pu'] or ''}}" placeholder="" autocomplete="off" class="layui-input">
            </div>
        </div>
    </div>
    <div class="layui-form-item">
        <label class="layui-form-label">最大和限红：</label>
        <div class="layui-inline">
            <label class="layui-form-label">点击:</label>
            <div class="layui-input-inline" style="width: 100px;">
                <input type="number" name="max_tie_limit[c]" value="{{$maxTieLimit['c'] or ''}}" placeholder="" autocomplete="off" class="layui-input">
            </div>
            <div class="layui-form-mid">US:</div>
            <div class="layui-input-inline" style="width: 100px;">
                <input type="number" name="max_tie_limit[cu]" value="{{$maxTieLimit['cu'] or ''}}" placeholder="" autocomplete="off" class="layui-input">
            </div>
        </div>
        <div class="layui-inline">
            <label class="layui-form-label">电话:</label>
            <div class="layui-input-inline" style="width: 100px;">
                <input type="number" name="max_tie_limit[p]" value="{{$maxTieLimit['p'] or ''}}" placeholder="" autocomplete="off" class="layui-input">
            </div>
            <div class="layui-form-mid">US:</div>
            <div class="layui-input-inline" style="width: 100px;">
                <input type="number" name="max_tie_limit[pu]" value="{{$maxTieLimit['pu'] or ''}}" placeholder="" autocomplete="off" class="layui-input">
            </div>
        </div>
    </div>
    <div class="layui-form-item">
        <label class="layui-form-label">最小对子限红：</label>
        <div class="layui-inline">
            <label class="layui-form-label">点击:</label>
            <div class="layui-input-inline" style="width: 100px;">
                <input type="number" name="min_pair_limit[c]" value="{{$minPairLimit['c'] or ''}}" placeholder="" autocomplete="off" class="layui-input">
            </div>
            <div class="layui-form-mid">US:</div>
            <div class="layui-input-inline" style="width: 100px;">
                <input type="number" name="min_pair_limit[cu]" value="{{$minPairLimit['cu'] or ''}}" placeholder="" autocomplete="off" class="layui-input">
            </div>
        </div>
        <div class="layui-inline">
            <label class="layui-form-label">电话:</label>
            <div class="layui-input-inline" style="width: 100px;">
                <input type="number" name="min_pair_limit[p]" value="{{$minPairLimit['p'] or ''}}" placeholder="" autocomplete="off" class="layui-input">
            </div>
            <div class="layui-form-mid">US:</div>
            <div class="layui-input-inline" style="width: 100px;">
                <input type="number" name="min_pair_limit[pu]" value="{{$minPairLimit['pu'] or ''}}" placeholder="" autocomplete="off" class="layui-input">
            </div>
        </div>
    </div>
    <div class="layui-form-item">
        <label class="layui-form-label">最大对子限红：</label>
        <div class="layui-inline">
            <label class="layui-form-label">点击:</label>
            <div class="layui-input-inline" style="width: 100px;">
                <input type="number" name="max_pair_limit[c]" value="{{$maxPairLimit['c'] or ''}}" placeholder="" autocomplete="off" class="layui-input">
            </div>
            <div class="layui-form-mid">US:</div>
            <div class="layui-input-inline" style="width: 100px;">
                <input type="number" name="max_pair_limit[cu]" value="{{$maxPairLimit['cu'] or ''}}" placeholder="" autocomplete="off" class="layui-input">
            </div>
        </div>
        <div class="layui-inline">
            <label class="layui-form-label">电话:</label>
            <div class="layui-input-inline" style="width: 100px;">
                <input type="number" name="max_pair_limit[p]" value="{{$maxPairLimit['p'] or ''}}" placeholder="" autocomplete="off" class="layui-input">
            </div>
            <div class="layui-form-mid">US:</div>
            <div class="layui-input-inline" style="width: 100px;">
                <input type="number" name="max_pair_limit[pu]" value="{{$maxPairLimit['pu'] or ''}}" placeholder="" autocomplete="off" class="layui-input">
            </div>
        </div>
    </div>
    <div class="layui-form-item">
        <label class="layui-form-label">台桌登录IP限制：</label>
        <div class="layui-input-block">
            <input type="text" value="{{$info['ip_limit'] or ''}}" name="ip_limit" required lay-verify="ip_limit" placeholder="请输入IP地址，样式如：192.168.0.1" autocomplete="off" class="layui-input">
        </div>
    </div>
    <div class="layui-form-item">
        <label class="layui-form-label">台桌顺序：</label>
        <div class="layui-input-inline">
            <input type="number" value="{{$info['sort'] or  ''}}" name="sort" lay-verify="required|sort" autocomplete="off" class="layui-input">
        </div>
    </div>
    <div class="layui-form-item">
        <label class="layui-form-label">是否主播：</label>
        <div class="layui-input-block">
                <input type="radio" name="is_alive" value="0" title="否"
                       @if(!isset($info['is_alive']))
                       checked
                       @elseif(isset($info['is_alive'])&&$info['is_alive'])
                       checked
                @else
                        @endif>
                <input type="radio" name="is_alive" value="1" title="是" {{isset($info['is_alive'])&&!$info['is_alive']?'checked':''}}>
            </div>
    </div>
    <div class="layui-form-item">
        <label class="layui-form-label">台桌推送：</label>
        <div class="layui-input-block">
            <input type="radio" name="is_push" value="0" title="点击"
                   @if(!isset($info['is_push']))
                   checked
                   @elseif(isset($info['is_push'])&&$info['is_push'])
                   checked
            @else
                    @endif>
            <input type="radio" name="is_push" value="1" title="电话" {{isset($info['is_push'])&&!$info['is_push']?'checked':''}}>
        </div>
    </div>
    @if($info != null)
        @if($info['game_id'] != 1 && $info['game_id'] != 2)
            <div class="layui-form-item">
                <label class="layui-form-label">超倍开关：</label>
                <div class="layui-input-block">
                    <input type="radio" name="super" value="0" title="关"
                           @if(!isset($info['super']))
                           checked
                           @elseif(isset($info['super'])&&$info['super'])
                           checked
                    @else
                            @endif>
                    <input type="radio" name="super" value="1" title="开" {{isset($info['super'])&&!$info['super']?'checked':''}}>
                </div>
            </div>
        @endif
    @else
    <div class="layui-form-item" id="open">
        <label class="layui-form-label">超倍开关：</label>
        <div class="layui-input-block">
            <input type="radio" name="super" value="0" title="关" checked>
            <input type="radio" name="super" value="1" title="开">
        </div>
    </div>
    @endif
@endsection
@section('id',$id)
@section('js')
    <script>
        window.onload=function(){
            var game = $("select[name='game_id']").val();
            if (game != 1 && game != 2){
                $("#open").show();
            }else{
                $("#open").hide();
            }
        }
        layui.use(['form','laypage', 'layer'], function() {
            var form = layui.form();
            form.render();
            var laypage = layui.laypage
                ,layer = layui.layer;
            form.verify({
                desk_name:function (value) {
                    if(value.length <2){
                        return '台桌名称最少2个字符'
                    }
                },
                count_down:function (value) {
                    if(value<20){
                        return '倒计时时间必须大于20秒'
                    }
                },
                wait_down:function (value) {
                    if(value < 5){
                        return '等待开牌时间必须大于5秒'
                    }
                },
                ip_limit:function (value) {
                    //效验ip正则表达式
                    var reg = /^(\d{1,2}|1\d\d|2[0-4]\d|25[0-5])\.(\d{1,2}|1\d\d|2[0-4]\d|25[0-5])\.(\d{1,2}|1\d\d|2[0-4]\d|25[0-5])\.(\d{1,2}|1\d\d|2[0-4]\d|25[0-5])$/;
                    if(reg.test(value)==false){
                        return 'IP格式不对'
                    }
                }
            });
            form.on('select(game)',function (data) {
                var v = data.value;
                if (v != "" && v != 1 && v != 2){
                    $("#open").show();
                }else{
                    $("#open").hide();
                }
            });
            form.on('submit(formDemo)', function(data) {
                var id = $("input[name='id']").val();
                if(id==0){
                    $.ajax({
                        url:"{{url('/admin/desk')}}",
                        data:$('form').serialize(),
                        type:'post',
                        dataType:'json',
                        success:function(res){
                            if(res.status == 1){
                                layer.msg(res.msg,{icon:6});
                                var index = parent.layer.getFrameIndex(window.name);
                                setTimeout('parent.layer.close('+index+')',2000);
                                //parent.layer.close(index);
                            }else{
                                layer.msg(res.msg,{shift: 6,icon:5});
                            }
                        },
                        error : function(XMLHttpRequest, textStatus, errorThrown) {
                            layer.msg('网络失败', {time: 1000});
                        }
                    });
                }else{
                    $.ajax({
                        url:"{{url('/admin/deskUpdate')}}",
                        data:$('form').serialize(),
                        type:'post',
                        dataType:'json',
                        success:function(res){
                            if(res.status == 1){
                                layer.msg(res.msg,{icon:6});
                                var index = parent.layer.getFrameIndex(window.name);
                                setTimeout('parent.layer.close('+index+')',2000);
                                //parent.layer.close(index);
                            }else{
                                layer.msg(res.msg,{shift: 6,icon:5});
                            }
                        },
                        error : function(XMLHttpRequest, textStatus, errorThrown) {
                            layer.msg('网络失败', {time: 1000});
                        }
                    });
                }
                return false;
            });
        });
    </script>
@endsection
@extends('common.edit')
