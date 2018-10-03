<?php

namespace App\Http\Controllers;

use App\Models\Address;
use Illuminate\Http\Request;
use App\Http\Resources\Address as AddressResource;

class GetContactsByAddress extends Controller
{
    public function __invoke(Address $address)
    {
        return new AddressResource($address);
    }
}
