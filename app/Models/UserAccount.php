<?php


namespace App\Models;


use Illuminate\Database\Eloquent\Model;

class UserAccount extends Model
{
    protected $table = "user";
    public $timestamps = false;
    protected $hidden = ['password','token','draw_pwd'];
    protected $primaryKey="user_id";
}