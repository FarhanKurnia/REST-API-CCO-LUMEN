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
        DB::table('roles')->insert([
        [
            'id_role'=> '0',
            'name'=> 'ADMIN',
            'created_at' => Carbon::now(),
        ],
        [
            // 'id_role'=> '1',
            'role'=> 'HELPDESK',
            'created_at' => Carbon::now(),
        ],
        [
            // 'id_role'=> '2',
            'name'=> 'NOC',
            'created_at' => Carbon::now(),
        ]
        // [
        //     // 'id_role'=> '3',
        //     'name'=> 'FOP',
        //     'created_at' => Carbon::now(),
        // ]
        ]);
    }
}
