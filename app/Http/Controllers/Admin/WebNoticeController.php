<?php


namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreRequest;
use App\Models\Notice;

/**
 * web轮播公告
 * Class WebNoticeController
 * @package App\Http\Controllers\Admin
 */
class WebNoticeController extends Controller
{
    public function index()
    {
        $data = Notice::where("type",'=',1)->first();
        return view('webnotice.list',['info'=>$data]);
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