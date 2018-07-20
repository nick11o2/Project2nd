<?php

namespace App;
use DB;
use Illuminate\Database\Eloquent\Model;

class admin extends Model
{
    //
    static function checkRoll($obj)
    {
    	$arr=DB::raw("select * from admin where taikhoan=? and matkhau=? ",[$obj->taikhoan,$obj->matkhau]);
    	$check = count($arr);
    	return $check;
    }
}
