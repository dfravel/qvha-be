<?php
namespace App\Observers;

use Hashids;
use App\Models\Address;

class AddressObserver
{
    public function created(Address $address)
    {
        $address->hashed_id = Hashids::encode($address->id);
        $address->save();
    }
}
