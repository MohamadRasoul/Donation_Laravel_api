<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class DonationPostResource extends JsonResource
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
            "id"                         =>  $this->id,
            "title"                      =>  $this->title,
            "description"                =>  $this->description,
            "start_date"                 =>  $this->start_date,
            "end_date"                   =>  $this->end_date,
            "amount_required"            =>  $this->amount_required,
            "amount_donated"             =>  $this->amount_donated ? $this->amount_donated : 0,
            "image"                      =>  $this->getFirstMediaUrl("DonationPost"),
            "branch_id"                  =>  $this->branch_id,
            "city_id"                    =>  $this->city_id,
            "city"                       =>  $this->city->name,
            "charitableFoundation"       =>  $this->charitablefoundation->name,
            "charitableFoundation_image" =>  $this->charitablefoundation->getFirstMediaUrl('Charitablefoundation'),
            "status_type_id"             =>  $this->statusTypes->pluck('id'),
            "status_types"               =>  StatusTypeResource::collection($this->statusTypes),

            'first_name'                 => $this->state->first_name,
            'last_name'                  => $this->state->last_name,
            'id_number'                  => $this->state->id_number,
            'phone_number'               => $this->state->phone_number,
            'father_name'                => $this->state->father_name,
            'mother_name'                => $this->state->mother_name,
        ];
    }
}
