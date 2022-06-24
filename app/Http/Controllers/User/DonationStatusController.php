<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Http\Controllers\DonationStatusResource;
use Illuminate\Http\Request;
use App\Models\DonationStatus;


class DonationStatusController extends Controller
{

    public function index()
    {
        // Get Data
        $donationStatuss = DonationStatus::latest()->get();

        // Return Response
        return response()->success(
            'this is all DonationStatuss',
            [
                "donationStatuss" => DonationStatusResource::collection($donationStatuss),
            ]
        );
    }


    public function store(Request $request)
    {

        // Data Validate
        $data = $request->validate([
            'name'          => 'required',
        ]);


        // Store DonationStatus
        $donationStatus = DonationStatus::create($data);


        // Add Image to DonationStatus
        $donationStatus
            ->addMediaFromRequest('image')
            ->toMediaCollection('DonationStatus');

        // Return Response
        return response()->success(
            'donationStatus is added success',
            [
                "donationStatus" => new DonationStatusResource($donationStatus),
            ]
        );
    }


    public function show(DonationStatus $donationStatus)
    {
        // Return Response
        return response()->success(
            'this is your donationStatus',
            [
                "donationStatus" => new DonationStatusResource($donationStatus),
            ]
        );
    }

    public function update(Request $request, DonationStatus $donationStatus)
    {
        // Data Validate
        $data = $request->validate([
            'name'          => 'nullable',
        ]);

        // Update DonationStatus
        $donationStatus->update($data);


        // Edit Image for  DonationStatus if exist
        $request->image &&
            $donationStatus
                ->addMediaFromRequest('image')
                ->toMediaCollection('DonationStatus');
        };


        // Return Response
        return response()->success(
            'donationStatus is updated success',
            [
                "donationStatus" => new DonationStatusResource($donationStatus),
            ]
        );
    }

    public function destroy(DonationStatus $donationStatus)
    {
        // Delete DonationStatus
        $donationStatus->delete();

        // Return Response
        return response()->success('donationStatus is deleted success');
    }
}
