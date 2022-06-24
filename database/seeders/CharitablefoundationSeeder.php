<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CharitablefoundationSeeder extends Seeder
{


    public function run()
    {
        \App\Models\Charitablefoundation::factory(10)->create();
    }
}
