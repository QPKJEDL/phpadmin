<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2020-6-10
 * Time: 13:38
 */

namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;
use App\Models\UserLoginLog;
use Illuminate\Http\Request;
class UserLoginLogController extends Controller{
    /**
     * 数据列表
     */
    public function index(Request $request){


        $sql=UserLoginLog::query();

        if(true==$request->has('account')){
            $sql->where('account','=',$request->input('account'));
        }

        if(true==$request->has('login_ip')){
            $sql->where('login_ip','=',$request->input('login_ip'));
        }

        if(true==$request->has('creatime')){
            $creatime=$request->input('creatime');
            $start=strtotime($creatime);
            $end=strtotime('+1day',$start);
            $sql->whereBetween('creatime',[$start,$end]);
        }

        //获取全部用户数据
        $data = $sql->paginate(10)->appends($request->all());
        foreach ($data as $key=>$value){
            $data[$key]['creatime'] = date("Y-m-d H:i:s",$value['creatime']);
            $data[$key]['login_addr'] = iptoaddr($value['login_ip']);
        }
        return view('userLoginLog.list',['list'=>$data,'input'=>$request->all()]);
    }
}