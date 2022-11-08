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
            'nomor_laporan'=> '1',
            'tanggal'=> Carbon::today(),
            'shift_id' => 1,
            'pop_id' => 1,
            'user_id' => 1,
            'petugas' => 'Farhan, Kurnia, Ragil',
            'lampiran_laporan' => "http://localhost:8000/laporan/REF-ID-2022110921631.pdf",
        ],
        [
            'nomor_laporan'=> '2',
            'tanggal'=> Carbon::today(),
            'shift_id' => 2,
            'pop_id' => 1,
            'user_id' => 2,
            'petugas' => 'Syahputra, Tedy, Afif',
            'lampiran_laporan' => "http://localhost:8000/laporan/REF-ID-2022110921631.pdf",
        ],
        [
            'nomor_laporan'=> '3',
            'tanggal'=> Carbon::today(),
            'shift_id' => 1,
            'pop_id' => 2,
            'user_id' => 3,
            'petugas' => 'Ridho, Alfiano, Ahmad',
            'lampiran_laporan' => "http://localhost:8000/laporan/REF-ID-2022110921631.pdf",
        ],
        [
            'nomor_laporan'=> '4',
            'tanggal'=> Carbon::today(),
            'shift_id' => 2,
            'pop_id' => 2,
            'user_id' => 4,
            'petugas' => 'Ramdhan, Rizki, Afif',
            'lampiran_laporan' => "http://localhost:8000/laporan/REF-ID-2022110921631.pdf",
        ]]);
    }
}
