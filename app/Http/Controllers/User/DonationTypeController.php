<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Http\Controllers\DonationTypeResource;
use Illuminate\Http\Request;
use App\Models\DonationType;


class DonationTypeController extends Controller
{

    public function index()
    {
        // Get Data
        $donationTypes = DonationType::latest()->get();

        // Return Response
        return response()->success(
            'this is all DonationTypes',
            [
                "donationTypes" => DonationTypeResource::collection($donationTypes),
            ]
        );
    }


    public function store(Request $request)
    {

        // Data Validate
        $data = $request->validate([
            'name'          => 'required',
        ]);


        // Store DonationType
        $donationType = DonationType::create($data);


        // Add Image to DonationType
        $donationType
            ->addMediaFromRequest('image')
            ->toMediaCollection('DonationType');

        // Return Response
        return response()->success(
            'donationType is added success',
            [
                "donationType" => new DonationTypeResource($donationType),
            ]
        );
    }


    public function show(DonationType $donationType)
    {
        // Return Response
        return response()->success(
            'this is your donationType',
            [
                "donationType" => new DonationTypeResource($donationType),
            ]
        );
    }

    public function update(Request $request, DonationType $donationType)
    {
        // Data Validate
        $data = $request->validate([
            'name'          => 'nullable',
        ]);

        // Update DonationType
        $donationType->update($data);


        // Edit Image for  DonationType if exist
        $request->image &&
            $donationType
                ->addMediaFromRequest('image')
                ->toMediaCollection('DonationType');
        };


        // Return Response
        return response()->success(
            'donationType is updated success',
            [
                "donationType" => new DonationTypeResource($donationType),
            ]
        );
    }

    public function destroy(DonationType $donationType)
    {
        // Delete DonationType
        $donationType->delete();

        // Return Response
        return response()->success('donationType is deleted success');
    }
}
