<?php

namespace Database\Seeders;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;
use Illuminate\Database\Seeder;

class RFOGangguanSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('r_f_o_gangguans')->insert([[
            'nomor_rfo_gangguan'=>'RFOG111111',
            'problem' => 'FO Cut Gunungkidul',
            'action' => 'Splicing',
            'deskripsi' => 'Terjadi FO Cut diarah Gunungkidul dan sudah selesai displice',
            'status' => 'open',
            'mulai_gangguan' => Carbon::now(),
            'selesai_gangguan' => Carbon::now(),
            'nomor_tiket' => '12345678',
            'user_id' => '1',
            'created_at' => Carbon::now(),
        ],
        [
            'nomor_rfo_gangguan'=>'RFOG111112',
            'problem' => 'Gangguan Upstream',
            'action' => 'reroute',
            'deskripsi' => 'Normal',
            'status' => 'open',
            'mulai_gangguan' => Carbon::now(),
            'selesai_gangguan' => Carbon::now(),
            'nomor_tiket' => '12345670',
            'user_id' => '2',
            'created_at' => Carbon::now(),
        ]]);
    }
}
