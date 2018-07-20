<?php

use Illuminate\Database\Seeder;

class nhanvien extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $nhanvien = array(
		  array('manv' => '1','taikhoan' => 'nhanvien','matkhau' => '123456','hoten' => 'Nghiêm Xuân Back','sdt' => '01634545154','ngaysinh' => '1989-06-09','gioitinh' => '1','maphongban' => '3','machucvu' => '2','tienluong' => '85000.00','calam' => '1,2'),
		  array('manv' => '2','taikhoan' => 'nhanvien2','matkhau' => '123456','hoten' => 'Nguyễn Sơn Trường','sdt' => '013341545354','ngaysinh' => '1996-06-13','gioitinh' => '1','maphongban' => '1','machucvu' => '2','tienluong' => '40000.00','calam' => '1,2,3'),
		  array('manv' => '3','taikhoan' => 'nhanvien3','matkhau' => '123456','hoten' => 'Đinh Tuấn Dũng','sdt' => '015654545248','ngaysinh' => '1995-06-23','gioitinh' => '1','maphongban' => '3','machucvu' => '2','tienluong' => '85000.00','calam' => '2,3'),
		  array('manv' => '4','taikhoan' => 'nhanvien4','matkhau' => '123456','hoten' => 'Nguyễn Khánh Linh','sdt' => '01621542184','ngaysinh' => '1992-06-16','gioitinh' => '1','maphongban' => '1','machucvu' => '1','tienluong' => '90000.00','calam' => '1,2'),
		  array('manv' => '5','taikhoan' => 'nhanvien5','matkhau' => '123456','hoten' => 'Đặng Anh Hào','sdt' => '0163164619','ngaysinh' => '1994-06-09','gioitinh' => '1','maphongban' => '2','machucvu' => '2','tienluong' => '44000.00','calam' => '1,3'),
		  array('manv' => '6','taikhoan' => 'nhanvien6','matkhau' => '123456','hoten' => 'Chu Minh Heo','sdt' => '016364521845','ngaysinh' => '1998-06-11','gioitinh' => '1','maphongban' => '2','machucvu' => '1','tienluong' => '100000.00','calam' => '1,2')
		);
        DB::table('nhanvien')->insert($nhanvien);
    }
}
