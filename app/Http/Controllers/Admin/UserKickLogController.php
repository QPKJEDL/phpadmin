<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2020-6-9
 * Time: 16:44
 */

namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;
use App\Models\UserKickLog;
use Illuminate\Http\Request;

class UserKickLogController extends Controller{
    /**
     * 数据列表
     */
    public function index(Request $request){


        $sql=UserKickLog::query();

        if(true==$request->has('account')){
            $sql->where('account','=',$request->input('account'));
        }

        if(true==$request->has('create_time')){
            $creatime=$request->input('create_time');
            $start=strtotime($creatime);
            $end=strtotime('+1day',$start);
            $sql->whereBetween('create_time',[$start,$end]);
        }

        //获取全部用户数据
        $data = $sql->paginate(10)->appends($request->all());
        foreach ($data as $key=>$value){
            $data[$key]['create_time'] = date("Y-m-d H:i:s",$value['create_time']);
        }
        return view('userKickLog.list',['list'=>$data,'input'=>$request->all()]);
    }
}