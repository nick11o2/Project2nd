<?php

namespace App;
use DB;
use Illuminate\Database\Eloquent\Model;

class tinhtrang extends Model
{
    //
    static function getAll()
    {
    	$arr=DB::raw("select * from tinhtrangcheckout");
    	return $arr;
    }
    static function themTinhTrang($obj)
    {
    	DB::raw(" INSERT INTO `tinhtrangcheckout`(`tentinhtrang`) VALUE ('$obj->tentinhtrang') ");
    }
    static function suaTinhTrang($obj)
    {
    	$matinhtrangcheckin=$obj->matinhtrangcheckout;
    	$tentinhtrang=$obj->tentinhtrang;
    	DB::raw("update tinhtrangcheckout set tentinhtrang=? where matinhtrangcheckout=?",['$tentinhtrang','$matinhtrangcheckout']);
    }
    static function xoaTinhTrang($matinhtrangcheckout)
    {
    	DB::raw("delete from tinhtrangcheckout where matinhtrangcheckout=?",[$matinhtrangcheckout]);
    }
}
