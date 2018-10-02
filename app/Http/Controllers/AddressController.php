<?php

namespace App\Http\Controllers;

use App\Models\Address;
use App\Http\Resources\Address as AddressResource;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;

class AddressController extends Controller
{

    public function index()
    {
        // return all of the addresses with the count of contacts
        return AddressResource::collection(Address::withCount('contacts')->get());
    }


    public function store(Request $request)
    {
        // save a new address after validation check
    }

    public function show(Address $address)
    {
        //
    }


    public function update(Request $request, Address $address)
    {
        //
    }

    public function destroy(Address $address)
    {
        //
    }



    private function validateAddress($data)
    {
        return Validator::make($data, [
            'address_line_1' => 'required|string|max:255',
            'city' => 'required|string|max:255',
            'zip' => 'required|string|max:255',

        ]);
    }
}
