<?php

namespace App\Models;

use Carbon\Carbon;
use Hashids;
use Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Database\Eloquent\SoftDeletes;

use Tymon\JWTAuth\Contracts\JWTSubject;

class User extends Authenticatable implements JWTSubject
{
    use Notifiable;

    use SoftDeletes;

    protected $fillable = [
        'first_name', 'last_name', 'email', 'password', 'is_admin_login', 'require_password_reset', 'hashed_id', 'is_verified', 'verification_token', 'is_first_login', 'last_login_at'
    ];


    protected $dates = ['deleted_at'];

    protected $hidden = [
        'password', 'remember_token',
    ];


    protected $casts = [
        'is_admin_login' => 'boolean',
        'is_verified' => 'boolean',
        'is_first_login' => 'boolean',
        'require_password_reset' => 'boolean'
    ];


    public function getJWTIdentifier()
    {
        return $this->getKey();
    }

    public function getJWTCustomClaims()
    {
        return [];
    }

    public function getRouteKeyName()
    {
        return 'hashed_id';
    }

    public function setPasswordAttribute($value)
    {
        $this->attributes['password'] = Hash::make($value);
    }


    public function getNameAttribute()
    {
        return ucfirst($this->first_name) . ' ' . ucfirst($this->last_name);
    }

    public function isAdmin()
    {
        return $this->is_admin_login;
    }

    public function isVerified()
    {
        return $this->is_verified;
    }


    public function isFirstLogin()
    {
        return $this->is_first_login;
    }


    public function requirePasswordReset()
    {
        return $this->require_password_reset;
    }

    public function updateFirstLogin()
    {
        $this->is_first_login = 0;
        $this->save();
    }


    public function getLastLoginAttribute()
    {
        if ($this->last_login_at) {
            return Carbon::createFromTimestamp(strtotime($this->last_login_at))
                ->timezone(Auth::user()->timezone)
                ->toDayDateTimeString();
        } else {
            return "Never Logged In";
        }
    }
}
