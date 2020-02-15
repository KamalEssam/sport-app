<?php

namespace App\Models;

use Tymon\JWTAuth\Contracts\JWTSubject;
use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Spatie\Permission\Traits\HasRoles;
use Hash;

class User extends Authenticatable implements JWTSubject
{
    use Notifiable, HasRoles;

    // Rest omitted for brevity

    /**
     * Get the identifier that will be stored in the subject claim of the JWT.
     *
     * @return mixed
     */
    public function getJWTIdentifier()
    {
        return $this->getKey();
    }

    /**
     * Return a key value array, containing any custom claims to be added to the JWT.
     *
     * @return array
     */
    public function getJWTCustomClaims()
    {
        return [];
    }

    protected $guard_name = 'web';

    protected $fillable = [
        'name', 
        'email', 
        'mobile',
        'password',
        'type',
        'is_blocked',
    ];

    protected $hidden = [
        'password', 
        'remember_token',
        'permissions',
        'email_verified_at',
        'reset_code',
        'is_blocked',
        'type',
    ];

    public function getUserPermissionsAttribute()
    {
        return $this->permissions->pluck('name')->toArray();
    }

    public function setPasswordAttribute($value)
    {
        $this->attributes['password'] = Hash::make($value);
    }

    public function getImageAttribute($value)
    {
        return $value != NULL ? URL('/').'/uploads/users/'.$value : URL('/').'/images/user.png';
    }

}