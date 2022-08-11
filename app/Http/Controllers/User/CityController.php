<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Http\Resources\CityResource;
use Illuminate\Http\Request;
use App\Models\City;


class CityController extends Controller
{

    public function index()
    {
        // Get Data
        $cities = City::latest()->get();

        // Return Response
        return response()->success(
            'this is all Citys',
            [
                "cities" => CityResource::collection($cities),
            ]
        );
    }
}
