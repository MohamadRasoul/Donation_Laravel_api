<?php

namespace App\Http\Controllers\Admin;

use App\Http\Resources\CharitablefoundationResource;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Charitablefoundation;
use phpDocumentor\Reflection\Types\Boolean;

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
            'name'           => 'required',
            'description'    => 'required',
            'website'        => 'required',
            'email'          => 'required|email',
            'phone_number'   => 'required',
        ]);

        // Store Charitablefoundation
        $charitablefoundation = Charitablefoundation::create($data);

        // Add Image to Charitablefoundation
        $request->hasFile('image') &&
            $charitablefoundation
                ->addMediaFromRequest('image')
                ->toMediaCollection('Charitablefoundation');
        

        $request->hasFile('cover') &&
            $charitablefoundation
            ->addMediaFromRequest('cover')
            ->toMediaCollection('Charitablefoundation_cover');

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
            'name'           => 'nullable',
            'description'    => 'nullable',
            'website'        => 'nullable',
            'email'          => 'nullable|email',
            'phone_number'   => 'nullable',
        ]);

        // Update Charitablefoundation
        $charitablefoundation->update($data);


        // Edit Image for  Charitablefoundation if exist
        $request->hasFile('image') &&
            $charitablefoundation
            ->addMediaFromRequest('image')
            ->toMediaCollection('Charitablefoundation');

        $request->hasFile('cover') &&
            $charitablefoundation
            ->addMediaFromRequest('cover')
            ->toMediaCollection('Charitablefoundation_cover');



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
