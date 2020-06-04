<?php
namespace App\Http\Controllers\Admin\Agent;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreRequest;
use App\Models\Agent\Agent;
use App\Models\Agent\AgentRole;
use App\Models\Agent\AgentRoleUser;
use App\Models\UserAccount;
use Illuminate\Http\Request;

class AgentUserController extends Controller
{
    /**
     * 列表
     */
    public function index(Request $request){
        $list=Agent::where('del_flag',0)->with('agentRoles')->get()->toArray();
        return view('agent.list',['list'=>$list]);
    }

    /**
     * 编辑页
     */
    public function edit($id=0){
        $data = $id?Agent::find($id):[];
        $info = AgentRoleUser::where('user_id','=',$id)->first();
        if($id!=0){
            $data['fee']=json_decode($data['fee'],true);
            $data['limit']=json_decode($data['limit'],true);
            $data['bjlbets_fee']=json_decode($data['bjlbets_fee'],true);
            $data['lhbets_fee']=json_decode($data['lhbets_fee'],true);
            $data['nnbets_fee']=json_decode($data['nnbets_fee'],true);
            $data['a89bets_fee']=json_decode($data['a89bets_fee'],true);
            $data['sgbets_fee']=json_decode($data['sgbets_fee'],true);
        }
        return view('agent.edit',['id'=>$id,'roles'=>AgentRole::all(),'info'=>$data,'userRole'=>$info]);
    }

    public function store(StoreRequest $request)
    {
        $data = $request->all();
        $roleId = $request->input('user_role');
        unset($data['id']);
        unset($data['_token']);
        unset($data['user_role']);
        //判断两次密码是否相同
        if($data['pwd']!=$data['pwd_confirmation']){
            return ['msg'=>'两次密码不同','status'=>0];
        }
        //密码加密
        $data['password']=bcrypt($data['pwd']);
        unset($data['pwd']);
        unset($data['pwd_confirmation']);
        $data['created_at']=date('Y-m-d H:i:s',time());
        $data['fee']=json_encode($data['fee']);
        $data['limit']=json_encode($data['limit']);
        $data['bjlbets_fee']=json_encode($data['bjlbets_fee']);
        $data['lhbets_fee']=json_encode($data['lhbets_fee']);
        $data['nnbets_fee']=json_encode($data['nnbets_fee']);
        $data['a89bets_fee']=json_encode($data['a89bets_fee']);
        $data['sgbets_fee']=json_encode($data['sgbets_fee']);

        $count = Agent::insertGetId($data);
        if ($count){
            $this->insertUserRole($count,$roleId);
            return ['msg'=>'操作成功','status'=>1];
        }else{
            return ['msg'=>'操作失败','status'=>0];
        }

    }
    /*
     * 编辑s
     */
    public function update(StoreRequest $request){
        $id = $request->input('id');
        $data = $request->all();
        $roleId = $request->input('user_role');
        unset($data['_token']);
        unset($data['id']);
        unset($data['user_role']);
        if(empty($data["pwd"])){
            unset($data['pwd']);
            unset($data['pwd_confirmation']);
        }
        $data['fee']=json_encode($data['fee']);
        $data['limit']=json_encode($data['limit']);
        $data['bjlbets_fee']=json_encode($data['bjlbets_fee']);
        $data['lhbets_fee']=json_encode($data['lhbets_fee']);
        $data['nnbets_fee']=json_encode($data['nnbets_fee']);
        $data['a89bets_fee']=json_encode($data['a89bets_fee']);
        $data['sgbets_fee']=json_encode($data['sgbets_fee']);
        $up=Agent::where('id',$id)->update($data);
        if($up!==false){
            AgentRoleUser::where('user_id',$id)->update(array('role_id'=>$roleId));
            return ['msg'=>'修改成功','status'=>1];
        }else{
            return ['msg'=>'修改失败','status'=>0];
        }
    }

    /**
     * 删除
     */
    public function destroy($id){
        $agent = Agent::where('id','=',$id)->update(array("del_flag"=>1));
        if($agent){
            UserAccount::where('agent_id',$id)->update(array("del_flag"=>1));
            return ['msg'=>'删除成功','status'=>1];
        }else{
            return ['msg'=>'删除失败','status'=>0];
        }
    }
    /*
     * 停用
     */
    public function stop(StoreRequest $request){
        $id=$request->input('id');
        $stop = Agent::where('id','=',$id)->update(array("status"=>1));
        if($stop){
            return ['msg'=>'停用成功','status'=>1];
        }else{
            return ['msg'=>'停用失败','status'=>0];
        }
    }
    /*
    * 添加代理
    */
    public function insertUserRole($agentId,$roleId){
        $data['user_id']=$agentId;
        $data['role_id']=$roleId;
        AgentRoleUser::insert($data);
    }
}