<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class RolesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('roles')->insert([[
            'id'=> '1',
            'role'=> 'HELPDESK',
            'created_at' => Carbon::now(),
        ],
        [
            'id'=> '2',
            'name'=> 'NOC',
            'created_at' => Carbon::now(),
        ]]);
    }
}
