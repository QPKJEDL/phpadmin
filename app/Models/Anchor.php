<?php


namespace App\Models;


use Illuminate\Database\Eloquent\Model;

class Anchor extends Model
{
    protected $table = "anchor";
    public $timestamps = false;
    protected $hidden = ['password'];
}