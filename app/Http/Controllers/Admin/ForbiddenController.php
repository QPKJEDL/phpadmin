<?php
namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests\StoreRequest;
use App\Models\UserAccount;
use Illuminate\Support\Facades\Redis;
class ForbiddenController extends Controller
{
    /*
     * 列表
     */
    public function index(Request $request)
    {
        $map = array();
        if (true==$request->has('account')){
            $map['account']=$request->input('account');
        }
        $map["is_talk"]=1;
        $data = UserAccount::where($map)->paginate(10)->appends($request->all());
        return view('forbidden.list',['list'=>$data,'input'=>$request->all()]);
    }

    /**
     * 添加/编辑页
     * @param int $id
     * @return Factory|View
     */
//    public function edit($id=0)
//    {
//        $info = $id?Silence::find($id):[];
//        if ($id!=0){
//            $info['start_date']=date('Y-m-d',$info['start_date']);
//            $info['end_date']=date('Y-m-d',$info['end_date']);
//        }
//        return view('forbidden.edit',['info'=>$info,'id'=>$id]);
//    }


    /*
     * 添加
     */
//    public function store(StoreRequest $request)
//    {
//        $data = $request->all();
//        $user_account=$data["user_account"];
//        $is=UserAccount::where("account",$user_account)->first();
//        if(!$is){
//            return ['msg'=>'会员不存在！'];
//        }
//        $black=Silence::where("user_account",$user_account)->exists();
//        if($black){
//            return ['msg'=>'该会员禁言！'];
//        }
//        unset($data['_token']);
//        $data['create_by']=getLoginUser();
//        $count = Silence::insert($data);
//        if ($count){
//            return ['msg'=>'添加禁言成功！','status'=>1];
//        }else{
//            return ['msg'=>'添加禁言失败！','status'=>0];
//        }
//
//    }

    /*
     * 编辑
     */
//    public function update(StoreRequest $request)
//    {
//        $data = $request->all();
//        $id = $data['id'];
//
//        $user_account=$data["user_account"];
//        $is=UserAccount::where("account",$user_account)->first();
//        if(!$is){
//            return ['msg'=>'会员不存在！'];
//        }
//        $has=Silence::where('user_account',$user_account)->where('id','<>',$id)->first();
//        if ($has){
//            return ['msg'=>'该会员已禁言！'];
//        }
//        unset($data['_token']);
//        unset($data['id']);
//        $data['update_time']=time();
//        $data['update_by']=getLoginUser();
//        $count = Silence::where('id',$id)->update($data);
//        if ($count!==false){
//            return ['msg'=>'编辑成功！','status'=>1];
//        }else{
//            return ['msg'=>'编辑失败！','status'=>0];
//        }
//
//    }
    /*
     * 删除
     */
    public function open(StoreRequest $request)
    {
        $data = $request->all();
        $id = $data['id'];
        $count = UserAccount::where('user_id','=',$id)->update(array("is_talk"=>0));
        $userdata=Redis::get('UserInfo_'.$id);
        $userinfo=json_decode($userdata,true);
        if ($count){
            $userinfo["Talk"]=0;
            $new=json_encode($userinfo);
            Redis::set("UserInfo_".$id,$new);
            return ['msg'=>'解禁成功！','status'=>1];
        }else{
            return ['msg'=>'解禁失败！','status'=>0];
        }
    }

}