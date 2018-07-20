<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\phongban;
class phongbanController extends Controller
{
    //
    public function danhsach()
    {
    	$arr = phongban::getAll();
    	return view('admin.phongban.danhsach',['arr' => $arr]);
    }
    public function them()
    {
        $phongbans = phongban::getAll();
        return view('admin.phongban.them',['phongbans'=>$phongbans]);
    }
    public function themprocess(Request $request)
    {
        $check = phongban::checkphongban($request->txtTenphongban);
        if($check[0]->checker > 0)
        {
            return redirect()->route('danhsachphongban')->with("message","phòng ban đã tồn tại!");
        }else
        {
            $obj = new phongban();
            $obj->tenphongban = $request->txtTenphongban;
            phongban::themphongban($obj);
            return redirect()->route('danhsachphongban');
        }
    }
    public function suaphongban($maphongban)
    {
    	$phongbans = phongban::getById($maphongban);
        $phongban = $phongbans[0];
    	return view('admin.phongban.sua',['phongban' => $phongban]);
    }
    public function suaprocess(Request $request)
    {
        $check = phongban::checkphongban($request->txtTenphongban);
        if($check[0]->checker > 0)
        {
            return redirect()->route('danhsachphongban')->with("message","phòng ban đã tồn tại!");
        }else
        {
        	$arr = phongban::getById($request->txtMaphongban);
            $obj = $arr[0];
        	$obj->tenphongban = $request->txtTenphongban;
        	phongban::suaphongban($obj);
        	return redirect()->route('danhsachphongban');
        }
    }
    public function xoaprocess($maphongban)
    {
    	phongban::xoaphongban($maphongban);
    	return redirect()->route('danhsachphongban');
    }
}
