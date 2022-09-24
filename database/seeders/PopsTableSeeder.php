<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;
class PopsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('pops')->insert([[
            'id_pop'=> '1',
            'pop'=> 'Yogyakarta',
            // 'created_at' => Carbon::now(),
        ],
        [
            'id_pop'=> '2',
            'pop'=> 'Solo',
            // 'created_at' => Carbon::now(),
        ],
        [
            'id_pop'=> '3',
            'pop'=> 'Purwokerto',
            // 'created_at' => Carbon::now(),
        ],
        [
            'id_pop'=> '4',
            'pop'=> 'Tegal',
            // 'created_at' => Carbon::now(),
        ]]);
    }
}
