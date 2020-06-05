<?php


namespace App\Http\Controllers\Admin;


use App\Http\Controllers\Controller;
use App\Http\Requests\StoreRequest;
use App\Models\Camera;

class CameraController extends Controller
{
    /**
     * 列表页
     */
    public function index()
    {
        $data = Camera::get()->toArray();
        return view("camera.list",["list"=>$data]);
    }

    public function store(StoreRequest $request){
        $data = $request->input('data');
        $arr = json_decode($data,true);
        $num=0;
        foreach ($arr as $key=>$value)
        {
            Camera::where('id',$arr[$key]['id'])->update(["url"=>$arr[$key]['value']]);

            $num = $num + 1;

        }
        if ($num==4){
            return ['msg'=>"操作成功！",'status'=>1];
        }else{
            return ['msg'=>"操作失败！",'status'=>0];
        }
    }


}