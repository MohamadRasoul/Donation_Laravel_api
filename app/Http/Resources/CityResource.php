<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;


class CityResource extends JsonResource
{
    
    
    public function toArray($request)
    {
        // return parent::toArray($request);


        return [
            'id'             => $this->id,
            'name'           => $this->name,
            'latitude'       => $this->latitude,
            'longitude'      => $this->longitude,
            'image'          => $this->getFirstMediaUrl('City'),
        ];
    }
}
