<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class NotifikasiSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('notifikasis')->insert([[
            'judul'=> 'Keluhan Baru Jogja',
            'detail'=> 'Terdapat keluhan baru',
            'user_id_notif' => null,
            'pop_id' => 1,
            'created_at' => Carbon::now(),
        ],
        [
            'judul'=> 'Balasan Baru Jogja',
            'detail'=> 'Terdapat balasan baru',
            'user_id_notif' => null,
            'pop_id' => 1,
            'created_at' => Carbon::now(),
        ],
        [
            'judul'=> 'Balasan Solo',
            'detail'=> 'Terdapat balasan baru',
            'user_id_notif' => null,
            'pop_id' => 2,
            'created_at' => Carbon::now(),
        ],]);
    }
}
