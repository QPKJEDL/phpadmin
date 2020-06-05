<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2020-6-5
 * Time: 9:54
 */namespace App\Models;


use Illuminate\Database\Eloquent\Model;

class UserBlacklist extends Model
{
    protected $table = 'user_blacklist';
    public $timestamps = false;
}