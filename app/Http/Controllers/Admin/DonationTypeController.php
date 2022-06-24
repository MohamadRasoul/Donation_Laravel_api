<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Resources\DonationTypeResource;
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
            'title'          => 'required',
            'description'          => 'required',
        ]);


        // Store DonationType
        $donationType = DonationType::create($data);


        // Add Image to DonationType
        $request->image &&
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
            'title'          => 'nullable',
            'description'          => 'nullable',
        ]);

        // Update DonationType
        $donationType->update($data);


        // Edit Image for  DonationType if exist
        $request->image &&
            $donationType
            ->addMediaFromRequest('image')
            ->toMediaCollection('DonationType');


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
