<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\calamviec;
class calamController extends Controller
{
    //
    public function danhsach()
    {
    	$arr = calamviec::getAll();
    	return view('admin.calamviec.danhsach', ['arr' => $arr]);
    }
    public function them()
    {
    	return view('admin.calamviec.them');
    }
    public function themprocess(Request $request)
    {
        $obj = new calamviec();
        $obj->giobatdau = ($request->giobatdau);
        $obj->gioketthuc = ($request->gioketthuc);
        $check = calamviec::checkRoll($obj);
        $check1 = calamviec::checkRoll1($obj);
        $check2 = calamviec::checkRoll2($obj);
        $calam = calamviec::getAll();
        foreach($calam as $ca)
        {
            if(strtotime($ca->giobatdau) < strtotime($obj->giobatdau) && strtotime($ca->gioketthuc) > strtotime($obj->gioketthuc) )
            {
                 return redirect()->route('danhsachcalam')->with('message','Đã có ca làm có thời gian nằm trong khoảng thời gian này');
            }
        }
        if(strtotime($obj->gioketthuc) < strtotime($obj->giobatdau))
        {
            return redirect()->route('themcalam')->with('message','Thời Gian Kết Thúc không được sớm hơn Thời Gian Bắt Đầu');
        }else if($check > 0 || $check1 > 0 || $check2 > 0)
        {
            return redirect()->route('danhsachcalam')->with('message','Ca làm bạn tạo trùng thời gian với 1 ca làm tồn tại');
        }else
        {
            calamviec::themCaLam($obj);
            return redirect()->route('danhsachcalam');
        }
        
    }
    public function suacalam($maca)
    {
        $arr = calamviec::getById($maca);
        $obj = new calamviec();
        $obj = $arr[0];
        return view('admin.calamviec.sua',['obj'=>$obj]);
    }
    public function suaprocess(Request $request)
    {
        $obj = new calamviec();
        $obj->maca = $request->maca;
        $obj->giobatdau = $request->giobatdau;
        $obj->gioketthuc = $request->gioketthuc;
        $check = calamviec::checkRoll($obj);
        $check1 = calamviec::checkRoll1($obj);
        $check2 = calamviec::checkRoll2($obj);
        $calam = calamviec::caConLai($obj->maca);

        foreach($calam as $ca)
        {
            if(strtotime($ca->giobatdau) < strtotime($obj->giobatdau) && strtotime($ca->gioketthuc) > strtotime($obj->gioketthuc) )
            {
                 return redirect()->route('danhsachcalam')->with('message','Đã có ca làm có thời gian nằm trong khoảng thời gian này');
            }
        }
        if(strtotime($obj->gioketthuc) < strtotime($obj->giobatdau))
        {
            return redirect()->route('suacalam')->with('message','Thời Gian Kết Thúc không được sớm hơn Thời Gian Bắt Đầu');
        }else if($check > 0 || $check1 > 0 || $check2 > 0)
        {
            return redirect()->route('danhsachcalam')->with('message','Ca làm bạn tạo trùng thời gian với 1 ca làm tồn tại');
        }else
        {
            calamviec::suaCaLam($obj);
            return redirect()->route('danhsachcalam');
        }   

    }
    public function xoaprocess($maca)
    {
        calamviec::xoaCaLam($maca);
        return redirect()->route('danhsachcalam');
    }
}
