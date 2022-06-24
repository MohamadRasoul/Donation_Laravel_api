<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Resources\StateResource;
use App\Models\State;


class StateController extends Controller
{

    public function index()
    {
        // Get Data
        $states = State::latest()->get();

        // Return Response
        return response()->success(
            'this is all States',
            [
                "states" => StateResource::collection($states),
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
        $request->image &&
            $state
            ->addMediaFromRequest('image')
            ->toMediaCollection('State');

        $request->idCard_front_image &&
            $state
            ->addMediaFromRequest('idCard_front_image')
            ->toMediaCollection('IdCardFront');

        $request->idCard_back_image &&
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
        $request->image &&
            $state
            ->addMediaFromRequest('image')
            ->toMediaCollection('State');

        $request->idCard_front_image &&
            $state
            ->addMediaFromRequest('idCard_front_image')
            ->toMediaCollection('IdCardFront');

        $request->idCard_back_image &&
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

}
