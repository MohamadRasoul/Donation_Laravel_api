<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Http\Controllers\NewsResource;
use Illuminate\Http\Request;
use App\Models\News;


class NewsController extends Controller
{

    public function index()
    {
        // Get Data
        $newss = News::latest()->get();

        // Return Response
        return response()->success(
            'this is all Newss',
            [
                "newss" => NewsResource::collection($newss),
            ]
        );
    }


    public function store(Request $request)
    {

        // Data Validate
        $data = $request->validate([
            'name'          => 'required',
        ]);


        // Store News
        $news = News::create($data);


        // Add Image to News
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
            'name'          => 'nullable',
        ]);

        // Update News
        $news->update($data);


        // Edit Image for  News if exist
        $request->image &&
            $news
                ->addMediaFromRequest('image')
                ->toMediaCollection('News');
        };


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
