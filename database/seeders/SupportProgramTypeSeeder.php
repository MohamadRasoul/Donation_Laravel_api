<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class SupportProgramTypeSeeder extends Seeder
{


    public function run()
    {
        \App\Models\SupportProgramType::factory(10)->create();
    }
}
