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

}
