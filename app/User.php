<?php

namespace App;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Passport\HasApiTokens;
use Illuminate\Database\Eloquent\SoftDeletes;

class User extends Authenticatable
{
    use HasApiTokens, Notifiable,SoftDeletes;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password', 'roles', 'logo'
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
    public function barangayCertificate()
    {
        return $this->hasMany('App\BarangayCertificate');
    }
    public function barangayClearance()
    {
        return $this->hasMany('App\BarangayClearance');
    }
    public function businessClearance()
    {
        return $this->hasMany('App\BusinessClearance');
    }
    public function filedCase()
    {
        return $this->hasMany('App\Filedcase');
    }
    public function officials()
    {
        return $this->hasMany('App\Official');
    }
}
