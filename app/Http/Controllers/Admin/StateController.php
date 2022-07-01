<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Resources\StateDonationResource;
use Illuminate\Http\Request;
use App\Http\Resources\StateResource;
use App\Http\Resources\StateSponsorShipResource;
use App\Models\State;


class StateController extends Controller
{

    public function indexDonation()
    {
        // Get Data
        $states = State::whereRelation('donationPost', 'post_type_id', '!=', 2)->latest()->get();

        // Return Response
        return response()->success(
            'this is all States',
            [
                "states" => StateDonationResource::collection($states),
            ]
        );
    }

    public function indexSponsorShip()
    {
        // Get Data
        $states = State::whereRelation('donationPost', 'post_type_id', 2)->latest()->get();


        // Return Response
        return response()->success(
            'this is all States',
            [
                "states" => StateSponsorShipResource::collection($states),
            ]
        );
    }


    public function store(Request $request)
    {

        // Data Validate
        $data = $request->validate([
            'first_name'         => 'required',
            'last_name'          => 'required',
            'id_number'          => 'required',
            'phone_number'       => 'required',
            'father_name'        => 'required',
            'mother_name'        => 'required',
            'donation_post_id'   => 'required',
        ]);


        // Store State
        $state = State::create($data);


        // Add Image to State
        $request->hasFile('image') &&
            $state
            ->addMediaFromRequest('image')
            ->toMediaCollection('State');

        $request->hasFile('idCard_front_image') &&
            $state
            ->addMediaFromRequest('idCard_front_image')
            ->toMediaCollection('IdCardFront');

        $request->hasFile('idCard_back_image') &&
            $state
            ->addMediaFromRequest('idCard_back_image')
            ->toMediaCollection('IdCardBack');

        // Return Response
        return response()->success(
            'state is added success',
            [
                "state" => new StateResource($state),
            ]
        );
    }


    public function show(State $state)
    {
        // Return Response
        return response()->success(
            'this is your state',
            [
                "state" => new StateResource($state),
            ]
        );
    }

    public function update(Request $request, State $state)
    {
        // Data Validate
        $data = $request->validate([
            'first_name'         => 'required',
            'last_name'          => 'required',
            'id_number'          => 'required',
            'phone_number'       => 'required',
            'father_name'        => 'required',
            'mother_name'        => 'required',
        ]);

        // Update State
        $state->update($data);

        // Edit Image for  State if exist
        $request->hasFile('image') &&
            $state
            ->addMediaFromRequest('image')
            ->toMediaCollection('State');

        $request->hasFile('idCard_front_image') &&
            $state
            ->addMediaFromRequest('idCard_front_image')
            ->toMediaCollection('IdCardFront');

        $request->hasFile('idCard_back_image') &&
            $state
            ->addMediaFromRequest('idCard_back_image')
            ->toMediaCollection('IdCardBack');


        // Return Response
        return response()->success(
            'state is updated success',
            [
                "state" => new StateResource($state),
            ]
        );
    }

    public function updateAmount(Request $request, State $state)
    {


        // Update State
        $state->update([
            'amount_delivery'  => $state->amount_delivery + $request->amount_delivery
        ]);


        // Return Response
        return response()->success(
            'state amount delivery is updated success',
            [
                "state" => new StateResource($state),
            ]
        );
    }
}
