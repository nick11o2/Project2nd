<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class DbTinhluongcongnhanvienNgay17Thang4 extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('admin', function(Blueprint $table)
        {
            $table->string('taikhoan',20)->primary();
            $table->string('matkhau',20);
        });
        Schema::create('phongban', function(Blueprint $table)
        {
            $table->increments('maphongban');
            $table->string('tenphongban',30)->unique();
        });
        Schema::create('chucvu', function(Blueprint $table)
        {
            $table->increments('machucvu');
            $table->string('tenchucvu',30)->unique();
        });
        Schema::create('nhanvien', function(Blueprint $table)
        {
            $table->increments('manv');
            $table->string('taikhoan',30)->unique();
            $table->string('matkhau',30);
            $table->string('hoten',50);
            $table->string('sdt',15);
            $table->date('ngaysinh');
            $table->boolean('gioitinh');
            $table->integer('maphongban')->unsigned();
            $table->foreign('maphongban')->references('maphongban')->on('phongban');
            $table->integer('machucvu')->unsigned();
            $table->foreign('machucvu')->references('machucvu')->on('chucvu');
            $table->float('tienluong');
            $table->string('calam')->nullable();
        });
        Schema::create('calamviec', function(Blueprint $table)
        {
            $table->increments('maca');     
            $table->time('giobatdau');
            $table->time('gioketthuc');
        });
        Schema::create('tinhtrang', function(Blueprint $table)
        {
            $table->increments('matinhtrang');
            $table->string('tentinhtrang');
            $table->float('hesoluong');
        });
        Schema::create('diemdanh', function(Blueprint $table)
        {
            $table->increments('madiemdanh');
            $table->integer('manv')->unsigned();
            $table->time('checkin');
            $table->time('checkout')->nullable();
            $table->date('ngay');
            $table->integer('matinhtrang')->unsigned()->default('1');
            $table->foreign('matinhtrang')->references('matinhtrang')->on('tinhtrang');
            $table->foreign('manv')->references('manv')->on('nhanvien');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        //
    }
}
