<?php
namespace App\Observers;

use Hashids;
use App\Models\Contact;

class ContactObserver
{
    public function created(Contact $contact)
    {
        $contact->hashed_id = Hashids::encode($contact->id);
        $contact->save();
    }
}
