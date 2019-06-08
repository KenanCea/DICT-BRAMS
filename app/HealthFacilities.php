<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class HealthFacilities extends Model
{
    protected $fillable = [
        'healthfacility_type',
        'number',
        'numpatients',
        'otherSpecify',
    ];
    public function barangay()
    {
        return $this->belongsTo('App\Barangay');
    }
}
