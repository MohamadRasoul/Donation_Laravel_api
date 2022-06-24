<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class CityFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'name'                      => $this->faker->state,
            'latitude'                  => $this->faker->latitude($min = -90, $max = 90),
            'longitude'                 => $this->faker->longitude($min = -180, $max = 180),
        ];
    }
}
