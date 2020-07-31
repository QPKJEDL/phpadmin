<?php


namespace App\Models\Business;


use App\Models\Traits\AdminUsersTrait;
use Illuminate\Auth\Authenticatable;
use Illuminate\Auth\Passwords\CanResetPassword;
use Illuminate\Database\Eloquent\Model;

class Business extends Model
{
    use Authenticatable, CanResetPassword, AdminUsersTrait;
    protected $table = 'business';
    protected $primaryKey = 'id';
    protected $fillable = ['username', 'email', 'mobile', 'password'];
    protected $hidden = ['password', 'remember_token'];
}