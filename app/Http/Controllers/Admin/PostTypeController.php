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

}
