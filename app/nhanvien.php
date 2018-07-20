<?php

namespace App;
use DB;
use Illuminate\Database\Eloquent\Model;

class nhanvien extends Model
{
    //
    static function getAll()
    {
        $arr = DB::select('select nhanvien.manv,nhanvien.matkhau,nhanvien.hoten,nhanvien.sdt,nhanvien.ngaysinh,nhanvien.gioitinh,nhanvien.tienluong,phongban.tenphongban,nhanvien.calam,chucvu.tenchucvu from nhanvien inner join phongban on nhanvien.maphongban=phongban.maphongban inner join chucvu on nhanvien.machucvu = chucvu.machucvu');
        return $arr;
    }
    static function getById($manv)
    {
        $obj=DB::select('select * from nhanvien where manv=? limit 1',[$manv]);
        return $obj;
    }
    static function themNhanVien($obj)
    {
        DB::INSERT( "INSERT INTO `nhanvien`( `taikhoan`, `matkhau`, `hoten`, `sdt`, `ngaysinh`, `gioitinh`, `maphongban`, `machucvu`, `tienluong`, `calam`) VALUES ('$obj->taikhoan','$obj->matkhau','$obj->hoten','$obj->sdt','$obj->ngaysinh','$obj->gioitinh','$obj->maphongban','$obj->machucvu','$obj->tienluong','$obj->calam') " );
    }
    static function suaNhanVien($obj)
    {
        DB::update("update nhanvien set hoten=?, sdt=?, ngaysinh=?, gioitinh=?, maphongban=?, machucvu=?, tienluong=?, calam=? where manv=? ",[$obj->hoten,$obj->sdt,$obj->ngaysinh,$obj->gioitinh,$obj->maphongban,$obj->machucvu,$obj->tienluong,$obj->calam,$obj->manv]);
    }
    static function xoaNhanVien($manv)
    {
        DB::delete("delete from nhanvien where manv=?",[$manv]);
    }
    static function checkTaiKhoan($taikhoan)
    {
       $check = DB::select('select count(*) as checker from nhanvien where taikhoan=?',[$taikhoan]);
       return $check;
    }
    static function checkRoll($obj)
    {
        $arr = DB::select('select taikhoan,matkhau,manv from nhanvien where taikhoan=? and matkhau=? ',[$obj->taikhoan,$obj->matkhau]);
        $check = count($arr);
        return $check;
    }
    static function laythongtincanhan($taikhoan)
    {
        $arr = DB::select('select nhanvien.manv,nhanvien.hoten,nhanvien.sdt,nhanvien.ngaysinh,nhanvien.gioitinh,phongban.tenphongban from nhanvien inner join phongban on nhanvien.maphongban=phongban.maphongban where nhanvien.taikhoan=?',[$taikhoan]);
        return $arr;
    }
    static function checkCaLam($manv)
    {
        $arr = DB::select(" select calam from nhanvien where manv=?",[$manv]);
        return $arr;
    }
    static function thongtincanhan($manv)
    {
        $arr = DB::select(' select nhanvien.manv,nhanvien.hoten,nhanvien.sdt,nhanvien.ngaysinh,nhanvien.gioitinh,phongban.tenphongban from nhanvien inner join phongban on nhanvien.maphongban=phongban.maphongban inner join chucvu on nhanvien.machucvu=chucvu.machucvu where nhanvien.manv=?',[$manv]);
        return $arr;
    }
    static function getById2($taikhoan)
    {
        $arr = DB::select("select * from nhanvien where taikhoan=?",[$taikhoan]);
        return $arr;
    }
}
