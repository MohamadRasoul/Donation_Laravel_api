<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Resources\DonationPostResource;
use App\Models\Charitablefoundation;
use Illuminate\Http\Request;
use App\Models\DonationPost;
use Spatie\QueryBuilder\AllowedFilter;
use Spatie\QueryBuilder\QueryBuilder;

class DonationPostController extends Controller
{

    public function index()
    {
        // Get Data
        $donationPosts = QueryBuilder::for(DonationPost::latest())
            ->allowedFilters([
                AllowedFilter::exact('donation_type_id'),
                AllowedFilter::exact('post_type_id'),
                AllowedFilter::exact('city_id'),
            ])->get();

        // Return Response
        return response()->success(
            'this is all DonationPosts',
            [
                "donationPosts" => DonationPostResource::collection($donationPosts),
            ]
        );
    }

    public function indexByCharitablefoundation(Charitablefoundation $charitablefoundation)
    {
        // Get Data
        $donationPosts = QueryBuilder::for($charitablefoundation->donationPosts()->latest())
            ->allowedFilters([
                AllowedFilter::exact('branch_id'),
                AllowedFilter::exact('donation_type_id'),
                AllowedFilter::exact('post_type_id'),
                AllowedFilter::exact('city_id'),
            ])->get();

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
            'title'            => 'required',
            'description'      => 'required',
            'start_date'       => 'required',
            'end_date'         => 'required',
            'amount_required'  => 'required',
            'branch_id'        => 'required',
            'post_type_id'     => 'required',
            'city_id'          => 'required',
        ]);

        // Store DonationPost
        $donationPost = DonationPost::create($data);

        $donationPost->statusTypes()->sync($request->status_type_id);

        // Add Image to DonationPost
        $request->image &&
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


        // Edit Image for DonationPost if exist
        $request->image &&
            $donationPost
            ->addMediaFromRequest('image')
            ->toMediaCollection('DonationPost');

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
