<?php

namespace App\Http\Resources;

use Carbon\Carbon;
use Illuminate\Http\Resources\Json\JsonResource;


class  StateSponsorShipResource extends JsonResource
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
            'image'                            => $this->getFirstMediaUrl('State'),
            'idCard_front_image'               => $this->getFirstMediaUrl('IdCardFront'),
            'idCard_back_image'                => $this->getFirstMediaUrl('IdCardBack'),
            "usersSponsor"                     => UserResource::collection($this->donationPost->users),
            'charitablefoundation'             => $this->charitablefoundation->name,

        ];
    }
}
