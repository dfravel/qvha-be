<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class User extends JsonResource
{

    public function toArray($request)
    {
        return [
            'user_id' => $this->hashed_id,
            'first_name' => $this->first_name,
            'last_name' => $this->last_name,
            'email' => $this->email,
            'is_admin' => $this->is_admin_login,
        ];
    }
}
