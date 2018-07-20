<?php

namespace App;
use DB;
use Illuminate\Database\Eloquent\Model;

class chucvu extends Model
{
    //
    static function getAll()
    {
    	$arr=DB::select('select * from chucvu');
    	return $arr;
    }
    static function getById($machucvu)
    {
        $arr = DB::select("select * from chucvu where machucvu=?",[$machucvu]);
        return $arr;
    }
    static function themchucvu($obj)
    {
    	DB::INSERT(" INSERT INTO `chucvu`(`tenchucvu`) VALUES ('$obj->tenchucvu') ");
    }
    static function suachucvu($obj)
    {
    	$machucvu=$obj->machucvu;
    	$tenchucvu=$obj->tenchucvu;
    	DB::update("update chucvu set tenchucvu=? where machucvu=?",[$tenchucvu,$machucvu]);
    }
    static function xoachucvu($machucvu)
    {
    	DB::delete("delete from chucvu where machucvu=?",[$machucvu]);
    }
    static function checkChucVu($tenchucvu)
    {
        $check = DB::select("select count(*) as checker from chucvu where tenchucvu=?",[$tenchucvu]);
        return $check;
    }
}
