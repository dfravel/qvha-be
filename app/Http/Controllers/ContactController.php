<?php

namespace App\Http\Controllers;

use App\Models\Contact;
use App\Http\Resources\ContactWithAddress as ContactResource;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;

class ContactController extends Controller
{

    public function index()
    {
        return ContactResource::collection(Contact::with('address')->get());
    }


    public function store(Request $request)
    {
        $validator = $this->validateContact($request->all());

        if ($validator->fails()) {
            return response()->json([
                'status' => 'error',
                'errors' => $validator->errors()
            ], 422);
        }

        $contact = Contact::create($request->all());

        $data = [
            'data' => new ContactResource($contact),
            'status' => (bool)$contact,
            'message' => $contact ? 'Contact Created!' : 'Error Creating Contact',
        ];

        return response()->json($data);
    }

    public function show(Contact $contact)
    {
        return new ContactResource($contact);
    }

    public function update(Request $request, Contact $contact)
    {
        $validator = $this->validateContact($request->all());

        if ($validator->fails()) {
            return response()->json([
                'status' => 'error',
                'errors' => $validator->errors()
            ], 422);
        }

        $contact->fill($request->all())->save();

        $data = [
            'data' => new ContactResource($contact),
            'status' => (bool)$contact,
            'message' => $contact ? 'Contact Updated!' : 'Error Updating Contact',
        ];

        return response()->json($data);
    }

    public function destroy(Contact $contact)
    {
        $contact->delete();

        $data = [
            'status' => (bool)$contact,
            'message' => $contact ? 'Contact Deleted!' : 'Error Deleting Contact',
        ];

        // I prefer to send a 200 with a message when deleting a record. I know others prefer a 204
        // but I think it's better to tell the front end what happened so they can take action
        return response()->json($data, 200);
    }

    private function validateContact($data)
    {
        return Validator::make($data, [
            'first_name' => 'required|string|max:255',
            'last_name' => 'required|string|max:255',
            'address_id' => 'required|numeric',
        ]);
    }
}
