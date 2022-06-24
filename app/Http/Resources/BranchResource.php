<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class BranchResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        return [
            "id"                       => $this->id,
            "description"              => $this->description,
            "phone_number"             => $this->phone_number,
            "email"                    => $this->email,
            "address"                  => $this->address,
            "latitude"                 => $this->latitude,
            "longitude"                => $this->longitude,
            "city"                     => $this->city->name,
            "charitable_foundation"    => $this->charitablefoundation->name,
            "image"                    => $this->charitablefoundation->getFirstMediaUrl('Charitablefoundation')
        ];
    }
}
