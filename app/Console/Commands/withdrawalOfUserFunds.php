<?php

namespace App\Console\Commands;

use App\Models\SponsorShip;
use Illuminate\Console\Command;

class withdrawalOfUserFunds extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'fund:withdrawal';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Withdrawal Of User Funds';

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        // get all sponsor in this day
        // $sponsorShipToday = SponsorShip::where()


        // Withdrawal from all


        // add amount to donation post table

        return 0;
    }
}
