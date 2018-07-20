<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});
Route::group(['prefix' => 'Admin'], function(){
		Route::get('dangnhap','adminController@dangnhap')->name('dangnhap');
		Route::post('xulydangnhap','adminController@dangnhapprocess')->name('dangnhapprocess');
		Route::group(['prefix' => 'nhanvien'], function(){
			Route::get('/', function() {
				return redirect()->route('danhsachnhanvien');
			});
			Route::get('danhsach','nhanvienController@danhsach')->name('danhsachnhanvien')->middleware('DanhNhapMiddleware');
			Route::get('them','nhanvienController@them')->name('themnhanvien')->middleware('DanhNhapMiddleware');
			Route::get('sua/{manv}','nhanvienController@suanhanvien')->name('suanhanvien')->middleware('DanhNhapMiddleware');
			Route::get('xoa/{manv}','nhanvienController@xoaprocess')->name('xoanhanvien')->middleware('DanhNhapMiddleware');
			Route::post('them/process','nhanvienController@themprocess')->name('themnhanvienprocess')->middleware('DanhNhapMiddleware');
			Route::post('sua/process','nhanvienController@suaprocess')->name('suanhanvienprocess')->middleware('DanhNhapMiddleware');
		});
		Route::group(['prefix' => 'phongban'], function(){
			Route::get('/', function() {
				return redirect()->route('danhsachphongban')->middleware('DanhNhapMiddleware');
			});
			Route::get('danhsach','phongbanController@danhsach')->name('danhsachphongban')->middleware('DanhNhapMiddleware');
			Route::get('them','phongbanController@them')->name('themphongban')->middleware('DanhNhapMiddleware');
			Route::get('sua/{maphongban}','phongbanController@suaphongban')->name('suaphongban')->middleware('DanhNhapMiddleware');
			Route::get('xoa/{maphongban}','phongbanController@xoaprocess')->name('xoaphongban')->middleware('DanhNhapMiddleware');
			Route::post('them/process','phongbanController@themprocess')->name('themphongbanprocess')->middleware('DanhNhapMiddleware');
			Route::post('sua/process','phongbanController@suaprocess')->name('suaphongbanprocess')->middleware('DanhNhapMiddleware');
		});
		Route::group(['prefix' => 'chucvu'], function(){
			Route::get('/', function() {
				return redirect()->route('danhsachchucvu')->middleware('DanhNhapMiddleware');
			});
			Route::get('danhsach','chucvuController@danhsach')->name('danhsachchucvu')->middleware('DanhNhapMiddleware');
			Route::get('them','chucvuController@them')->name('themchucvu')->middleware('DanhNhapMiddleware');
			Route::get('sua/{machucvu}','chucvuController@suachucvu')->name('suachucvu')->middleware('DanhNhapMiddleware');
			Route::get('xoa/{machucvu}','chucvuController@xoaprocess')->name('xoachucvu')->middleware('DanhNhapMiddleware');
			Route::post('them/process','chucvuController@themprocess')->name('themchucvuprocess')->middleware('DanhNhapMiddleware');
			Route::post('sua/process','chucvuController@suaprocess')->name('suachucvuprocess')->middleware('DanhNhapMiddleware');
		});
		Route::group(['prefix' => 'calamviec'], function(){
			Route::get('/', function() {
				return redirect()->route('danhsachcalam')->middleware('DanhNhapMiddleware');
			});
			Route::get('danhsach','calamController@danhsach')->name('danhsachcalam')->middleware('DanhNhapMiddleware');
			Route::get('them','calamController@them')->name('themcalam')->middleware('DanhNhapMiddleware');
			Route::get('sua/{maca}','calamController@suacalam')->name('suacalam')->middleware('DanhNhapMiddleware');
			Route::get('xoa/{maca}','calamController@xoaprocess')->name('xoacalam')->middleware('DanhNhapMiddleware');
			Route::post('them/process','calamController@themprocess')->name('themcalamprocess')->middleware('DanhNhapMiddleware');
			Route::post('sua/process','calamController@suaprocess')->name('suacalamprocess')->middleware('DanhNhapMiddleware');
		});
		Route::group(['prefix' => 'thongke'], function(){
			Route::get('', function() {
				return redirect()->route('thongke')->middleware('DanhNhapMiddleware');
			});
			Route::get('thongketrongngay','thongkeController@thongketrongngay')->name('thongketrongngay')->middleware('DanhNhapMiddleware');
			Route::get('chitiet/{manv}','thongkeController@thongkechitiet')->name('thongkechitiet')->middleware('DanhNhapMiddleware');
			Route::get('thongketheothang','thongkeController@thongketheothang')->name('thongketheothang')->middleware('DanhNhapMiddleware');
			Route::get('demo','thongkeController@demo')->middleware('DanhNhapMiddleware');
			Route::get('chiTietTheoThang','thongkeController@chiTietTheoThang')->middleware('DanhNhapMiddleware');
		});
		Route::get('dangxuat','adminController@dangxuat')->name('dangxuatadmin');
});
Route::group(['prefix' => 'nhanvien'], function(){
		Route::get('dangnhap','nhanvienController@dangnhap')->name('dangnhapnhanvien');
		Route::post('xulydangnhap','nhanvienController@dangnhapprocess')->name('dangnhapnhanvienprocess');
		Route::group(['prefix' => 'diemdanh'], function(){
			Route::get('/', function() {
				return redirect()->route('diemdanh');
			});
			Route::get('thongtincanhan','nhanvienController@thongtincanhan')->name('thongtincanhan')->middleware('nhanvienMiddleware');
			Route::get('diemdanhcheckin','diemdanhController@checkin')->name('checkin')->middleware('nhanvienMiddleware');
			Route::post('diemdanhcheckinprocess','diemdanhController@checkinprocess')->name('checkinprocess')->middleware('nhanvienMiddleware');
			Route::post('diemdanhcheckoutprocess','diemdanhController@checkoutprocess')->name('checkoutprocess')->middleware('nhanvienMiddleware');
			Route::get('dangxuat','nhanvienController@dangxuat')->name('dangxuatnhanvien');
		});
});

Route::get('test',function(){
	return view('test');
});
