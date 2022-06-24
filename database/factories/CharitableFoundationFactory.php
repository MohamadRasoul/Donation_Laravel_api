<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class CharitableFoundationFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'name'          => $this->faker->name,
            'description'   => $this->faker->text(200),
            'website'       => $this->faker->url,
            'email'         => $this->faker->email,
            'phone_number'  => $this->faker->phoneNumber,
        ];
    }
}
