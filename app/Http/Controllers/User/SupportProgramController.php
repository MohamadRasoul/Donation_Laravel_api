<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Http\Resources\SupportProgramResource;
use Illuminate\Http\Request;
use App\Models\Charitablefoundation;
use App\Models\SupportProgram;
use Carbon\Carbon;
use Spatie\QueryBuilder\AllowedFilter;
use Spatie\QueryBuilder\QueryBuilder;

class SupportProgramController extends Controller
{
    public function index()
    {
        // Get Data
        $supportProgramsQuery = SupportProgram::query()
            ->where('begin_date', '>', Carbon::now())->latest();

        $supportPrograms = QueryBuilder::for($supportProgramsQuery)
            ->allowedFilters([
                AllowedFilter::exact('support_program_type_id'),
                AllowedFilter::exact('city_id'),
            ])->get();

        // Return Response
        return response()->success(
            'this is all SupportPrograms',
            [
                "supportPrograms" => SupportProgramResource::collection($supportPrograms),
            ]
        );
    }


    public function indexByCharitablefoundation(Charitablefoundation $charitablefoundation)
    {
        // Get Data
        $supportProgramsQuery = $charitablefoundation->supportPrograms()
            ->where('begin_date', '>', Carbon::now())->latest();

        $supportPrograms = QueryBuilder::for($supportProgramsQuery)
            ->allowedFilters([
                AllowedFilter::exact('support_program_type_id'),
                AllowedFilter::exact('branch_id'),
                AllowedFilter::exact('city_id'),
            ])->get();

        // Return Response
        return response()->success(
            'this is all SupportPrograms',
            [
                "supportPrograms" => SupportProgramResource::collection($supportPrograms),
            ]
        );
    }
}
