<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Landuse extends Model
{
    protected $fillable = [
        'landuse_type',
        'land_area_sqm', 
        'land_area_hec', 
        'totalpop'
    ];
    public function barangay()
    {
        return $this->belongsTo('App\Barangay');
    }

    public function householddistribution()
    {
        return $this->belongsTo('App\HouseholdDistribution');
    }
}
