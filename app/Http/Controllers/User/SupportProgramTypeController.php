<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Controllers\SupportProgramTypeResource;
use App\Models\SupportProgramType;


class SupportProgramTypeController extends Controller
{

    public function index()
    {
        // Get Data
        $supportProgramTypes = SupportProgramType::latest()->get();

        // Return Response
        return response()->success(
            'this is all SupportProgramTypes',
            [
                "supportProgramTypes" => SupportProgramTypeResource::collection($supportProgramTypes),
            ]
        );
    }


    public function store(Request $request)
    {

        // Data Validate
        $data = $request->validate([
            'name'          => 'required',
        ]);


        // Store SupportProgramType
        $supportProgramType = SupportProgramType::create($data);


        // Add Image to SupportProgramType
        $supportProgramType
            ->addMediaFromRequest('image')
            ->toMediaCollection('SupportProgramType');

        // Return Response
        return response()->success(
            'supportProgramType is added success',
            [
                "supportProgramType" => new SupportProgramTypeResource($supportProgramType),
            ]
        );
    }


    public function show(SupportProgramType $supportProgramType)
    {
        // Return Response
        return response()->success(
            'this is your supportProgramType',
            [
                "supportProgramType" => new SupportProgramTypeResource($supportProgramType),
            ]
        );
    }

    public function update(Request $request, SupportProgramType $supportProgramType)
    {
        // Data Validate
        $data = $request->validate([
            'name'          => 'nullable',
        ]);

        // Update SupportProgramType
        $supportProgramType->update($data);


        // Edit Image for  SupportProgramType if exist
        $request->image &&
            $supportProgramType
                ->addMediaFromRequest('image')
                ->toMediaCollection('SupportProgramType');
        };


        // Return Response
        return response()->success(
            'supportProgramType is updated success',
            [
                "supportProgramType" => new SupportProgramTypeResource($supportProgramType),
            ]
        );
    }

    public function destroy(SupportProgramType $supportProgramType)
    {
        // Delete SupportProgramType
        $supportProgramType->delete();

        // Return Response
        return response()->success('supportProgramType is deleted success');
    }
}
