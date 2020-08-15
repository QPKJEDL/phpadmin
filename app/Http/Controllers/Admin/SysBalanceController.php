<?php


namespace App\Http\Controllers\Admin;


use App\Http\Controllers\Controller;
use App\Http\Requests\StoreRequest;
use App\Models\SysBalance;
use App\Models\SysBalanceRecord;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Mockery\Exception;

class SysBalanceController extends Controller
{
    public function index()
    {
        $data = SysBalance::where('id','=',1)->first();
        return view('sysBalance.list',['data'=>$data]);
    }

    public function edit($id=0)
    {
        return view('sysBalance.edit',['id'=>1]);
    }

    public function store(StoreRequest $request)
    {
        $data = $request->all();
        DB::beginTransaction();
        try {
            $info = SysBalance::where('id','=',1)->lockForUpdate()->first();
            $update = SysBalance::where('id','=',1)->update(['update_time'=>date('Y-m-d H:i:s',time()),'balance'=>$data['balance']*100 + $info['balance']]);
            if (!$update)
            {
                DB::rollBack();
                return ['msg'=>'操作失败','status'=>0];
            }
            $map = array();
            $map['user_id']=Auth::id();
            $map['balance']=$data['balance']*100;
            $map['be_bal']=$info['balance'];
            $map['after_bal']=$data['balance']*100 + $info['balance'];
            $map['create_time']=date('Y-m-d H:i:s',time());
            $count = SysBalanceRecord::insert($map);
            if (!$count){
                DB::rollBack();
                return ['msg'=>'操作失败','status'=>0];
            }
            DB::commit();
            return ['msg'=>'操作成功','status'=>1];
        }
        catch (Exception $exception)
        {
            DB::rollBack();
            return ['msg'=>'发生异常，请重新提交','status'=>0];
        }
    }
}