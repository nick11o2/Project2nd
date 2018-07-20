<?php

namespace App;
use DB;
use Illuminate\Database\Eloquent\Model;

class phongban extends Model
{
    //
    static function getAll()
    {
    	$arr=DB::select('select * from phongban');
    	return $arr;
    }
    static function getById($maphongban)
    {
        $arr = DB::select("select * from phongban where maphongban=?",[$maphongban]);
        return $arr;
    }
    static function themphongban($obj)
    {
    	DB::INSERT(" INSERT INTO `phongban`(`tenphongban`) VALUES ('$obj->tenphongban') ");
    }
    static function suaphongban($obj)
    {
    	$maphongban=$obj->maphongban;
    	$tenphongban=$obj->tenphongban;
    	DB::update("update phongban set tenphongban=? where maphongban=?",[$tenphongban,$maphongban]);
    }
    static function xoaphongban($maphongban)
    {
    	DB::delete("delete from phongban where maphongban=?",[$maphongban]);
    }
    static function checkPhongBan($tenphongban)
    {
        $check = DB::select("select count(*) as checker from phongban where tenphongban=?",[$tenphongban]);
        return $check;
    }
}
