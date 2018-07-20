<?php

namespace App\Http\Controllers;
use App\diemdanh;
use App\nhanvien;
use App\calamviec;  
use Illuminate\Http\Request;

class diemdanhController extends Controller
{
    //
    public function checkin()
    {
        $manv=session('manv');
        /*
        $diemdanh = diemdanh::KiemTraCheckIn($manv);
        $obj = new diemdanh();
        $obj = $diemdanh[0];
        $thoigiancheckin = $obj->checkin;
        $gio = date('Y-m-d',strtotime($thoigiancheckin));
        echo $gio;
        */
        $onetime = diemdanh::diemDanh1Lan1Ngay($manv);
        $SMT = diemdanh::KiemTraDiemDanh();
    	return view('nhanvien.diemdanh.checkin', ['SMT' => $SMT,'onetime' => $onetime]);
    }
    public function checkinprocess(Request $request)
    {   
        $manv = session('manv');
        session()->put('checkin','check');
        echo $manv;
    	diemdanh::CheckIn($manv);
        // date_default_timezone_set("Asia/Ho_Chi_Minh");
        // /*$diemdanh = diemdanh::KiemTraCheckIn($manv);
        // $obj = new diemdanh();
        // $obj = $diemdanh[0];*/
        // // $thoigiancheckin = $obj->checkin;
        // $thoigiancheckin= date('H:i:s',time());
        // $thoigiancheckout = $obj->checkout;
        // $gio = date('H:i:s',strtotime($thoigiancheckin));
        // // echo $gio;
        // // echo "<br>";
        $calam = diemdanh::KiemTraDiemDanh();
        $chuyencan = diemdanh::kiemTraChuyenCan($manv);
        // var_dump( $chuyencan);
        if($chuyencan[0]->chuyencan == 1)
        {
            diemdanh::Muon($manv);
        }
        return redirect()->route('checkin');
        // $arrCalam = calamviec::kiemTraCa($manv);
        // $exp_CaLam= explode(",", $arrCalam[0]->calam);
        // $calam=$arrCalam[0]->calam;
        
        // foreach($exp_CaLam as $ca){
        //     $mangCa[]=calamviec::find($ca);
        // }
        // $SMT=calamviec::whereIn('maca',$exp_CaLam)->orderBy('giobatdau')->orderBy('gioketthuc')->get();

        // foreach($SMT as $ca){
        //     $bd_ts=strtotime($ca->giobatdau);
        //     $kt_ts=strtotime($ca->gioketthuc);
        //     $ci_ts=strtotime($thoigiancheckin);

        //     if($kt_ts > $ci_ts)
        //     {

        //         if($bd_ts-$ci_ts>0)
        //         {
        //             echo "CHECK IN SOM CA ".$ca->maca;
        //             diemdanh::DungGio($manv);
        //             break;
        //         }else if($bd_ts-$ci_ts<0)
        //         {
        //             echo "check in muon ca".$ca->maca;
        //             diemdanh::Muon($manv);
        //             break;
        //         }
        //         break;
        //     }
        // }

        // return response()->json($mangCa);
        
        
            /*$arrCalam = calamviec::kiemTraCa($maca);
            foreach($arrCalam as $canhanvien)
            {

                if(strtotime($canhanvien->giobatdau < strtotime($gio) || strtotime($canhanvien->giobatdau == strtotime($gio))))
                {e
                    echo "som";
                }else
                {
                    echo "muon";
                }
            }
        */
        

        /*
        
        $giocodinh = '08:00:00';
        if(strtotime($gio) < strtotime($giocodinh) || strtotime($gio) == strtotime($giocodinh))
        {
            echo "dung gio";
        }
        else if(strtotime($gio) > strtotime($giocodinh)) 
        {
            diemdanh::CapNhatTinhTrang($manv);
            echo "muon";
        }
        */
    }
    public function checkout()
    {
        return view('nhanvien.diemdanh.checkout');
    }
    public function checkoutprocess(Request $request)
    {
        session()->forget('checkin');
        $manv = $request->manv;
        diemdanh::CheckOut($manv);
        $caNv = diemdanh::soCaCuaNv($manv);
        $chuyencan = diemdanh::kiemTraChuyenCan($manv);
        $checkout = diemdanh::getDiemDanh($manv);
        foreach ($caNv as $ca)
        {
            if(strtotime($checkout[0]->checkout) < strtotime($ca->gioketthuc))
            {
                diemdanh::checkoutSom($manv);
            }
            else if(strtotime($checkout[0]->checkout) < strtotime($ca->gioketthuc) && $chuyencan[0]->chuyencan == 1)
            {
                diemdanh::checkoutSomvaMuon($manv);
            }
        }
        return redirect()->route('checkin');
        // date_default_timezone_set("Asia/Ho_Chi_Minh");
        // $thoigiancheckout = date('H:i:s',time());
        // $arrCalam = calamviec::kiemTraCa($manv);
        // $exp_CaLam= explode(",", $arrCalam[0]->calam);
        // $calam=$arrCalam[0]->calam;
        // $SMT=calamviec::whereIn('maca',$exp_CaLam)->orderBy('giobatdau')->orderBy('gioketthuc')->get();
        // return response()->json($SMT);
        // foreach($SMT as $ca){
        //     $bd_ts=strtotime($ca->giobatdau);
        //     $kt_ts=strtotime($ca->gioketthuc);
        //     $co_ts=strtotime($thoigiancheckout);

        //     if($kt_ts > $co_ts)
        //     {

        //         if($bd_ts-$co_ts>0)
        //         {
        //             echo "CHECK IN SOM CA ".$ca->maca;
        //             diemdanh::DungGio($manv);
        //             break;
        //         }else if($bd_ts-$co_ts<0)
        //         {
        //             echo "check in muon ca".$ca->maca;
        //             diemdanh::Muon($manv);
        //             break;
        //         }
        //         break;
        //     }
        // }
    }   
}

