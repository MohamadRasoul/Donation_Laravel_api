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
            "id"                =>  $this->id,
            "title"             =>  $this->title,
            "description"       =>  $this->description,
            "start_date"        =>  $this->start_date,
            "end_date"          =>  $this->end_date,
            "amount_required"   =>  $this->amount_required,
            "amount_donated"    =>  $this->amount_donated,
            "image"             =>  $this->getFirstMediaUrl("DonationPost"),
            "branch_id"         =>  $this->branch_id,
            "city"              =>  $this->city->name,
            "status_types"      =>  StatusTypeResource::collection($this->statusTypes),
        ];
    }
}
