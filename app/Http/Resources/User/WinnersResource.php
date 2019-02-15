<?php

namespace App\Http\Resources\User;

use Illuminate\Http\Resources\Json\JsonResource;

class WinnersResource extends JsonResource
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
            'Id'      => $this->id,
            'Name'    => $this->name,
            'Surname' => $this->surname,
            'Date'    => $this->updated_at
        ];
    }
}
