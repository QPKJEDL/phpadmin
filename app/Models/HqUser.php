<?php


namespace App\Models;


use Illuminate\Database\Eloquent\Model;

class HqUser extends Model
{
    protected $table = 'user';
    protected $primaryKey = 'user_id';

    /**
     * 根据userId获取用户信息
     * @param $userId
     * @return HqUser|HqUser[]|array|\Illuminate\Database\Eloquent\Collection|Model|null
     */
    public static function getUserInfoByUserId($userId)
    {
        return $userId?HqUser::find($userId):[];
    }
}