<?php


namespace App\Http\Controllers\Admin\Agent;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreRequest;
use App\Models\Agent\Agent;
use App\Models\Agent\AgentRole;
use App\Models\Agent\AgentRoleUser;
use Illuminate\Http\Request;

/**
 * 线上代理列表
 * Class OnAgentUserController
 * @package App\Http\Controllers\Admin\Agent
 */
class OnAgentUserController extends Controller
{
    /**
     * 数据列表
     * @param Request $request
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\Foundation\Application|\Illuminate\View\View
     */
    public function index(Request $request)
    {
        $list=Agent::where('del_flag',0)->where('userType','=',2)->with('agentRoles')->get()->toArray();
        return view('onAgent.list',['list'=>$list]);
    }

    /**
     * 编辑页
     * @param int $id
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\Foundation\Application|\Illuminate\View\View
     */
    public function edit($id=0)
    {
        $info = $id?Agent::find($id):[];
        return view('onAgent.edit',['id'=>$id,'info'=>$info,'roles'=>AgentRole::all()]);
    }

    public function store(StoreRequest $request)
    {
        $roleId = $request->input('user_role');
        $data = $request->all();
        $newPwd = $data['pwd_confirmation'];
        $data['password']=$data['pwd'];
        unset($data['pwd']);
        unset($data['pwd_confirmation']);
        unset($data['_token']);
        unset($data['id']);
        unset($data['user_role']);
        if ($data['password']==$newPwd){
            $data['password']=bcrypt($data['password']);
            $data['userType']=2;
            $data["ancestors"]=0;
            $data['limit']=json_encode($data['limit']);
            $count = Agent::insertGetId($data);
            if ($count){
                $this->insertUserRole($count,$roleId);
                return ['msg'=>'操作成功','status'=>1];
            }else{
                return ['msg'=>'操作失败','status'=>0];
            }
        }else{
            return ['msg'=>'两次密码不一致','status'=>0];
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