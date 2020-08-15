<?php


namespace App\Http\Controllers\Admin;


use App\Models\SysBalanceRecord;
use Illuminate\Http\Request;

class SysBalanceRecordController
{
    public function index(Request $request)
    {
        $map = array();
        $data = SysBalanceRecord::where($map)->paginate(10)->appends($request->all());
        return view('balanceRecord.list',['list'=>$data,'input'=>$request->all()]);
    }
}