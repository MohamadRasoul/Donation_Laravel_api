<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Controllers\SaveResource;
use App\Models\Save;


class SaveController extends Controller
{

    public function index()
    {
        // Get Data
        $saves = Save::latest()->get();

        // Return Response
        return response()->success(
            'this is all Saves',
            [
                "saves" => SaveResource::collection($saves),
            ]
        );
    }


    public function store(Request $request)
    {

        // Data Validate
        $data = $request->validate([
            'name'          => 'required',
        ]);


        // Store Save
        $save = Save::create($data);


        // Add Image to Save
        $save
            ->addMediaFromRequest('image')
            ->toMediaCollection('Save');

        // Return Response
        return response()->success(
            'save is added success',
            [
                "save" => new SaveResource($save),
            ]
        );
    }


    public function show(Save $save)
    {
        // Return Response
        return response()->success(
            'this is your save',
            [
                "save" => new SaveResource($save),
            ]
        );
    }

    public function update(Request $request, Save $save)
    {
        // Data Validate
        $data = $request->validate([
            'name'          => 'nullable',
        ]);

        // Update Save
        $save->update($data);


        // Edit Image for  Save if exist
        $request->image &&
            $save
                ->addMediaFromRequest('image')
                ->toMediaCollection('Save');
        };


        // Return Response
        return response()->success(
            'save is updated success',
            [
                "save" => new SaveResource($save),
            ]
        );
    }

    public function destroy(Save $save)
    {
        // Delete Save
        $save->delete();

        // Return Response
        return response()->success('save is deleted success');
    }
}
