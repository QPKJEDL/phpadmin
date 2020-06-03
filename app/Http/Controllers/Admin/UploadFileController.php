<?php


namespace App\Http\Controllers\Admin;


use App\Http\Controllers\Controller;
use App\Http\Requests\StoreRequest;
use Illuminate\Support\Facades\Storage;

class UploadFileController extends Controller
{
    /**
     * 文件上传
     */
    public function uploadFile(StoreRequest $request)
    {
        $fileCharater = $request->file('file');

        if ($fileCharater->isValid()){
            //获取文件的扩展名
            $ext = $fileCharater->getClientOriginalExtension();
            //获取文件的绝对路径
            $path = $fileCharater->getRealPath();
            //定义文件名
            $fileName = date('Ymdhis').'.'.$ext;

            //存储文件
            Storage::disk('public')->put($fileName,file_get_contents($path));
            return ['code'=>0,'url'=>$_SERVER['HTTP_HOST'].'/storage/'.$fileName,'filename'=>$fileName];
        }
        return ['code'=>1];
    }
}