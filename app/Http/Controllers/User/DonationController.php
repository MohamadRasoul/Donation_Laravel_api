<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Http\Controllers\DonationResource;
use Illuminate\Http\Request;
use App\Models\Donation;


class DonationController extends Controller
{

    public function index()
    {
        // Get Data
        $donations = Donation::latest()->get();

        // Return Response
        return response()->success(
            'this is all Donations',
            [
                "donations" => DonationResource::collection($donations),
            ]
        );
    }


    public function store(Request $request)
    {

        // Data Validate
        $data = $request->validate([
            'name'          => 'required',
        ]);


        // Store Donation
        $donation = Donation::create($data);


        // Add Image to Donation
        $donation
            ->addMediaFromRequest('image')
            ->toMediaCollection('Donation');

        // Return Response
        return response()->success(
            'donation is added success',
            [
                "donation" => new DonationResource($donation),
            ]
        );
    }


    public function show(Donation $donation)
    {
        // Return Response
        return response()->success(
            'this is your donation',
            [
                "donation" => new DonationResource($donation),
            ]
        );
    }

    public function update(Request $request, Donation $donation)
    {
        // Data Validate
        $data = $request->validate([
            'name'          => 'nullable',
        ]);

        // Update Donation
        $donation->update($data);


        // Edit Image for  Donation if exist
        $request->hasFile('image') &&
            $donation
                ->addMediaFromRequest('image')
                ->toMediaCollection('Donation');
        };


        // Return Response
        return response()->success(
            'donation is updated success',
            [
                "donation" => new DonationResource($donation),
            ]
        );
    }

    public function destroy(Donation $donation)
    {
        // Delete Donation
        $donation->delete();

        // Return Response
        return response()->success('donation is deleted success');
    }
}
