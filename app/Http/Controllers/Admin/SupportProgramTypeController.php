<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Resources\SupportProgramTypeResource;
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
            'title'          => 'required',
            'description'          => 'required',
        ]);


        // Store SupportProgramType
        $supportProgramType = SupportProgramType::create($data);


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
            'title'          => 'nullable',
            'description'          => 'nullable',
        ]);

        // Update SupportProgramType
        $supportProgramType->update($data);


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
