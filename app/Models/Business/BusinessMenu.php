<?php


namespace App\Models\Business;


use App\Models\Traits\BusinessMenuTrait;
use Illuminate\Database\Eloquent\Model;

class BusinessMenu extends Model
{
    use BusinessMenuTrait;
    protected $table = "business_menus";

    protected $primaryKey = 'id';
    protected $hidden = ['icon', 'uri','routes','created_at','updated_at'];
    protected static $branchOrder = null;

    public static function tree($parent_id=0)
    {
        $data = BusinessMenu::where('parent_id',$parent_id)->get();  //第一次做的时候get()后面加了toArray()，页面遍历数据时报错遍历的不是对象，去掉后可行
        $arr = array();
        if (sizeof($data) !=0){
            foreach ($data as $k =>$datum) {
                $datum['children'] = self::tree($datum['id']);
                $arr[]=$datum;
            }
        }
        return $arr;
    }

    public static function editTree($parent_id,$roleId)
    {
        $data = BusinessMenu::where('parent_id',$parent_id)->get();
        $arr = array();
        if (sizeof($data) != 0){
            foreach ($data as $key=>&$datum){
                $roleMenu = BusinessRoleMenu::getInfo($roleId,$data[$key]['id']);
                if ($roleMenu!=null){
                    $datum['checked']=true;
                }
                $datum['children'] = self::editTree($datum['parent_id'],$datum['id']);
                $arr[]=$datum;
            }
        }
        return $arr;
    }

    public static function editTreeList($roleId)
    {
        $data = BusinessMenu::get()->toArray();
        foreach ($data as $key=>&$value){
            $roleMenu = BusinessRoleMenu::getInfo($roleId,$value['id']);
            if ($roleMenu!=null){
                $value['checked']=true;
            }
        }
        return self::getTreeMenu($data,'id','parent_id','children',0);
    }
    public static function getTreeMenu($data,$pk='id',$pid='parent_id',$child='children',$root)
    {
        //创建tree
        $tree = array();
        if (is_array($data)){
            //创建基于注解的数组引用
            $refer = array();
            foreach ($data as $key=>$value){
                $data[$key][$child]=[];
                $refer[$data[$key][$pk]] =& $data[$key];
            }
            foreach ($data as $key=>$value){
                //判断是否存在parent
                $parent = $data[$key][$pid];
                if ($root==$parent){
                    $tree[] = & $data[$key];
                }else{
                    if (isset($refer[$parent])){
                        $par = & $refer[$parent];
                        $par[$child][]= & $data[$key];
                    }
                }
            }
        }
        return $tree;
    }

    /**
     * 获取所有的菜单
     */
    public static function getAllAgentMenu()
    {
        $data = BusinessMenu::get()->toArray();
        return self::getAllParentMenu($data,0);
    }

    /**
     * 根据父节点的ID获取所有子节点
     */
    public static function getAllParentMenu($data,$parentId)
    {
        $menuData = array();
        foreach($data as $key=>$value){
            if($value['parent_id']==$parentId){
                BusinessMenu::getTreeMenu($data,$data[$key]);
                array_push($menuData,$data[$key]);
            }
        }
        return $menuData;
    }

    /**
     * 递归
     */
    /*public static function getTreeMenu($data,$menu)
    {
        $children = AgentMenu::getChildList($data,$menu);
        $menu['children']=$children;
        foreach($children as $key=>$value)
        {
            $c = AgentMenu::getChildList($data,$children[$key]);
            if($c != null && count($c) > 0){
                AgentMenu::getTreeMenu($data,$children[$key]);
            }
        }
    }*/

    /**
     * 得到字节点列表
     */
    public static function getChildList($data,$menu)
    {
        $map = array();
        foreach($data as $key=>$value){
            if($menu['parent_id']==$data[$key]['parent_id'])
            {
                array_push($map,$data[$key]);
            }
        }
        return $map;
    }
}