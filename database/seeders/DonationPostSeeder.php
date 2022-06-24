<?php

namespace Database\Seeders;

use App\Models\Donation;
use App\Models\DonationPost;
use App\Models\DonationStatus;
use App\Models\Save;
use App\Models\SponsorShip;
use App\Models\State;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DonationPostSeeder extends Seeder
{


    public function run()
    {

        DonationPost::factory(300)->create()->each(
            function ($donationPost) {
                State::factory([
                    'donation_post_id' => $donationPost->id,
                ])->create();
                
                for ($i = 0; $i < rand(1, 3); $i++) {
                    DonationStatus::factory([
                        'donation_post_id' => $donationPost->id,
                    ])->create();
                }

                for ($i = 0; $i < rand(1, 50); $i++) {
                    Save::factory([
                        'donation_post_id' => $donationPost->id,
                    ])->create();
                }

                for ($i = 0; $i < rand(1, 10); $i++) {
                    SponsorShip::factory([
                        'donation_post_id' => $donationPost->id,
                    ])->create();
                }

                for ($i = 0; $i < rand(1, 20); $i++) {
                    Donation::factory([
                        'donation_post_id' => $donationPost->id,
                    ])->create();
                };
            }
        );
    }
}
