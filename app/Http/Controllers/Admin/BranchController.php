<?php

namespace App\Http\Controllers\Admin;

use App\Http\Resources\BranchResource;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Branch;
use App\Models\Charitablefoundation;

class BranchController extends Controller
{

    public function indexByCharitablefoundation(Charitablefoundation $charitablefoundation)
    {
        // Get Data
        $branchs = $charitablefoundation->branchs()->latest()->get();

        // Return Response
        return response()->success(
            'this is all Branchs',
            [
                "branchs" => BranchResource::collection($branchs),
            ]
        );
    }


    public function store(Request $request)
    {

        // Data Validate
        $data = $request->validate([
            'description'             => 'required',
            'phone_number'            => 'required',
            'email'                   => 'required',
            'address'                 => 'required',
            'latitude'                => 'required',
            'longitude'               => 'required',
            'charitablefoundation_id' => 'required',
            'city_id'                 => 'required',
        ]);


        // Store Branch
        $branch = Branch::create($data);


        // Return Response
        return response()->success(
            'branch is added success',
            [
                "branch" => new BranchResource($branch),
            ]
        );
    }


    public function show(Branch $branch)
    {
        // Return Response
        return response()->success(
            'this is your branch',
            [
                "branch" => new BranchResource($branch),
            ]
        );
    }

    public function update(Request $request, Branch $branch)
    {
        // Data Validate
        $data = $request->validate([
            'description'             => 'nullable',
            'phone_number'            => 'nullable',
            'email'                   => 'nullable',
            'address'                 => 'nullable',
            'latitude'                => 'nullable',
            'longitude'               => 'nullable',
        ]);

        // Update Branch
        $branch->update($data);

        // Return Response
        return response()->success(
            'branch is updated success',
            [
                "branch" => new BranchResource($branch),
            ]
        );
    }

    public function destroy(Branch $branch)
    {
        // Delete Branch
        $branch->delete();

        // Return Response
        return response()->success('branch is deleted success');
    }
}
