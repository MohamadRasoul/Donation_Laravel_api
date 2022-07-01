<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Controllers\SponsorShipResource;
use App\Models\SponsorShip;


class SponsorShipController extends Controller
{

    public function index()
    {
        // Get Data
        $sponsorShips = SponsorShip::latest()->get();

        // Return Response
        return response()->success(
            'this is all SponsorShips',
            [
                "sponsorShips" => SponsorShipResource::collection($sponsorShips),
            ]
        );
    }


    public function store(Request $request)
    {

        // Data Validate
        $data = $request->validate([
            'name'          => 'required',
        ]);


        // Store SponsorShip
        $sponsorShip = SponsorShip::create($data);


        // Add Image to SponsorShip
        $sponsorShip
            ->addMediaFromRequest('image')
            ->toMediaCollection('SponsorShip');

        // Return Response
        return response()->success(
            'sponsorShip is added success',
            [
                "sponsorShip" => new SponsorShipResource($sponsorShip),
            ]
        );
    }


    public function show(SponsorShip $sponsorShip)
    {
        // Return Response
        return response()->success(
            'this is your sponsorShip',
            [
                "sponsorShip" => new SponsorShipResource($sponsorShip),
            ]
        );
    }

    public function update(Request $request, SponsorShip $sponsorShip)
    {
        // Data Validate
        $data = $request->validate([
            'name'          => 'nullable',
        ]);

        // Update SponsorShip
        $sponsorShip->update($data);


        // Edit Image for  SponsorShip if exist
        $request->hasFile('image') &&
            $sponsorShip
                ->addMediaFromRequest('image')
                ->toMediaCollection('SponsorShip');
        };


        // Return Response
        return response()->success(
            'sponsorShip is updated success',
            [
                "sponsorShip" => new SponsorShipResource($sponsorShip),
            ]
        );
    }

    public function destroy(SponsorShip $sponsorShip)
    {
        // Delete SponsorShip
        $sponsorShip->delete();

        // Return Response
        return response()->success('sponsorShip is deleted success');
    }
}
