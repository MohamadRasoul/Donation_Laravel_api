<?php

namespace Database\Factories;

use App\Models\Charitablefoundation;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\State>
 */
class StateFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            "first_name"   => $this->faker->name,
            "last_name"   => $this->faker->name,
            "id_number"   => $this->faker->ean13(),
            "phone_number"   => $this->faker->ean8(),
            "father_name"   => $this->faker->name,
            "mother_name"   => $this->faker->name,
            'charitablefoundation_id'  => Charitablefoundation::all()->random()->id,
            

        ];
    }
}
