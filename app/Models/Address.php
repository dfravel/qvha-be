<?php

namespace App\Models;

use Hashids;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Address extends Model
{
    protected $table = 'addresses';

    use SoftDeletes;

    protected $fillable = [
        'hashed_id',
        'parent_id',
        'address_type',
        'address_line_1',
        'address_line_2',
        'address_line_3',
        'city',
        'state',
        'zip',
        'country'
    ];

    protected $guarded = [];

    protected $dates = ['deleted_at'];

    public function getRouteKeyName()
    {
        return 'hashed_id';
    }

    public function contacts()
    {
        return $this->hasMany('App\Models\Contact', 'address_id');
    }

    public function dues()
    {
        return $this->hasMany('App\Models\Dues', 'address_id');
    }
}
