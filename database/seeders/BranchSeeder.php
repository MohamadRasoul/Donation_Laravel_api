<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class BranchSeeder extends Seeder
{


    public function run()
    {
        \App\Models\Branch::factory(30)->create();
    }
}
