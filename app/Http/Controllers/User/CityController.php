<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\CityResource;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\City;


class CityController extends Controller
{

    public function index()
    {
        // Get Data
        $citys = City::latest()->get();

        // Return Response
        return response()->success(
            'this is all Citys',
            [
                "citys" => CityResource::collection($citys),
            ]
        );
    }


    public function store(Request $request)
    {

        // Data Validate
        $data = $request->validate([
            'name'          => 'required',
        ]);


        // Store City
        $city = City::create($data);


        // Add Image to City
        $city
            ->addMediaFromRequest('image')
            ->toMediaCollection('City');

        // Return Response
        return response()->success(
            'city is added success',
            [
                "city" => new CityResource($city),
            ]
        );
    }


    public function show(City $city)
    {
        // Return Response
        return response()->success(
            'this is your city',
            [
                "city" => new CityResource($city),
            ]
        );
    }

    public function update(Request $request, City $city)
    {
        // Data Validate
        $data = $request->validate([
            'name'          => 'nullable',
        ]);

        // Update City
        $city->update($data);


        // Edit Image for  City if exist
        $request->hasFile('image') &&
            $city
                ->addMediaFromRequest('image')
                ->toMediaCollection('City');
        };


        // Return Response
        return response()->success(
            'city is updated success',
            [
                "city" => new CityResource($city),
            ]
        );
    }

    public function destroy(City $city)
    {
        // Delete City
        $city->delete();

        // Return Response
        return response()->success('city is deleted success');
    }
}
