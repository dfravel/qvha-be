<?php

use Illuminate\Database\Seeder;
use App\Models\Address;
use App\Models\Contact;

class AddressTableSeeder extends Seeder
{

    public function run()
    {
        factory(Address::class, 50)->create()->each(function ($address) {
            $address->contacts()->saveMany(factory(Contact::class, 5)->make());
        });

    }
}
