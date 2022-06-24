<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class SupportProgramSeeder extends Seeder
{
    
    
    public function run()
    {
         \App\Models\SupportProgram::factory(10)->create();
        
    }
}
