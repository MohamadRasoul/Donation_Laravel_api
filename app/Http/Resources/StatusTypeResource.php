<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;


class StatusTypeResource extends JsonResource
{
    
    
    public function toArray($request)
    {
        return parent::toArray($request);


        // return [
        //     'id'             => $this->id,
        // ];
    }
}
