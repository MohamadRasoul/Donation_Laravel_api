<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Http\Resources\CharitableFoundationResource;
use App\Models\Charitablefoundation;


class CharitablefoundationController extends Controller
{

    public function index()
    {
        // Get Data
        $charitablefoundations = Charitablefoundation::latest()->get();

        // Return Response
        return response()->success(
            'this is all Charitablefoundations',
            [
                "charitablefoundations" => CharitableFoundationResource::collection($charitablefoundations),
            ]
        );
    }


    public function show(Charitablefoundation $charitablefoundation)
    {
        // Return Response
        return response()->success(
            'this is your charitablefoundation',
            [
                "charitablefoundation" => new CharitablefoundationResource($charitablefoundation),
            ]
        );
    }
}
