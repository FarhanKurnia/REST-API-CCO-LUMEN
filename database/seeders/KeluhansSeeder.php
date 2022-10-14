<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;
class KeluhansSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('keluhans')->insert([[
            'id_pelanggan' => '12345678',
            'nama_pelanggan' => 'Alexander',
            'nama_pelapor' => 'Alex',
            'nomor_pelapor' => '08888888888',
            'nomor_keluhan' => 'J123456780016' ,
            'sumber' => 'Telepon',
            'detail_sumber' => '08888888888',
            'keluhan' => 'Koneksi Lambat',
            'status' => 'open',
            'pop_id' => '1',
            'user_id' => '1',
            'created_at' => Carbon::now(),
            'rfo_gangguan_id' => 1,
        ],
        [
            'id_pelanggan' => '23456789',
            'nama_pelanggan' => 'Christopher',
            'nama_pelapor' => 'Kris',
            'nomor_pelapor' => '08888888888',
            'nomor_keluhan' => 'J123456780015' ,
            'sumber' => 'Twiter',
            'detail_sumber' => '@twitter',
            'keluhan' => 'Wifi Error',
            'status' => 'open',
            'pop_id' => '1',
            'user_id' => '2',
            'created_at' => Carbon::now(),
            'rfo_gangguan_id' => 1,
        ],
        [
            'id_pelanggan' => '34567890',
            'nama_pelanggan' => 'Mark',
            'nama_pelapor' => 'Mark',
            'nomor_pelapor' => '08888888888',
            'nomor_keluhan' => 'J123456780019' ,
            'sumber' => 'Instagram',
            'detail_sumber' => '@instagram',
            'keluhan' => 'Sinyal wifi tidak sampai kamar',
            'status' => 'open',
            'pop_id' => '2',
            'user_id' => '1',
            'created_at' => Carbon::now(),
            'rfo_gangguan_id' => 1,
        ],
        [
            'id_pelanggan' => '45678901',
            'nama_pelanggan' => 'Iqbal',
            'nama_pelapor' => 'iqbal',
            'nomor_pelapor' => '08888888888',
            'sumber' => 'Email',
            'detail_sumber' => 'iqbal@gmail.com',
            'no_keluhan' => 'J123456780018' ,
            'keluhan' => 'Kabel terputus',
            'status' => 'open',
            'pop_id' => '2',
            'user_id' => '2',
            'created_at' => Carbon::now(),
            'rfo_gangguan_id' => 1,
        ]
    ]);
    }
}
