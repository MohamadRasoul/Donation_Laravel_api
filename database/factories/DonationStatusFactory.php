<?php

namespace Database\Factories;

use App\Models\DonationPost;
use App\Models\StatusType;
use Illuminate\Database\Eloquent\Factories\Factory;

class DonationStatusFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'status_type_id'   => StatusType::all()->random()->id,
        ];
    }
}
