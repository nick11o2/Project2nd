<?php

namespace App;
use DB;
use Illuminate\Database\Eloquent\Model;

class diemdanh extends Model
{
    //
    protected $table = 'diemdanh';
    public $timestamps = false;
    static function CheckIn($manv)
    {
        date_default_timezone_set("Asia/Ho_Chi_Minh");
    	$time = date('H:i:s', time());
        $date = date('Y-m-d',time());
        //date_default_timezone_set("Asia/Ho_Chi_Minh");
    	DB::insert("INSERT INTO `diemdanh` (`manv`, `checkin`, `checkout`, `ngay` ) VALUES ( '$manv','$time', '$time', '$date' )");
    }
    static function CheckOut($manv)
    {
        date_default_timezone_set("Asia/Ho_Chi_Minh");
    	$datetime = date('Y-m-d H:i:s', time());
    	DB::update("update diemdanh set checkout='$datetime' where madiemdanh = (select * from (select MAX(madiemdanh) as MAX from diemdanh where manv=$manv ) t) ");
        //update diemdanh set checkout='$thoigian' where madiemdanh = (select max(madiemdanh) from diemdanh where manv=$manv )
    }
    static function KiemTraCheckIn($manv)
    {
       $arr = DB::select(" select * from diemdanh where date(checkin) = date(now()) ");
       return $arr;
    }
    static function DungGio($manv)
    {
        DB::update(" update diemdanh set matinhtrang = 1 where madiemdanh = (select * from (select MAX(madiemdanh) as MAX from diemdanh where manv=?) t)",[$manv]);
    }
    static function Muon($manv)
    {
        DB::update(" update diemdanh set matinhtrang = 2 where madiemdanh = (select * from (select MAX(madiemdanh) as MAX from diemdanh where manv=?) t)",[$manv]);
    }
    static function KiemTraDiemDanh()
    {
        $arr = DB::select(" Select * from calamviec where abs(Timestampdiff(minute, now(), giobatdau)) < 30");
        return $arr;
    }
    static function DiLam($manv)
    {
        $arr = DB::select(" select * from diemdanh where date(checkin) = date(now()) and manv=? ",[$manv]);
        return $arr;
    }
    static function getDiemDanh($manv)
    {
        $arr = DB::select(" select * from diemdanh where madiemdanh = (select * from (select MAX(madiemdanh) as MAX from diemdanh where manv=?) t)",[$manv]);
        return $arr;
    }
    static function soCaNghi($manv)
    {
        $arr = DB::select(" select 
        diemdanh.checkin,diemdanh.checkout,calamviec.maca,calamviec.giobatdau,calamviec.gioketthuc,diemdanh.ngay 
        from diemdanh 
        inner join calamviec 
        where  maca in (select maca from nhanvien where manv = ?) 
        and ( (timestampdiff(minute,checkin,gioketthuc)<0) or (timestampdiff(minute,checkout,giobatdau)>0) ) group by ngay",[$manv]);
        return $arr;
    }
    static function kiemTraChuyenCan($manv)
    {
        $arr = DB::select(" select 
            diemdanh.madiemdanh,diemdanh.manv,diemdanh.checkin,diemdanh.checkin,diemdanh.checkout,
            diemdanh.ngay,diemdanh.matinhtrang,calamviec.maca,calamviec.giobatdau,calamviec.gioketthuc,
            Timestampdiff(minute,diemdanh.checkin,calamviec.giobatdau)<0 as chuyencan 
            from diemdanh inner join calamviec 
            where madiemdanh = (select * from (select MAX(madiemdanh) as MAX from diemdanh where manv=?) t) 
            and abs(Timestampdiff(minute, now(), giobatdau)) < 30",[$manv]);
        return $arr;
    }
    static function diemDanh1Lan1Ngay($manv)
    {
        $arr = DB::select(" select * from diemdanh where ngay=date(now()) and madiemdanh = (select max(madiemdanh) from diemdanh where manv=?)",[$manv]);
        return $arr;
    }
    static function soLanDiMuon($manv)
    {
        $arr = DB::select(" select * from diemdanh 
            inner join calamviec 
            where maca in (select maca from nhanvien where manv=1) 
            and ((timestampdiff(minute,diemdanh.checkin,calamviec.giobatdau))>-31 
            and (timestampdiff(minute,diemdanh.checkin,calamviec.giobatdau))<0 )");
        return $arr;
    }
    static function soCaCuaNv($manv)
    {
        $arr = DB::select(" select * from calamviec where maca in( select calam from nhanvien where manv=?) ",[$manv]);
        return $arr;
    }
    static function checkoutSom($manv)
    {
        DB::update(" update diemdanh set matinhtrang = 3 where madiemdanh = (select * from (select MAX(madiemdanh) as MAX from diemdanh where manv=?) t)",[$manv]);
    }
    static function checkoutSomvaMuon($manv)
    {
        DB::update(" update diemdanh set matinhtrang = 4 where madiemdanh = (select * from (select MAX(madiemdanh) as MAX from diemdanh where manv=?) t)",[$manv]);
    }
}
