<?php


namespace App\Http\Controllers\Admin;


use App\Http\Controllers\Controller;
use App\Models\Desk;
use App\Models\DeskLog;
use Illuminate\Http\Request;

class DeskUpdateResultController extends Controller
{
    /**
     * 台桌结果日志
     */
    public function index(Request $request)
    {
        //条件
        $map = array();
        $map['desk_log.log_type']=2;
        if (true==$request->has('desk_id')){
            $map['desk_log.desk_id']=$request->input('desk_id');
        }
        if (true==$request->has('bootNum')){
            $map['desk_log.boot_num']=$request->input('bootNum');
        }
        if (true==$request->has('paveNum')){
            $map['desk_log.pave_num']=$request->input('paveNum');
        }
        if (true==$request->has('bootTime')){
            $time = strtotime($request->input('create_time'));
            $map['desk_log.boot_time']=$time;
        }
        $deskLog = DeskLog::query();
        $sql=$deskLog->leftJoin('desk','desk.id','=','desk_log.desk_id')
            ->leftJoin('game','desk.game_id','=','game.id')
            ->select('desk_log.*','desk.desk_name','desk.game_id','game.game_name')
            ->where($map);
        if (true==$request->has('create_time')){
            $time = strtotime($request->input('create_time'));
            $date=strtotime(date('Y-m-d',$time));
            $next=strtotime('+1day',$date)-1;
            $data = $sql->whereBetween('desk_log.create_time',[$date,$next])->orderBy('desk_log.create_time','desc')->paginate(10)->appends($request->all());
        }else{
            $data = $sql->orderBy('desk_log.create_time','desc')->paginate(10)->appends($request->all());
        }
        foreach ($data as $key=>$value)
        {
            if ($data[$key]['game_id']==1){//百家乐
                $data[$key]['result']=$this->getBaccaratParseJson($data[$key]['after_result']);
                $data[$key]['afterResult']=$this->getBaccaratParseJson($data[$key]['before_result']);
            }else if ($data[$key]['game_id']==2){//龙虎
                $data[$key]['result']=$this->getDragonTigerJson($data[$key]['after_result']);
                $data[$key]['afterResult']=$this->getDragonTigerJson($data[$key]['before_result']);
            }else if($data[$key]['game_id']==3){//牛牛
                $data[$key]['result']=$this->getFullParseJson($data[$key]['after_result']);
                $data[$key]['afterResult']=$this->getFullParseJson($data[$key]['before_result']);
            }else if($data[$key]['game_id']==4){

            }else{

            }
            $data[$key]['create_time'] = date("Y-m-d H:i:s",$value['create_time']);
            if ($data[$key]['boot_time']!=''||$data[$key]['boot_time']!=null){
                $data[$key]['boot_time'] = date("Y-m-d",$value['boot_time']);
            }
        }
        return view('deskResultLog.list',['list'=>$data,'input'=>$request->all(),'desk'=>Desk::get(),'min'=>config('admin.min_date')]);
    }

    /**
     * 解析百家乐的json数据
     * 根据游戏类型解析json数据
     * @param $jsonStr
     * @return array
     */
    public function getBaccaratParseJson($jsonStr)
    {
        $arr = array();
        //json格式数据
        //{"game":4,"playerPair":5,"bankerPair":2}
        $data=json_decode($jsonStr,true);
        if ($data['game']==1){
            $arr['game']="和";
        }else if($data['game']==4){
            $arr['game']="闲";
        }else{
            $arr['game']="庄";
        }
        if (empty($data['playerPair'])){
            $arr['playerPair']="";
        }else{
            $arr['playerPair']="闲对";
        }
        if (empty($data['bankerPair'])){
            $arr['bankerPair']="";
        }else{
            $arr['bankerPair']="庄对";
        }
        return $arr;
    }

    /**
     * 判断龙虎结果
     * @param $winner
     * @return string
     */
    public function getDragonTigerJson($winner)
    {
        if ($winner==7){
            $result = "龙";
        }else if($winner==4){
            $result = "虎";
        }else{
            $result = "和";
        }
        return $result;
    }

    /**
     * 解析牛牛的json数据
     * 根据游戏类型解析json数据
     * @param $jsonStr
     * @return array
     */
    public function getFullParseJson($jsonStr)
    {
        $arr = array();
        //解析json
        //{"bankernum":"牛1","x1num":"牛牛","x1result":"win","x2num":"牛2","x2result":"win","x3num":"牛3","x3result":"win"}
        $data = json_decode($jsonStr,true);
        //先判断庄是不是通吃
        if ($data['x1result']==""&&$data['x2result']==""&&$data['x3result']==""){
            $arr['bankernum']="庄";
        }else{
            $arr['bankernum']="";
        }
        if($data['x1result']=="win"){
            $arr['x1result']="闲1";
        }else{
            $arr['x1result']="";
        }
        if($data['x2result']=="win"){
            $arr['x2result']="闲2";
        }else{
            $arr['x2result']="";
        }
        if($data['x3result']=="win"){
            $arr['x3result']="闲3";
        }else{
            $arr['x4result']="";
        }
        return $arr;
    }
}