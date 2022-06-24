<?php

namespace Database\Seeders;

use App\Models\StatusType;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class StatusTypeSeeder extends Seeder
{
    
    
    public function run()
    {
        //  \App\Models\StatusTypeSeeder::factory(10)->create();
        StatusType::insert(
            [
                [
                    'title'       => 'Health Care',
                    'description' => 'after they lost their father, who was arrested in 2013. Dima is an innocent girl aspiring to live a happy life despite poverty and living in a dilapidated house. Let',
                ],
                [
                    'title'       => 'Orphans',
                    'description' => 'after they lost their father, who was arrested in 2013. Dima is an innocent girl aspiring to live a happy life despite poverty and living in a dilapidated house. Let',
                ],
                [
                    'title'       => 'Analgesic Support',
                    'description' => 'after they lost their father, who was arrested in 2013. Dima is an innocent girl aspiring to live a happy life despite poverty and living in a dilapidated house. Let',
                ],
                [
                    'title'       => 'Education',
                    'description' => 'after they lost their father, who was arrested in 2013. Dima is an innocent girl aspiring to live a happy life despite poverty and living in a dilapidated house. Let',
                ],
                [
                    'title'       => 'General',
                    'description' => 'after they lost their father, who was arrested in 2013. Dima is an innocent girl aspiring to live a happy life despite poverty and living in a dilapidated house. Let',
                ]
            ]
        );
    }
}
