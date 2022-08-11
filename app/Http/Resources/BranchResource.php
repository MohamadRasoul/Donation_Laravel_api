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
        $cases = $this->cases();
        $sponsorShip = $this->sponsorShips();
        $campaigns = $this->campigns();


        $casesAmountDonated = $cases->sum('amount_donated');
        $sponsorShipAmountDonated = $sponsorShip->sum('amount_donated');
        $campaignsAmountDonated = $campaigns->sum('amount_donated');

        $casesAmountRequired = $cases->sum('amount_required');
        $campaignsAmountRequired = $campaigns->sum('amount_required');

        $amount_donated = $casesAmountDonated + $sponsorShipAmountDonated + $campaignsAmountDonated;
        $amount_required = $casesAmountRequired + $campaignsAmountRequired;

        return [
            "id"                       => $this->id,
            "name"                     => $this->name,
            "phone_number"             => $this->phone_number,
            "email"                    => $this->email,
            "address"                  => $this->address,
            "latitude"                 => $this->latitude,
            "longitude"                => $this->longitude,
            "amount_required"          => $amount_required,
            "amount_donated"           => $amount_donated,
            "amount_delivery"          => $this->amount_delivery,
            "city"                     => $this->city->name,
            "city_id"                  => $this->city_id,
            "charitable_foundation"    => $this->charitablefoundation->name,
            "image"                    => $this->charitablefoundation->getFirstMediaUrl('Charitablefoundation')
        ];
    }
}
