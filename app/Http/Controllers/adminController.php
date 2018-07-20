<?php

namespace App\Http\Controllers;
use App\admin;
use Illuminate\Http\Request;

class adminController extends Controller
{
    //
    public function dangnhap()
    {
    	return view("dangnhap");
    }
    public function dangnhapprocess(Request $request)
    {
    	$obj= new admin();
    	$obj->taikhoan=$request->txtTaiKhoan;
    	$obj->matkhau=$request->txtMatKhau;
    	$check = admin::checkRoll($obj);
    	if($check > 0)
    	{
    		session()->put('admin',$obj->taikhoan);
    		return redirect()->route('danhsachnhanvien');
    	}
    }
    public function dangxuat()
    {
        session()->forget('admin');
        return redirect()->route('dangnhap');
    }
}
