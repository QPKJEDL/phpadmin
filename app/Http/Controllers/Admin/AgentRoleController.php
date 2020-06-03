<?php
namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Game;
use Illuminate\Http\Request;

class AgentRoleController extends Controller
{
    public function index(Request $request){
        $map = array();
        $data = Game::where($map)->paginate(10)->appends($request->all());
        return view('agentRole.list',['list'=>$data]);
    }
}