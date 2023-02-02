<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;
use Illuminate\Support\Str;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('users')->insert([[
            'name'=> 'Farhan',
            'pop_id' => '1',
            'role_id' => '1',
            'aktif' => true,
            'online' => false,
            'verifikasi' => true,
            'token_verifikasi' => Str::random(128),
            'avatar' => 'https://backend-api.skripsiprjt-utdi.my.id/avatar/1672584134_Farhan_avatar.jpg',
            'email'=> 'hdyk@citra.net.id',
            'password'=>app('hash')->make('rahasia'),
            'created_at' => Carbon::now(),
        ],
        [
            'name'=> 'Kurnia',
            'pop_id' => '1',
            'role_id' => '2',
            'aktif' => true,
            'online' => false,
            'verifikasi' => true,
            'token_verifikasi' => Str::random(128),
            'avatar' => 'https://backend-api.skripsiprjt-utdi.my.id/avatar/1672583339_Kurnia_avatar.jpg',
            'email'=> 'nocyk@citra.net.id',
            'password'=>app('hash')->make('rahasia'),
            'created_at' => Carbon::now(),
        ],
        [
            'name'=> 'Afif',
            'pop_id' => '2',
            'role_id' => '1',
            'aktif' => true,
            'online' => false,
            'verifikasi' => true,
            'token_verifikasi' => Str::random(128),
            'avatar' => 'https://backend-api.skripsiprjt-utdi.my.id/1672584926_Afif_avatar.jpg',
            'email'=> 'hdsl@citra.net.id',
            'password'=>app('hash')->make('rahasia'),
            'created_at' => Carbon::now(),
        ],
        [
            'name'=> 'Alfiano',
            'pop_id' => '2',
            'role_id' => '2',
            'aktif' => true,
            'online' => false,
            'verifikasi' => true,
            'token_verifikasi' => null,
            'avatar' => 'https://backend-api.skripsiprjt-utdi.my.id/avatar/1672584507_Alfiano_avatar.jpg',
            'email'=> 'nocsl@citra.net.id',
            'password'=>app('hash')->make('rahasia'),
            'created_at' => Carbon::now(),
        ],
        [
            'name'=> 'Admin',
            'pop_id' => '1',
            'role_id' => '0',
            'aktif' => true,
            'online' => false,
            'verifikasi' => true,
            'token_verifikasi' => Str::random(128),
            'avatar' => 'https://backend-api.skripsiprjt-utdi.my.id/avatar/1667660685_Admin_avatar.jpeg',
            'email'=> 'admin@citra.net.id',
            'password'=>app('hash')->make('rahasia'),
            'created_at' => Carbon::now(),
        ]]);
    }
}
