<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\CharitablefoundationResource;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Charitablefoundation;


class CharitablefoundationController extends Controller
{

    public function index()
    {
        // Get Data
        $charitablefoundations = Charitablefoundation::latest()->get();

        // Return Response
        return response()->success(
            'this is all Charitablefoundations',
            [
                "charitablefoundations" => CharitablefoundationResource::collection($charitablefoundations),
            ]
        );
    }


    public function store(Request $request)
    {

        // Data Validate
        $data = $request->validate([
            'name'          => 'required',
        ]);


        // Store Charitablefoundation
        $charitablefoundation = Charitablefoundation::create($data);


        // Add Image to Charitablefoundation
        $charitablefoundation
            ->addMediaFromRequest('image')
            ->toMediaCollection('Charitablefoundation');

        // Return Response
        return response()->success(
            'charitablefoundation is added success',
            [
                "charitablefoundation" => new CharitablefoundationResource($charitablefoundation),
            ]
        );
    }


    public function show(Charitablefoundation $charitablefoundation)
    {
        // Return Response
        return response()->success(
            'this is your charitablefoundation',
            [
                "charitablefoundation" => new CharitablefoundationResource($charitablefoundation),
            ]
        );
    }

    public function update(Request $request, Charitablefoundation $charitablefoundation)
    {
        // Data Validate
        $data = $request->validate([
            'name'          => 'nullable',
        ]);

        // Update Charitablefoundation
        $charitablefoundation->update($data);


        // Edit Image for  Charitablefoundation if exist
        $request->hasFile('image') &&
            $charitablefoundation
                ->addMediaFromRequest('image')
                ->toMediaCollection('Charitablefoundation');
        };


        // Return Response
        return response()->success(
            'charitablefoundation is updated success',
            [
                "charitablefoundation" => new CharitablefoundationResource($charitablefoundation),
            ]
        );
    }

    public function destroy(Charitablefoundation $charitablefoundation)
    {
        // Delete Charitablefoundation
        $charitablefoundation->delete();

        // Return Response
        return response()->success('charitablefoundation is deleted success');
    }
}
