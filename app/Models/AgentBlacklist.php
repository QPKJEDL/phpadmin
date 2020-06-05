<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2020-6-5
 * Time: 8:44
 */
namespace App\Models;


use Illuminate\Database\Eloquent\Model;

class AgentBlacklist extends Model
{
    protected $table = 'agent_blacklist';
    public $timestamps = false;
}