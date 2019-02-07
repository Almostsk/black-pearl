<?php

namespace App\Http\Resources\User;

use Illuminate\Http\Resources\Json\JsonResource;

class UserResource extends JsonResource
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
            'id' => $this->id,
            'name' => $this->name,
            'surname' => $this->surname,
            'is_admin' => $this->is_admin,
            'city' => $this->city->name,
            'mobile_phone' => $this->mobile_phone,
            'is_mobile_verified' => $this->is_mobile_verified,
            'status' => $this->status->name,
            'can_be_brand_face' => $this->can_be_brand_face,
            'about_me' => $this->about_me,
            'avatar' => $this->avatar,
        ];
    }
}
