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
            'email'=> 'hdyk@gmail.com',
            'password'=>app('hash')->make('rahasia'),
            'created_at' => Carbon::now(),
        ],
        [
            'name'=> 'Kurnia',
            'pop_id' => '1',
            'role_id' => '2',
            'email'=> 'nocyk@gmail.com',
            'password'=>app('hash')->make('rahasia'),
            'created_at' => Carbon::now(),
        ],
        [
            'name'=> 'Ragil',
            'pop_id' => '2',
            'role_id' => '1',
            'email'=> 'hdsl@gmail.com',
            'password'=>app('hash')->make('rahasia'),
            'created_at' => Carbon::now(),
        ],
        [
            'name'=> 'Syahputra',
            'pop_id' => '2',
            'role_id' => '2',
            'email'=> 'nocsl@gmail.com',
            'password'=>app('hash')->make('rahasia'),
            'created_at' => Carbon::now(),
        ],
        [
            'name'=> 'Admin',
            'pop_id' => '1',
            'role_id' => '0',
            'email'=> 'admin@gmail.com',
            'password'=>app('hash')->make('rahasia'),
            'created_at' => Carbon::now(),
        ]]);
    }
}
