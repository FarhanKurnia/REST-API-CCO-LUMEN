<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // $this->call('UsersTableSeeder');
        $this->call([
            PopsTableSeeder::class,
            RolesTableSeeder::class,
            UsersTableSeeder::class,
            BtsTableSeeder::class,
            KeluhansSeeder::class,
            BalasansSeeder::class,
            KeluhansSeeder::class,
        ]);
    }
}
