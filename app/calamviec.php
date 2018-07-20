<?php

namespace App;
use DB;
use Illuminate\Database\Eloquent\Model;

class calamviec extends Model
{
    protected $table='calamviec';
    protected $primaryKey='maca';
    public $timestamps=false;

	static function getAll()
	{
		$arr = DB::select(" select * from calamviec");
		return $arr;
	}
	static function themCaLam($obj)
	{
		DB::insert(" INSERT INTO `calamviec`(`giobatdau`, `gioketthuc`) VALUES ('$obj->giobatdau','$obj->gioketthuc') ");
	}
	static function suaCaLam($obj)
	{
		DB::update("update calamviec set giobatdau=?, gioketthuc=? where maca=? ",[$obj->giobatdau,$obj->gioketthuc,$obj->maca]);
	}
	static function xoaCaLam($maca)
	{
		DB::delete("delete from calamviec where maca=?",[$maca]);
	}
	static function getById($maca)
	{
		$arr = DB::select("select * from calamviec where maca=?",[$maca]);
		return $arr;
	}
	static function checkRoll($obj)
	{
		$check = DB::select(" select * from calamviec where giobatdau=? and gioketthuc=?",[$obj->giobatdau, $obj->gioketthuc]);
		return count($check);
	}
	static function checkRoll1($obj)
	{
		$check = DB::select(" select * from calamviec where giobatdau=?",[$obj->giobatdau]);
		return count($check);
	}
	static function checkRoll2($obj)
	{
		$check = DB::select(" select * from calamviec where gioketthuc=?",[$obj->gioketthuc]);
		return count($check);
	}
	static function kiemTraCa($manv)
    {
        // $arr = DB::select(" select * from calamviec where maca in( select calam from nhanvien where manv=?) ",[$manv]);
        $arr = DB::select(" select * from nhanvien where manv =? limit 1 ",[$manv]);
        return $arr;
    }
    static function caConLai($maca)
    {
    	$arr = DB::select(" select * from calamviec where not maca=?",[$maca]);
    	return $arr;
    }
}
