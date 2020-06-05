<?php
namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreRequest;
use Illuminate\Http\Request;
use App\Models\AgentBlacklist;
use App\Models\Agent\Agent;
class AgentBlackController extends Controller
{
    /*
     * 列表
     */
    public function index(Request $request){
        $map = array();
        if (true==$request->has('agent_id')){
            $map['agent_id']=$request->input('agent_id');
        }
        $data = AgentBlacklist::where($map)->paginate(10)->appends($request->all());
        foreach ($data as $key=>$value){
            $data[$key]['start_date'] = date("Y-m-d",$value['start_date']);
            $data[$key]['end_date'] = date("Y-m-d",$value['end_date']);
            if ($data[$key]['update_time']!='' || $data[$key]['update_time']!=null){
                $data[$key]['update_time'] = date("Y-m-d H:i:s",$value['update_time']);
            }
        }
        return view('agentBlack.list',['list'=>$data,'input'=>$request->all()]);
    }

    /**
     * 添加/编辑页
     * @param int $id
     * @return Factory|View
     */
    public function edit($id=0)
    {
        $info = $id?AgentBlacklist::find($id):[];
        if ($id!=0){
            $info['start_date']=date('Y-m-d',$info['start_date']);
            $info['end_date']=date('Y-m-d',$info['end_date']);
        }
        return view('agentBlack.edit',['info'=>$info,'id'=>$id]);
    }
    /*
     * 添加
     */
    public function store(StoreRequest $request)
    {
        $data = $request->all();
        $agent_id=$data["agent_id"];
        $is=Agent::where("id",$agent_id)->first();
        if(!$is){
            return ['msg'=>'代理不存在！'];
        }
        $black=AgentBlacklist::where("agent_id",$agent_id)->exists();
        if($black){
            return ['msg'=>'该代理已封禁！'];
        }
        unset($data['_token']);
        $data['start_date']=strtotime($data['start_date']);
        $data['end_date']=strtotime($data['end_date']);
        $data['create_by']=getLoginUser();
        $count = AgentBlacklist::insert($data);
        if ($count){
            return ['msg'=>'添加封禁成功！','status'=>1];
        }else{
            return ['msg'=>'添加封禁失败！','status'=>0];
        }

    }
    /*
     * 编辑
     */
    public function update(StoreRequest $request)
    {
        $data = $request->all();
        $id = $data['id'];

        $agent_id=$data["agent_id"];
        $is=Agent::where("id",$agent_id)->first();
        if(!$is){
            return ['msg'=>'代理不存在！'];
        }
        $has=AgentBlacklist::where('agent_id',$agent_id)->where('id','<>',$id)->first();
        if ($has){
            return ['msg'=>'该IP已被封禁！'];
        }
        unset($data['_token']);
        unset($data['id']);
        $data['start_date']=strtotime($data['start_date']);
        $data['end_date']=strtotime($data['end_date']);
        $data['update_time']=time();
        $data['update_by']=getLoginUser();
        $count = AgentBlacklist::where('id',$id)->update($data);
        if ($count!==false){
            return ['msg'=>'编辑成功！','status'=>1];
        }else{
            return ['msg'=>'编辑失败！','status'=>0];
        }

    }
    /*
     * 删除
     */
    public function destroy($id)
    {
        $count = AgentBlacklist::where('id','=',$id)->delete();
        if ($count){
            return ['msg'=>'操作成功！','status'=>1];
        }else{
            return ['msg'=>'操作失败！','status'=>0];
        }
    }

}