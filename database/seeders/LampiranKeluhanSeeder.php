<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

use Illuminate\Support\Facades\DB;

class LampiranKeluhanSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('lampiran__keluhans')->insert([[
            'path' => 'http://localhost:8000/lampiran/20221109131_attachment_keluhan.pdf',
            'keluhan_id'=> '1',
        ],
        [
            'path' => 'http://localhost:8000/lampiran/20221109131_attachment_keluhan.pdf',
            'keluhan_id'=> '1',
        ],
        [
            'path' => 'http://localhost:8000/lampiran/20221109131_attachment_keluhan.pdf',
            'keluhan_id'=> '2',
        ]]);
    }
}
