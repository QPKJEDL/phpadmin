<?php
namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Game;
use Illuminate\Http\Request;

class ForbiddenController extends Controller
{
    public function index(Request $request)
    {
        $map = array();
        $data = Game::where($map)->paginate(10)->appends($request->all());
        return view('forbidden.list',['list'=>$data,'input'=>$request->all()]);
    }
}