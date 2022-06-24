<?php

namespace Database\Seeders;

use App\Models\DonationType;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DonationTypeSeeder extends Seeder
{
    
    
    public function run()
    {
        //  \App\Models\DonationTypeSeeder::factory(10)->create();
        DonationType::insert(
            [
                [
                    'title'       => 'Medicine',
                    'description' => 'after they lost their father, who was arrested in 2013. Dima is an innocent girl aspiring to live a happy life despite poverty and living in a dilapidated house. Let',
                ],
                [
                    'title'       => 'Food',
                    'description' => 'after they lost their father, who was arrested in 2013. Dima is an innocent girl aspiring to live a happy life despite poverty and living in a dilapidated house. Let',
                ],
                [
                    'title'       => 'Clothing',
                    'description' => 'after they lost their father, who was arrested in 2013. Dima is an innocent girl aspiring to live a happy life despite poverty and living in a dilapidated house. Let',
                ],
                [
                    'title'       => 'Furniture',
                    'description' => 'after they lost their father, who was arrested in 2013. Dima is an innocent girl aspiring to live a happy life despite poverty and living in a dilapidated house. Let',
                ],
                [
                    'title'       => 'Household Appliance',
                    'description' => 'after they lost their father, who was arrested in 2013. Dima is an innocent girl aspiring to live a happy life despite poverty and living in a dilapidated house. Let',
                ]
            ]
        );
        
    }
}
