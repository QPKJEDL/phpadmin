<?php


namespace App\Http\Controllers\Admin;


use App\Http\Controllers\Controller;
use App\Http\Requests\StoreRequest;
use App\Models\UserAccount;
use App\Models\Agent\Agent;
use Illuminate\Http\Request;

class UserAccountController extends Controller
{
    /**
     * 数据列表
     */
    public function index(Request $request){

        $map = array();
        $sql=UserAccount::query();

        if(true==$request->has('account')){
            $map['user.account']=$request->input('account');

        }
        $map["user.is_online"]=1;
        //获取全部用户数据
        $data = $sql->leftJoin('agent_users','user.agent_id','=','agent_users.id')
                    ->leftJoin('desk','user.desk_id','=','desk.id')
                    ->select('user.*','agent_users.id','agent_users.nickname','desk.id','desk.desk_name')
                    ->where($map)->paginate(10)->appends($request->all());
        foreach ($data as $key=>$value){
            $data[$key]['savetime'] = date("Y-m-d H:i:s",$value['savetime']);
            $data[$key]['server_ip']=$_SERVER['SERVER_ADDR'];
            $data[$key]['logaddr']=$this->iptoaddr($value['last_ip']);
            $data[$key]['par_agent_nickname']=$value['nickname'];
            $dir_agent=$this->get_direct_agent($value['agent_id']);
            $data[$key]['dir_agent_id']=$dir_agent['id'];
            $data[$key]['dir_agent_nickname']=$dir_agent['nickname'];


        }
        return view('userAccount.list',['list'=>$data,'input'=>$request->all()]);
    }


    /**
     * 踢下线
     */
    public function offline(StoreRequest $request){

        //获取userId
        $userId = $request->input("userId");


    }
    /*
     * ip获取登录地址
     */
    private function iptoaddr($ip){
        $url = "http://whois.pconline.com.cn/ipJson.jsp?ip=".$ip."'&json=true";
        $result = file_get_contents($url);
        $result = iconv('gb2312','utf-8//IGNORE',$result);
        $result = json_decode($result,true);
        return $result['addr'];
    }
    /*
     * 递归查询直属一级
     */
    private function get_direct_agent($agent_id){
        $agentlist=Agent::select('id','nickname','parent_id')->get()->toArray();
        foreach ($agentlist as $key=>&$value){
            if ($value['id']==$agent_id){
                if($agentlist[$key]["parent_id"]>0){
                    return $this->get_direct_agent($agentlist[$key]["parent_id"]);
                }
                return $agentlist[$key];
                continue;
            }
        }
    }

}