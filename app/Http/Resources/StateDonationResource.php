<?php

namespace App\Http\Resources;

use Carbon\Carbon;
use Illuminate\Http\Resources\Json\JsonResource;


class StateDonationResource extends JsonResource
{
    public function toArray($request)
    {

        return [
            'id'                               => $this->id,
            'name'                             => $this->first_name . " " . $this->last_name,
            'id_number'                        => $this->id_number,
            'phone_number'                     => $this->phone_number,
            'father_name'                      => $this->father_name,
            'mother_name'                      => $this->mother_name,
            'charitablefoundation'             => $this->charitablefoundation->name,
            'image'                            => $this->getFirstMediaUrl('State'),
            'idCard_front_image'               => $this->getFirstMediaUrl('IdCardFront'),
            'idCard_back_image'                => $this->getFirstMediaUrl('IdCardBack'),

            'amount_donated'                   => $this->donationPost->amount_donated,
            'amount_required'                  => $this->donationPost->amount_required,
            "usersDonate"                      => UserResource::collection($this->donationPost->users)
        ];
    }
}
