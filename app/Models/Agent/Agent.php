<?php

namespace App\Models\Agent;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Auth\Authenticatable;
use Illuminate\Auth\Passwords\CanResetPassword;
use Illuminate\Contracts\Auth\Authenticatable as AuthenticatableContract;
use Illuminate\Contracts\Auth\CanResetPassword as CanResetPasswordContract;
use App\Models\Interfaces\AdminUsersInterface;
use App\Models\Traits\AdminUsersTrait;
class Agent extends Model implements AuthenticatableContract, CanResetPasswordContract, AdminUsersInterface
{
    use Authenticatable, CanResetPassword, AdminUsersTrait;
    protected $table = 'agent_users';
    protected $fillable = ['username', 'email', 'mobile', 'password'];
    protected $hidden = ['password', 'remember_token'];
}