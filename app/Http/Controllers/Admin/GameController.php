<?php


namespace App\Http\Controllers\Admin;


use App\Http\Controllers\Controller;
use App\Http\Requests\StoreRequest;
use App\Models\Game;
use Illuminate\Http\Request;

class GameController extends Controller
{
    /**
     * 数据列表
     */
    public function index(Request $request)
    {
        $map = array();
        $data = Game::where($map)->paginate(10)->appends($request->all());
        foreach ($data as $key=>$value){
            $data[$key]['creatime'] = date("Y-m-d H:i:s",$value['creatime']);
            $data[$key]['savetime'] = date("Y-m-d H:i:s",$value['savetime']);
        }
        return view("game.list",['list'=>$data,'input'=>$request->all()]);
    }


    /**
     * 编辑页
     */
    public function edit($id=0)
    {
        $info = $id?Game::find($id):[];
        $info['fee']=json_decode($info['fee'],true);
        return view("game.edit",['id'=>$id,'info'=>$info]);
    }

    /**
     * 保存数据
     */
    public function store(StoreRequest $request)
    {
        $data = $request->all();
        unset($data['_token']);
        $data["creatime"]=time();
        $count = Game::insert($data);
        if($count){
            return ['msg'=>"保存成功！","status"=>1];
        }else{
            return ['msg'=>"保存失败！",'status'=>0];
        }
    }

    public function update(StoreRequest $request)
    {
        $id = $request->input("id");
        $data = $request->all();
        unset($data['_token']);
        unset($data['id']);
        if($id==1){
            $bjl['player'] = (int)$data['fee']['player'];
            $bjl['playerPair']=(int)$data['fee']['playerPair'];
            $bjl['tie']=(int)$data['fee']['tie'];
            $bjl['banker']=(int)$data['fee']['banker'];
            $bjl['bankerPair']=(int)$data['fee']['bankerPair'];
            $data['fee'] = json_encode($bjl);
        }elseif ($id==2){
            $lh['dragon'] = (int)$data['fee']['dragon'];
            $lh['tiger']=(int)$data['fee']['tiger'];
            $lh['tie']=(int)$data['fee']['tie'];
            $data['fee'] = json_encode($lh);
        }elseif ($id==3){
            $nn['SuperDouble'] = (int)$data['fee']['SuperDouble'];
            $nn['Double'] = (int)$data['fee']['Double'];
            $nn['Equal'] = (int)$data['fee']['Equal'];
            $data['fee']=json_encode($nn);
        }
        $data["savetime"]=time();
        $count = Game::where('id',$id)->update($data);
        if($count){
            return ["msg"=>"更新成功！","status"=>1];
        }else{
            return ['msg'=>"更新失败！"];
        }
    }

    /**
     * 删除
     */
    public function destroy($id)
    {
        $count = Game::where('id','=',$id)->delete();
        if ($count){
            return ["msg"=>"操作成功！",'status'=>1];
        }else{
            return ["msg"=>"操作失败！",'status'=>0];
        }
    }
}