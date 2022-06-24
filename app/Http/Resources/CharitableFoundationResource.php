<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class CharitableFoundationResource extends JsonResource
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
            "id"            => $this->id,
            "name"          => $this->name,
            "description"   => $this->description,
            "website"       => $this->website,
            "email"         => $this->email,
            "phone_number"  => $this->phone_number,
            "image"         => $this->getFirstMediaUrl('Charitablefoundation'),
            "cover"         => $this->getFirstMediaUrl('Charitablefoundation_cover')
        ];
    }
}
