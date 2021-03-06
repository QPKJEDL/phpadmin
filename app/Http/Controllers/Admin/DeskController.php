<?php


namespace App\Http\Controllers\Admin;


use App\Http\Controllers\Controller;
use App\Http\Requests\StoreRequest;
use App\Models\Desk;
use App\Models\Game;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redis;
class DeskController extends Controller
{
    /**
     *数据列表
     **/
    public function index(Request $request)
    {
        //->orderBy('creatime','desc')
        $map = array();
        if($request->input('game_id')!='' || $request->input('game_id')!=null){
            $map['game_id']=$request->input('game_id');
        }
        if($request->input('is_alive')!='' || $request->input('is_alive')!=null){
            $map['is_alive']=$request->input('is_alive');
        }
        if($request->input('is_push') != '' || $request->input('is_push')!=null){
            $map['is_push']=$request->input('is_push');
        }
        $map['status']=0;
        //获取全部台桌数据
        $data = Desk::where($map)->paginate(10)->appends($request->all());
        foreach ($data as $key=>$value){
            $data[$key]['min_limit'] = json_decode($data[$key]['min_limit'],true);
            $data[$key]['min_tie_limit'] = json_decode($data[$key]['min_tie_limit'],true);
            $data[$key]['min_pair_limit']= json_decode($data[$key]['min_pair_limit'],true);
            $data[$key]['max_limit']=json_decode($data[$key]['max_limit'],true);
            $data[$key]['max_tie_limit']=json_decode($data[$key]['max_tie_limit'],true);
            $data[$key]['max_pair_limit']=json_decode($data[$key]['max_pair_limit'],true);
            $data[$key]['creatime'] = date("Y-m-d H:i:s",$value['creatime']);
        }
        //获取全部的游戏
        $gameType = Game::where('type','=',1)->get()->toArray();
        return view("desk.list",['list'=>$data,'input'=>$request->all(),'gameType'=>$gameType]);
    }

    /**
     * 编辑页
     */
    public function edit($id=0)
    {
        //获取全部的游戏
        $gameType = Game::where('type','=','1')->get();
        $info = $id?Desk::find($id):[];
        if($id==0){
            return view('desk.edit',['id'=>$id,'info'=>$info,'gameType'=>$gameType]);
        }else{
            $minLimit=json_decode($info['min_limit'],true);
            $minTieLimit=json_decode($info['min_tie_limit'],true);
            $minPairLimit=json_decode($info['min_pair_limit'],true);
            $maxLimit = json_decode($info['max_limit'],true);
            $maxTieLimit = json_decode($info['max_tie_limit'],true);
            $maxPairLimit = json_decode($info['max_pair_limit'],true);

            $minLimit["c"]=(int)$minLimit["c"]/100;
            $minLimit['cu']=(int)$minLimit["cu"]/100;
            $minLimit['p']=(int)$minLimit['p']/100;
            $minLimit['pu']=(int)$minLimit['pu']/100;

            $minTieLimit["c"]=(int)$minTieLimit["c"]/100;
            $minTieLimit['cu']=(int)$minTieLimit["cu"]/100;
            $minTieLimit['p']=(int)$minTieLimit['p']/100;
            $minTieLimit['pu']=(int)$minTieLimit['pu']/100;

            $minPairLimit["c"]=(int)$minPairLimit["c"]/100;
            $minPairLimit['cu']=(int)$minPairLimit["cu"]/100;
            $minPairLimit['p']=(int)$minPairLimit['p']/100;
            $minPairLimit['pu']=(int)$minPairLimit['pu']/100;

            $maxLimit["c"]=(int)$maxLimit["c"]/100;
            $maxLimit['cu']=(int)$maxLimit["cu"]/100;
            $maxLimit['p']=(int)$maxLimit['p']/100;
            $maxLimit['pu']=(int)$maxLimit['pu']/100;

            $maxTieLimit["c"]=(int)$maxTieLimit["c"]/100;
            $maxTieLimit['cu']=(int)$maxTieLimit["cu"]/100;
            $maxTieLimit['p']=(int)$maxTieLimit['p']/100;
            $maxTieLimit['pu']=(int)$maxTieLimit['pu']/100;

            $maxPairLimit["c"]=(int)$maxPairLimit["c"]/100;
            $maxPairLimit['cu']=(int)$maxPairLimit["cu"]/100;
            $maxPairLimit['p']=(int)$maxPairLimit['p']/100;
            $maxPairLimit['pu']=(int)$maxPairLimit['pu']/100;

            return view("desk.edit",['id'=>$id,'info'=>$info,'gameType'=>$gameType,"minLimit"=>$minLimit,'minTieLimit'=>$minTieLimit,'minPairLimit'=>$minPairLimit,'maxLimit'=>$maxLimit,'maxTieLimit'=>$maxTieLimit,'maxPairLimit'=>$maxPairLimit]);
        }
    }

    /**
     * 保存添加数据
     */
    public function store(StoreRequest $request)
    {
        $data = $request->all();
        unset($data['_token']);
        //通过game_id获取到game_name
        $gameInfo = $data['game_id']?Game::find($data['game_id']):[];
        $data['game_name']=$gameInfo['game_name'];
        //把数据过滤  防止出现问题
        $min_limit["c"]=(int)$data["min_limit"]["c"]*100;
        $min_limit['cu']=(int)$data['min_limit']['cu']*100;
        $min_limit['p']=(int)$data["min_limit"]["p"]*100;
        $min_limit['pu']=(int)$data['min_limit']['pu']*100;
        $min_tie_limit['c']=(int)$data['min_tie_limit']['c']*100;
        $min_tie_limit['cu']=(int)$data['min_tie_limit']['cu']*100;
        $min_tie_limit['p']=(int)$data['min_tie_limit']['p']*100;
        $min_tie_limit['pu']=(int)$data['min_tie_limit']['pu']*100;
        $min_pair_limit['c']=(int)$data['min_pair_limit']['c']*100;
        $min_pair_limit['cu']=(int)$data['min_pair_limit']['cu']*100;
        $min_pair_limit['p']=(int)$data['min_pair_limit']['p']*100;
        $min_pair_limit['pu']=(int)$data['min_pair_limit']['pu']*100;
        $max_limit['c']=(int)$data['max_limit']['c']*100;
        $max_limit['cu']=(int)$data['max_limit']['cu']*100;
        $max_limit['p']=(int)$data['max_limit']['p']*100;
        $max_limit['pu']=(int)$data['max_limit']['pu']*100;
        $max_tie_limit['c']=(int)$data['max_tie_limit']['c']*100;
        $max_tie_limit['cu']=(int)$data['max_tie_limit']['cu']*100;
        $max_tie_limit['p']=(int)$data['max_tie_limit']['p']*100;
        $max_tie_limit['pu']=(int)$data['max_tie_limit']['pu']*100;
        $max_pair_limit['c']=(int)$data['max_pair_limit']['c']*100;
        $max_pair_limit['cu']=(int)$data['max_pair_limit']['cu']*100;
        $max_pair_limit['p']=(int)$data['max_pair_limit']['p']*100;
        $max_pair_limit['pu']=(int)$data['max_pair_limit']['pu']*100;
        $data['min_limit']=json_encode($min_limit);
        $data['min_tie_limit']=json_encode($min_tie_limit);
        $data['min_pair_limit']=json_encode($min_pair_limit);
        $data['max_limit']=json_encode($max_limit);
        $data['max_tie_limit']=json_encode($max_tie_limit);
        $data['max_pair_limit']=json_encode($max_pair_limit);
        $count = Desk::insertGetId($data);
        if ($count){
            $deskData["DeskId"]=(int)$count;
            $deskData["Phase"]=(int)0;
            $deskData["BootNum"]=(int)1;
            $deskData["GameId"]=(int)$data["game_id"];
            $deskData["PaveNum"]=(int)0;
            $deskData["BootSn"]=date("YmdHis").$count."1";
            $deskData["DeskName"]=$this->getDeskName($count);
            $deskData["GameName"]=$this->getGameName($data["game_id"]);
            $deskData["CountDown"]=(int)$data["count_down"];
            $deskData["WaitDown"]=(int)$data["wait_down"];
            $deskData["MinLimit"]=$min_limit["c"]/100;
            $deskData["MaxLimit"]=$max_limit["c"]/100;
            $deskData["TieMinLimit"]=$min_tie_limit["c"]/100;
            $deskData["TieMaxLimit"]=$max_tie_limit["c"]/100;
            $deskData["PairMinLimit"]=$min_pair_limit["c"]/100;
            $deskData["PairMaxLimit"]=$max_pair_limit["c"]/100;
            $deskData["PairMaxLimit"]=$max_pair_limit["c"]/100;
            $deskData["LeftPlay"]=$data["left_play"];
            $deskData["RightPlay"]=$data["right_play"];
            Redis::set("desk_info_".$count,json_encode($deskData));
           return ["msg"=>"保存成功！","status"=>1];
        }else{
            return ["msg"=>"操作失败！","status"=>0];
        }
    }

    /**
     * 更新数据
     */
    public function update(StoreRequest $request)
    {
        $id = $request->input('id');
        $data = $request->all();
        unset($data['_token']);
        unset($data['id']);
        $gameInfo = $data['game_id']?Game::find($data['game_id']):[];
        $data['game_name']=$gameInfo['game_name'];
        $min_limit["c"]=(int)$data["min_limit"]["c"]*100;
        $min_limit['cu']=(int)$data['min_limit']['cu']*100;
        $min_limit['p']=(int)$data["min_limit"]["p"]*100;
        $min_limit['pu']=(int)$data['min_limit']['pu']*100;
        $min_tie_limit['c']=(int)$data['min_tie_limit']['c']*100;
        $min_tie_limit['cu']=(int)$data['min_tie_limit']['cu']*100;
        $min_tie_limit['p']=(int)$data['min_tie_limit']['p']*100;
        $min_tie_limit['pu']=(int)$data['min_tie_limit']['pu']*100;
        $min_pair_limit['c']=(int)$data['min_pair_limit']['c']*100;
        $min_pair_limit['cu']=(int)$data['min_pair_limit']['cu']*100;
        $min_pair_limit['p']=(int)$data['min_pair_limit']['p']*100;
        $min_pair_limit['pu']=(int)$data['min_pair_limit']['pu']*100;
        $max_limit['c']=(int)$data['max_limit']['c']*100;
        $max_limit['cu']=(int)$data['max_limit']['cu']*100;
        $max_limit['p']=(int)$data['max_limit']['p']*100;
        $max_limit['pu']=(int)$data['max_limit']['pu']*100;
        $max_tie_limit['c']=(int)$data['max_tie_limit']['c']*100;
        $max_tie_limit['cu']=(int)$data['max_tie_limit']['cu']*100;
        $max_tie_limit['p']=(int)$data['max_tie_limit']['p']*100;
        $max_tie_limit['pu']=(int)$data['max_tie_limit']['pu']*100;
        $max_pair_limit['c']=(int)$data['max_pair_limit']['c']*100;
        $max_pair_limit['cu']=(int)$data['max_pair_limit']['cu']*100;
        $max_pair_limit['p']=(int)$data['max_pair_limit']['p']*100;
        $max_pair_limit['pu']=(int)$data['max_pair_limit']['pu']*100;
        $data['min_limit']=json_encode($min_limit);
        $data['min_tie_limit']=json_encode($min_tie_limit);
        $data['min_pair_limit']=json_encode($min_pair_limit);
        $data['max_limit']=json_encode($max_limit);
        $data['max_tie_limit']=json_encode($max_tie_limit);
        $data['max_pair_limit']=json_encode($max_pair_limit);
        $update = Desk::where('id',$id)->update($data);

        if($update!==false){
            //$deskInfo = $id?Desk::find($id):[];
            $desk=Redis::get("desk_info_".$id);

            if($desk){
                $deskData=json_decode($desk,true);
                $deskData["CountDown"]=(int)$data["count_down"];
                $deskData["WaitDown"]=(int)$data["wait_down"];
                $deskData["MinLimit"]=$min_limit["c"]/100;
                $deskData["MaxLimit"]=$max_limit["c"]/100;
                $deskData["TieMinLimit"]=$min_tie_limit["c"]/100;
                $deskData["TieMaxLimit"]=$max_tie_limit["c"]/100;
                $deskData["PairMinLimit"]=$min_pair_limit["c"]/100;
                $deskData["PairMaxLimit"]=$max_pair_limit["c"]/100;
                $deskData["PairMaxLimit"]=$max_pair_limit["c"]/100;
                $deskData["LeftPlay"]=$data["left_play"];
                $deskData["RightPlay"]=$data["right_play"];
                Redis::set("desk_info_".$id,json_encode($deskData));
                insertDeskLogOperaType($id,'修改了台桌信息');
                return ['msg'=>'修改成功！','status'=>1];
            }else{
                $deskData["DeskId"]=(int)$id;
                $deskData["Phase"]=(int)0;
                $deskData["BootNum"]=(int)1;
                $deskData["GameId"]=(int)$data["game_id"];
                $deskData["PaveNum"]=(int)0;
                $deskData["BootSn"]=date("YmdHis").$id."1";
                $deskData["DeskName"]=$this->getDeskName($id);
                $deskData["GameName"]=$this->getGameName($data["game_id"]);
                $deskData["CountDown"]=(int)$data["count_down"];
                $deskData["WaitDown"]=(int)$data["wait_down"];
                $deskData["MinLimit"]=$min_limit["c"]/100;
                $deskData["MaxLimit"]=$max_limit["c"]/100;
                $deskData["TieMinLimit"]=$min_tie_limit["c"]/100;
                $deskData["TieMaxLimit"]=$max_tie_limit["c"]/100;
                $deskData["PairMinLimit"]=$min_pair_limit["c"]/100;
                $deskData["PairMaxLimit"]=$max_pair_limit["c"]/100;
                $deskData["PairMaxLimit"]=$max_pair_limit["c"]/100;
                $deskData["LeftPlay"]=$data["left_play"];
                $deskData["RightPlay"]=$data["right_play"];
                Redis::set("desk_info_".$id,json_encode($deskData));
                insertDeskLogOperaType($id,'修改了台桌信息');
                return ['msg'=>'修改成功！','status'=>1];
            }

        }else{
            return ['msg'=>"修改失败！",'status'=>0];
        }
    }
    //getDeskName
    private function getDeskName($id){
        return Desk::where("id",$id)->value("desk_name");
    }



    //gameID->gameName
    private function getGameName($gameId){

        switch ($gameId){
            case 1:
                return (string)"百家乐";
            case 2:
                return (string)"龙虎";
            case 3:
                return (string)"牛牛";
            case 4:
                return (string)"三公";
            case 5:
                return (string)"A89";
            default:
                return "";
        }
    }


    /**
     * 停用
     */
    public function changStatus(StoreRequest $request)
    {
        $id = $request->input('id');
        $status = $request->input('status');
        $count = Desk::where('id',$id)->update(['status'=>$status]);
        if($count){
            return ['msg'=>"操作成功！",'status'=>1];
        }else{
            return ['msg'=>'操作失败！','status'=>0];
        }
    }

    /**
     * 关视频
     */
    public function closeVideo(StoreRequest $request){
        $id = $request->input('id');
        $videoStatus = $request->input('video_status');
        return ['msg'=>'操作成功！','status'=>1];
    }

    /**
     * 删除
     */
    public function destroy($id)
    {
        $count = Desk::where("id",'=',$id)->delete();
        if ($count){
            return ["msg"=>"操作成功！",'status'=>1];
        }else{
            return ["msg"=>"操作失败！",'status'=>0];
        }
    }

    /**
     * 重置密码
     * @param StoreRequest $request
     * @return array
     */
    public function resetPassword(StoreRequest $request)
    {
        $id = $request->input('id');
        $password = $request->input('password');
        $count = Desk::where('id',$id)->update(['password'=>md5($password)]);
        if ($count){
            insertDeskLogOperaType($id,'修改了台桌登录密码');
            return ["msg"=>"操作成功","status"=>1];
        }else{
            return ["msg"=>"操作失败",'status'=>0];
        }
    }
}