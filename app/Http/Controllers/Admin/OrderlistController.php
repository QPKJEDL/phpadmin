<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests\StoreRequest;
use App\Models\Order;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class OrderlistController extends Controller
{
    /**
     * 订单列表
     */
    public function index(StoreRequest $request){
        $order =new Order;
        $order->setTable('order_'."20200409");
        $sql=$order->orderBy('creatime','desc');

            $data=$sql->paginate(10)->appends($request->all());
            foreach ($data as $key=>$value){
                $data[$key]['creatime']=date("Y-m-d H:i:s",$value["creatime"]);
                $data[$key]['pay_time']=date("Y-m-d H:i:s",$value["pay_time"]);
            }

        $min=config('admin.min_date');
        return view('orderlist.list',['list'=>$data,'min'=>$min,'input'=>$request->all()]);
    }
    /**
     * 码商收款
     */
    protected function sk_status($type){
        switch ($type){
            case $type==0:
                $name='未收款';
                return $name;
                break;
            case $type==1:
                $name='手动收款';
                return $name;
                break;
            case $type==2:
                $name='自动收款';
                return $name;
                break;
        }
    }
    /**
     * paytype判断
     */
    protected function payName($type){
        switch ($type){
            case $type==0:
                $name='默认';
                return $name;
                break;
            case $type==1:
                $name='微信';
                return $name;
                break;
            case $type==2:
                $name='支付宝';
                return $name;
                break;
        }
    }
    /**
     * status判断
     */
    protected function statusName($type){
        switch ($type){
            case $type==0:
                $name='未支付';
                return $name;
                break;
            case $type==1:
                $name='支付成功';
                return $name;
                break;
            case $type==2:
                $name='过期';
                return $name;
                break;
            case $type==3:
                $name='取消';
                return $name;
                break;
        }
    }
    /**
     * callback判断
     */
    protected function callback($type){
        switch ($type){
            case $type==1:
                $name='推送成功';
                return $name;
                break;
            case $type==2:
                $name='推送失败';
                return $name;
                break;
        }
    }
}
