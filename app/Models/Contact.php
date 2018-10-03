<?php

namespace App\Models;

use Hashids;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Contact extends Model
{
    protected $table = 'contacts';

    use SoftDeletes;

    protected $fillable = [
        'hashed_id',
        'contact_type',
        'first_name',
        'last_name',
        'phone',
        'email',
        'preferred_contact_method',
        'relationship',
        'comments'
    ];

    protected $guarded = [];

    protected $dates = ['deleted_at'];

    public function getRouteKeyName()
    {
        return 'hashed_id';
    }

    public function address()
    {
        return $this->belongsTo('App\Models\Address', 'address_id');
    }


}
