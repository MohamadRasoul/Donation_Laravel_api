<?php

namespace Database\Factories;

use App\Models\Branch;
use App\Models\City;
use App\Models\SupportProgramType;
use Illuminate\Database\Eloquent\Factories\Factory;

class SupportProgramFactory extends Factory
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
            'instructor'              => $this->faker->name,
            'begin_date'              => $this->faker->dateTimeBetween($startDate = 'now', $endDate = '+ 20 days', $timezone = null),
            'url_to_contact'          => $this->faker->url,
            'is_available'            => $this->faker->boolean,
            'branch_id'               => Branch::all()->random()->id,
            'city_id'                 => City::all()->random()->id,
            'support_program_type_id' => SupportProgramType::all()->random()->id,
        ];
    }
}
