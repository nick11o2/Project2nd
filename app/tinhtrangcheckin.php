<?php

namespace App;
use DB;
use Illuminate\Database\Eloquent\Model;

class tinhtrang extends Model
{
    //
    static function getAll()
    {
    	$arr=DB::raw("select * from tinhtrangcheckin");
    	return $arr;
    }
    static function themTinhTrang($obj)
    {
    	DB::raw(" INSERT INTO `tinhtrangcheckin`(`tentinhtrang`) VALUE ('$obj->tentinhtrang') ");
    }
    static function suaTinhTrang($obj)
    {
    	$matinhtrangcheckin=$obj->matinhtrangcheckin;
    	$tentinhtrang=$obj->tentinhtrang;
    	DB::raw("update tinhtrangcheckin set tentinhtrang=? where matinhtrangcheckin=?",['$tentinhtrang','$matinhtrangcheckin']);
    }
    static function xoaTinhTrang($matinhtrangcheckin)
    {
    	DB::raw("delete from tinhtrangcheckin where matinhtrangcheckin=?",[$matinhtrangcheckin]);
    }
}
