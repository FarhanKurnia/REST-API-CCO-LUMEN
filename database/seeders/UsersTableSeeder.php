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
            'name'=> 'farhan',
            'pop_id' => '1',
            'role_id' => '1',
            'email'=> 'user1@gmail.com',
            'password'=>app('hash')->make('rahasia'),
            'created_at' => Carbon::now(),
        ],
        [
            'name'=> 'kurnia',
            'pop_id' => '2',
            'role_id' => '2',
            'email'=> 'user2@gmail.com',
            'password'=>app('hash')->make('rahasia'),
            'created_at' => Carbon::now(),
        ]]);
    }
}
