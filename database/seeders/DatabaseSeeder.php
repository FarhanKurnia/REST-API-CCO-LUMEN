<?php

namespace Database\Seeders;

use App\Models\Lampiran_Balasan;
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
            RFOKeluhanSeeder::class,
            RFOGangguanSeeder::class,
            KeluhansSeeder::class,
            BalasansSeeder::class,
            ShiftSeeder::class,
            LaporanSeeder::class,
            LampiranBalasanSeeder::class,
            LampiranKeluhanSeeder::class,
        ]);
    }
}
