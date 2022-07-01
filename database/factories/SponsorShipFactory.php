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
            'amount'              => $this->faker->numberBetween($min = 1000, $max = 35000),
            'month_to_pay'        => $this->faker->dateTimeBetween($startDate = 'now', $endDate = '+ 360 days', $timezone = null),
            'is_delivery'         => $this->faker->boolean(),

            'user_id'             => User::all()->random()->id,
        ];
    }
}
