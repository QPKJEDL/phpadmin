<?php


namespace App\Http\Controllers\Admin;


use App\Http\Controllers\Controller;
use App\Http\Requests\StoreRequest;
use App\Models\Desk;
use App\Models\UserAccount;
use App\Models\UserDesk;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redis;

class UserDeskController extends Controller
{
    public function index(Request $request){
        $map = array();
        $data = UserDesk::where($map)->leftJoin('user','user.user_id','=','user_desk.user_id')->leftJoin('desk','desk.id','=','user_desk.desk_id')->paginate(10)->appends($request->all());
        return view('userDesk.list',['list'=>$data,'input'=>$request->all()]);
    }

    public function edit($id=0){
        $info = $id?UserDesk::find($id):[];
        //获取所有用户信息
        $userData = UserAccount::where('is_over','=',0)->get();
        //获取所有台桌信息
        $deskDate = Desk::where('status','=',0)->select('id','desk_name','game_name')->get();
        if ($id!=0){
            $info['limit'] = json_decode($info['limit'],true);
            $info['pair_limit']=json_decode($info['pair_limit'],true);
            $info['tie_limit']=json_decode($info['tie_limit'],true);
        }
        $data = array();
        foreach ($deskDate as $key=>$value){
            $d = array();
            $d['label'] = $value['desk_name'].'---'.$value['game_name'];
            $d['value'] = $value['id'];
            $data[] = $d;
        }
        return view('userDesk.edit',['info'=>$info,'id'=>$id,'userData'=>$userData,'deskData'=>$data]);
    }

    public function update(StoreRequest $request)
    {
        $data = $request->all();
        $id = $data['id'];
        unset($data['_token']);
        unset($data['id']);
        $limit['min']=(int)$data['limit']['min'];
        $limit['max']=(int)$data['limit']['max'];
        $pairLimit['min'] = (int)$data['pair_limit']['min'];
        $pairLimit['max'] = (int)$data['pair_limit']['max'];
        $tieLimit['min'] = (int)$data['tie_limit']['min'];
        $tieLimit['max'] = (int)$data['tie_limit']['max'];
        $data['limit']=json_encode($limit);
        $data['pair_limit'] = json_encode($pairLimit);
        $data['tie_limit'] = json_encode($tieLimit);
        $count = UserDesk::where('id',$id)->update($data);
        if ($count){
            $d = array();
            $d['limit']=json_encode($limit);
            $d['pair_limit'] = json_encode($pairLimit);
            $d['tie_limit'] = json_encode($tieLimit);
            $info = $id?UserDesk::find($id):[];
            Redis::set('user'.$info['user_id'].'_desk'.$info['desk_id'],json_encode($d));
            return ['msg'=>'更新成功','status'=>1];
        }else{
            return ['msg'=>'更新失败','status'=>0];
        }
    }

    public function store(StoreRequest $request){
        $data = $request->all();
        unset($data['_token']);
        $limit['min']=(int)$data['limit']['min'];
        $limit['max']=(int)$data['limit']['max'];
        $pairLimit['min'] = (int)$data['pair_limit']['min'];
        $pairLimit['max'] = (int)$data['pair_limit']['max'];
        $tieLimit['min'] = (int)$data['tie_limit']['min'];
        $tieLimit['max'] = (int)$data['tie_limit']['max'];
        $data['limit']=json_encode($limit);
        $data['pair_limit'] = json_encode($pairLimit);
        $data['tie_limit'] = json_encode($tieLimit);
        $deskIds = json_decode($data['deskIds'],true);
        unset($data['deskIds']);
        $count = 0;
        foreach ($deskIds as $key=>$value){
            $data['desk_id']=$value;
            $result = UserDesk::insert($data);
            if ($result){
                $d = array();
                $d['limit']=json_encode($limit);
                $d['pair_limit'] = json_encode($pairLimit);
                $d['tie_limit'] = json_encode($tieLimit);
                Redis::set('user'.$data['user_id'].'_desk'.$data['desk_id'],json_encode($d));
                $count++;
            }else{
                return ['msg'=>'操作失败','status'=>0];
                continue;
            }
        }
        if ($count==count($deskIds)){
            return ['msg'=>'操作成功','status'=>1];
        }else{
            return ['msg'=>'操作失败','status'=>0];
        }
    }

    public function destroy($id)
    {
        $info = $id?UserDesk::find($id):[];
        $count = UserDesk::where('id','=',$id)->delete();
        if ($count){
            Redis::del('user'.$info['user_id'].'_desk'.$info['desk_id']);
            return ['msg'=>'操作成功！','status'=>1];
        }else{
            return ['msg'=>'操作失败！','status'=>0];
        }
    }
}