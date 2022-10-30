<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;
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
            'email'=> 'hdyk@citra.net.id',
            'password'=>app('hash')->make('rahasia'),
            'created_at' => Carbon::now(),
        ],
        [
            'name'=> 'Kurnia',
            'pop_id' => '1',
            'role_id' => '2',
            'email'=> 'nocyk@citra.net.id',
            'password'=>app('hash')->make('rahasia'),
            'created_at' => Carbon::now(),
        ],
        [
            'name'=> 'Afif',
            'pop_id' => '2',
            'role_id' => '1',
            'email'=> 'hdsl@citra.net.id',
            'password'=>app('hash')->make('rahasia'),
            'created_at' => Carbon::now(),
        ],
        [
            'name'=> 'Alfiano',
            'pop_id' => '2',
            'role_id' => '2',
            'email'=> 'nocsl@citra.net.id',
            'password'=>app('hash')->make('rahasia'),
            'created_at' => Carbon::now(),
        ],
        [
            'name'=> 'Admin',
            'pop_id' => '1',
            'role_id' => '0',
            'email'=> 'admin@citra.net.id',
            'password'=>app('hash')->make('rahasia'),
            'created_at' => Carbon::now(),
        ]]);
    }
}
