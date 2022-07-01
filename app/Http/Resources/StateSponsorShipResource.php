<?php

namespace App\Http\Resources;

use Carbon\Carbon;
use Illuminate\Http\Resources\Json\JsonResource;


class StateSponsorShipResource extends JsonResource
{
    public function toArray($request)
    {

        $sponsorShips =  $this
            ->donationPost
            ->sponsorShips();

        $sponsorShipsThisMonthNotDelivery =
            (clone $sponsorShips)
            ->where(function ($q) {
                $q->whereYear('month_to_pay', Carbon::now()->year)
                    ->whereMonth('month_to_pay', Carbon::now()->month)
                    ->where('is_delivery', 0);
            });

        $sponsorShips_amount_delivery =  (clone $sponsorShips)->where('is_delivery', 1)->sum('amount');
        $sponsorShips_amount_not_delivery_this_month =  (clone $sponsorShipsThisMonthNotDelivery)->sum('amount');

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

            'sponsorShips_this_month_not_delivery'        => SponsorShipResource::collection($sponsorShipsThisMonthNotDelivery->get()),
            'sponsorShips_amount_delivery'                => $sponsorShips_amount_delivery,
            'sponsorShips_amount_not_delivery_this_month' => $sponsorShips_amount_not_delivery_this_month,
        ];
    }
}
