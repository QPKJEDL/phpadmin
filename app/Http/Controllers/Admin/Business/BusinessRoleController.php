<?php


namespace App\Http\Controllers\Admin\Business;


use App\Http\Controllers\Controller;
use App\Http\Requests\StoreRequest;
use App\Models\Business\BusinessMenu;
use App\Models\Business\BusinessRole;
use App\Models\Business\BusinessRoleMenu;

class BusinessRoleController extends Controller
{
    /**
     * 列表
     */
    public function index(){
        return view('business.role.list',['list'=>BusinessRole::get()->toArray()]);
    }

    /**
     * 角色编辑
     */
    public function edit($id=0)
    {
        $info = $id?BusinessRole::find($id):[];
        if ($info!=null)
        {
            return view('business.role.edit', ['id'=>$id,'info'=>$info,'tree'=>BusinessMenu::editTreeList($id)]);
        }else{
            dump(BusinessMenu::tree());
            return view('business.role.edit', ['id'=>$id,'info'=>$info,'tree'=>BusinessMenu::tree()]);
        }
    }

    public function store(StoreRequest $request)
    {
        $data = $request->all();
        $menus = $request->input('menus');
        $menusData = json_decode($menus,true);
        unset($data['id']);
        unset($data['menus']);
        unset($data['_token']);
        $data['created_at']=date('Y-m-d H:i:s',time());
        $count = BusinessRole::insertGetId($data);
        if ($count){
            $this->insertAgentRole($menusData,$count);
            return ['msg'=>'添加成功','status'=>1,'id'=>$count];
        }else{
            return ['msg'=>'添加失败','status'=>0];
        }
    }
    public function destroy($id)
    {
        $count = BusinessRole::where('id','=',$id)->delete();
        if($count){
            $this->deleteAgentRoleMenu($id);
            return ['msg'=>'删除成功','status'=>1];
        }else{
            return ['msg'=>'删除失败','status'=>0];
        }
    }

    public function update(StoreRequest $request)
    {
        $data = $request->all();
        $menus = $request->input('menus');
        $id = $request->input('id');
        $menuData = json_decode($menus,true);
        unset($data['id']);
        unset($data['menus']);
        unset($data['_token']);
        $data['updated_at']=date('Y-m-d H:i:s',time());
        $count = BusinessRole::where('id',$id)->update($data);
        if ($count!==false){
            if ($menuData!=null){
                $this->deleteAgentRoleMenu($id);
            }
            $this->insertAgentRole($menuData,$id);
            return ['msg'=>'操作成功','status'=>1];
        }else{
            return ['msg'=>'操作失败','status'=>0];
        }
    }
    public function deleteAgentRoleMenu($roleId){
        BusinessRoleMenu::where('role_id','=',$roleId)->delete();
    }

    public function insertAgentRole($data,$roleId){
        if(is_array($data)){
            if (count($data)>0){
                foreach ($data as $key=>$value)
                {
                    BusinessRoleMenu::insert(['role_id'=>$roleId,'menu_id'=>$data[$key]['id']]);
                }
            }
        }
    }
}