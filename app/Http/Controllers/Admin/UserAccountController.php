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
        dump(233);
        die;

        $map = array();

        if(true==$request->has('account')){
            $map['account']=$request->input('account');

        }
        $map["is_online"]=1;
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
    private function get_agent_info($agent_id,$agentlist){
        foreach ($agentlist as $key=>$value){
            if ($value['id']==$agent_id){
                return $agentlist[$key];
                continue;
            }
        }
    }
    /*
     * 递归查询直属一级
     */
    private function get_direct_agent($agent_id){
        $agent_info=Agent::where('id',$agent_id)->select('id','nickname','parent_id')->first()->toArray();
        if($agent_info["parent_id"]>0){
            $this->get_direct_agent($agent_info["parent_id"]);
        }
        return $agent_info;
    }

    /*
     * 获取直属一级信息
     */
    private function get_direct_agent_info($agent_id){
        //$list=Agent::select('id','nickname','parent_id')->get()->toArray();
        $data=$this->get_direct_agent($agent_id);
        return $data;
    }

}