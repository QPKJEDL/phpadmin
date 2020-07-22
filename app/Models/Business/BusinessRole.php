<?php


namespace App\Models\Business;


use App\Models\Traits\AdminRoleTrait;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class BusinessRole extends Model
{
    use AdminRoleTrait;
    protected $table = 'business_roles';
    public function isAbleDel($roleid){
        return DB::table('business_role_user')->where('role_id',$roleid)->get()->toArray()?true:false;
    }
}