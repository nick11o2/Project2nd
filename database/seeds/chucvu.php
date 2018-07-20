<?php

use Illuminate\Database\Seeder;

class chucvu extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
         $chucvu = array(
          array('machucvu' => '1','tenchucvu' => 'Trưởng phòng'),
          array('machucvu' => '2','tenchucvu' => 'Phó phòng'),
          array('machucvu' => '3','tenchucvu' => 'Nhân viên')
        );
        DB::table('chucvu')->insert($chucvu);
    }
}
