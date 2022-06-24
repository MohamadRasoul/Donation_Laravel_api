<?php

namespace Database\Factories;

use App\Models\DonationPost;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

class DonationFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'amount'           => $this->faker->numberBetween(5000, 45000),
            'user_id'          => User::all()->random()->id,
        ];
    }
}
