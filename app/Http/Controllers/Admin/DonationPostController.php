<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Resources\CampaignResource;
use App\Http\Resources\DonationPostResource;
use App\Models\Branch;
use App\Models\Charitablefoundation;
use Illuminate\Http\Request;
use App\Models\DonationPost;
use App\Models\State;
use Illuminate\Support\Facades\DB;
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

    public function indexCampaign()
    {
        // Get Data
        $campaigns = DonationPost::Where('post_type_id', 3)->latest()->get();

        // Return Response
        return response()->success(
            'this is all DonationPosts',
            [
                "donationPosts" => CampaignResource::collection($campaigns),
            ]
        );
    }

    public function storeCampaign(Request $request)
    {
        // Data Validate
        $request->validate([
            'title'            => 'required',
            'description'      => 'required',
            'start_date'       => 'required',
            'end_date'         => 'required',
            'amount_required'  => 'required',
            'branch_id'        => 'required',
            'post_type_id'     => 'required',
            'city_id'          => 'required',
        ]);

        $branch = Branch::find($request->branch_id);
        $charitablefoundation = $branch->charitablefoundation;

        $campaignDate = [
            'title'                     => $request->title,
            'description'               => $request->description,
            'start_date'                => $request->start_date,
            'end_date'                  => $request->end_date,
            'amount_required'           => $request->amount_required,
            'branch_id'                 => $request->branch_id,
            'post_type_id'              => $request->post_type_id,
            'city_id'                   => $request->city_id,
            'charitablefoundation_id'  => $charitablefoundation->id,
        ];

        // Store DonationPost
        $campaign = DonationPost::create($campaignDate);

        $campaign->statusTypes()->sync(json_decode($request->status_type_id));

        // Add Image to DonationPost
        $request->hasFile('image') &&
            $campaign
            ->addMediaFromRequest('image')
            ->toMediaCollection('DonationPost');


        // Add News

        $newsData = [
            'title'             => $request->title,
            'description'       => 'New humanitarian relief campaigns is added for supporting in branch ' . $branch->name,
            'branch_id'         => $request->branch_id,
        ];
        // Store News
        $news = $campaign->news()->create($newsData);


        // Add Image to News
        $request->hasFile('image') &&
            $news
            ->addMedia($campaign->getFirstMediaPath('DonationPost'))
            ->preservingOriginal()
            ->toMediaCollection('News');




        // Return Response
        return response()->success(
            'campaign is added success',
            [
                "campaign" => new CampaignResource($campaign),
            ]
        );
    }

    public function store(Request $request)
    {
        DB::beginTransaction();
        try {
            // donationPost Data Validate
            $request->validate([
                'title'            => 'required',
                'description'      => 'required',
                'start_date'       => 'required',
                'end_date'         => 'required',
                'amount_required'  => 'required',
                'branch_id'        => 'required',
                'post_type_id'     => 'required',
                'city_id'          => 'required',
            ]);

            $branch = Branch::find($request->branch_id);
            $charitablefoundation = $branch->charitablefoundation;

            $donationPostDate = [
                'title'                     => $request->title,
                'description'               => $request->description,
                'start_date'                => $request->start_date,
                'end_date'                  => $request->end_date,
                'amount_required'           => $request->amount_required,
                'branch_id'                 => $request->branch_id,
                'post_type_id'              => $request->post_type_id,
                'city_id'                   => $request->city_id,
                'charitablefoundation_id'  => $charitablefoundation->id,
            ];

            // Store DonationPost
            $donationPost = DonationPost::create($donationPostDate);

            $request->status_type_id &&
                $donationPost->statusTypes()->sync(json_decode($request->status_type_id));

            // Add Image to DonationPost

            $request->hasFile('image') &&
                $donationPost
                ->addMediaFromRequest('image')
                ->toMediaCollection('DonationPost');


            // State Data Validate
            $data = $request->validate([
                'first_name'         => 'required',
                'last_name'          => 'required',
                'id_number'          => 'required',
                'phone_number'       => 'required',
                'father_name'        => 'required',
                'mother_name'        => 'required',
            ]);

            $stateData = [
                'first_name'                => $request->first_name,
                'last_name'                 => $request->last_name,
                'id_number'                 => $request->id_number,
                'phone_number'              => $request->phone_number,
                'father_name'               => $request->father_name,
                'mother_name'               => $request->mother_name,
                'charitablefoundation_id'  => $charitablefoundation->id,
            ];
            // Store State
            $state = $donationPost->state()->create($stateData);


            // Add Image to State
            $request->hasFile('state_image') &&
                $state
                ->addMediaFromRequest('state_image')
                ->toMediaCollection('State');

            $request->hasFile('idCard_front_image') &&
                $state
                ->addMediaFromRequest('idCard_front_image')
                ->toMediaCollection('IdCardFront');

            $request->hasFile('idCard_back_image') &&
                $state
                ->addMediaFromRequest('idCard_back_image')
                ->toMediaCollection('IdCardBack');



            // add news

            $newsData = [
                'title'             => $request->title,
                'description'       => 'New humanitarian and medical case is added for supporting in branch ' . $branch->name,
                'branch_id'         => $request->branch_id,
            ];
            // Store State

            $news = $donationPost->news()->create($newsData);

            // Add Image to News
            $request->hasFile('image') &&
                $news
                ->addMedia($donationPost->getFirstMediaPath('DonationPost'))
                ->preservingOriginal()
                ->toMediaCollection('News');





            DB::commit();

            // Return Response
            return response()->success(
                'donationPost is added success',
                [
                    "donationPost" => new DonationPostResource($donationPost),
                ]
            );
        } catch (\Throwable $th) {
            DB::rollBack();

            return response()->error(
                'donationPost is not added '
            );
        }
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
        DB::beginTransaction();
        try {
            // donationPost Data Validate
            $donationPostDate = $request->validate([
                'title'            => 'nullable',
                'description'      => 'nullable',
                'start_date'       => 'nullable',
                'end_date'         => 'nullable',
                'amount_required'  => 'nullable',
                'branch_id'        => 'nullable',
                'post_type_id'     => 'nullable',
                'city_id'          => 'nullable',
            ]);

            // Store DonationPost
            $donationPost->update($donationPostDate);

            $donationPost->statusTypes()->sync(json_decode($request->status_type_id));

            // Add Image to DonationPost
            $request->hasFile('image') &&
                $donationPost
                ->addMediaFromRequest('image')
                ->toMediaCollection('DonationPost');



            // State Data Validate
            $stateData = $request->validate([
                'first_name'         => 'nullable',
                'last_name'          => 'nullable',
                'id_number'          => 'nullable',
                'phone_number'       => 'nullable',
                'father_name'        => 'nullable',
                'mother_name'        => 'nullable',
            ]);

            // Store State
            $state = $donationPost->state()->update($stateData);


            // Add Image to State
            $request->hasFile('state_image') &&
                $state
                ->addMediaFromRequest('state_image')
                ->toMediaCollection('State');

            $request->hasFile('idCard_front_image') &&
                $state
                ->addMediaFromRequest('idCard_front_image')
                ->toMediaCollection('IdCardFront');

            $request->hasFile('idCard_back_image') &&
                $state
                ->addMediaFromRequest('idCard_back_image')
                ->toMediaCollection('IdCardBack');


            DB::commit();



            // Return Response
            return response()->success(
                'donationPost is updated success',
                [
                    "donationPost" => new DonationPostResource($donationPost),
                ]
            );
        } catch (\Throwable $th) {
            DB::rollBack();

            return response()->error(
                'donationPost is not updated '
            );
        }
    }

    public function destroy(DonationPost $donationPost)
    {
        // Delete DonationPost
        $donationPost->delete();

        // Return Response
        return response()->success('donationPost is deleted success');
    }
}
