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
            // "id_rfo_gangguan" => 1,
            "nomor_rfo_gangguan" => "#RFO-G20230201625",
            "problem" => "Jalur Backbone High Latency",
            "action" => "Pemindahan jalur Backbone",
            "deskripsi" => "Perbaikan selesai",
            "status" => "closed",
            "mulai_gangguan" => "2023-02-01T11:00:00.000Z",
            "selesai_gangguan" => "2023-02-01T12:08:00.000Z",
            "nomor_tiket" => "",
            "durasi" => "0 Hari - 1 Jam - 8 Menit",
            "deleted_at" => null,
            "user_id" => 1,
            "created_at" => "2023-02-01T12:08:20.000Z",
            "updated_at" => "2023-02-01T12:59:00.000Z"
        ],
        [
            // "id_rfo_gangguan" => 2,
            "nomor_rfo_gangguan" => "#RFO-G20230201667",
            "problem" => "FO Cut Sleman Kota",
            "action" => "Splashing oleh tim di lapangan",
            "deskripsi" => "Pengerjaan sudah selesai",
            "status" => "closed",
            "mulai_gangguan" => "2023-02-01T11:29:00.000Z",
            "selesai_gangguan" => "2023-02-01T12:29:00.000Z",
            "nomor_tiket" => "-",
            "durasi" => "0 Hari - 1 Jam - 0 Menit",
            "deleted_at" => null,
            "user_id" => 1,
            "created_at" => "2023-02-01T12:29:57.000Z",
            "updated_at" => "2023-02-01T12:58:51.000Z"
        ]]);
    }
}
