<?php

namespace App\Providers;

use App\Models\User;
use App\Observers\UserObserver;

use App\Models\Address;
use App\Observers\AddressObserver;

use Illuminate\Support\ServiceProvider;

use App\Models\Contact;
use App\Observers\ContactObserver;

class AppServiceProvider extends ServiceProvider
{

    public function boot()
    {
        User::observe(UserObserver::class);
        Address::observe(AddressObserver::class);
        Contact::observe(ContactObserver::class);
    }


    public function register()
    {
        //
    }
}
