<?php


namespace App\Http\Controllers\Admin;


use App\Http\Controllers\Controller;
use App\Http\Requests\StoreRequest;
use App\Models\Game;
use App\Models\GameLabel;
use Illuminate\Http\Request;

class GameLabelController extends Controller
{
    /**
     * 数据列表
     */
    public function index(Request $request)
    {
        $map = array();
        $data = GameLabel::where($map)->paginate(10)->appends($request->all());
        foreach ($data as $key=>$value){
            $data[$key]['game']=$this->getGameInfoByGameId($data[$key]['game_type']);
            $data[$key]['creatime'] = date("Y-m-d H:i:s",$value['creatime']);
        }
        return view('label.list',['list'=>$data,'input'=>$request->all()]);
    }

    /**
     * 通过游戏类型id获取到游戏名称
     */
    public function getGameInfoByGameId($id)
    {
        return $id?Game::find($id):[];
    }

    /**
     * 编辑页
     */
    public function edit($id=0)
    {
        $gameType = Game::where('type','=','1')->get();
        $data = $id?GameLabel::find($id):[];
        return view('label.edit',['info'=>$data,'id'=>$id,'gameType'=>$gameType]);
    }

    /**
     * 保存
     */
    public function store(StoreRequest $request)
    {
        $id = $request->input('id');
        $data = $request->all();
        unset($data['_token']);
        unset($data['id']);
        $data["creatime"]=time();
        $count = GameLabel::insert($data);
        if ($count){
            return ['msg'=>'操作成功','status'=>1];
        }else{
            return ['msg'=>'操作失败','status'=>0];
        }
    }
}