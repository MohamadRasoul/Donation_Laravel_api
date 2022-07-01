<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Http\Controllers\DonationPostResource;
use Illuminate\Http\Request;
use App\Models\DonationPost;


class DonationPostController extends Controller
{

    public function index()
    {
        // Get Data
        $donationPosts = DonationPost::latest()->get();

        // Return Response
        return response()->success(
            'this is all DonationPosts',
            [
                "donationPosts" => DonationPostResource::collection($donationPosts),
            ]
        );
    }


    public function store(Request $request)
    {

        // Data Validate
        $data = $request->validate([
            'name'          => 'required',
        ]);


        // Store DonationPost
        $donationPost = DonationPost::create($data);


        // Add Image to DonationPost
        $donationPost
            ->addMediaFromRequest('image')
            ->toMediaCollection('DonationPost');

        // Return Response
        return response()->success(
            'donationPost is added success',
            [
                "donationPost" => new DonationPostResource($donationPost),
            ]
        );
    }


    public function show(DonationPost $donationPost)
    {
        // Return Response
        return response()->success(
            'this is your donationPost',
            [
                "donationPost" => new DonationPostResource($donationPost),
            ]
        );
    }

    public function update(Request $request, DonationPost $donationPost)
    {
        // Data Validate
        $data = $request->validate([
            'name'          => 'nullable',
        ]);

        // Update DonationPost
        $donationPost->update($data);


        // Edit Image for  DonationPost if exist
        $request->hasFile('image') &&
            $donationPost
                ->addMediaFromRequest('image')
                ->toMediaCollection('DonationPost');
        };


        // Return Response
        return response()->success(
            'donationPost is updated success',
            [
                "donationPost" => new DonationPostResource($donationPost),
            ]
        );
    }

    public function destroy(DonationPost $donationPost)
    {
        // Delete DonationPost
        $donationPost->delete();

        // Return Response
        return response()->success('donationPost is deleted success');
    }
}
