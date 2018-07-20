<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\nhanvien;
use App\phongban;
use App\calamviec;
use App\chucvu;
class nhanvienController extends Controller
{
    //
    public function danhsach()
    {
    	$arr=nhanvien::getAll();
        $calam = calamviec::getAll();
    	return view('admin.nhanvien.danhsach',['arr'=>$arr,'calam'=>$calam]);
    }
    public function them()
    {
    	$phongbans = phongban::getAll();
        $calam = calamviec::getAll();
        $chucvus = chucvu::getAll();
    	return view('admin.nhanvien.them',['phongbans'=>$phongbans, 'calam' => $calam, 'chucvus'=>$chucvus]);
    }
    public function themprocess(Request $request)
    {
        $check = nhanvien::checkTaiKhoan($request->txtTaiKhoan);
        if($check[0]->checker > 0)
        {
            return redirect()->route('themnhanvien')->with("message","tài khoản đã tồn tại!");
        }else
        {
    	$obj = new nhanvien();
    	$obj->taikhoan = $request->txtTaiKhoan;
    	$obj->matkhau = $request->txtMatKhau;
    	$obj->hoten = $request->txtHoTen;
    	$obj->sdt = $request->txtSdt;
    	$obj->ngaysinh = $request->txtNgaySinh;
    	$obj->gioitinh = $request->rdbGioiTinh;
    	$obj->maphongban = $request->ddlphongban;
        $obj->machucvu = $request->ddlchucvu;
        $obj->tienluong = $request->txtLuong;
        $obj->calam = implode(',',$request->calam);
    	nhanvien::themNhanVien($obj);
        echo var_dump($obj);
        return redirect()->route('danhsachnhanvien');
        }
    }
    public function suanhanvien($manv)
    {
        $nhanvien = nhanvien::getById($manv);
        $phongbans = phongban::getAll();
        $chucvus = chucvu::getAll();
        $obj = new nhanvien();
        $obj = $nhanvien[0];
        $calam = calamviec::getAll();
        return view('admin.nhanvien.sua',['obj' => $obj, 'phongbans' => $phongbans, 'calam' => $calam, 'chucvus' => $chucvus]);
    }
    public function suaprocess(Request $request)
    {
        $check = nhanvien::checkTaiKhoan($request->txtTaiKhoan);
        if($check[0]->checker > 0)
        {
            return redirect()->route('suanhanvien')->with("message","tài khoản đã tồn tại!");
        }else
        {
        $obj = new nhanvien();
        $obj->manv = $request->manv;
        $obj->hoten = $request->txtHoTen;
        $obj->sdt = $request->txtSdt;
        $obj->ngaysinh = $request->txtNgaySinh;
        $obj->gioitinh = $request->rdbGioiTinh;
        $obj->maphongban = $request->ddlphongban;
        $obj->machucvu = $request->ddlchucvu;
        $obj->tienluong = $request->txtLuong;
        $obj->calam = implode(',',$request->calam);
        nhanvien::suaNhanVien($obj);
        return redirect()->route('danhsachnhanvien');
        }
    }
    public function xoaprocess($manv)
    {
        nhanvien::xoaNhanVien($manv);
        return redirect()->route('danhsachnhanvien');
    }
    public function dangnhap()
    {
        return view('nhanvien.dangnhap');
    }
    public function dangnhapprocess(Request $request)
    {
        $obj = new nhanvien();
        $obj->taikhoan = $request->txtTaiKhoan;
        $obj->matkhau = $request->txtMatKhau;
        $nhanvien = nhanvien::getById2($request->txtTaiKhoan);
        $manv = $nhanvien[0]->manv;
        $check = nhanvien::checkRoll($obj);
        if($check > 0)
        {
            session()->put('taikhoan',$obj->taikhoan);
            session()->put('manv',$manv);
            return redirect()->route('checkin');
        }else
        {
            return redirect()->route('dangnhapnhanvien')->with("message","không chính xác xin thử lại!");
        }
    }
    public function thongtincanhan()
    {
        $taikhoan = session('taikhoan');
        $arr = nhanvien::laythongtincanhan($taikhoan);
        $obj = new nhanvien();
        $obj = $arr[0];
        session()->put('manv',$obj->manv);
        return view('nhanvien.thongtincanhan.thongtin',['obj' => $obj]);
    }
    public function dangxuat()
    {
        session()->forget('checkin');
        session()->forget('manv');
        session()->forget('taikhoan');
        return redirect()->route('dangnhapnhanvien');
    }

}
