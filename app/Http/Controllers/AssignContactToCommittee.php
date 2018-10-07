<?php

namespace App\Http\Controllers;

use App\Models\Contact;
use App\Models\Committee;
use Illuminate\Http\Request;

class AssignContactToCommittee extends Controller
{

    public function __invoke(Request $request)
    {
        $contact = Contact::findOrFail($request->contact_id);
        $contact->committees()->sync($request->all());

        $data = [
            'status' => (bool)$contact,
            'message' => $contact ? 'Contact/Committee Updated' : 'Error Updating Contact Committee',
        ];

        // I prefer to send a 200 with a message when deleting a record. I know others prefer a 204
        // but I think it's better to tell the front end what happened so they can take action
        return response()->json($data, 200);
    }
}
