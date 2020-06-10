<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2020-6-10
 * Time: 13:39
 */
namespace App\Models;
use Illuminate\Database\Eloquent\Model;

class UserLoginLog extends Model{
    protected $table = 'user_login_log';
    public $timestamps = false;
}