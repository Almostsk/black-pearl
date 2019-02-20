<?php

namespace App\Http\Resources\User;

use Illuminate\Http\Resources\Json\JsonResource;
use App\Http\Resources\Dictionaries\CodeResource;

class CabinetResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        return [
            'Id'                 => $this->id,
            'Name'               => $this->name,
            'Surname'            => $this->surname,
            'City'               => $this->city->name,
            'Mobile_phone'       => $this->mobile_phone,
            'Status_id'          => $this->status_id,
            'Can_be_brand_face'  => $this->can_be_brand_face,
            'About_me'           => $this->about_me,
            'Avatar'             => $this->avatar,
            'Codes'              => CodeResource::collection($this->codes)
        ];
    }
}
