<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

use Illuminate\Support\Facades\DB;

class LampiranBalasanSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('lampiran__balasans')->insert([[
            'path' => 'http://localhost:8000/lampiran/20221109371_attachment_balasan.pdf',
            'balasan_id'=> '1',
        ],
        [
            'path' => 'http://localhost:8000/lampiran/20221109371_attachment_balasan.pdf',
            'balasan_id'=> '1',
        ],
        [
            'path' => 'http://localhost:8000/lampiran/20221109371_attachment_balasan.pdf',
            'balasan_id'=> '2',
        ]]);
    }
}
