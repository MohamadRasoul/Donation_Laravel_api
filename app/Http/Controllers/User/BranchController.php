<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Http\Resources\BranchResource;
use Illuminate\Http\Request;
use App\Models\Branch;
use App\Models\Charitablefoundation;

class BranchController extends Controller
{

    public function indexByCharitablefoundation(Charitablefoundation $charitablefoundation)
    {
        // Get Data
        $branchs = $charitablefoundation->branchs()->latest()->get();

        // Return Response
        return response()->success(
            'this is all Branchs',
            [
                "branchs" => BranchResource::collection($branchs),
            ]
        );
    }
}
