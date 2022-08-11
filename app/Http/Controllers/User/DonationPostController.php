<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Http\Resources\DonationPostResource;
use App\Models\Charitablefoundation;
use Illuminate\Http\Request;
use App\Models\DonationPost;
use Carbon\Carbon;
use Spatie\QueryBuilder\AllowedFilter;
use Spatie\QueryBuilder\QueryBuilder;

class DonationPostController extends Controller
{

    public function index()
    {
        // Get Data

        $donationPostsQuery = DonationPost::query()
            ->where('start_date', '<', Carbon::now())
            ->where('end_date', '>', Carbon::now())->latest();

        $donationPosts = QueryBuilder::for($donationPostsQuery)
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

        $donationPostsQuery = $charitablefoundation->donationPosts()
            ->where('start_date', '<', Carbon::now())
            ->where('end_date', '>', Carbon::now())->latest();

        $donationPosts = QueryBuilder::for($donationPostsQuery)
            ->allowedFilters([
                AllowedFilter::exact('branch_id'),
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
}
