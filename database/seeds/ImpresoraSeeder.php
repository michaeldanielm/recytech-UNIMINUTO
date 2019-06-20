<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
class ImpresoraSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('impresoras')->insert([
          ['modelo'=>'HP Officejet Pro x476dw MFP'],
          ['modelo'=>'Brother MFC L8850cdw'],
          ['modelo'=>'HP Laserjet Pro MFP M377dw'],
          ['modelo'=>'HP Laserjet Pro MFP M477fnw'],
          ['modelo'=>'Samsung SL-M4072FD'],
          ['modelo'=>'Brother DCP-L2540DW'],
          ['modelo'=>'HP Lasejet 200 MFP M276nw'],
          ['modelo'=>'HP Officejet Pro 8620']
        ]);
    }
}
