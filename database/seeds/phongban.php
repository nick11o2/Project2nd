<?php

use Illuminate\Database\Seeder;

class phongban extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $phongban = array(
		  array('maphongban' => '1','tenphongban' => 'Kế Toán'),
		  array('maphongban' => '2','tenphongban' => 'Thu Ngân'),
		  array('maphongban' => '3','tenphongban' => 'Marketing')
		);
		DB::table('phongban')->insert($phongban);
    }
}
