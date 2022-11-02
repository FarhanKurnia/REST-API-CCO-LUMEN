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
            SumberKeluhanSeeder::class,
            RolesTableSeeder::class,
            PopsTableSeeder::class,
            UsersTableSeeder::class,
            BtsTableSeeder::class,
            RFOGangguanSeeder::class,
            KeluhansSeeder::class,
            BalasansSeeder::class,
            RFOKeluhanSeeder::class,
            ShiftSeeder::class,
        ]);
    }
}
