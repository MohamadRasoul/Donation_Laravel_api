<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Resources\SupportProgramResource;
use App\Models\Charitablefoundation;
use App\Models\SupportProgram;
use Spatie\QueryBuilder\AllowedFilter;
use Spatie\QueryBuilder\QueryBuilder;

class SupportProgramController extends Controller
{

    public function index()
    {
        // Get Data
        $supportPrograms = QueryBuilder::for(SupportProgram::latest())
            ->allowedFilters([
                AllowedFilter::exact('support_program_type_id'),
                AllowedFilter::exact('city_id'),
            ])->get();

        // Return Response
        return response()->success(
            'this is all SupportPrograms',
            [
                "supportPrograms" => SupportProgramResource::collection($supportPrograms),
            ]
        );
    }

    public function indexByCharitablefoundation(Charitablefoundation $charitablefoundation)
    {
        // Get Data
        $supportPrograms = QueryBuilder::for($charitablefoundation->supportPrograms()->latest())
            ->allowedFilters([
                AllowedFilter::exact('support_program_type_id'),
                AllowedFilter::exact('branch_id'),
                AllowedFilter::exact('city_id'),
            ])->get();

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
            'title'                   => 'required',
            'description'             => 'required',
            'instructor'              => 'required',
            'begin_date'              => 'required',
            'url_to_contact'          => 'required',
            'support_program_type_id' => 'required',
            'branch_id'               => 'required',
            'city_id'                 => 'required',
        ]);

        // Store SupportProgram
        $supportProgram = SupportProgram::create($data);


        // Add Image to SupportProgram
        $request->hasFile('image') &&
            $supportProgram
            ->addMediaFromRequest('image')
            ->toMediaCollection('SupportProgram');

        $request->hasFile('image_instructor') &&
            $supportProgram
            ->addMediaFromRequest('image_instructor')
            ->toMediaCollection('SupportProgramInstructor');


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
            'title'                   => 'nullable',
            'description'             => 'nullable',
            'instructor'              => 'nullable',
            'begin_date'              => 'nullable',
            'url_to_contact'          => 'nullable',
            'support_program_type_id' => 'nullable',
        ]);

        // Update SupportProgram
        $supportProgram->update($data);


        // Update Image to SupportProgram
        $request->hasFile('image') &&
            $supportProgram
            ->addMediaFromRequest('image')
            ->toMediaCollection('SupportProgram');

        $request->hasFile('image_instructor')   &&
            $supportProgram
            ->addMediaFromRequest('image_instructor')
            ->toMediaCollection('SupportProgramInstructor');


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
