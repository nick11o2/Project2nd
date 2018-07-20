<?php

namespace App;
use DB;
use Illuminate\Database\Eloquent\Model;

class thongke extends Model
{
    //
    static function soCaNghi($manv)
    {
        $arr = DB::select(" SELECT 
        diemdanh.checkin,diemdanh.checkout,calamviec.maca,calamviec.giobatdau,calamviec.gioketthuc,diemdanh.ngay 
        from diemdanh 
        inner join calamviec 
        where  maca in (select calam from nhanvien where manv = ?) 
        and ( (timestampdiff(minute,checkin,gioketthuc)<0) or (timestampdiff(minute,checkout,giobatdau)>0) ) 
        group by ngay,checkin,checkout,calamviec.maca,calamviec.giobatdau,calamviec.gioketthuc",[$manv]);
        return $arr;
    }
    static function soLanDiMuon($manv)
    {
        $arr = DB::select(" SELECT * from diemdanh 
            inner join calamviec 
            where maca in (select calam from nhanvien where manv=$manv) 
            and ((timestampdiff(minute,diemdanh.checkin,calamviec.giobatdau))>-31 
            and (timestampdiff(minute,diemdanh.checkin,calamviec.giobatdau))<0 )
            and manv=$manv");
        return $arr;
    }
    static function soLanDiSom($manv)
    {
        $arr = DB::select("SELECT DISTINCT(madiemdanh),checkin,checkout,ngay from diemdanh 
            inner join calamviec
            where maca in (select calam from nhanvien where manv=$manv)
            and ((timestampdiff(minute,diemdanh.checkin,calamviec.giobatdau))>=0)
            and (timestampdiff(minute,diemdanh.checkin,calamviec.giobatdau) < 1440)
            and manv=$manv");
    	/*$arr = DB::select(" select * from diemdanh 
    		inner join calamviec
    		where maca in (select maca from nhanvien where manv=$manv)
    		and ((timestampdiff(minute,diemdanh.checkin,calamviec.giobatdau))>0)
            and manv=$manv group by diemdanh.madiemdanh,diemdanh.manv,diemdanh.checkin,diemdanh.checkout,diemdanh.ngay,diemdanh.matinhtrang,calamviec.maca,calamviec.giobatdau,calamviec.gioketthuc");*/
    	return $arr;
    }
    static function tongSoGioLam()
    {
    	$arr = DB::select(" SELECT SUM(timestampdiff(minute,checkin,checkout)/60) as sogio FROM `diemdanh` group by manv ");
    	return $arr;
    }
    static function soLuongTrongNgay()
    {
    	$arr = DB::select(" SELECT nhanvien.manv,nhanvien.hoten,nhanvien.sdt,nhanvien.ngaysinh,nhanvien.gioitinh,phongban.tenphongban,chucvu.tenchucvu,diemdanh.checkin,diemdanh.checkout,diemdanh.ngay,tinhtrang.tentinhtrang,tinhtrang.hesoluong,(timestampdiff(minute,checkin,checkout)/60) as sogio, (nhanvien.tienluong*tinhtrang.hesoluong) as luongthucte, ( (timestampdiff(minute,checkin,checkout)/60)* (nhanvien.tienluong*tinhtrang.hesoluong)) as luongthuctetrongngay 
    		from diemdanh 
    		inner join nhanvien 
    		on diemdanh.manv=nhanvien.manv 
    		inner join tinhtrang 
    		on diemdanh.matinhtrang=tinhtrang.matinhtrang
            inner join phongban
            on phongban.maphongban=nhanvien.maphongban
            inner join chucvu
            on chucvu.machucvu=nhanvien.machucvu
            where diemdanh.ngay=date(now())");
    	return $arr;
    }
    static function tatCaNhanVien()
    {
        $arr = DB::select(" SELECT * from nhanvien 
            inner join phongban 
            on nhanvien.maphongban=phongban.maphongban
            inner join chucvu
            on nhanvien.machucvu=chucvu.machucvu");
        return $arr;
    }
    static function soLuongTrongThang($id)
    {
    	$arr = DB::select(" SELECT nhanvien.manv,sum(timestampdiff(minute,diemdanh.checkin,diemdanh.checkout)/60) as tongsogio,nhanvien.hoten,nhanvien.sdt,phongban.tenphongban,chucvu.tenchucvu,nhanvien.tienluong,sum(tinhtrang.hesoluong) as heso from diemdanh 
            inner join nhanvien 
            on nhanvien.manv=diemdanh.manv 
            inner join phongban 
            on nhanvien.maphongban=phongban.maphongban
            inner join chucvu 
            on nhanvien.machucvu=chucvu.machucvu 
            inner join tinhtrang 
            on tinhtrang.matinhtrang=diemdanh.matinhtrang 
            where month(diemdanh.ngay) = ? 
            group by nhanvien.manv,nhanvien.hoten,nhanvien.sdt,phongban.tenphongban,nhanvien.tienluong,chucvu.tenchucvu ",[$id]);
    	return $arr;
    }
    static function tongSoGioLamNv($manv)
    {
        $arr = DB::select(" SELECT Sum(timestampdiff(minute,checkin,checkout)/60) as sogio from diemdanh where manv=?",[$manv]);
        return $arr;
    }
    static function checkOutSom($manv)
    {
        $arr = DB::select("SELECT * from diemdanh where manv=? and matinhtrang=3",[$manv]);
        return $arr;
    }
    static function diMuonTheoThang($id,$manv)
    {
        $arr = DB::select("SELECT * from diemdanh 
            inner join calamviec 
            where maca in (select calam from nhanvien where manv=?) 
            and ((timestampdiff(minute,diemdanh.checkin,calamviec.giobatdau))>-31 
            and (timestampdiff(minute,diemdanh.checkin,calamviec.giobatdau))<0 )
            and manv=?
            and month(diemdanh.ngay) = ? ",[$manv,$manv,$id]);
        $dem = count($arr);
        return $dem;
    }
    static function caNghiTheoThang($id,$manv)
    {
        $arr = DB::select(" SELECT 
        diemdanh.checkin,diemdanh.checkout,calamviec.maca,calamviec.giobatdau,calamviec.gioketthuc,diemdanh.ngay 
        from diemdanh 
        inner join calamviec 
        where  maca in (select calam from nhanvien where manv = $manv) 
        and ( (timestampdiff(minute,checkin,gioketthuc)<0) or (timestampdiff(minute,checkout,giobatdau)>0) ) 
        and month(diemdanh.ngay) = $id
        group by ngay,checkin,checkout,calamviec.maca,calamviec.giobatdau,calamviec.gioketthuc");
        $dem = count($arr);
        return $dem;
    }
    static function diSomTheoThang($id,$manv)
    {
        $arr = DB::select("SELECT DISTINCT(madiemdanh),checkin,checkout,ngay from diemdanh 
            inner join calamviec
            where maca in (select calam from nhanvien where manv=$manv)
            and ((timestampdiff(minute,diemdanh.checkin,calamviec.giobatdau))>=0)
            and (timestampdiff(minute,diemdanh.checkin,calamviec.giobatdau) < 1440)
            and manv=$manv
            and month(diemdanh.ngay) = $id");
        $dem = count($arr);
        return $dem;
    }
}
