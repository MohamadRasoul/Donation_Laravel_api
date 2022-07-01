<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\BranchResource;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Branch;


class BranchController extends Controller
{

    public function index()
    {
        // Get Data
        $branchs = Branch::latest()->get();

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
            'name'          => 'required',
        ]);


        // Store Branch
        $branch = Branch::create($data);


        // Add Image to Branch
        $branch
            ->addMediaFromRequest('image')
            ->toMediaCollection('Branch');

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
            'name'          => 'nullable',
        ]);

        // Update Branch
        $branch->update($data);


        // Edit Image for  Branch if exist
        $request->hasFile('image') &&
            $branch
                ->addMediaFromRequest('image')
                ->toMediaCollection('Branch');
        };


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
