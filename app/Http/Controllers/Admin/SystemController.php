<?php


namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;
use App\Http\Requests\StoreRequest;
use App\Models\Sysset;

/**
 * 系统开关
 * Class SystemController
 * @package App\Http\Controllers\Admin
 */
class SystemController extends Controller
{
    /**
     * 主页
     */
    public function index()
    {
        $system = Sysset::where("id",1)->first();
        $drawOpen = Sysset::where("id",2)->first();
        return view("system.list",['system'=>$system,'drawOpen'=>$drawOpen]);
    }

    /**
     * 点击系统一键维护
     * @param StoreRequest $request
     * @return array
     */
    public function sysSwitch(StoreRequest $request)
    {
        $data=$request->all();
        $id=$data['id'];
        unset($data['_token']);
        $sys=$data['sys'];
        $msg="";
        if($sys==0){
            $msg="系统维护关闭";
        }else if($sys==1){
            $msg="系统维护开启";
        }
        $status=Sysset::where("id",$id)->update(array("status"=>$sys));
        if($status){
            return ['msg'=>$msg."成功",'status'=>1];
        }else{
            return ['msg'=>$msg."失败！",'status'=>0];
        }
    }

    /**
     * 充提开关
     * @param StoreRequest $request
     * @return array
     */
    public function drawSwitch(StoreRequest $request)
    {
        $data=$request->all();
        $id=$data['id'];
        unset($data['_token']);
        $draw=$data['draw'];
        $msg="";
        if($draw==0){
            $msg="提现开启";
        }else if($draw==1){
            $msg="提现关闭";
        }
        $status=Sysset::where("id",$id)->update(array("status"=>$draw));
        if($status){
            return ['msg'=>$msg."成功",'status'=>1];
        }else{
            return ['msg'=>$msg."失败！",'status'=>0];
        }
    }
}