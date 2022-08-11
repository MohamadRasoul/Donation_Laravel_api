<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;


class SponsorShipResource extends JsonResource
{


    public function toArray($request)
    {
        // return parent::toArray($request);
        $state = $this->donationPost->state;

        return [
            "id"               => $this->id,
            "amount"           => $this->amount,
            "month_to_pay"     => $this->month_to_pay,

            "state_name"       => $state->first_name . " " . $state->last_name,
            "state_image"      => $state->getFirstMediaUrl('State'),

            "user"             => $this->user->first_name . " " . $this->user->last_name,
        ];
    }
}
