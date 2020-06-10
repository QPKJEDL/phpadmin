<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2020-6-10
 * Time: 14:00
 */
namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;
use App\Models\AgentLoginLog;
use Illuminate\Http\Request;
Class AgentLoginLogController extends Controller{
    /**
     * 数据列表
     */
    public function index(Request $request){


        $sql=AgentLoginLog::query();

        if(true==$request->has('username')){
            $sql->where('agent_users.username','=',$request->input('username'));
        }

        if(true==$request->has('log_ip')){
            $sql->where('agent_logs.log_ip','=',$request->input('log_ip'));
        }

        if(true==$request->has('log_time')){
            $creatime=$request->input('log_time');
            $start=strtotime($creatime);
            $end=strtotime('+1day',$start);
            $sql->whereBetween('agent_logs.creatime',[$start,$end]);
        }

        //获取全部用户数据
        $data = $sql->leftJoin('agent_users','agent_logs.admin_id','=','agent_users.id')
                    ->select('agent_logs.*','agent_users.username')
                    ->paginate(10)->appends($request->all());
        foreach ($data as $key=>$value){
            $data[$key]['login_addr'] = iptoaddr($value['log_ip']);
        }
        return view('agentLoginLog.list',['list'=>$data,'input'=>$request->all()]);
    }
}