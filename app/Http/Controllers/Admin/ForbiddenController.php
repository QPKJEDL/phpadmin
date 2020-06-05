<?php
namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Silence;
use Illuminate\Http\Request;
use App\Http\Requests\StoreRequest;
use App\Models\UserAccount;
class ForbiddenController extends Controller
{
    /*
     * 列表
     */
    public function index(Request $request)
    {
        $map = array();
        if (true==$request->has('user_account')){
            $map['user_account']=$request->input('user_account');
        }
        $data = Silence::where($map)->paginate(10)->appends($request->all());
        foreach ($data as $key=>$value){
            $data[$key]['start_date'] = date("Y-m-d",$value['start_date']);
            $data[$key]['end_date'] = date("Y-m-d",$value['end_date']);
            if ($data[$key]['update_time']!='' || $data[$key]['update_time']!=null){
                $data[$key]['update_time'] = date("Y-m-d H:i:s",$value['update_time']);
            }
        }
        return view('forbidden.list',['list'=>$data,'input'=>$request->all()]);
    }

    /**
     * 添加/编辑页
     * @param int $id
     * @return Factory|View
     */
    public function edit($id=0)
    {
        $info = $id?Silence::find($id):[];
        if ($id!=0){
            $info['start_date']=date('Y-m-d',$info['start_date']);
            $info['end_date']=date('Y-m-d',$info['end_date']);
        }
        return view('forbidden.edit',['info'=>$info,'id'=>$id]);
    }


    /*
     * 添加
     */
    public function store(StoreRequest $request)
    {
        $data = $request->all();
        $user_account=$data["user_account"];
        $is=UserAccount::where("account",$user_account)->first();
        if(!$is){
            return ['msg'=>'会员不存在！'];
        }
        $black=Silence::where("user_account",$user_account)->exists();
        if($black){
            return ['msg'=>'该会员禁言！'];
        }
        unset($data['_token']);
        $data['start_date']=strtotime($data['start_date']);
        $data['end_date']=strtotime($data['end_date']);
        $data['create_by']=getLoginUser();
        $count = Silence::insert($data);
        if ($count){
            return ['msg'=>'添加禁言成功！','status'=>1];
        }else{
            return ['msg'=>'添加禁言失败！','status'=>0];
        }

    }

    /*
     * 编辑
     */
    public function update(StoreRequest $request)
    {
        $data = $request->all();
        $id = $data['id'];

        $user_account=$data["user_account"];
        $is=UserAccount::where("account",$user_account)->first();
        if(!$is){
            return ['msg'=>'会员不存在！'];
        }
        $has=Silence::where('user_account',$user_account)->where('id','<>',$id)->first();
        if ($has){
            return ['msg'=>'该会员已禁言！'];
        }
        unset($data['_token']);
        unset($data['id']);
        $data['start_date']=strtotime($data['start_date']);
        $data['end_date']=strtotime($data['end_date']);
        $data['update_time']=time();
        $data['update_by']=getLoginUser();
        $count = Silence::where('id',$id)->update($data);
        if ($count!==false){
            return ['msg'=>'编辑成功！','status'=>1];
        }else{
            return ['msg'=>'编辑失败！','status'=>0];
        }

    }
    /*
     * 删除
     */
    public function destroy($id)
    {
        $count = Silence::where('id','=',$id)->delete();
        if ($count){
            return ['msg'=>'操作成功！','status'=>1];
        }else{
            return ['msg'=>'操作失败！','status'=>0];
        }
    }

}