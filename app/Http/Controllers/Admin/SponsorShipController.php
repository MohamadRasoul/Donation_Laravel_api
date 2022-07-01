<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Resources\SponsorShipResource;
use App\Models\SponsorShip;


class SponsorShipController extends Controller
{

    public function updateDeliveryToDone(SponsorShip $sponsorShip)
    {

        // Update SponsorShip
        $sponsorShip->update([
            "is_delivery" => true
        ]);

        // Return Response
        return response()->success(
            'sponsorShip is updated success',
            [
                "sponsorShip" => new SponsorShipResource($sponsorShip),
            ]
        );
    }

}
