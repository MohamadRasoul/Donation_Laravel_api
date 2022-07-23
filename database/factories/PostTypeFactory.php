<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class PostTypeFactory extends Factory
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
            'description'             => $this->faker->text(200),
            // 'color'                   => $this->faker->hexcolor,
        ];
    }
}
