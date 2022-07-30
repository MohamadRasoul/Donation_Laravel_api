<?php

namespace Database\Seeders;

use App\Models\PostType;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class PostTypeSeeder extends Seeder
{
    
    
    public function run()
    {
        //  \App\Models\PostTypeSeeder::factory(10)->create();
        PostType::insert(
            [
                [
                    'title'       => 'Cases',
                    'description' => 'after they lost their father, who was arrested in 2013. Dima is an innocent girl aspiring to live a happy life despite poverty and living in a dilapidated house. Let',
                ],
                [
                    'title'       => 'Sponsorships',
                    'description' => 'after they lost their father, who was arrested in 2013. Dima is an innocent girl aspiring to live a happy life despite poverty and living in a dilapidated house. Let',
                ],
                [
                    'title'       => 'Campaigns',
                    'description' => 'after they lost their father, who was arrested in 2013. Dima is an innocent girl aspiring to live a happy life despite poverty and living in a dilapidated house. Let',
                ],
                [
                    'title'       => 'Education',
                    'description' => 'after they lost their father, who was arrested in 2013. Dima is an innocent girl aspiring to live a happy life despite poverty and living in a dilapidated house. Let',
                ]
            ]
        );
    }
}
