<?php


namespace App\Models\Business;


use Illuminate\Database\Eloquent\Model;

class BusinessRoleMenu extends Model
{
    protected $table = "business_role_menu";

    public $timestamps = false;

    public static function getInfo($roleId,$menuId){
        $data = BusinessRoleMenu::where('role_id','=',$roleId)->where('menu_id','=',$menuId)->first();
        return $data;
    }
}