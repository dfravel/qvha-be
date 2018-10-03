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
        //
    }

    public function show(Contact $contact)
    {
        //
    }

    public function update(Request $request, Contact $contact)
    {
        //
    }

    public function destroy(Contact $contact)
    {
        //
    }
}
