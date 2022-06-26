<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;


class NewsResource extends JsonResource
{


    public function toArray($request)
    {
        // return parent::toArray($request);

        return [
            'id'                 => $this->id,
            'title'              => $this->title,
            'description'        => $this->description,
            'image'              => $this->getFirstMediaUrl('News'),
            'branch'             => $this->branch->city->name,
            'donation_post_id'   => $this->donation_post_id,
            'support_program_id' => $this->support_program_id,
        ];
    }
}
