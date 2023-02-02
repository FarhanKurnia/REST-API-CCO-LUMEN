<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class LaporanSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('laporans')->insert([[
            // 'nomor_laporan'=> '1',
            'tanggal'=> Carbon::today(),
            'shift_id' => 1,
            'pop_id' => 1,
            'user_id' => 1,
            'noc' => 'Farhan, Kurnia, Ragil',
            'helpdesk' => 'Farhan, Kurnia, Ragil',
            'lampiran_laporan' => "http://localhost:8000/laporan/REF-ID-2022110921631.pdf",
        ],
        [
            // 'nomor_laporan'=> '2',
            'tanggal'=> Carbon::today(),
            'shift_id' => 2,
            'pop_id' => 1,
            'user_id' => 2,
            'noc' => 'Syahputra, Tedy, Afif',
            'helpdesk' => 'Farhan, Kurnia, Ragil',
            'lampiran_laporan' => "http://localhost:8000/laporan/REF-ID-2022110921631.pdf",
        ],
        [
            'nomor_laporan'=> '3',
            'tanggal'=> Carbon::today(),
            'shift_id' => 1,
            'pop_id' => 2,
            'user_id' => 3,
            'noc' => 'Ridho, Alfiano, Ahmad',
            'helpdesk' => 'Farhan, Kurnia, Ragil',
            'lampiran_laporan' => "http://localhost:8000/laporan/REF-ID-2022110921631.pdf",
        ],
        [
            'nomor_laporan'=> '4',
            'tanggal'=> Carbon::today(),
            'shift_id' => 2,
            'pop_id' => 2,
            'user_id' => 4,
            'noc' => 'Ramdhan, Rizki, Afif',
            'helpdesk' => 'Farhan, Kurnia, Ragil',
            'lampiran_laporan' => "http://localhost:8000/laporan/REF-ID-2022110921631.pdf",
        ]]);
    }
}
