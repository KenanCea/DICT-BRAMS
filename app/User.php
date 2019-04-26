<?php

namespace App;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Passport\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password', 'roles',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    public function barangay()
    {
        return $this->hasOne('App\Barangay');
    }
    /**
     * Get the households for the user.
     */
    public function households()
    {
        return $this->hasMany('App\Household');
    }
    public function inhabitants()
    {
        return $this->hasMany('App\Inhabitant');
    }
    public function officials()
    {
        return $this->hasMany('App\Official');
    }
}
