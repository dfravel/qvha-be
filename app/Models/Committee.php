<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Committee extends Model
{
    protected $table = 'committees';

    use SoftDeletes;

    protected $fillable = [
        'committee_name'
    ];

    protected $guarded = [];

    protected $dates = ['deleted_at'];

    public function contacts()
    {
        return $this->belongsToMany('App\Models\Contact', 'committee_contact', 'committee_id', 'contact_id')->whereNull('committee_contact.deleted_at');
    }

}
