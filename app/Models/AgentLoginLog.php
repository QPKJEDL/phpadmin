<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2020-6-10
 * Time: 14:00
 */
namespace App\Models;
use Illuminate\Database\Eloquent\Model;

class AgentLoginLog extends Model{
    protected $table = 'agent_logs';
    public $timestamps = false;
}