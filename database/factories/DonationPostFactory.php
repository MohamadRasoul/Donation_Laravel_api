<?php

namespace Database\Factories;

use App\Models\Branch;
use App\Models\City;
use App\Models\PostType;
use Illuminate\Database\Eloquent\Factories\Factory;

class DonationPostFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'title'             => $this->faker->catchPhrase,
            'description'       => $this->faker->paragraph($nbSentences = 3, $variableNbSentences = true),
            'start_date'        => $this->faker->dateTimeBetween($startDate = 'now', $endDate = '+ 20 days', $timezone = null),
            'end_date'          => $this->faker->dateTimeBetween($startDate = '+ 20 days', $endDate = '+ 90 days', $timezone = null),
            'amount_required'   => $this->faker->numberBetween($min = 1000, $max = 35000),
            'amount_donated'    => $this->faker->numberBetween($min = 100, $max = 5000),

            'branch_id'         => Branch::all()->random()->id,
            'post_type_id'      => PostType::all()->random()->id,
            'city_id'           => City::all()->random()->id,
        ];
    }
}
