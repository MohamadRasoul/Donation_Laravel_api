<?php

namespace Database\Factories;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\SponsorShip>
 */
class SponsorShipFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'amount'                    => $this->faker->numberBetween($min = 1000, $max = 35000),
            'take_automatic'            => $this->faker->boolean,
            'month_day_to_pay'          => $this->faker->numberBetween($min = 1, $max = 30),
            'month_count_keep_paying'   => $this->faker->numberBetween($min = 3, $max = 12),

            'user_id'                   => User::all()->random()->id,
        ];
    }
}
