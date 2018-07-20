<?php

namespace App;
use DB;
use Illuminate\Database\Eloquent\Model;

class tinhluongmodel extends Model
{
    static function getAll()
    {
    	$arr=DB::raw("select tienluong.songaylamviec,tienluong.songaylamviecthucte,tienluong.solandimuon,tienluong.songaynghi,nhanvien.hoten,nhanvien.sdt,nhanvien.ngaysinh,nhanvien.gioitinh,nhanvien.gioitinh,nhanvien.tienluong from tienluong inner join nhanvien on tienluong.manv=nhanvien.manv");
    	return $arr;
    }
}
