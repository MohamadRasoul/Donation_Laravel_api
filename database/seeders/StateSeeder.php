<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class StateSeeder extends Seeder
{


    public function run()
    {
        \App\Models\State::factory(50)->create();
    }
}
