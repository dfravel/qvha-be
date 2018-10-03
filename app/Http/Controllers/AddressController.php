<?php

namespace App\Http\Controllers;

use App\Models\Address;
use Log;
use App\Http\Resources\Address as AddressResource;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;

class AddressController extends Controller
{

    public function index($type = 'physical')
    {
        return AddressResource::collection(Address::where('address_type', $type)->withCount('contacts')->get());
    }


    public function store(Request $request)
    {
        $validator = $this->validateAddress($request->all());

        if ($validator->fails()) {
            return response()->json([
                'status' => 'error',
                'errors' => $validator->errors()
            ], 422);
        }

        $address = Address::create($request->all());

        $data = [
            'data' => new AddressResource($address),
            'status' => (bool)$address,
            'message' => $address ? 'Address Created!' : 'Error Creating Address',
        ];

        return response()->json($data);
    }

    public function show(Address $address)
    {
        return new AddressResource($address);
    }


    public function update(Request $request, Address $address)
    {

        Log::info($request->all());

        $validator = $this->validateAddress($request->all());

        if ($validator->fails()) {
            return response()->json([
                'status' => 'error',
                'errors' => $validator->errors()
            ], 422);
        }

        $address->fill($request->all())->save();

        $data = [
            'data' => new AddressResource($address),
            'status' => (bool)$address,
            'message' => $address ? 'Address Updated!' : 'Error Updating Address',
        ];

        return response()->json($data);

    }

    public function destroy(Address $address)
    {
        $address->delete();

        $data = [
            'status' => (bool)$address,
            'message' => $address ? 'Address Deleted!' : 'Error Deleting Address',
        ];

        // I prefer to send a 200 with a message when deleting a record. I know others prefer a 204
        // but I think it's better to tell the front end what happened so they can take action
        return response()->json($data, 200);
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
