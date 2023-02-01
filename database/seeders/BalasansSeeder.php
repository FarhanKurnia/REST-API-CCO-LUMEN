<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;
class BalasansSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('balasans')->insert([
            [
                "id_balasan" => 1,
                "balasan" => "Akan dilakukan pengecekan",
                "user_id" => 2,
                "keluhan_id" => 1,
                "created_at" => "2023-02-01T11:18:07.000Z",
                "updated_at" => "2023-02-01T11:18:07.000Z"
            ],
            [
                "id_balasan" => 2,
            "balasan" => "Dari pengecekan untuk sinyal antenna belum optimal, mohon dibuatkan tiket visit lanjutan",
            "user_id" => 2,
            "keluhan_id" => 1,
            "created_at" => "2023-02-01T11:21:30.000Z",
            "updated_at" => "2023-02-01T11:21:30.000Z"
            ],
            [
                "id_balasan" => 3,
            "balasan" => "Akan dilakukan pengecekan",
            "user_id" => 2,
            "keluhan_id" => 3,
            "created_at" => "2023-02-01T11:22:09.000Z",
            "updated_at" => "2023-02-01T11:22:09.000Z"
            ],
            [
                "id_balasan" => 4,
            "balasan" => "Dari pengecekan untuk antenna di lokasi dalam keadaan down, mohon dapat dicoba restart adaptor nya dulu dan dipastikan kelistrikan di lokasi aman ya",
            "user_id" => 2,
            "keluhan_id" => 3,
            "created_at" => "2023-02-01T11:25:14.000Z",
            "updated_at" => "2023-02-01T11:25:14.000Z"
            ],
            [
                "id_balasan" => 5,
            "balasan" => "Sudah dibuatkan tiket visit di nomor tiket #0021213342567.\n Sudah dikonfirmasi ke klien untuk menunggu penjadwalan visit tim.",
            "user_id" => 1,
            "keluhan_id" => 1,
            "created_at" => "2023-02-01T11:26:30.000Z",
            "updated_at" => "2023-02-01T11:26:30.000Z"
            ],
            [
                "id_balasan" => 6,
            "balasan" => "Sudah dibuatkan tiket visit di nomor tiket #0021213342567.\n Sudah dikonfirmasi ke klien untuk menunggu penjadwalan visit tim.",
            "user_id" => 1,
            "keluhan_id" => 1,
            "created_at" => "2023-02-01T11:26:41.000Z",
            "updated_at" => "2023-02-01T11:26:41.000Z"
            ],
            [
                "id_balasan" => 7,
            "balasan" => "Akan dilakukan pengecekan",
            "user_id" => 2,
            "keluhan_id" => 2,
            "created_at" => "2023-02-01T11:56:06.000Z",
            "updated_at" => "2023-02-01T11:56:06.000Z"
            ],
            [
                "id_balasan" => 8,
            "balasan" => "Akan dilakukan konfirmasi ke pelanggan",
            "user_id" => 1,
            "keluhan_id" => 3,
            "created_at" => "2023-02-01T11:57:32.000Z",
            "updated_at" => "2023-02-01T11:57:32.000Z"
            ],
            [
                "id_balasan" => 9,
            "balasan" => "Akan dilakukan pengecekan",
            "user_id" => 2,
            "keluhan_id" => 4,
            "created_at" => "2023-02-01T11:58:08.000Z",
            "updated_at" => "2023-02-01T11:58:08.000Z"
            ],
            [
                "id_balasan" => 10,
            "balasan" => "Sudah dilakukan cabut-colok adapter, apakah antenna sudah bisa up?",
            "user_id" => 1,
            "keluhan_id" => 3,
            "created_at" => "2023-02-01T11:58:50.000Z",
            "updated_at" => "2023-02-01T11:58:50.000Z"
            ],
            [
                "id_balasan" => 11,
            "balasan" => "Dari pengecekan saat ini sedang ada gangguan massal di jalur backbone yang menyebabkan ping tinggi,\nMohon dibuatkan RFO Gangguan Massal nya ya",
            "user_id" => 2,
            "keluhan_id" => 4,
            "created_at" => "2023-02-01T12:00:13.000Z",
            "updated_at" => "2023-02-01T12:00:13.000Z"
            ],
            [
                "id_balasan" => 12,
            "balasan" => "Dari monitoring sudah bisa up dan sudah ada traffik pemakaian.\nBisa dicoba konfirmasi kembali koneksi nya",
            "user_id" => 2,
            "keluhan_id" => 3,
            "created_at" => "2023-02-01T12:00:56.000Z",
            "updated_at" => "2023-02-01T12:00:56.000Z"
            ],
            [
                "id_balasan" => 13,
            "balasan" => "Sudah dikonfirmasi ke klien dan diinformasikan sudah normal kembali",
            "user_id" => 1,
            "keluhan_id" => 3,
            "created_at" => "2023-02-01T12:01:35.000Z",
            "updated_at" => "2023-02-01T12:01:35.000Z"
            ],
            [
                "id_balasan" => 14,
            "balasan" => "Dari pengecekan saat ini sedang ada gangguan massal di jalur backbone yang menyebabkan ping tinggi,\nMohon dibuatkan RFO Gangguan Massal nya ya",
            "user_id" => 2,
            "keluhan_id" => 5,
            "created_at" => "2023-02-01T12:09:12.000Z",
            "updated_at" => "2023-02-01T12:09:12.000Z"
            ],
            [
                "id_balasan" => 15,
            "balasan" => "Saat iini perbaikan backbone sudah selesai, bisa dikonfirmasi kembali",
            "user_id" => 2,
            "keluhan_id" => 5,
            "created_at" => "2023-02-01T12:10:34.000Z",
            "updated_at" => "2023-02-01T12:10:34.000Z"
            ],
            [
                "id_balasan" => 16,
            "balasan" => "Saat iini perbaikan backbone sudah selesai, bisa dikonfirmasi kembali",
            "user_id" => 2,
            "keluhan_id" => 4,
            "created_at" => "2023-02-01T12:11:20.000Z",
            "updated_at" => "2023-02-01T12:11:20.000Z"
            ],
            [
                "id_balasan" => 17,
            "balasan" => "Sudah dikonfirmasi ke klien dan sudah normal kembali",
            "user_id" => 1,
            "keluhan_id" => 5,
            "created_at" => "2023-02-01T12:11:39.000Z",
            "updated_at" => "2023-02-01T12:11:39.000Z"
            ],
            [
                "id_balasan" => 18,
            "balasan" => "Sudah dikonfirmasi ke klien dan sudah normal kembali",
            "user_id" => 1,
            "keluhan_id" => 4,
            "created_at" => "2023-02-01T12:11:52.000Z",
            "updated_at" => "2023-02-01T12:11:52.000Z"
            ],
            [
                "id_balasan" => 19,
            "balasan" => "Dilakukan setting ulang wifi melalui remote\nbisa dikonfirmasi kembali ya",
            "user_id" => 2,
            "keluhan_id" => 2,
            "created_at" => "2023-02-01T12:13:20.000Z",
            "updated_at" => "2023-02-01T12:13:20.000Z"
            ],
            [
                "id_balasan" => 20,
            "balasan" => "Sudah dikonfirmasi dan sudah normal kembali",
            "user_id" => 1,
            "keluhan_id" => 2,
            "created_at" => "2023-02-01T12:13:44.000Z",
            "updated_at" => "2023-02-01T12:13:44.000Z"
            ],
            [
                "id_balasan" => 21,
            "balasan" => "Imbas gangguan FO Cut Sleman Kota",
            "user_id" => 2,
            "keluhan_id" => 8,
            "created_at" => "2023-02-01T12:22:00.000Z",
            "updated_at" => "2023-02-01T12:22:00.000Z"
            ],
            [
                "id_balasan" => 22,
                "balasan" => "Imbas gangguan FO Cut Sleman Kota",
                "user_id" => 2,
                "keluhan_id" => 7,
                "created_at" => "2023-02-01T12:22:33.000Z",
                "updated_at" => "2023-02-01T12:22:33.000Z"
            ],
            [
                "id_balasan" => 23,
            "balasan" => "Imbas gangguan FO Cut Sleman Kota",
            "user_id" => 2,
            "keluhan_id" => 6,
            "created_at" => "2023-02-01T12:22:55.000Z",
            "updated_at" => "2023-02-01T12:22:55.000Z"
            ],
            [
                "id_balasan" => 24,
            "balasan" => "Imbas gangguan FO Cut Sleman Kota",
            "user_id" => 2,
            "keluhan_id" => 9,
            "created_at" => "2023-02-01T12:26:02.000Z",
            "updated_at" => "2023-02-01T12:26:02.000Z"
            ],
            [
                "id_balasan" => 25,
            "balasan" => "Imbas gangguan FO Cut Sleman Kota",
            "user_id" => 2,
            "keluhan_id" => 10,
            "created_at" => "2023-02-01T12:28:21.000Z",
            "updated_at" => "2023-02-01T12:28:21.000Z"
            ],
            [
                "id_balasan" => 26,
            "balasan" => "Perbaikan sudah selesai, bisa dikonfirmasi kembali",
            "user_id" => 2,
            "keluhan_id" => 10,
            "created_at" => "2023-02-01T12:32:53.000Z",
            "updated_at" => "2023-02-01T12:32:53.000Z"],
            [
                "id_balasan" => 27,
            "balasan" => "Perbaikan sudah selesai, bisa dikonfirmasi kembali",
            "user_id" => 2,
            "keluhan_id" => 9,
            "created_at" => "2023-02-01T12:35:02.000Z",
            "updated_at" => "2023-02-01T12:35:02.000Z"
            ],
            [
                "id_balasan" => 28,
            "balasan" => "Perbaikan sudah selesai, bisa dikonfirmasi kembali",
            "user_id" => 2,
            "keluhan_id" => 8,
            "created_at" => "2023-02-01T12:35:53.000Z",
            "updated_at" => "2023-02-01T12:35:53.000Z"
            ],
            [
                "id_balasan" => 29,
            "balasan" => "Perbaikan sudah selesai, bisa dikonfirmasi kembali",
            "user_id" => 2,
            "keluhan_id" => 7,
            "created_at" => "2023-02-01T12:36:30.000Z",
            "updated_at" => "2023-02-01T12:36:30.000Z"
            ],
            [
                "id_balasan" => 30,
            "balasan" => "Perbaikan sudah selesai, bisa dikonfirmasi kembali",
            "user_id" => 2,
            "keluhan_id" => 6,
            "created_at" => "2023-02-01T12:36:41.000Z",
            "updated_at" => "2023-02-01T12:36:41.000Z"
            ],
            [
                "id_balasan" => 31,
            "balasan" => "Sudah dikonfirmasi dan sudah normal kembali",
            "user_id" => 1,
            "keluhan_id" => 10,
            "created_at" => "2023-02-01T12:37:04.000Z",
            "updated_at" => "2023-02-01T12:37:04.000Z"
            ],
            [
                "id_balasan" => 32,
            "balasan" => "Sudah dikonfirmasi dan sudah normal kembali",
            "user_id" => 1,
            "keluhan_id" => 9,
            "created_at" => "2023-02-01T12:37:20.000Z",
            "updated_at" => "2023-02-01T12:37:20.000Z"
            ],
            [
                "id_balasan" => 33,
            "balasan" => "Sudah dikonfirmasi dan sudah normal kembali",
            "user_id" => 1,
            "keluhan_id" => 8,
            "created_at" => "2023-02-01T12:37:33.000Z",
            "updated_at" => "2023-02-01T12:37:33.000Z"
            ],
            [
                "id_balasan" => 34,
            "balasan" => "Sudah dikonfirmasi dan sudah normal kembali",
            "user_id" => 1,
            "keluhan_id" => 7,
            "created_at" => "2023-02-01T12:38:06.000Z",
            "updated_at" => "2023-02-01T12:38:06.000Z"
            ],
            [
                "id_balasan" => 35,
            "balasan" => "Sudah dikonfirmasi dan sudah normal kembali",
            "user_id" => 1,
            "keluhan_id" => 6,
            "created_at" => "2023-02-01T12:39:01.000Z",
            "updated_at" => "2023-02-01T12:39:01.000Z"
            ],
            [
                "id_balasan" => 36,
            "balasan" => "Sudah dikonfirmasi dan sudah normal kembali",
            "user_id" => 1,
            "keluhan_id" => 7,
            "created_at" => "2023-02-01T12:39:24.000Z",
            "updated_at" => "2023-02-01T12:39:24.000Z"
            ],
            [
                "id_balasan" => 37,
            "balasan" => "Sudah dikonfirmasi dan sudah normal kembali",
            "user_id" => 1,
            "keluhan_id" => 8,
            "created_at" => "2023-02-01T12:39:46.000Z",
            "updated_at" => "2023-02-01T12:39:46.000Z"
            ],
            [
                "id_balasan" => 38,
            "balasan" => "Sudah dikonfirmasi dan sudah normal kembali",
            "user_id" => 1,
            "keluhan_id" => 9,
            "created_at" => "2023-02-01T12:40:09.000Z",
            "updated_at" => "2023-02-01T12:40:09.000Z"
            ],
            [
                "id_balasan" => 39,
            "balasan" => "Sudah normal kembali setelah direstart perangkat wifi oleh klien",
            "user_id" => 1,
            "keluhan_id" => 12,
            "created_at" => "2023-02-01T12:48:56.000Z",
            "updated_at" => "2023-02-01T12:48:56.000Z"
            ],
            [
                "id_balasan" => 40,
            "balasan" => "Bisa dicoba kembali, dilakukan restart router",
            "user_id" => 2,
            "keluhan_id" => 11,
            "created_at" => "2023-02-01T12:49:32.000Z",
            "updated_at" => "2023-02-01T12:49:32.000Z"
            ],
            [
                "id_balasan" => 41,
            "balasan" => "Sudah dikonfirmasi dan sudah normal kembali",
            "user_id" => 1,
            "keluhan_id" => 11,
            "created_at" => "2023-02-01T12:56:23.000Z",
            "updated_at" => "2023-02-01T12:56:23.000Z"
            ],
            [
                "id_balasan" => 42,
            "balasan" => "Sudah dikonfirmasi ke klien dan sudah normal kembali",
            "user_id" => 1,
            "keluhan_id" => 4,
            "created_at" => "2023-02-01T12:57:38.000Z",
            "updated_at" => "2023-02-01T12:57:38.000Z"
            ]]);
    }
}
