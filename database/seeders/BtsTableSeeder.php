<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;
class BtsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('bts')->insert([[
            'nama_bts' => 'Sleman',
            'nama_pic' => 'Asep',
            'nomor_pic' => '08888888888',
            'lokasi' => 'Sleman, Yogyakarta',
            'kordinat' => '-34656987. -34567893',
            'pop_id' => '1',
            'user_id' => '1',
            'created_at' => Carbon::now(),
        ],
        [
            'nama_bts' => 'Banjarsari',
            'nama_pic' => 'Dadang',
            'nomor_pic' => '0899999999',
            'lokasi' => 'Banjarsari, Solo',
            'kordinat' => '-346654379. -34567893',
            'pop_id' => '2',
            'user_id' => '2',
            'created_at' => Carbon::now(),
        ]]);
    }
}
