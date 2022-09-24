<?php

namespace Database\Seeders;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;
use Illuminate\Database\Seeder;

class RFOKeluhanSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('r_f_o__keluhans')->insert([[
            'keluhan_id' => '1',
            'user_id' => '1',
            'nomor_tiket' => '12345678',
            'mulai_keluhan' => Carbon::now(),
            'selesai_keluhan' => Carbon::now(),
            'problem' => 'Koneksi tidak bisa digunakan' ,
            'action' => 'Reconfigure Access point',
            'status' => 'closed',
            'deskripsi' => 'Normal',
            'created_at' => Carbon::now(),
        ],
        [
            'keluhan_id' => '2',
            'user_id' => '1',
            'nomor_tiket' => '23456789',
            'mulai_keluhan' => Carbon::now(),
            'selesai_keluhan' => Carbon::now(),
            'problem' => 'Koneksi lambat' ,
            'action' => 'Sinyal antenna belum kuat',
            'status' => 'closed',
            'deskripsi' => 'Sudah dibuatkan tiket pelaporan',
            'created_at' => Carbon::now(),
        ]]);
    }
}
