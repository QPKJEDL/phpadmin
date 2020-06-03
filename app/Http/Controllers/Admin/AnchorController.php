<?php


namespace App\Http\Controllers\Admin;


use App\Http\Controllers\Controller;
use App\Http\Requests\StoreRequest;
use App\Models\UserAccount;
use Exception;
use Illuminate\Contracts\View\Factory;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;

class AnchorController extends Controller
{
    /**
     * 数据列表
     * @param Request $request
     * @return Factory|View
     */
    public function index(Request $request)
    {
//        $map = array();
//        if ($request->input('account')!=''||$request->input('account')!=null){
//            $map['account']=$request->input('account');
//        }
        $map['shenfen']=1;//0用户1主播
        $data = UserAccount::where($map)->paginate(10)->appends($request->all());
        foreach ($data as $key=>$value){
            $data[$key]['create_time'] = date("Y-m-d H:i:s",$value['create_time']);

        }
        return view('anchor.list',['list'=>$data,'input'=>$request->all()]);
    }

    /**
     * 效验账号的唯一性
     * @param StoreRequest $request
     * @return array
     */
    public function checkUniqueAccount(StoreRequest $request)
    {
        $account = $request->input('account');
        //根据账号查询当前数据是否存在
        if(UserAccount::where(array("account"=>$account,"shenfen"=>1))->exists()){
            return ['msg'=>'账号已存在！','status'=>1];
        }else{
            return ['msg'=>"账号可以使用",'status'=>0];
        }
    }

    /**
     * 编辑页
     */
    public function edit($id=0)
    {
        $data = $id?UserAccount::find($id):[];
        return view('anchor.edit',['id'=>$id,'info'=>$data]);
    }

    /**
     * 保存数据 新增
     * @param StoreRequest $request
     * @return array
     */
    public function store(StoreRequest $request)
    {
        $account = $request->input('account');
        if (UserAccount::where('account','=',$account)->exists()){
            return ['msg'=>'账号已存在！','status'=>0];
        }else{
            $data = $request->all();
            $data['password']=md5($data['password']);
            unset($data['_token']);
            //获取当前认证用户
            $user = Auth::user();
            $data['create_by']=$user['username'];
            $data['creatime']=time();
            $data['savetime']=time();
            $count = UserAccount::insert($data);
            if($count){
                return ['msg'=>'添加成功','status'=>1];
            }else{
                return ['msg'=>'添加失败','status'=>0];
            }
        }
    }

    /**
     * 停用/启用
     * @param StoreRequest $request
     * @return array
     */
    public function changeStatus(StoreRequest $request)
    {
        $id = $request->input('id');
        $isover = $request->input('isover');
        dump($isover);
        if($isover==0){
            $on=UserAccount::where(array("user_id"=>$id,"shenfen"=>1))->update(['is_over'=>$isover]);
            if($on){
                return ['msg'=>'开启成功！','status'=>1];
            }else{
                return ['msg'=>'开启失败！','status'=>0];
            }
        }else if($isover==1){
            $off=UserAccount::where(array("user_id"=>$id,"shenfen"=>1))->update(['is_over'=>$isover]);
            if($off){
                return ['msg'=>'停用成功！','status'=>1];
            }else{
                return ['msg'=>'停用失败！','status'=>0];
            }
        }
    }

    /**
     * 更新数据
     * @param StoreRequest $request
     * @return array
     */
    public function update(StoreRequest $request)
    {
        $id = $request->input('id');
        $data = $request->all();
        unset($data['_token']);
        unset($data['id']);
        $count = Anchor::where('id',$id)->update($data);
        if ($count!==false){
            return ['msg'=>'操作成功','status'=>1];
        }else{
            return ['msg'=>'操作失败','status'=>0];
        }
    }

    /**
     * 删除
     * @param $id
     * @return array
     * @throws Exception
     */
    public function destroy($id)
    {
        $count = Anchor::where('id','=',$id)->delete();
        if ($count){
            return ['msg'=>"删除成功！",'status'=>1];
        }else{
            return ['msg'=>"删除失败！",'status'=>0];
        }
    }
}