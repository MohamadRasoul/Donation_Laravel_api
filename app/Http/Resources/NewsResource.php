<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;


class NewsResource extends JsonResource
{


    public function toArray($request)
    {
        // return parent::toArray($request);

        return [
            'id'                         => $this->id,
            'title'                      => $this->title,
            'description'                => $this->description,
            'image'                      => $this->getFirstMediaUrl('News'),
            'branch_id'                  => $this->branch_id,
            'charitablefoundation'       => $this->branch->charitablefoundation->name,
            'charitablefoundation_id'       => $this->branch->charitablefoundation->id,
            'charitablefoundation_image' => $this->branch->charitablefoundation->getFirstMediaUrl('Charitablefoundation'),
            'branch'                     => $this->branch->city->name,
            'donation_post_id'           => $this->donation_post_id,
            'support_program_id'         => $this->support_program_id,
            'updated_at'                 => $this->updated_at,
        ];
    }
}
