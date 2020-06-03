<?php
namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Game;
use Illuminate\Http\Request;

class AgentController extends Controller
{
    /**
     * 数据列表
     */
    public function index(Request $request){
        $map = array();
        $data = Game::where($map)->paginate(10)->appends($request->all());
        return view('agent.list',['list'=>$data,'input'=>$request->all()]);
    }

    public function store($id=0){
        $data = $id?Game::find($id):[];
        return view('agent.edit',['id'=>$id,'info'=>$data]);
    }
}