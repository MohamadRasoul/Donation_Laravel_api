<?php

namespace App\Http\Controllers\Admin;

use App\Http\Resources\CharitablefoundationResource;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Charitablefoundation;
use App\Models\Donation;
use App\Models\DonationPost;
use Carbon\Carbon;
use phpDocumentor\Reflection\Types\Boolean;

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
                "charitablefoundations" => CharitablefoundationResource::collection($charitablefoundations),
            ]
        );
    }

    public function showDonateStatistics(Request $request)
    {
        $month = $request->month;
        $charitablefoundation_id = $request->charitablefoundation_id;

        //get Donations
        $allDonation = Donation::query();
        $charitablefoundationDonation = collect();

        if ($charitablefoundation_id) {
            $charitablefoundation = Charitablefoundation::find($charitablefoundation_id);
            $charitablefoundationDonation = $charitablefoundation->donations();
        }


        // filter by month
        if ($month) {
            $allDonation->whereMonth(
                'created_at',
                '=',
                Carbon::parse($month)->month
            );

            if ($charitablefoundation_id) {
                $charitablefoundationDonation->whereMonth(
                    'donations.created_at',
                    '=',
                    Carbon::parse($month)->month
                );
            }
        }
        // sum amount of donation 

        // $charitablefoundationDonation = 
        return response()->success(
            'charitablefoundation is added success',
            [
                "sumAllDonation"                  => $allDonation->sum('amount'),
                "sumCharitablefoundationDonation" => $charitablefoundationDonation->sum('amount'),
            ]
        );
    }

    public function showPostStatistics(Request $request)
    {
        $month = $request->month;
        $charitablefoundation_id = $request->charitablefoundation_id;

        //get DonationPost
        $allDonationPost = DonationPost::query();
        $charitablefoundationDonationPost = collect();

        if ($charitablefoundation_id) {
            $charitablefoundation = Charitablefoundation::find($charitablefoundation_id);
            $charitablefoundationDonationPost = $charitablefoundation->donationPosts();
        }


        // filter by month
        if ($month) {
            $allDonationPost->whereMonth(
                'created_at',
                '=',
                Carbon::parse($month)->month
            );

            if ($charitablefoundation_id) {
                $charitablefoundationDonationPost->whereMonth(
                    'created_at',
                    '=',
                    Carbon::parse($month)->month
                );
            }
        }
        // count amount of donation 

        return response()->success(
            'charitablefoundation is added success',
            [
                "countAllDonationPost"                  => $allDonationPost->count(),
                "countCharitablefoundationDonationPost" => $charitablefoundationDonationPost->count(),
            ]
        );
    }

    public function showActivityStatistics(Request $request)
    {
        $month = $request->month;
        $charitablefoundation_id = $request->charitablefoundation_id;

        //get Donations
        $allDonation = Donation::query();
        $charitablefoundationDonation = collect();

        if ($charitablefoundation_id) {
            $charitablefoundation = Charitablefoundation::find($charitablefoundation_id);
            $charitablefoundationDonation = $charitablefoundation->donations();
        }


        // filter by month
        if ($month) {
            $allDonation->whereMonth(
                'created_at',
                '=',
                Carbon::parse($month)->month
            );

            if ($charitablefoundation_id) {
                $charitablefoundationDonation->whereMonth(
                    'donations.created_at',
                    '=',
                    Carbon::parse($month)->month
                );
            }
        }
        // count amount of donation 

        return response()->success(
            'charitablefoundation is added success',
            [
                "countAllDonation"                  => $allDonation->count(),
                "countCharitablefoundationDonation" => $charitablefoundationDonation->count(),
            ]
        );
    }

    public function store(Request $request)
    {
        // Data Validate
        $data = $request->validate([
            'name'           => 'required|regex:/(^[A-Za-z ]+$)+/',
            'description'    => 'required',
            'website'        => 'required|url',
            'email'          => 'required|email',
            'phone_number'   => 'required',
        ]);

        // Store Charitablefoundation
        $charitablefoundation = Charitablefoundation::create($data);

        // Add Image to Charitablefoundation
        $request->hasFile('image') &&
            $charitablefoundation
            ->addMediaFromRequest('image')
            ->toMediaCollection('Charitablefoundation');


        $request->hasFile('cover') &&
            $charitablefoundation
            ->addMediaFromRequest('cover')
            ->toMediaCollection('Charitablefoundation_cover');

        // Return Response
        return response()->success(
            'charitablefoundation is added success',
            [
                "charitablefoundation" => new CharitablefoundationResource($charitablefoundation),
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

    public function update(Request $request, Charitablefoundation $charitablefoundation)
    {
        // Data Validate
        $data = $request->validate([
            'name'           => 'nullable|regex:/(^[A-Za-z ]+$)+/',
            'description'    => 'nullable',
            'website'        => 'nullable|url',
            'email'          => 'nullable|email',
            'phone_number'   => 'nullable',
        ]);

        // Update Charitablefoundation
        $charitablefoundation->update($data);


        // Edit Image for  Charitablefoundation if exist
        $request->hasFile('image') &&
            $charitablefoundation
            ->addMediaFromRequest('image')
            ->toMediaCollection('Charitablefoundation');

        $request->hasFile('cover') &&
            $charitablefoundation
            ->addMediaFromRequest('cover')
            ->toMediaCollection('Charitablefoundation_cover');



        // Return Response
        return response()->success(
            'charitablefoundation is updated success',
            [
                "charitablefoundation" => new CharitablefoundationResource($charitablefoundation),
            ]
        );
    }

    public function destroy(Charitablefoundation $charitablefoundation)
    {
        // Delete Charitablefoundation
        $charitablefoundation->delete();

        // Return Response
        return response()->success('charitablefoundation is deleted success');
    }
}
