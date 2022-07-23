<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call([
            PermissionSeeder::class,
            CitySeeder::class,
            UserSeeder::class,
            CharitableFoundationSeeder::class,
            BranchSeeder::class,
            SupportProgramTypeSeeder::class,
            SupportProgramSeeder::class,
            PostTypeSeeder::class,
            StatusTypeSeeder::class,
            DonationPostSeeder::class,
            NewsSeeder::class,
        ]);
    }
}
