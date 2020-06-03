<?php


namespace App\Http\Controllers\Admin;


use App\Http\Controllers\Controller;
use App\Http\Requests\StoreRequest;
use App\Models\Notice;

class EntranceNoticeController extends Controller
{
    public function index()
    {
        $data = Notice::where('type','=',3)->first();
        return view('entrance.list',['info'=>$data]);
    }

    public function store(StoreRequest $request)
    {
        $id = $request->input('id');
        $data["content"]=$request->input('content');
        $data["language"]=$request->input('language');
        $count = Notice::where('id',$id)->update($data);
        if ($count){
            return ['msg'=>'操作成功！','status'=>1];
        }else{
            return ['msg'=>'操作失败！','status'=>0];
        }
    }
}