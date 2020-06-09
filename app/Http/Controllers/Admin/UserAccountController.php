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
        if($request->input('user_account')!='' || $request->input('user_account')!=null){
            $map['user_account']=$request->input('user_account');
        }

        $map["is_online"]=1;

        $agent_id=$request->input('user_account');
        $data=$this->direct_agent($agent_id);
        dump($data);

        //获取全部用户数据
        $data = UserAccount::where($map)->paginate(10)->appends($request->all());
        foreach ($data as $key=>$value){
            $data[$key]['savetime'] = date("Y-m-d H:i:s",$value['savetime']);
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
     * 直属上级
     */
    private function par_agent($agent_id){
        return Agent::where('id',$agent_id)->value('nickname');
    }

    /*
     * 代理数据
     */
    private function agentinfo($agent_id){
        $agentlist=Agent::select('id','nickname','parent_id')->get()->toArray();
        foreach ($agentlist as $key=>&$value){
            if ($agent_id==$value['id']){
                return $agentlist[$key];
                continue;
            }
        }
    }
    /*
     * 获取直属一级
     */
    private function direct_agent($agent_id){
        $agent_info=$this->agentinfo($agent_id);
        if($agent_info["parent_id"]==0){
            return $agent_info;
        }else{
            return $this->direct_agent($agent_info["id"]);
        }
    }


}