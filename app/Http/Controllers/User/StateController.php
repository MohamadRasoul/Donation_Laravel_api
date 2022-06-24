<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Controllers\StateResource;
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
            'name'          => 'required',
        ]);


        // Store State
        $state = State::create($data);


        // Add Image to State
        $state
            ->addMediaFromRequest('image')
            ->toMediaCollection('State');

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
            'name'          => 'nullable',
        ]);

        // Update State
        $state->update($data);


        // Edit Image for  State if exist
        $request->image &&
            $state
                ->addMediaFromRequest('image')
                ->toMediaCollection('State');
        };


        // Return Response
        return response()->success(
            'state is updated success',
            [
                "state" => new StateResource($state),
            ]
        );
    }

    public function destroy(State $state)
    {
        // Delete State
        $state->delete();

        // Return Response
        return response()->success('state is deleted success');
    }
}
