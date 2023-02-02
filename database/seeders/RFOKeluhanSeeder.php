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
            // "id_rfo_keluhan" => 1,
            "nomor_rfo_keluhan" => "#RFO-S2023020113741",
            "nomor_tiket" => "#0021213342567",
            "mulai_keluhan" => "2023-02-01T05:00:00.000Z",
            "selesai_keluhan" => "2023-02-01T05:00:00.000Z",
            "durasi" => "0 Hari - 0 Jam - 0 Menit",
            "problem" => "Sinyal antenna belum optimal",
            "action" => "Dibuatkan tiket visit untuk cek antenna di lokasi",
            "deskripsi" => "-",
            "deleted_at" => "2023-02-01T11:53:58.000Z",
            "user_id" => 1,
            "created_at" => "2023-02-01T11:28:13.000Z",
            "updated_at" => "2023-02-01T11:53:58.000Z"
        ],
        [
            // "id_rfo_keluhan" => 2,
            "nomor_rfo_keluhan" => "#RFO-S2023020177054",
            "nomor_tiket" => "#0021213342567",
            "mulai_keluhan" => "2023-02-01T11:14:47.000Z",
            "selesai_keluhan" => "2023-02-01T11:26:41.000Z",
            "durasi" => "0 Hari - 0 Jam - 11 Menit",
            "problem" => "Koneksi lambat dikarenakan sinyal antenna belum optimal",
            "action" => "Perlu dilakukan visit pengecekan antenna dan sudah dibuatkan tiket visit.\nMenunggu penjadwalan",
            "deskripsi" => "-",
            "deleted_at" => null,
            "user_id" => 1,
            "created_at" => "2023-02-01T11:55:19.000Z",
            "updated_at" => "2023-02-01T11:55:19.000Z"
        ],
        [
            // "id_rfo_keluhan" => 3,
            "nomor_rfo_keluhan" => "#RFO-S2023020187053",
            "nomor_tiket" => "-",
            "mulai_keluhan" => "2023-02-01T11:19:47.000Z",
            "selesai_keluhan" => "2023-02-01T12:01:35.000Z",
            "durasi" => "0 Hari - 0 Jam - 41 Menit",
            "problem" => "Antenna klien down (tidak terhubung)",
            "action" => "Dilakukan pemanduan cabut-clok adapter",
            "deskripsi" => "Koneksi sudah normal kembali",
            "deleted_at" => null,
            "user_id" => 1,
            "created_at" => "2023-02-01T12:02:47.000Z",
            "updated_at" => "2023-02-01T12:02:47.000Z"
        ],
        [
            // "id_rfo_keluhan" => 4,
            "nomor_rfo_keluhan" => "#RFO-S2023020134687",
            "nomor_tiket" => "-",
            "mulai_keluhan" => "2023-02-01T11:17:12.000Z",
            "selesai_keluhan" => "2023-02-01T12:13:44.000Z",
            "durasi" => "0 Hari - 0 Jam - 56 Menit",
            "problem" => "Koneksi putus-putus karena pengaturan wifi kurang sesuai",
            "action" => "Dilakukan setting ulang wifi",
            "deskripsi" => "Koneksi sudah normal kembali",
            "deleted_at" => null,
            "user_id" => 1,
            "created_at" => "2023-02-01T12:14:57.000Z",
            "updated_at" => "2023-02-01T12:14:57.000Z"
        ],
        [
            // "id_rfo_keluhan" => 5,
            "nomor_rfo_keluhan" => "#RFO-S2023020117628",
            "nomor_tiket" => "-",
            "mulai_keluhan" => "2023-02-01T12:47:25.000Z",
            "selesai_keluhan" => "2023-02-01T12:48:56.000Z",
            "durasi" => "0 Hari - 0 Jam - 1 Menit",
            "problem" => "Koneksi down indikasi dikarenakan issue modem hang",
            "action" => "Restart modem secara fisik oleh klien",
            "deskripsi" => "Sudah normal kembali",
            "deleted_at" => null,
            "user_id" => 1,
            "created_at" => "2023-02-01T12:50:24.000Z",
            "updated_at" => "2023-02-01T12:50:24.000Z"
        ],
        [
            // "id_rfo_keluhan" => 6,
            "nomor_rfo_keluhan" => "#RFO-S2023020149128",
            "nomor_tiket" => "-",
            "mulai_keluhan" => "2023-02-01T12:44:38.000Z",
            "selesai_keluhan" => "2023-02-01T12:56:23.000Z",
            "durasi" => "0 Hari - 0 Jam - 11 Menit",
            "problem" => "Koneksi tidak lancar indikasi issue modem hang",
            "action" => "Dilakukan restart modem",
            "deskripsi" => "Sudah normal kembali",
            "deleted_at" => null,
            "user_id" => 1,
            "created_at" => "2023-02-01T12:57:07.000Z",
            "updated_at" => "2023-02-01T12:57:07.000Z"
        ]]);
    }
}
