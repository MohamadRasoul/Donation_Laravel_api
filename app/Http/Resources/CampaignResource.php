<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;


class CampaignResource extends JsonResource
{


    public function toArray($request)
    {
        $startDate = \Carbon\Carbon::createFromFormat('Y-m-d', $this->start_date);
        $endDate = \Carbon\Carbon::createFromFormat('Y-m-d', $this->end_date);
        $is_active = \Carbon\Carbon::now()->between($startDate, $endDate);

        return [
            "id"                         =>  $this->id,
            "title"                      =>  $this->title,
            "description"                =>  $this->description,
            "start_date"                 =>  $this->start_date,
            "end_date"                   =>  $this->end_date,
            "is_activate"                =>  $is_active,
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
            "usersDonate"                => UserResource::collection($this->users)

        ];
    }
}
