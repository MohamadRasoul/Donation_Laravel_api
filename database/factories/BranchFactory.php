<?php

namespace Database\Factories;

use App\Models\Charitablefoundation;
use App\Models\City;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Branch>
 */
class BranchFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'name'                     => $this->faker->company(),
            'phone_number'             => $this->faker->e164PhoneNumber,
            'email'                    => $this->faker->email,
            'address'                  => $this->faker->paragraph($nbSentences = 3, $variableNbSentences = true),
            'latitude'                 => $this->faker->latitude($min = -90, $max = 90),
            'longitude'                => $this->faker->longitude($min = -180, $max = 180),

            'charitablefoundation_id'  => Charitablefoundation::all()->random()->id,
            'city_id'                  => City::all()->random()->id,
        ];
    }
}
