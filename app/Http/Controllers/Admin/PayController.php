<?php


namespace App\Http\Controllers\Admin;


use App\Http\Controllers\Controller;
use App\Http\Requests\StoreRequest;
use App\Models\Pay;
use Illuminate\Contracts\View\Factory;
use Illuminate\Http\Request;
use Illuminate\View\View;

class PayController extends Controller
{
    /**
     * 数据列表
     * @param Request $request
     * @return Factory|View
     */
    public function index(Request $request)
    {
        $map = array();
        $data = Pay::where($map)->paginate(10)->appends($request->all());
        return view('pay.list',['list'=>$data]);
    }


    /**
     * 编辑页
     * @param int $id
     * @return Factory|View
     */
    public function edit($id=0)
    {
        $data = $id?Pay::find($id):[];
        return view('pay.edit',['info'=>$data,'id'=>$id]);
    }

    /**
     * 保存
     * @param StoreRequest $request
     * @return array
     */
    public function store(StoreRequest $request)
    {
        $data = $request->all();
        unset($data['_token']);
        $data['create_time']=time();
        $count = Pay::insert($data);
        if ($count){
            return ['msg'=>'操作成功！','status'=>1];
        }else{
            return ['msg'=>'操作失败！','status'=>0];
        }
    }

    /**
     * 禁用
     * @param $id
     * @return array
     */
    public function destroy($id)
    {
        $count = Pay::where('id','=',$id)->update(['status'=>1]);
        if ($count){
            return ['msg'=>'操作成功!','status'=>1];
        }else{
            return ['msg'=>'操作失败！','status'=>0];
        }
    }
}