<?php

namespace Database\Factories;

use App\Models\Branch;
use App\Models\DonationPost;
use App\Models\SupportProgram;
use Illuminate\Database\Eloquent\Factories\Factory;

class NewsFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'title'                   => $this->faker->catchPhrase,
            'description'             => $this->faker->paragraph($nbSentences = 3, $variableNbSentences = true),

            'donation_post_id'        => DonationPost::all()->random()->id,
            'support_program_id'      => SupportProgram::all()->random()->id,
            'branch_id'               => Branch::all()->random()->id,
        ];
    }
}
