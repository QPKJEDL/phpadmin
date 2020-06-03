@section('title', '配置编辑')
@section('content')
    <style>
        .mySelect{
            position: relative;
        }
        .mySelect .inputWrap{
            width:100%;
            min-height: 40px;
            border: 1px solid #ccc;
            border-radius: 3px;
            position: relative;
            cursor: pointer;
        }
        .mySelect ul{
            padding:0 5px ;
            margin: 0;
            padding-right: 35px;
        }
        .mySelect ul,li{
            list-style: none;
        }
        .mySelect li{
            display: inline-block;
            background: #eaeaea;
            padding: 5px;
            margin: 5px 5px 5px 0;
            border-radius: 5px;
        }
        .mySelect .fa-close{
            cursor: pointer;
        }
        .mySelect .fa-close:hover{
            color: #237eff;
        }
        .mySelect .mySelect-option{
            width: 100%;
            border: 1px solid #ccc;
            max-height: 200px;
            overflow-y: scroll;
            position: absolute;
            height: 0;
            opacity: 0;
        }
        .mySelect .mySelect-option div{
            padding: 10px;
        }
        .mySelect .inputWrap>i{
            position: absolute;
            padding: 13px;
            right: 0;
            top: 0;
        }
        .mySelect-option div{
            cursor: pointer;
            border-bottom: 1px solid #e7e7e7;
            margin: 5px;
        }
        .mySelect-option div i{
            float: right;
            color: #ffffff;
        }
        .mySelect-option div.selected{
            background: #237eff;
            color: #ffffff;
            border-radius: 5px;
        }
        .mySelect-option div:hover{
            /*background: #9ec6ff;*/
            color: #9ec6ff;
            border-bottom: 1px solid #9ec6ff;
        }
    </style>
    <div class="layui-form-item">
        <label class="layui-form-label">用户：</label>
        <div class="layui-input-inline">
            <select name="user_id" lay-search="" disabled>
                <option value="">直接搜索或请选择用户</option>
                @foreach($userData as $user)
                    <option value="{{$user['user_id']}}" {{isset($info['user_id'])&&$info['user_id']==$user['user_id']?'selected':''}}>{{$user['nickname']}}</option>
                @endforeach
            </select>
        </div>
    </div>

    @if($info!=null)
        <div class="layui-form-item">
            <label class="layui-form-label">台桌：</label>
            <div class="layui-input-inline">
                <select name="desk_id" lay-verify="required" lay-search="" disabled>
                    <option value="">直接选择或搜索选择</option>
                    @foreach($deskData as $desk)
                        <option value="{{$desk['value']}}" {{isset($info['desk_id'])&&$info['desk_id']==$desk['value']?'selected':''}}>{{$desk['label']}}</option>
                    @endforeach
                </select>
            </div>
        </div>
    @else
        <div class="layui-form-item">
            <label class="layui-form-label">台桌：</label>
            <div class="layui-input-block">
                <div id="mySelect" class="mySelect" style="width: 250px;float: left"></div>
            </div>
            <div class="layui-form-mid layui-word-aux">请点击下拉</div>
        </div>
        &nbsp;<br/>
        &nbsp;<br/>&nbsp;<br/>&nbsp;<br/>&nbsp;<br/>&nbsp;<br/>&nbsp;<br/>&nbsp;<br/>&nbsp;<br/>&nbsp;<br/>&nbsp;<br/>&nbsp;<br/>&nbsp;<br/>
    @endif

    <div class="layui-form-item">
        <div class="layui-inline">
            <label class="layui-form-label">最小限红</label>
            <div class="layui-input-inline" style="width: 100px;">
                <input type="number" name="limit[min]" lay-verify="minLimit" value="{{$info['limit']['min'] or ''}}" placeholder="￥" autocomplete="off" class="layui-input">
            </div>
            <div class="layui-form-mid">最大限红</div>
            <div class="layui-input-inline" style="width: 100px;">
                <input type="number" name="limit[max]" lay-verify="maxLimit" value="{{$info['limit']['max'] or ''}}" placeholder="￥" autocomplete="off" class="layui-input">
            </div>
        </div>
    </div>
    <div class="layui-form-item">
        <div class="layui-inline">
            <label class="layui-form-label">最小和限红</label>
            <div class="layui-input-inline" style="width: 100px;">
                <input type="number" name="pair_limit[min]" lay-verify="minPairLimit" value="{{$info['pair_limit']['min'] or ''}}"  placeholder="￥" autocomplete="off" class="layui-input">
            </div>
            <div class="layui-form-mid">最大和限红</div>
            <div class="layui-input-inline" style="width: 100px;">
                <input type="number" name="pair_limit[max]" lay-verify="maxPairLimit" value="{{$info['pair_limit']['max'] or ''}}" placeholder="￥" autocomplete="off" class="layui-input">
            </div>
        </div>
    </div>
    <div class="layui-form-item">
        <div class="layui-inline">
            <label class="layui-form-label">最小对限红</label>
            <div class="layui-input-inline" style="width: 100px;">
                <input type="number" name="tie_limit[min]" lay-verify="minTieLimit" value="{{$info['tie_limit']['min'] or ''}}" placeholder="￥" autocomplete="off" class="layui-input">
            </div>
            <div class="layui-form-mid">最大对限红</div>
            <div class="layui-input-inline" style="width: 100px;">
                <input type="number" name="tie_limit[max]" lay-verify="maxTieLimit" value="{{$info['tie_limit']['max'] or ''}}" placeholder="￥" autocomplete="off" class="layui-input">
            </div>
        </div>
    </div>
@endsection
@section('id',$id)
@section('js')
    <script>
        var deskData= '<?php echo json_encode($deskData);?>';
        var data = JSON.parse(deskData);
        var mySelect = $("#mySelect").mySelect({
            mult: true, //true为多选,false为单选
            option:data,
            onChange: function(res) { //选择框值变化返回结果
                console.log(res)
            }
        });
        layui.use(['form','jquery','layer'], function() {
            var form = layui.form()
                ,layer = layui.layer
                ,$ = layui.jquery;
            form.render();
            form.verify({
                minLimit:function (value) {
                    if (value<20){
                        return '最小不能低于20';
                    }
                },
                maxLimit:function (value) {
                    var minLimit = $("input[name='limit[min]']").val();
                    if (value<minLimit){
                        return '不能小于最小限红';
                    }
                },
                minPairLimit:function (value) {
                    if (value<20){
                        return '最小不能低于20';
                    }
                },
                maxPairLimit:function (value) {
                    var minLimit = $("input[name='pair_limit[min]']").val();
                    if (value<minLimit){
                        return '不能小于最小限红';
                    }
                },
                minTieLimit:function (value) {
                    if (value<20){
                        return '最小不能低于20';
                    }
                },
                maxTieLimit:function (value) {
                    var minLimit = $("input[name='tie_limit[min]']").val();
                    if (value<minLimit){
                        return '不能小于最小限红';
                    }
                }
            });
            var id = $("input[name='id']").val();
            var index = parent.layer.getFrameIndex(window.name);
            if(id==0){
                form.on('submit(formDemo)', function(data) {
                    var select = JSON.stringify(mySelect.getResult());
                    var data = $('form').serializeArray();
                    data.push({"name":"deskIds","value":select});
                    $.ajax({
                        url:"{{url('/admin/userDesk')}}",
                        data:data,
                        type:'post',
                        dataType:'json',
                        success:function(res){
                            if(res.status == 1){
                                layer.msg(res.msg,{icon:6});
                                var index = parent.layer.getFrameIndex(window.name);
                                setTimeout('parent.layer.close('+index+')',2000);
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
            }else{
                form.on('submit(formDemo)', function(data) {
                    $.ajax({
                        url:"{{url('/admin/userDesk/update')}}",
                        data:$('form').serializeArray(),
                        type:'post',
                        dataType:'json',
                        success:function(res){
                            if(res.status == 1){
                                layer.msg(res.msg,{icon:6});
                                var index = parent.layer.getFrameIndex(window.name);
                                setTimeout('parent.layer.close('+index+')',2000);
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
            }
        });
    </script>
@endsection
@extends('common.edit')