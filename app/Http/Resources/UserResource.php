<?php

namespace App\Http\Resources;

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
            'id'                   =>  $this->id,
            'email'                =>  $this->email,
            'phone'                =>  $this->phone,
            'status'               =>  $this->status,
            'data_name'            =>  $this->data->name,
            'data_surname'         =>  $this->data->surname,
            'data_gender'          =>  $this->data->gender,
            'town_name'            =>  $this->data->town->name,
            'town_translit_name'   =>  $this->data->town->translit_name
        ];
    }

}
