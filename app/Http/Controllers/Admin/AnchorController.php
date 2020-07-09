<?php


namespace App\Http\Controllers\Admin;


use App\Http\Controllers\Controller;
use App\Http\Requests\StoreRequest;
use App\Models\UserAccount;
use App\Models\UserMoney;
use App\Models\LiveInfo;
use Illuminate\Support\Facades\DB;
use Exception;
use Illuminate\Contracts\View\Factory;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;
use Illuminate\Support\Facades\Redis;
class AnchorController extends Controller
{
    /**
     * 数据列表
     * @param Request $request
     * @return Factory|View
     */
    public function index(Request $request)    {

        $sql=UserAccount::query();
        if(true==$request->has('account')){
            $sql->where('user.account','=',$request->input('account'));
        }
        $sql->where('user.shenfen','=',1);
        $data = $sql->leftJoin('user_account','user.user_id','=','user_account.user_id')
                    ->select('user_account.balance','user.user_id','user.nickname','user.account','user.is_over','user.create_by','user.creatime','user.remark')
                    ->paginate(10)->appends($request->all());
        foreach ($data as $key=>$value){
            $data[$key]['creatime'] = date("Y-m-d H:i:s",$value['creatime']);
        }
        return view('anchor.list',['list'=>$data,'input'=>$request->all()]);
    }


    /**
     * 编辑页
     */
    public function edit($id=0)
    {
        $data = $id?UserAccount::find($id):[];
        $info=LiveInfo::where("live_user_id",$id)->first();
        $data["age"]=$info["age"];
        $data["height"]=$info["height"];
        $data["three_sides"]=$info["three_sides"];
        $data["star"]=$info["star"];
        $data["hobby"]=$info["hobby"];
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
            return ['msg'=>'账号已存在！'];
        }
        $data = $request->all();
        $data['password']=md5($data['password']);

        $info["age"]=$data["age"];
        $info["height"]=$data["height"];
        $info["three_sides"]=$data["three_sides"];
        $info["star"]=$data["star"];
        $info["hobby"]=$data["hobby"];
        unset($data['id']);
        unset($data['_token']);
        unset($data["age"]);
        unset($data["height"]);
        unset($data["three_sides"]);
        unset($data["star"]);
        unset($data["hobby"]);
        //获取当前登录用户
        $user = Auth::user();
        $data["shenfen"]=1;
        $data['create_by']=$user['username'];
        $data['creatime']=time();
        $data['savetime']=time();
        DB::beginTransaction();
        try{
            $insertId = UserAccount::insertGetId($data);
            if(!$insertId){
                DB::rollBack();
                return ['msg'=>'主播添加失败！'];
            }
            $account=[
                "user_id"=>$insertId,
                "creatime"=>time(),
                "savetime"=>time(),
            ];
            $anchor=UserMoney::insert($account);
            if(!$anchor){
                DB::rollBack();
                return ['msg'=>'主播帐户添加失败！'];
            }
            $live=[
                "live_user_id"=>$insertId,
                "age"=>$info["age"],
                "height"=>$info["height"],
                "three_sides"=>$info["three_sides"],
                "star"=>$info["star"],
                "hobby"=>$info["hobby"],
                "creatime"=>time(),
            ];
            $liveinfo=LiveInfo::insert($live);
            if(!$liveinfo){
                DB::rollBack();
                return ['msg'=>'主播信息添加失败！'];
            }
            DB::commit();
            $live_user_info=[
                'LiveUserId'=>$insertId,
                'NickName'=>$data["nickname"],
                'Age'=>$info["age"],
                'Height'=>$info["height"],
                'ThreeSides'=>$info["three_sides"],
                'Star'=>$info["star"],
                'Hobby'=>$info["hobby"]
            ];
            $new=json_encode($live_user_info);
            Redis::set("LiveUserInfo_".$insertId,$new);
            return ['msg'=>'主播添加成功！','status'=>1];

        }catch (Exception $e){
            DB::rollBack();
            return ['msg'=>'操作异常！请稍后重试！'];
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

        $info["age"]=$data["age"];
        $info["height"]=$data["height"];
        $info["three_sides"]=$data["three_sides"];
        $info["star"]=$data["star"];
        $info["hobby"]=$data["hobby"];
        unset($data['id']);
        unset($data['_token']);
        unset($data["age"]);
        unset($data["height"]);
        unset($data["three_sides"]);
        unset($data["star"]);
        unset($data["hobby"]);

        unset($data['_token']);
        unset($data['id']);

        if(empty($data["password"])){
            unset($data['password']);
        }

        $count = UserAccount::where('user_id',$id)->update($data);
        if ($count!==false){
            $live=LiveInfo::where('live_user_id',$id)->update($info);
            if($live!==false){
                $live_user_info=[
                    'LiveUserId'=>$id,
                    'NickName'=>$data["nickname"],
                    'Age'=>$info["age"],
                    'Height'=>$info["height"],
                    'ThreeSides'=>$info["three_sides"],
                    'Star'=>$info["star"],
                    'Hobby'=>$info["hobby"]
                ];
                $new=json_encode($live_user_info);
                Redis::set("LiveUserInfo_".$id,$new);
                return ['msg'=>'修改成功','status'=>1];
            }else{
                return ['msg'=>'修改失败','status'=>0];
            }
        }else{
            return ['msg'=>'修改失败','status'=>0];
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
        $count = Anchor::where('id','=',$id)->update(array("del_flag"=>1,"is_over"=>1));
        if ($count){
            return ['msg'=>"删除成功！",'status'=>1];
        }else{
            return ['msg'=>"删除失败！",'status'=>0];
        }
    }
}