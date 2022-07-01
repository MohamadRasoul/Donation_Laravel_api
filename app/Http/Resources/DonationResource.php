<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;


class DonationResource extends JsonResource
{


    public function toArray($request)
    {
        
        $state = $this->donationPost->state;

        return [
            'id'             => $this->id,
            "amount"         => $this->amount,
            "state_name"     => $state->first_name . " " . $state->last_name,
            "state_image"    => $state->getFirstMediaUrl('State'),
            "date"           => $this->created_at,
        ];
    }
}
