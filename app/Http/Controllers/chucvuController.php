<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\chucvu;
class chucvuController extends Controller
{
    //
    public function danhsach()
    {
    	$arr = chucvu::getAll();
    	return view('admin.chucvu.danhsach',['arr' => $arr]);
    }
    public function them()
    {
        $chucvus = chucvu::getAll();
        return view('admin.chucvu.them',['chucvus'=>$chucvus]);
    }
    public function themprocess(Request $request)
    {
        $check = chucvu::checkChucVu($request->txtTenchucvu);
        if($check[0]->checker > 0)
        {
            return redirect()->route('danhsachchucvu')->with("message","chức vụ đã tồn tại!");
        }else
        {
        	$obj = new chucvu();
        	$obj->tenchucvu = $request->txtTenchucvu;
        	chucvu::themchucvu($obj);
            return redirect()->route('danhsachchucvu');
        }
    }
    public function suachucvu($machucvu)
    {
    	$chucvus = chucvu::getById($machucvu);
        $chucvu = $chucvus[0];
    	return view('admin.chucvu.sua',['chucvu' => $chucvu]);
    }
    public function suaprocess(Request $request)
    {
        $check = chucvu::checkChucVu($request->txtTenchucvu);
        if($check[0]->checker > 0)
        {
            return redirect()->route('danhsachchucvu')->with("message","chức vụ đã tồn tại!");
        }else
        {
    	$arr = chucvu::getById($request->txtMachucvu);
        $obj = $arr[0];
    	$obj->tenchucvu = $request->txtTenchucvu;
    	chucvu::suachucvu($obj);
    	return redirect()->route('danhsachchucvu');
        }
    }
    public function xoaprocess($machucvu)
    {
    	chucvu::xoachucvu($machucvu);
    	return redirect()->route('danhsachchucvu');
    }
}
