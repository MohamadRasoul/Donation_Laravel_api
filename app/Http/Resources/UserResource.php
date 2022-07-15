<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class UserResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        // dd($this);
        return [
            'id'            => $this->id,
            'name'          => $this->first_name . " " . $this->last_name,
            'phone_number'  => $this->phone_number,
            'email'         => $this->email,
            'amount_donated'=> $this->donations_sum_amount,
            'amount_sponsor'=> $this->sponsor_ships_sum_amount,
            'is_admin'      => $this->hasRole('Admin'),
            'donations'     => DonationResource::collection($this->donations),
            'sponsorShips'  => SponsorShipResource::collection($this->sponsorShips()->distinct()->get())
        ];
    }
}
