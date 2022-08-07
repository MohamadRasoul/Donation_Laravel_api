<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class SupportProgramResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        return [
            "id"                      => $this->id,
            "title"                   => $this->title,
            "image"                   => $this->getFirstMediaUrl('SupportProgram'),
            "description"             => $this->description,
            "instructor"              => $this->instructor,
            "image_instructor"        => $this->getFirstMediaUrl('SupportProgramInstructor'),
            "begin_date"              => $this->begin_date,
            "url_to_contact"          => $this->url_to_contact,
            "is_available"            => $this->is_available,
            "branch_id"               => $this->branch_id,
            "support_program_type"    => $this->supportProgramType->title,
            "support_program_type_id" => $this->support_program_type_id,
            "city_id"                 => $this->city_id,
        ];
    }
}
