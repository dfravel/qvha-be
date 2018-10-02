<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class Address extends JsonResource
{

    public function toArray($request)
    {
        return [
            'id' => $this->hashed_id,
            'address_type' => $this->address_type,
            'address_line_1' => $this->address_line_1,
            'address_line_2' => $this->address_line_2,
            'address_line_3' => $this->address_line_3,
            'city' => $this->city,
            'state' => $this->state,
            'zip' => $this->zip,
            'country' => $this->country,
            'contact_count' => $this->contacts_count,
        ];
    }
}
