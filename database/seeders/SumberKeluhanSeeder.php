<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class SumberKeluhanSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('sumber_keluhans')->insert([[
            // 'id_sumber'=> 1,
            'sumber'=> 'Telepon',
            'created_at' => Carbon::now(),
        ],
        [
            // 'id_sumber'=> 2,
            'sumber'=> 'Whatsapp',
            'created_at' => Carbon::now(),
        ],
        [
            // 'id_sumber'=> 3,
            'sumber'=> 'Email',
            'created_at' => Carbon::now(),
        ],
        [
            // 'id_sumber'=> 4,
            'sumber'=> 'Livechat',
            'created_at' => Carbon::now(),
        ],
        [
            // 'id_sumber'=> 5,
            'sumber'=> 'Salesform',
            'created_at' => Carbon::now(),
        ],
        [
            // 'id_sumber'=> 6,
            'sumber'=> 'Whatsapp Group',
            'created_at' => Carbon::now(),
        ],
        [
            // 'id_sumber'=> 7,
            'sumber'=> 'Telegram Group',
            'created_at' => Carbon::now(),
        ],
        [
            // 'id_sumber'=> 8,
            'sumber'=> 'Twitter',
            'created_at' => Carbon::now(),
        ],
        [
            // 'id_sumber'=> 9,
            'sumber'=> 'Instagram',
            'created_at' => Carbon::now(),
        ],
        [
            // 'id_sumber'=> 10,
            'sumber'=> 'Google Business',
            'created_at' => Carbon::now(),
        ]
    ]);
    }
}
