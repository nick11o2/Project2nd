<?php

use Illuminate\Database\Seeder;

class tinhtrang extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $tinhtrang = array(
		  array('matinhtrang' => '1','tentinhtrang' => 'Đúng giờ', 'hesoluong' => '1'),
		  array('matinhtrang' => '2','tentinhtrang' => 'Muộn', 'hesoluong' => '0.8'),
		  array('matinhtrang' => '3','tentinhtrang' => 'CheckOut sớm', 'hesoluong' => '0.9')
		);
		DB::table('tinhtrang')->insert($tinhtrang);
    }
}
