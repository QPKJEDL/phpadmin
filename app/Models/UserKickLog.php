<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2020-6-9
 * Time: 16:19
 */
namespace App\Models;
use Illuminate\Database\Eloquent\Model;

class UserKickLog extends Model{
    protected $table = 'user_kick_log';
    public $timestamps = false;
}