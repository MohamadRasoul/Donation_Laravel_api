<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Http\Resources\NewsResource;
use App\Models\Charitablefoundation;
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
}
