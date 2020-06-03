<?php


namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreRequest;
use App\Models\IpBlacklist;
use Illuminate\Contracts\View\Factory;
use Illuminate\Http\Request;
use Illuminate\View\View;

/**
 * ip黑名单
 * Class IpBlacklistController
 * @package App\Http\Controllers\Admin
 */
class IpBlacklistController extends Controller
{
    /**
     * 数据列表
     * @param Request $request
     * @return Factory|View
     */
    public function index(Request $request)
    {
        $map=array();
        if (true==$request->has('ip_address')){
            $map['ip_address']=$request->input('ip_address');
        }
        $data = IpBlacklist::where($map)->paginate(10)->appends($request->all());
        foreach ($data as $key=>$value){
            $data[$key]['start_date'] = date("Y-m-d",$value['start_date']);
            $data[$key]['end_date'] = date("Y-m-d",$value['end_date']);
            if ($data[$key]['update_time']!='' || $data[$key]['update_time']!=null){
                $data[$key]['update_time'] = date("Y-m-d H:m:s",$value['update_time']);
            }
        }
        return view('ipBlacklist.list',['list'=>$data,'input'=>$request->all()]);
    }

    /**
     * 编辑页
     * @param int $id
     * @return Factory|View
     */
    public function edit($id=0)
    {
        $info = $id?IpBlacklist::find($id):[];
        if ($id!=0){
            $info['start_date']=date('Y-m-d',$info['start_date']);
            $info['end_date']=date('Y-m-d',$info['end_date']);
        }
        return view('ipBlacklist.edit',['info'=>$info,'id'=>$id]);
    }

    /**
     * 新增保存
     * @param StoreRequest $request
     * @return array
     */
    public function store(StoreRequest $request)
    {
        $data = $request->all();
        if (IpBlacklist::where('ip_address','=',$request->input('ip_address'))->exists()){
            return ['msg'=>'该IP已被封禁！','status'=>0];
        }else{
            unset($data['_token']);
            $data['start_date']=strtotime($data['start_date']);
            $data['end_date']=strtotime($data['end_date']);
            $data['create_by']=getLoginUser();
            $count = IpBlacklist::insert($data);
            if ($count){
                return ['msg'=>'操作成功！','status'=>1];
            }else{
                return ['msg'=>'操作失败！','status'=>0];
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
        $data = $request->all();
        $id = $data['id'];
        if (IpBlacklist::where('ip_address','=',$request->input('ip_address'))->where('id','<>',$id)->first()){
            return ['msg'=>'该IP已被封禁！','status'=>0];
        }else{
            unset($data['_token']);
            unset($data['id']);
            $data['start_date']=strtotime($data['start_date']);
            $data['end_date']=strtotime($data['end_date']);
            $data['update_time']=time();
            $data['update_by']=getLoginUser();
            $count = IpBlacklist::where('id',$id)->update($data);
            if ($count!==false){
                return ['msg'=>'操作成功！','status'=>1];
            }else{
                return ['msg'=>'操作失败！','status'=>0];
            }
        }
    }

    /**
     * 效验ip是否存在
     * @param StoreRequest $request
     * @return array
     */
    public function checkUniqueIp(StoreRequest $request)
    {
        $id = $request->input('id');
        if ($id==0){
            if (IpBlacklist::where('ip_address','=',$request->input('ip_address'))->exists())
            {
                return ['msg'=>'该IP已被封禁！','status'=>0];
            }
        }else{
            if (IpBlacklist::where('ip_address','=',$request->input('ip_address'))->where('id','<>',$id)->first())
            {
                return ['msg'=>'该IP已被封禁！','status'=>0];
            }
        }
    }

    /**
     * 解禁
     * @param $id
     * @return array
     * @throws \Exception
     */
    public function destroy($id)
    {
        $count = IpBlacklist::where('id','=',$id)->delete();
        if ($count){
            return ['msg'=>'操作成功！','status'=>1];
        }else{
            return ['msg'=>'操作失败！','status'=>0];
        }
    }
}