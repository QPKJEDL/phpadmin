<?php

namespace App\Http\Controllers\Admin\Agent;

use App\Http\Controllers\Controller;
use App\Models\Agent\AgentMenu;

class AgentMenuController extends Controller
{
    public function index(){
        $data = AgentMenu::get()->toArray();
        return view('agentMenu.list',['list'=>$data]);
    }
}