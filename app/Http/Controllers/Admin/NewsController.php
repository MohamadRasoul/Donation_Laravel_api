<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Resources\NewsResource;
use App\Models\Charitablefoundation;
use Illuminate\Http\Request;
use App\Models\News;
use Spatie\QueryBuilder\AllowedFilter;
use Spatie\QueryBuilder\QueryBuilder;

class NewsController extends Controller
{

    public function index()
    {
        // Get Data
        $news = QueryBuilder::for(News::latest())
            ->allowedFilters([
                AllowedFilter::exact('charitablefoundation_id'),
            ])->get();

        // Return Response
        return response()->success(
            'this is all Newss',
            [
                "news" => NewsResource::collection($news),
            ]
        );
    }

    public function indexByCharitablefoundation(Charitablefoundation $charitablefoundation)
    {
        // Get Data
        $news = QueryBuilder::for($charitablefoundation->news()->latest())
            ->allowedFilters([
                AllowedFilter::exact('branch_id'),
            ])->get();

        // Return Response
        return response()->success(
            'this is all News',
            [
                "news" => NewsResource::collection($news),
            ]
        );
    }


    public function store(Request $request)
    {

        // Data Validate
        $data = $request->validate([
            'title'                => 'required',
            'description'          => 'required',
            'branch_id'            => 'required',
        ]);


        // Store News
        $news = News::create($data);


        // Add Image to News
        $request->hasFile('image') &&
            $news
            ->addMediaFromRequest('image')
            ->toMediaCollection('News');

        // Return Response
        return response()->success(
            'news is added success',
            [
                "news" => new NewsResource($news),
            ]
        );
    }


    public function show(News $news)
    {
        // Return Response
        return response()->success(
            'this is your news',
            [
                "news" => new NewsResource($news),
            ]
        );
    }

    public function update(Request $request, News $news)
    {
        // Data Validate
        $data = $request->validate([
            'title'          => 'nullable',
            'description'    => 'nullable',
        ]);

        // Update News
        $news->update($data);


        // Edit Image for  News if exist
        $request->hasFile('image') &&
            $news
            ->addMediaFromRequest('image')
            ->toMediaCollection('News');


        // Return Response
        return response()->success(
            'news is updated success',
            [
                "news" => new NewsResource($news),
            ]
        );
    }

    public function destroy(News $news)
    {
        // Delete News
        $news->delete();

        // Return Response
        return response()->success('news is deleted success');
    }
}
