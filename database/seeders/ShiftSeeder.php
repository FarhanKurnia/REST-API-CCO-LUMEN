<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;
class ShiftSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('shifts')->insert([[
            // 'id_shift'=> '1',
            'shift'=> '1',
            'mulai'=>'08:00',
            'selesai' => '17:00',
            'created_at' => Carbon::now(),
        ],
        [
            // 'id_shift'=> '2',
            'shift'=> '2',
            'mulai'=>'16:30',
            'selesai' => '00:30',
            'created_at' => Carbon::now(),
        ]]);
    }
}
