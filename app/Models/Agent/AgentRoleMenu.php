<?php


namespace App\Models\Agent;


use Illuminate\Database\Eloquent\Model;

class AgentRoleMenu extends Model
{
    protected $table = "agent_role_menu";

    public $timestamps = false;

    public static function getInfo($roleId,$menuId){
        $data = AgentRoleMenu::where('role_id','=',$roleId)->where('menu_id','=',$menuId)->first();
        return $data;
    }
}