<?php


namespace App\Http\Controllers\Admin;


use App\Http\Controllers\Controller;
use App\Http\Requests\StoreRequest;
use App\Models\UserAccount;
use Illuminate\Http\Request;

class UserAccountController extends Controller
{
    /**
     * 数据列表
     */
    public function index(Request $request)
    {
        $map = array();
        //获取全部用户数据
        $data = UserAccount::where($map)->paginate(10)->appends($request->all());
        foreach ($data as $key=>$value){
            $data[$key]['creatime'] = date("Y-m-d H:i:s",$value['creatime']);
            $data[$key]['savetime'] = date("Y-m-d H:i:s",$value['savetime']);
        }
        return view('userAccount.list',['list'=>$data,'input'=>$request->all()]);
    }

    /**
     * 编辑页
     */
    public function edit($user_id=0)
    {
        $info = $user_id?UserAccount::find($user_id):[];
        return view('userAccount.edit',['user_id'=>$user_id,'info'=>$info]);
    }

    /**
     * 保存数据
     */
    public function store(StoreRequest $request)
    {
        $data = $request->all();
        unset($data['_token']);
        $count = UserAccount::insert($data);
        if($count){
            return ["msg"=>"保存成功！","status"=>1];
        }else{
            return ["msg"=>"保存失败！","status"=>0];
        }
    }

    /**
     * 封禁/解除
     */
    public function isLogin(StoreRequest $request)
    {
        //获取userId
        $userId = $request->input("userId");
        //获取状态
        $status = $request->input("status");
        $count = UserAccount::where('user_id',$userId)->update(['is_over'=>$status]);
        if($count){
            return ['msg'=>"操作成功！",'status'=>1];
        }else{
            return ['msg'=>'操作失败！','status'=>0];
        }
    }

    /**
     * 删除
     */
    public function destroy($id)
    {
        $count = UserAccount::where("id",'=',$id)->delete();
        if($count){
            return ["msg"=>"删除成功！","status"=>1];
        }else{
            return ['msg'=>"删除失败！",'status'=>0];
        }
    }

    /**
     * 修改密码
     */
    public function resetPwd(StoreRequest $request)
    {
        //获取userId
        $userId = $request->input('user_id');
        //获取密码
        $pwd = $request->input('pwd');
        $count = UserAccount::where('user_id',$userId)->update(['password'=>md5($pwd)]);
        if($count){
            return ['msg'=>"操作成功！",'status'=>1];
        }else{
            return ['msg'=>"操作失败！",'status'=>0];
        }
    }
}