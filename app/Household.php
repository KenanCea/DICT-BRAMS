<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Household extends Model
{
    protected $fillable = [
        'house_number',
        'barangay',
        'email_address',
        'purok',
        'place_of_origin',
        'mobile_number',
        'street',
        'ethnic_group',
        'telephone_no',
        'status_of_ownership_house',
        'status_of_ownership_lot',
        'type_of_dwelling_structure',
    ];

    public function user()
    {
        return $this->belongsTo('App\User');

    }
    public function inhabitants()
    {
        return $this->hasMany('App\Inhabitant');
    }

}
