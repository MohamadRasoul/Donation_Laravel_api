<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Controllers\SupportProgramResource;
use App\Models\SupportProgram;


class SupportProgramController extends Controller
{

    public function index()
    {
        // Get Data
        $supportPrograms = SupportProgram::latest()->get();

        // Return Response
        return response()->success(
            'this is all SupportPrograms',
            [
                "supportPrograms" => SupportProgramResource::collection($supportPrograms),
            ]
        );
    }


    public function store(Request $request)
    {

        // Data Validate
        $data = $request->validate([
            'name'          => 'required',
        ]);


        // Store SupportProgram
        $supportProgram = SupportProgram::create($data);


        // Add Image to SupportProgram
        $supportProgram
            ->addMediaFromRequest('image')
            ->toMediaCollection('SupportProgram');

        // Return Response
        return response()->success(
            'supportProgram is added success',
            [
                "supportProgram" => new SupportProgramResource($supportProgram),
            ]
        );
    }


    public function show(SupportProgram $supportProgram)
    {
        // Return Response
        return response()->success(
            'this is your supportProgram',
            [
                "supportProgram" => new SupportProgramResource($supportProgram),
            ]
        );
    }

    public function update(Request $request, SupportProgram $supportProgram)
    {
        // Data Validate
        $data = $request->validate([
            'name'          => 'nullable',
        ]);

        // Update SupportProgram
        $supportProgram->update($data);


        // Edit Image for  SupportProgram if exist
        $request->image &&
            $supportProgram
                ->addMediaFromRequest('image')
                ->toMediaCollection('SupportProgram');
        };


        // Return Response
        return response()->success(
            'supportProgram is updated success',
            [
                "supportProgram" => new SupportProgramResource($supportProgram),
            ]
        );
    }

    public function destroy(SupportProgram $supportProgram)
    {
        // Delete SupportProgram
        $supportProgram->delete();

        // Return Response
        return response()->success('supportProgram is deleted success');
    }
}
