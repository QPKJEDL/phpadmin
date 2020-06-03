<?php


namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;
use App\Models\Desk;
use App\Models\DeskLog;
use Illuminate\Http\Request;

/**
 * 台桌修改日志管理
 **/

class DeskLogController extends Controller
{
    /**
     * 数据列表
     */
    public function index(Request $request)
    {
        //条件
        $map = array();
        $map['desk_log.log_type']='1';
        if ($request->input('desk_id')!=''||$request->input('desk_id')!=null){
            $map['desk_log.desk_id']=$request->input('desk_id');
        }
        $deskLog = DeskLog::query();
        $sql=$deskLog->leftJoin('desk','desk.id','=','desk_log.desk_id')
            ->leftJoin('game','desk.game_id','=','game.id')
            ->select('desk_log.id','desk_log.action','desk_log.create_by','desk_log.create_time','desk.desk_name','game.game_name')
            ->where($map);
        if ($request->has('create_time')==true){
            $time = strtotime($request->input('create_time'));
            $date=strtotime(date('Y-m-d',$time));
            $next=strtotime('+1day',$date)-1;
            $data = $sql->whereBetween('desk_log.create_time',[$date,$next])->orderBy('desk_log.create_time','desc')->paginate(10)->appends($request->all());
        }else{
            $data = $sql->orderBy('desk_log.create_time','desc')->paginate(10)->appends($request->all());
        }
        foreach ($data as $key=>$value)
        {
            $data[$key]['create_time'] = date("Y-m-d H:i:s",$value['create_time']);
        }
        return view('deskLog.list',['list'=>$data,'input'=>$request->all(),'desk'=>Desk::get(),'min'=>config('admin.min_date')]);
    }
}