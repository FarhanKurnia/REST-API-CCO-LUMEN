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
            'id'=> '1',
            'pop'=> 'Yogyakarta',
            'created_at' => Carbon::now(),
        ],
        [
            'id'=> '2',
            'pop'=> 'Solo',
            'created_at' => Carbon::now(),
        ],
        [
            'id'=> '3',
            'pop'=> 'Purwokerto',
            'created_at' => Carbon::now(),
        ],
        [
            'id'=> '4',
            'pop'=> 'Tegal',
            'created_at' => Carbon::now(),
        ]]);
    }
}
