<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Resources\PostTypeResource;
use Illuminate\Http\Request;
use App\Models\PostType;


class PostTypeController extends Controller
{

    public function index()
    {
        // Get Data
        $postTypes = PostType::latest()->get();

        // Return Response
        return response()->success(
            'this is all PostTypes',
            [
                "postTypes" => PostTypeResource::collection($postTypes),
            ]
        );
    }


    public function store(Request $request)
    {

        // Data Validate
        $data = $request->validate([
            'title'       => 'required',
            'description' => 'required',
            'color'       => 'required',
        ]);


        // Store PostType
        $postType = PostType::create($data);


        // Add Image to PostType
        $request->image &&
            $postType
            ->addMediaFromRequest('image')
            ->toMediaCollection('PostType');

        // Return Response
        return response()->success(
            'postType is added success',
            [
                "postType" => new PostTypeResource($postType),
            ]
        );
    }


    public function show(PostType $postType)
    {
        // Return Response
        return response()->success(
            'this is your postType',
            [
                "postType" => new PostTypeResource($postType),
            ]
        );
    }

    public function update(Request $request, PostType $postType)
    {
        // Data Validate
        $data = $request->validate([
            'title'       => 'nullable',
            'description' => 'nullable',
            'color'       => 'nullable',
        ]);

        // Update PostType
        $postType->update($data);


        // Edit Image for  PostType if exist
        $request->image &&
            $postType
            ->addMediaFromRequest('image')
            ->toMediaCollection('PostType');


        // Return Response
        return response()->success(
            'postType is updated success',
            [
                "postType" => new PostTypeResource($postType),
            ]
        );
    }

    public function destroy(PostType $postType)
    {
        // Delete PostType
        $postType->delete();

        // Return Response
        return response()->success('postType is deleted success');
    }
}
