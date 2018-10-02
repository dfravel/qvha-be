<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class Contact extends JsonResource
{

    public function toArray($request)
    {
        return [
            'contact_id' => $this->hashed_id,
            'first_name' => $this->first_name,
            'last_name' => $this->last_name,
            'phone' => $this->phone,
            'email' => $this->email,
            'contact_type' => $this->contact_type,
            'comments' => $this->comments,
            'relationship' => $this->relationship,
            'preferred_contact_method' => $this->preferred_contact_method
        ];
    }
}
