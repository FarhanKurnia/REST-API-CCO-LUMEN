<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;
class BalasansSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('balasans')->insert([[
            'keluhan_id' => '1',
            'balasan' => 'Dari pengecekan untuk kendala berada di sinyalnya yang belum optimal',
            'user_id' => '1',
            'created_at' => Carbon::now(),
        ],
        [
            'keluhan_id' => '1',
            'balasan' => 'Dari pengecekan untuk kendala berada di sinyalnya yang belum optimal',
            'user_id' => '2',
            'created_at' => Carbon::now(),
        ]]);
    }
}
