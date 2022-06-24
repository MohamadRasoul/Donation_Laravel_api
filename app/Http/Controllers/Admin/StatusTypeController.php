<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Resources\StatusTypeResource;
use App\Models\StatusType;


class StatusTypeController extends Controller
{

    public function index()
    {
        // Get Data
        $statusTypes = StatusType::latest()->get();

        // Return Response
        return response()->success(
            'this is all StatusTypes',
            [
                "statusTypes" => StatusTypeResource::collection($statusTypes),
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


        // Store StatusType
        $statusType = StatusType::create($data);


        // Add Image to StatusType
        $request->image &&
            $statusType
            ->addMediaFromRequest('image')
            ->toMediaCollection('StatusType');

        // Return Response
        return response()->success(
            'statusType is added success',
            [
                "statusType" => new StatusTypeResource($statusType),
            ]
        );
    }


    public function show(StatusType $statusType)
    {
        // Return Response
        return response()->success(
            'this is your statusType',
            [
                "statusType" => new StatusTypeResource($statusType),
            ]
        );
    }

    public function update(Request $request, StatusType $statusType)
    {
        // Data Validate
        $data = $request->validate([
            'title'          => 'nullable',
            'description'          => 'nullable',
        ]);

        // Update StatusType
        $statusType->update($data);


        // Edit Image for  StatusType if exist
        $request->image &&
            $statusType
            ->addMediaFromRequest('image')
            ->toMediaCollection('StatusType');


        // Return Response
        return response()->success(
            'statusType is updated success',
            [
                "statusType" => new StatusTypeResource($statusType),
            ]
        );
    }

    public function destroy(StatusType $statusType)
    {
        // Delete StatusType
        $statusType->delete();

        // Return Response
        return response()->success('statusType is deleted success');
    }
}
