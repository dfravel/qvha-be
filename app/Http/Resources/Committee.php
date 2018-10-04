<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class Committee extends JsonResource
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
            'comittee_id' => $this->id,
            'comittee_name' => $this->committee_name,
        ];
    }
}
