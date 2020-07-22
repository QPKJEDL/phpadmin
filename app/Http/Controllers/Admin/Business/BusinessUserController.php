<?php


namespace App\Http\Controllers\Admin\Business;


use App\Http\Controllers\Admin\BaseController;
use App\Http\Controllers\Controller;
use App\Http\Requests\StoreRequest;
use App\Models\Admin;
use App\Models\Business\Business;
use App\Models\Business\BusinessRole;
use App\Models\Log;
use App\Service\DataService;

class BusinessUserController extends BaseController
{
    /**
     * 用户列表
     */
    public function index()
    {
        return view('business.user.list', ['list'=>Business::with('roles')->get()->toArray()]);
    }

    /**
     *用户编辑页面
     */
    public function edit($id=0)
    {
        $info = $id?Business::find($id):[];
        return view('business.user.edit', ['id'=>$id,'roles'=>BusinessRole::all(),'info'=>$info]);
    }

    /**
     * 用户增加保存
     */
    public function store(StoreRequest $request){
        $model = new Business();
        $user = DataService::handleDate($model,$request->all(),'users-add_or_update');
        if($user['status']==1)Log::addLogs(trans('fzs.users.handle_user').trans('fzs.common.success'),'/users/story');
        else Log::addLogs(trans('fzs.users.handle_user').trans('fzs.common.fail'),'/users/destroy');
        return $user;
    }
    /**
     *用户删除
     */
    public function destroy($id)
    {
        if (is_config_id($id, "admin.user_table_cannot_manage_ids", false))return $this->resultJson('fzs.users.notdel', 0);
        $model = new Business();
        $user = DataService::handleDate($model,['id'=>$id],'users-delete');
        if($user['status']==1)Log::addLogs(trans('fzs.users.del_user').trans('fzs.common.success'),'/users/destroy/'.$id);
        else Log::addLogs(trans('fzs.users.del_user').trans('fzs.menus.fail'),'/users/destroy/'.$id);
        return $user;
    }
    /**
     *用户基本信息编辑页面
     */
    public function userInfo(){
        $user = new Admin();
        return view('users.userinfo',['userinfo'=>$user->user()]);
    }
    /**
     *用户基本信息修改
     */
    public function saveInfo(StoreRequest $request,$type){
        if($type==1)$kind = 'update_info';
        else $kind = 'update_pwd';
        $user = DataService::handleDate(new Business(),$request->all(),'users-'.$kind);
        if($user['status']==1)Log::addLogs(trans('fzs.users.'.$kind).trans('fzs.common.success'),'/saveinfo/'.$type);
        else Log::addLogs(trans('fzs.users.'.$kind).trans('fzs.common.fail'),'/saveinfo/'.$type);
        return $user;
    }
}