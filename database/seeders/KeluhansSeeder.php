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
            'id_pelanggan' => '1',
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
            'id_pelanggan' => '2',
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
            'id_pelanggan' => '3',
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
            'rfo_gangguan_id' => null,
        ],
        [
            'id_pelanggan' => '4',
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
            'rfo_gangguan_id' => null,
        ],
        [
            'id_pelanggan' => '5',
            'nama_pelanggan' => 'Sambadha',
            'nama_pelapor' => 'Sambadha',
            'nomor_pelapor' => '08888888888',
            'sumber' => 'Email',
            'detail_sumber' => 'Sambadha@gmail.com',
            'no_keluhan' => 'J123456780018' ,
            'keluhan' => 'Kabel terputus',
            'status' => 'open',
            'pop_id' => '2',
            'user_id' => '2',
            'created_at' => Carbon::now(),
            'rfo_gangguan_id' => null,
        ],
        [
            'id_pelanggan' => '6',
            'nama_pelanggan' => 'Dery',
            'nama_pelapor' => 'Dery',
            'nomor_pelapor' => '08888888888',
            'sumber' => 'Email',
            'detail_sumber' => 'Dery@gmail.com',
            'no_keluhan' => 'J123456780018' ,
            'keluhan' => 'Kabel terputus',
            'status' => 'open',
            'pop_id' => '2',
            'user_id' => '2',
            'created_at' => Carbon::now(),
            'rfo_gangguan_id' => null,
        ],
        [
            'id_pelanggan' => '7',
            'nama_pelanggan' => 'Sunarto',
            'nama_pelapor' => 'Sunarto',
            'nomor_pelapor' => '08888888888',
            'sumber' => 'Email',
            'detail_sumber' => 'Sunarto@gmail.com',
            'no_keluhan' => 'J123456780018' ,
            'keluhan' => 'Kabel terputus',
            'status' => 'open',
            'pop_id' => '2',
            'user_id' => '2',
            'created_at' => Carbon::now(),
            'rfo_gangguan_id' => null,
        ],
        [
            'id_pelanggan' => '8',
            'nama_pelanggan' => 'Rama',
            'nama_pelapor' => 'Rama',
            'nomor_pelapor' => '08888888888',
            'sumber' => 'Email',
            'detail_sumber' => 'Rama@gmail.com',
            'no_keluhan' => 'J123456780018' ,
            'keluhan' => 'Kabel terputus',
            'status' => 'open',
            'pop_id' => '2',
            'user_id' => '2',
            'created_at' => Carbon::now(),
            'rfo_gangguan_id' => null,
        ],
        [
            'id_pelanggan' => '9',
            'nama_pelanggan' => 'Nikita',
            'nama_pelapor' => 'Nikita',
            'nomor_pelapor' => '08888888888',
            'sumber' => 'Email',
            'detail_sumber' => 'Nikita@gmail.com',
            'no_keluhan' => 'J123456780018' ,
            'keluhan' => 'Kabel terputus',
            'status' => 'open',
            'pop_id' => '2',
            'user_id' => '2',
            'created_at' => Carbon::now(),
            'rfo_gangguan_id' => null,
        ],
        [
            'id_pelanggan' => '10',
            'nama_pelanggan' => 'Faiz',
            'nama_pelapor' => 'Faiz',
            'nomor_pelapor' => '08888888888',
            'sumber' => 'Email',
            'detail_sumber' => 'Faiz@gmail.com',
            'no_keluhan' => 'J123456780018' ,
            'keluhan' => 'Kabel terputus',
            'status' => 'closed',
            'pop_id' => '2',
            'user_id' => '2',
            'created_at' => Carbon::now(),
            'rfo_gangguan_id' => null,
        ],
        [
            'id_pelanggan' => '11',
            'nama_pelanggan' => 'Alexa',
            'nama_pelapor' => 'Alexa',
            'nomor_pelapor' => '08888888888',
            'nomor_keluhan' => 'J123456780016' ,
            'sumber' => 'Telepon',
            'detail_sumber' => '08888888888',
            'keluhan' => 'Koneksi Lambat',
            'status' => 'closed',
            'pop_id' => '1',
            'user_id' => '1',
            'created_at' => Carbon::now(),
            'rfo_gangguan_id' => 1,
        ],
        [
            'id_pelanggan' => '12',
            'nama_pelanggan' => 'Anggun',
            'nama_pelapor' => 'Anggun',
            'nomor_pelapor' => '08888888888',
            'nomor_keluhan' => 'J123456780015' ,
            'sumber' => 'Twiter',
            'detail_sumber' => '@twitter',
            'keluhan' => 'Wifi Error',
            'status' => 'closed',
            'pop_id' => '1',
            'user_id' => '2',
            'created_at' => Carbon::now(),
            'rfo_gangguan_id' => 1,
        ],
        [
            'id_pelanggan' => '13',
            'nama_pelanggan' => 'Haechan',
            'nama_pelapor' => 'Haechan',
            'nomor_pelapor' => '08888888888',
            'nomor_keluhan' => 'J123456780019' ,
            'sumber' => 'Instagram',
            'detail_sumber' => '@instagram',
            'keluhan' => 'Sinyal wifi tidak sampai kamar',
            'status' => 'closed',
            'pop_id' => '2',
            'user_id' => '1',
            'created_at' => Carbon::now(),
            'rfo_gangguan_id' => 1,
        ],
        [
            'id_pelanggan' => '14',
            'nama_pelanggan' => 'Dochi',
            'nama_pelapor' => 'Dochi',
            'nomor_pelapor' => '08888888888',
            'sumber' => 'Email',
            'detail_sumber' => 'Dochi@gmail.com',
            'no_keluhan' => 'J123456780018' ,
            'keluhan' => 'Kabel terputus',
            'status' => 'closed',
            'pop_id' => '2',
            'user_id' => '2',
            'created_at' => Carbon::now(),
            'rfo_gangguan_id' => 1,
        ],
        [
            'id_pelanggan' => '15',
            'nama_pelanggan' => 'Tama',
            'nama_pelapor' => 'Tama',
            'nomor_pelapor' => '08888888888',
            'sumber' => 'Email',
            'detail_sumber' => 'Tama@gmail.com',
            'no_keluhan' => 'J123456780018' ,
            'keluhan' => 'Kabel terputus',
            'status' => 'closed',
            'pop_id' => '2',
            'user_id' => '2',
            'created_at' => Carbon::now(),
            'rfo_gangguan_id' => 1,

        ],
        [
            'id_pelanggan' => '16',
            'nama_pelanggan' => 'Fathia',
            'nama_pelapor' => 'Fathia',
            'nomor_pelapor' => '08888888888',
            'sumber' => 'Email',
            'detail_sumber' => 'Fathia@gmail.com',
            'no_keluhan' => 'J123456780018' ,
            'keluhan' => 'Kabel terputus',
            'status' => 'closed',
            'pop_id' => '2',
            'user_id' => '2',
            'created_at' => Carbon::now(),
            'rfo_gangguan_id' => 1,
        ],
        [
            'id_pelanggan' => '17',
            'nama_pelanggan' => 'Hindia',
            'nama_pelapor' => 'Hindia',
            'nomor_pelapor' => '08888888888',
            'sumber' => 'Email',
            'detail_sumber' => 'Hindia@gmail.com',
            'no_keluhan' => 'J123456780018' ,
            'keluhan' => 'Kabel terputus',
            'status' => 'closed',
            'pop_id' => '2',
            'user_id' => '2',
            'created_at' => Carbon::now(),
            'rfo_gangguan_id' => 1,
        ],
        [
            'id_pelanggan' => '18',
            'nama_pelanggan' => 'Enrico',
            'nama_pelapor' => 'Enrico',
            'nomor_pelapor' => '08888888888',
            'sumber' => 'Email',
            'detail_sumber' => 'Enrico@gmail.com',
            'no_keluhan' => 'J123456780018' ,
            'keluhan' => 'Kabel terputus',
            'status' => 'closed',
            'pop_id' => '2',
            'user_id' => '2',
            'created_at' => Carbon::now(),
            'rfo_gangguan_id' => 1,
        ],
        [
            'id_pelanggan' => '19',
            'nama_pelanggan' => 'Teteh Kitten',
            'nama_pelapor' => 'Teteh Kitten',
            'nomor_pelapor' => '08888888888',
            'sumber' => 'Email',
            'detail_sumber' => 'Teh@gmail.com',
            'no_keluhan' => 'J123456780018' ,
            'keluhan' => 'Kabel terputus',
            'status' => 'closed',
            'pop_id' => '2',
            'user_id' => '2',
            'created_at' => Carbon::now(),
            'rfo_gangguan_id' => 1,
        ],
        [
            'id_pelanggan' => '20',
            'nama_pelanggan' => 'Nugi',
            'nama_pelapor' => 'Nugi',
            'nomor_pelapor' => '08888888888',
            'sumber' => 'Email',
            'detail_sumber' => 'Nugi@gmail.com',
            'no_keluhan' => 'J123456780018' ,
            'keluhan' => 'Kabel terputus',
            'status' => 'closed',
            'pop_id' => '2',
            'user_id' => '2',
            'created_at' => Carbon::now(),
            'rfo_gangguan_id' => 1,
        ]
    ]);
    }
}
