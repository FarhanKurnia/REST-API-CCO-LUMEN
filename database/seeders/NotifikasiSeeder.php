<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class NotifikasiSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('notifikasis')->insert([
            [
                // "id_notifikasi" => 1,
            "judul" => "Keluhan baru UNREGISTERED - AGUS SUSANTO",
            "detail" => "Terdapat keluhan baru a.n pelanggan  UNREGISTERED - AGUS SUSANTO. Diupdate oleh Farhan",
            "keluhan_id" => 1,
            "user_id_notif" => null,
            "pop_id" => 1,
            "deep_link" => "http:\/\/localhost\/3000\/dashboard\/detail\/1",
            "created_at" => "2023-02-01T11:15:32.000Z",
            "updated_at" => "2023-02-01T11:15:32.000Z"
            ],
            [
                // "id_notifikasi" => 2,
            "judul" => "Keluhan baru 100004422 - MAULANA IBRAHIM",
            "detail" => "Terdapat keluhan baru a.n pelanggan  100004422 - MAULANA IBRAHIM. Diupdate oleh Farhan",
            "keluhan_id" => 2,
            "user_id_notif" => null,
            "pop_id" => 1,
            "deep_link" => "http:\/\/localhost\/3000\/dashboard\/detail\/2",
            "created_at" => "2023-02-01T11:17:14.000Z",
            "updated_at" => "2023-02-01T11:17:14.000Z"
            ],
            [
                // "id_notifikasi" => 3,
            "judul" => "Balasan baru UNREGISTERED - AGUS SUSANTO",
            "detail" => "Terdapat balasan terbaru untuk keluhan a.n pelanggan  UNREGISTERED - AGUS SUSANTO. Diupdate oleh Kurnia",
            "keluhan_id" => 1,
            "user_id_notif" => null,
            "pop_id" => 1,
            "deep_link" => "http:\/\/localhost\/3000\/dashboard\/detail\/1",
            "created_at" => "2023-02-01T11:18:09.000Z",
            "updated_at" => "2023-02-01T11:18:09.000Z"
            ],
            [
                // "id_notifikasi" => 4,
            "judul" => "Keluhan baru 100005524 - FATHIA IZZATI",
            "detail" => "Terdapat keluhan baru a.n pelanggan  100005524 - FATHIA IZZATI. Diupdate oleh Farhan",
            "keluhan_id" => 3,
            "user_id_notif" => null,
            "pop_id" => 1,
            "deep_link" => "http:\/\/localhost\/3000\/dashboard\/detail\/3",
            "created_at" => "2023-02-01T11:19:49.000Z",
            "updated_at" => "2023-02-01T11:19:49.000Z"
            ],
            [
                // "id_notifikasi" => 5,
            "judul" => "Balasan baru UNREGISTERED - AGUS SUSANTO",
            "detail" => "Terdapat balasan terbaru untuk keluhan a.n pelanggan  UNREGISTERED - AGUS SUSANTO. Diupdate oleh Kurnia",
            "keluhan_id" => 1,
            "user_id_notif" => null,
            "pop_id" => 1,
            "deep_link" => "http:\/\/localhost\/3000\/dashboard\/detail\/1",
            "created_at" => "2023-02-01T11:21:32.000Z",
            "updated_at" => "2023-02-01T11:21:32.000Z"
            ],
            [
                // "id_notifikasi" => 6,
            "judul" => "Balasan baru 100005524 - FATHIA IZZATI",
            "detail" => "Terdapat balasan terbaru untuk keluhan a.n pelanggan  100005524 - FATHIA IZZATI. Diupdate oleh Kurnia",
            "keluhan_id" => 3,
            "user_id_notif" => null,
            "pop_id" => 1,
            "deep_link" => "http:\/\/localhost\/3000\/dashboard\/detail\/3",
            "created_at" => "2023-02-01T11:22:11.000Z",
            "updated_at" => "2023-02-01T11:22:11.000Z"
            ],
            [
                // "id_notifikasi" => 7,
            "judul" => "Keluhan baru UNREGISTERED - BASKARA PUTRA",
            "detail" => "Terdapat keluhan baru a.n pelanggan  UNREGISTERED - BASKARA PUTRA. Diupdate oleh Farhan",
            "keluhan_id" => 4,
            "user_id_notif" => null,
            "pop_id" => 1,
            "deep_link" => "http:\/\/localhost\/3000\/dashboard\/detail\/4",
            "created_at" => "2023-02-01T11:24:25.000Z",
            "updated_at" => "2023-02-01T11:24:25.000Z"
            ],
            [
                // "id_notifikasi" => 8,
            "judul" => "Balasan baru 100005524 - FATHIA IZZATI",
            "detail" => "Terdapat balasan terbaru untuk keluhan a.n pelanggan  100005524 - FATHIA IZZATI. Diupdate oleh Kurnia",
            "keluhan_id" => 3,
            "user_id_notif" => null,
            "pop_id" => 1,
            "deep_link" => "http:\/\/localhost\/3000\/dashboard\/detail\/3",
            "created_at" => "2023-02-01T11:25:16.000Z",
            "updated_at" => "2023-02-01T11:25:16.000Z"
            ],
            [
                // "id_notifikasi" => 9,
            "judul" => "Balasan baru UNREGISTERED - AGUS SUSANTO",
            "detail" => "Terdapat balasan terbaru untuk keluhan a.n pelanggan  UNREGISTERED - AGUS SUSANTO. Diupdate oleh Farhan",
            "keluhan_id" => 1,
            "user_id_notif" => null,
            "pop_id" => 1,
            "deep_link" => "http:\/\/localhost\/3000\/dashboard\/detail\/1",
            "created_at" => "2023-02-01T11:26:43.000Z",
            "updated_at" => "2023-02-01T11:26:43.000Z"
            ],
            [
                // "id_notifikasi" => 10,
            "judul" => "Balasan baru 100004422 - MAULANA IBRAHIM",
            "detail" => "Terdapat balasan terbaru untuk keluhan a.n pelanggan  100004422 - MAULANA IBRAHIM. Diupdate oleh Kurnia",
            "keluhan_id" => 2,
            "user_id_notif" => null,
            "pop_id" => 1,
            "deep_link" => "http:\/\/localhost\/3000\/dashboard\/detail\/2",
            "created_at" => "2023-02-01T11:56:29.000Z",
            "updated_at" => "2023-02-01T11:56:29.000Z"
            ],
            [
                // "id_notifikasi" => 11,
            "judul" => "Balasan baru 100005524 - FATHIA IZZATI",
            "detail" => "Terdapat balasan terbaru untuk keluhan a.n pelanggan  100005524 - FATHIA IZZATI. Diupdate oleh Farhan",
            "keluhan_id" => 3,
            "user_id_notif" => null,
            "pop_id" => 1,
            "deep_link" => "http:\/\/localhost\/3000\/dashboard\/detail\/3",
            "created_at" => "2023-02-01T11:57:46.000Z",
            "updated_at" => "2023-02-01T11:57:46.000Z"
            ],
            [
                // "id_notifikasi" => 12,
            "judul" => "Balasan baru UNREGISTERED - BASKARA PUTRA",
            "detail" => "Terdapat balasan terbaru untuk keluhan a.n pelanggan  UNREGISTERED - BASKARA PUTRA. Diupdate oleh Kurnia",
            "keluhan_id" => 4,
            "user_id_notif" => null,
            "pop_id" => 1,
            "deep_link" => "http:\/\/localhost\/3000\/dashboard\/detail\/4",
            "created_at" => "2023-02-01T11:58:13.000Z",
            "updated_at" => "2023-02-01T11:58:13.000Z"
            ],
            [
                // "id_notifikasi" => 13,
            "judul" => "Balasan baru 100005524 - FATHIA IZZATI",
            "detail" => "Terdapat balasan terbaru untuk keluhan a.n pelanggan  100005524 - FATHIA IZZATI. Diupdate oleh Farhan",
            "keluhan_id" => 3,
            "user_id_notif" => null,
            "pop_id" => 1,
            "deep_link" => "http:\/\/localhost\/3000\/dashboard\/detail\/3",
            "created_at" => "2023-02-01T11:59:12.000Z",
            "updated_at" => "2023-02-01T11:59:12.000Z"
            ],
            [
                // "id_notifikasi" => 14,
            "judul" => "Balasan baru UNREGISTERED - BASKARA PUTRA",
            "detail" => "Terdapat balasan terbaru untuk keluhan a.n pelanggan  UNREGISTERED - BASKARA PUTRA. Diupdate oleh Kurnia",
            "keluhan_id" => 4,
            "user_id_notif" => null,
            "pop_id" => 1,
            "deep_link" => "http:\/\/localhost\/3000\/dashboard\/detail\/4",
            "created_at" => "2023-02-01T12:00:15.000Z",
            "updated_at" => "2023-02-01T12:00:15.000Z"
            ],
            [
                // "id_notifikasi" => 15,
            "judul" => "Balasan baru 100005524 - FATHIA IZZATI",
            "detail" => "Terdapat balasan terbaru untuk keluhan a.n pelanggan  100005524 - FATHIA IZZATI. Diupdate oleh Farhan",
            "keluhan_id" => 3,
            "user_id_notif" => null,
            "pop_id" => 1,
            "deep_link" => "http:\/\/localhost\/3000\/dashboard\/detail\/3",
            "created_at" => "2023-02-01T12:01:40.000Z",
            "updated_at" => "2023-02-01T12:01:40.000Z"
            ],
            [
                // "id_notifikasi" => 16,
            "judul" => "Keluhan baru 100008998 - KUPIKU COFFEE",
            "detail" => "Terdapat keluhan baru a.n pelanggan  100008998 - KUPIKU COFFEE. Diupdate oleh Farhan",
            "keluhan_id" => 5,
            "user_id_notif" => null,
            "pop_id" => 1,
            "deep_link" => "http:\/\/localhost\/3000\/dashboard\/detail\/5",
            "created_at" => "2023-02-01T12:05:58.000Z",
            "updated_at" => "2023-02-01T12:05:58.000Z"
            ],
            [
                // "id_notifikasi" => 17,
            "judul" => "Balasan baru 100008998 - KUPIKU COFFEE",
            "detail" => "Terdapat balasan terbaru untuk keluhan a.n pelanggan  100008998 - KUPIKU COFFEE. Diupdate oleh Kurnia",
            "keluhan_id" => 5,
            "user_id_notif" => null,
            "pop_id" => 1,
            "deep_link" => "http:\/\/localhost\/3000\/dashboard\/detail\/5",
            "created_at" => "2023-02-01T12:10:04.000Z",
            "updated_at" => "2023-02-01T12:10:04.000Z"
            ],
            [
                // "id_notifikasi" => 18,
            "judul" => "Balasan baru UNREGISTERED - BASKARA PUTRA",
            "detail" => "Terdapat balasan terbaru untuk keluhan a.n pelanggan  UNREGISTERED - BASKARA PUTRA. Diupdate oleh Kurnia",
            "keluhan_id" => 4,
            "user_id_notif" => null,
            "pop_id" => 1,
            "deep_link" => "http:\/\/localhost\/3000\/dashboard\/detail\/4",
            "created_at" => "2023-02-01T12:11:22.000Z",
            "updated_at" => "2023-02-01T12:11:22.000Z"
            ],
            [
                // "id_notifikasi" => 19,
            "judul" => "Balasan baru 100008998 - KUPIKU COFFEE",
            "detail" => "Terdapat balasan terbaru untuk keluhan a.n pelanggan  100008998 - KUPIKU COFFEE. Diupdate oleh Farhan",
            "keluhan_id" => 5,
            "user_id_notif" => null,
            "pop_id" => 1,
            "deep_link" => "http:\/\/localhost\/3000\/dashboard\/detail\/5",
            "created_at" => "2023-02-01T12:11:41.000Z",
            "updated_at" => "2023-02-01T12:11:41.000Z"
            ],
            [
                // "id_notifikasi" => 20,
            "judul" => "Balasan baru UNREGISTERED - BASKARA PUTRA",
            "detail" => "Terdapat balasan terbaru untuk keluhan a.n pelanggan  UNREGISTERED - BASKARA PUTRA. Diupdate oleh Farhan",
            "keluhan_id" => 4,
            "user_id_notif" => null,
            "pop_id" => 1,
            "deep_link" => "http:\/\/localhost\/3000\/dashboard\/detail\/4",
            "created_at" => "2023-02-01T12:11:57.000Z",
            "updated_at" => "2023-02-01T12:11:57.000Z"
            ],
            [
                // "id_notifikasi" => 21,
            "judul" => "Balasan baru 100004422 - MAULANA IBRAHIM",
            "detail" => "Terdapat balasan terbaru untuk keluhan a.n pelanggan  100004422 - MAULANA IBRAHIM. Diupdate oleh Kurnia",
            "keluhan_id" => 2,
            "user_id_notif" => null,
            "pop_id" => 1,
            "deep_link" => "http:\/\/localhost\/3000\/dashboard\/detail\/2",
            "created_at" => "2023-02-01T12:13:26.000Z",
            "updated_at" => "2023-02-01T12:13:26.000Z"
            ],
            [
                // "id_notifikasi" => 22,
            "judul" => "Balasan baru 100004422 - MAULANA IBRAHIM",
            "detail" => "Terdapat balasan terbaru untuk keluhan a.n pelanggan  100004422 - MAULANA IBRAHIM. Diupdate oleh Farhan",
            "keluhan_id" => 2,
            "user_id_notif" => null,
            "pop_id" => 1,
            "deep_link" => "http:\/\/localhost\/3000\/dashboard\/detail\/2",
            "created_at" => "2023-02-01T12:13:46.000Z",
            "updated_at" => "2023-02-01T12:13:46.000Z"
            ],
            [
                // "id_notifikasi" => 23,
            "judul" => "Keluhan baru UNREGISTERED - COUVEE COFFEE",
            "detail" => "Terdapat keluhan baru a.n pelanggan  UNREGISTERED - COUVEE COFFEE. Diupdate oleh Farhan",
            "keluhan_id" => 6,
            "user_id_notif" => null,
            "pop_id" => 1,
            "deep_link" => "http:\/\/localhost\/3000\/dashboard\/detail\/6",
            "created_at" => "2023-02-01T12:17:10.000Z",
            "updated_at" => "2023-02-01T12:17:10.000Z"
            ],
            [
                // "id_notifikasi" => 24,
            "judul" => "Keluhan baru UNREGISTERED - FORE COFFEE",
            "detail" => "Terdapat keluhan baru a.n pelanggan  UNREGISTERED - FORE COFFEE. Diupdate oleh Farhan",
            "keluhan_id" => 7,
            "user_id_notif" => null,
            "pop_id" => 1,
            "deep_link" => "http:\/\/localhost\/3000\/dashboard\/detail\/7",
            "created_at" => "2023-02-01T12:18:42.000Z",
            "updated_at" => "2023-02-01T12:18:42.000Z"
            ],
            [
                // "id_notifikasi" => 25,
            "judul" => "Keluhan baru 100002334 - M ALEX TURNER",
            "detail" => "Terdapat keluhan baru a.n pelanggan  100002334 - M ALEX TURNER. Diupdate oleh Farhan",
            "keluhan_id" => 8,
            "user_id_notif" => null,
            "pop_id" => 1,
            "deep_link" => "http:\/\/localhost\/3000\/dashboard\/detail\/8",
            "created_at" => "2023-02-01T12:21:16.000Z",
            "updated_at" => "2023-02-01T12:21:16.000Z"
            ],
            [
                // "id_notifikasi" => 26,
            "judul" => "Balasan baru UNREGISTERED - FORE COFFEE",
            "detail" => "Terdapat balasan terbaru untuk keluhan a.n pelanggan  UNREGISTERED - FORE COFFEE. Diupdate oleh Kurnia",
            "keluhan_id" => 7,
            "user_id_notif" => null,
            "pop_id" => 1,
            "deep_link" => "http:\/\/localhost\/3000\/dashboard\/detail\/7",
            "created_at" => "2023-02-01T12:22:47.000Z",
            "updated_at" => "2023-02-01T12:22:47.000Z"
            ],
            [
                // "id_notifikasi" => 27,
            "judul" => "Balasan baru UNREGISTERED - COUVEE COFFEE",
            "detail" => "Terdapat balasan terbaru untuk keluhan a.n pelanggan  UNREGISTERED - COUVEE COFFEE. Diupdate oleh Kurnia",
            "keluhan_id" => 6,
            "user_id_notif" => null,
            "pop_id" => 1,
            "deep_link" => "http:\/\/localhost\/3000\/dashboard\/detail\/6",
            "created_at" => "2023-02-01T12:23:03.000Z",
            "updated_at" => "2023-02-01T12:23:03.000Z"
            ],
            [
                // "id_notifikasi" => 28,
            "judul" => "Keluhan baru UNREGISTERED - JAJANG SUSENO",
            "detail" => "Terdapat keluhan baru a.n pelanggan  UNREGISTERED - JAJANG SUSENO. Diupdate oleh Farhan",
            "keluhan_id" => 9,
            "user_id_notif" => null,
            "pop_id" => 1,
            "deep_link" => "http:\/\/localhost\/3000\/dashboard\/detail\/9",
            "created_at" => "2023-02-01T12:25:25.000Z",
            "updated_at" => "2023-02-01T12:25:25.000Z"
            ],
            [
                // "id_notifikasi" => 29,
            "judul" => "Keluhan baru 100005674 - FAJAR PURNAMA",
            "detail" => "Terdapat keluhan baru a.n pelanggan  100005674 - FAJAR PURNAMA. Diupdate oleh Farhan",
            "keluhan_id" => 10,
            "user_id_notif" => null,
            "pop_id" => 1,
            "deep_link" => "http:\/\/localhost\/3000\/dashboard\/detail\/10",
            "created_at" => "2023-02-01T12:27:58.000Z",
            "updated_at" => "2023-02-01T12:27:58.000Z"
            ],
            [
                // "id_notifikasi" => 30,
                "judul" => "Balasan baru 100005674 - FAJAR PURNAMA",
                "detail" => "Terdapat balasan terbaru untuk keluhan a.n pelanggan  100005674 - FAJAR PURNAMA. Diupdate oleh Kurnia",
                "keluhan_id" => 10,
                "user_id_notif" => null,
                "pop_id" => 1,
                "deep_link" => "http:\/\/localhost\/3000\/dashboard\/detail\/10",
                "created_at" => "2023-02-01T12:28:22.000Z",
                "updated_at" => "2023-02-01T12:28:22.000Z"
            ],[
                // "id_notifikasi" => 31,
                "judul" => "Balasan baru 100005674 - FAJAR PURNAMA",
                "detail" => "Terdapat balasan terbaru untuk keluhan a.n pelanggan  100005674 - FAJAR PURNAMA. Diupdate oleh Kurnia",
                "keluhan_id" => 10,
                "user_id_notif" => null,
                "pop_id" => 1,
                "deep_link" => "http:\/\/localhost\/3000\/dashboard\/detail\/10",
                "created_at" => "2023-02-01T12:33:30.000Z",
                "updated_at" => "2023-02-01T12:33:30.000Z"
            ],
            [
                // "id_notifikasi" => 32,
                "judul" => "Balasan baru UNREGISTERED - JAJANG SUSENO",
                "detail" => "Terdapat balasan terbaru untuk keluhan a.n pelanggan  UNREGISTERED - JAJANG SUSENO. Diupdate oleh Kurnia",
                "keluhan_id" => 9,
                "user_id_notif" => null,
                "pop_id" => 1,
                "deep_link" => "http:\/\/localhost\/3000\/dashboard\/detail\/9",
                "created_at" => "2023-02-01T12:35:40.000Z",
                "updated_at" => "2023-02-01T12:35:40.000Z"
            ],
            [
                // "id_notifikasi" => 33,
            "judul" => "Balasan baru UNREGISTERED - FORE COFFEE",
            "detail" => "Terdapat balasan terbaru untuk keluhan a.n pelanggan  UNREGISTERED - FORE COFFEE. Diupdate oleh Kurnia",
            "keluhan_id" => 7,
            "user_id_notif" => null,
            "pop_id" => 1,
            "deep_link" => "http:\/\/localhost\/3000\/dashboard\/detail\/7",
            "created_at" => "2023-02-01T12:36:32.000Z",
            "updated_at" => "2023-02-01T12:36:32.000Z"
            ],
            [
                // "id_notifikasi" => 34,
            "judul" => "Balasan baru UNREGISTERED - COUVEE COFFEE",
            "detail" => "Terdapat balasan terbaru untuk keluhan a.n pelanggan  UNREGISTERED - COUVEE COFFEE. Diupdate oleh Kurnia",
            "keluhan_id" => 6,
            "user_id_notif" => null,
            "pop_id" => 1,
            "deep_link" => "http:\/\/localhost\/3000\/dashboard\/detail\/6",
            "created_at" => "2023-02-01T12:36:43.000Z",
            "updated_at" => "2023-02-01T12:36:43.000Z"
            ],
            [
                // "id_notifikasi" => 35,
            "judul" => "Balasan baru 100005674 - FAJAR PURNAMA",
            "detail" => "Terdapat balasan terbaru untuk keluhan a.n pelanggan  100005674 - FAJAR PURNAMA. Diupdate oleh Farhan",
            "keluhan_id" => 10,
            "user_id_notif" => null,
            "pop_id" => 1,
            "deep_link" => "http:\/\/localhost\/3000\/dashboard\/detail\/10",
            "created_at" => "2023-02-01T12:37:06.000Z",
            "updated_at" => "2023-02-01T12:37:06.000Z"
            ],
            [
                // "id_notifikasi" => 36,
            "judul" => "Balasan baru UNREGISTERED - JAJANG SUSENO",
            "detail" => "Terdapat balasan terbaru untuk keluhan a.n pelanggan  UNREGISTERED - JAJANG SUSENO. Diupdate oleh Farhan",
            "keluhan_id" => 9,
            "user_id_notif" => null,
            "pop_id" => 1,
            "deep_link" => "http:\/\/localhost\/3000\/dashboard\/detail\/9",
            "created_at" => "2023-02-01T12:37:21.000Z",
            "updated_at" => "2023-02-01T12:37:21.000Z"
            ],
            [
                // "id_notifikasi" => 37,
            "judul" => "Balasan baru 100002334 - M ALEX TURNER",
            "detail" => "Terdapat balasan terbaru untuk keluhan a.n pelanggan  100002334 - M ALEX TURNER. Diupdate oleh Farhan",
            "keluhan_id" => 8,
            "user_id_notif" => null,
            "pop_id" => 1,
            "deep_link" => "http:\/\/localhost\/3000\/dashboard\/detail\/8",
            "created_at" => "2023-02-01T12:37:46.000Z",
            "updated_at" => "2023-02-01T12:37:46.000Z"
            ],
            [
                // "id_notifikasi" => 38,
            "judul" => "Keluhan baru UNREGISTERED - ABIGAIL",
            "detail" => "Terdapat keluhan baru a.n pelanggan  UNREGISTERED - ABIGAIL. Diupdate oleh Farhan",
            "keluhan_id" => 11,
            "user_id_notif" => null,
            "pop_id" => 1,
            "deep_link" => "http:\/\/localhost\/3000\/dashboard\/detail\/11",
            "created_at" => "2023-02-01T12:44:56.000Z",
            "updated_at" => "2023-02-01T12:44:56.000Z"
            ],
            [
                // "id_notifikasi" => 39,
            "judul" => "Balasan baru 200008976 - GIBRAN PANGAREP",
            "detail" => "Terdapat balasan terbaru untuk keluhan a.n pelanggan  200008976 - GIBRAN PANGAREP. Diupdate oleh Farhan",
            "keluhan_id" => 12,
            "user_id_notif" => null,
            "pop_id" => 1,
            "deep_link" => "http:\/\/localhost\/3000\/dashboard\/detail\/12",
            "created_at" => "2023-02-01T12:49:09.000Z",
            "updated_at" => "2023-02-01T12:49:09.000Z"
            ],
            [
                // "id_notifikasi" => 40,
            "judul" => "Balasan baru UNREGISTERED - ABIGAIL",
            "detail" => "Terdapat balasan terbaru untuk keluhan a.n pelanggan  UNREGISTERED - ABIGAIL. Diupdate oleh Kurnia",
            "keluhan_id" => 11,
            "user_id_notif" => null,
            "pop_id" => 1,
            "deep_link" => "http:\/\/localhost\/3000\/dashboard\/detail\/11",
            "created_at" => "2023-02-01T12:49:34.000Z",
            "updated_at" => "2023-02-01T12:49:34.000Z"
            ],
            [
                // "id_notifikasi" => 41,
            "judul" => "Balasan baru UNREGISTERED - ABIGAIL",
            "detail" => "Terdapat balasan terbaru untuk keluhan a.n pelanggan  UNREGISTERED - ABIGAIL. Diupdate oleh Farhan",
            "keluhan_id" => 11,
            "user_id_notif" => null,
            "pop_id" => 1,
            "deep_link" => "http:\/\/localhost\/3000\/dashboard\/detail\/11",
            "created_at" => "2023-02-01T12:56:25.000Z",
            "updated_at" => "2023-02-01T12:56:25.000Z"
            ],
            [
                // "id_notifikasi" => 42,
            "judul" => "Keluhan baru UNREGISTERED - MUHAMMAD AFFANDI",
            "detail" => "Terdapat keluhan baru a.n pelanggan  UNREGISTERED - MUHAMMAD AFFANDI. Diupdate oleh Farhan",
            "keluhan_id" => 13,
            "user_id_notif" => null,
            "pop_id" => 1,
            "deep_link" => "http:\/\/localhost\/3000\/dashboard\/detail\/13",
            "created_at" => "2023-02-01T13:03:27.000Z",
            "updated_at" => "2023-02-01T13:03:27.000Z"
            ],
            [
                // "id_notifikasi" => 43,
            "judul" => "Keluhan baru 100002329 - RAHAJENG ",
            "detail" => "Terdapat keluhan baru a.n pelanggan  100002329 - RAHAJENG . Diupdate oleh Farhan",
            "keluhan_id" => 15,
            "user_id_notif" => null,
            "pop_id" => 1,
            "deep_link" => "http:\/\/localhost\/3000\/dashboard\/detail\/15",
            "created_at" => "2023-02-01T13:10:20.000Z",
            "updated_at" => "2023-02-01T13:10:20.000Z"
            ]
        ]);
    }
}
