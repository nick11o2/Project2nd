<?php

namespace App\Http\Controllers;
use App\diemdanh;
use App\nhanvien;
use App\calamviec;
use App\thongke;
use Illuminate\Http\Request;

class thongkeController extends Controller
{
    //
	public function thongketrongngay()
	{
		$thongKeTrongNgay = thongke::soLuongTrongNgay();
		$tatCaNhanVien = thongke::tatCaNhanVien();
		/*echo json_encode($thongKeTrongNgay,JSON_UNESCAPED_UNICODE).'<br><br><br>1<br>';
		echo json_encode($tatCaNhanVien,JSON_UNESCAPED_UNICODE).'<br><br><br>2<br>';*/
		foreach ($tatCaNhanVien as $key => $nv) {
			foreach ($thongKeTrongNgay as $thongke) {
				if($thongke->manv==$nv->manv)
				{
					unset($tatCaNhanVien[$key]);
				}
			}
		}
		/*foreach($tatCaNhanVien as $nv){
			echo json_encode($nv,JSON_UNESCAPED_UNICODE).'<br><br><br>';
		}
*/		/*foreach($thongKeTrongNgay as $nv){
			echo json_encode($nv,JSON_UNESCAPED_UNICODE).'<br><br><br>';
		}*/
		return view('admin.thongke.thongketrongngay',['thongKeTrongNgay' => $thongKeTrongNgay,'chuaDiLam' => $tatCaNhanVien]);
		
	}
	public function thongkechitiet($manv)
	{
		$ma = $manv;
		$soCaNghi = thongke::soCaNghi($manv);
		$soLanDiMuon = thongke::soLanDiMuon($manv);
		$soLanDiSom = thongke::soLanDiSom($manv);
		$tongGioLam = thongke::tongSoGioLamNv($manv);
		$checkOutSom = thongke::checkOutSom($manv);
		$nhanvien = nhanvien::thongtincanhan($manv);
		return view('admin.thongke.thongkechitiet',['soCaNghi' =>$soCaNghi,'soLanDiMuon' => $soLanDiMuon,'soLanDiSom' => $soLanDiSom, 'tongGioLam' => $tongGioLam, 'checkOutSom' => $checkOutSom, 'nhanvien' => $nhanvien,'manv' => $ma]);
	}
	public function thongketheothang()
	{
		return view('admin.thongke.thongketheothang');
	}
	public function demo(Request $request)
	{
		/*$data = diemdanh::join('nhanvien','diemdanh.manv','=','nhanvien.manv')->join('tinhtrang','diemdanh.matinhtrang','=','tinhtrang.matinhtrang')->join('phongban','nhanvien.maphongban','=','phongban.maphongban')->whereMonth('diemdanh.ngay',$request->id)->get();*/
		$data = thongke::soLuongTrongThang($request->id);
		return response()->json($data);
	}
	public function chiTietTheoThang(Request $request)
	{
		$dem1 = thongke::diMuonTheoThang($request->id,$request->manv);
		$dem2 = thongke::caNghiTheoThang($request->id,$request->manv);
		$dem3 = thongke::diSomTheoThang($request->id,$request->manv);
		$data = array( "thongke" => array('dimuon' => $dem1, 'canghi' => $dem2, 'disom' => $dem3));
		return response()->json($data);
	}
}
