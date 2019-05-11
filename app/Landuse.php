<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Landuse extends Model
{
    protected $fillable = [
        'residential_land_area_sqm', 
        'residential_land_area_hec', 
        'residential_totalpop', 
        'commercial_land_area_sqm', 
        'commercial_land_area_hec', 
        'commercial_totalpop', 
        'industrial_land_area_sqm', 
        'industrial_land_area_hec', 
        'industrial_totalpop', 
        'agricultural_land_area_sqm', 
        'agricultural_land_area_hec', 
        'agricultural_totalpop', 
        'aquatic_land_area_sqm', 
        'aquatic_land_area_hec', 
        'aquatic_totalpop',
        'forest_land_area_sqm',
        'forest_land_area_hec',
        'forest_totalpop',
        'idle_land_area_sqm',
        'idle_land_area_hec',
        'idle_land_area_totalpop',
        'total_no_hhold',
        'ave_persons_hhold',
        'ave_income_hhold',
        'rank1_employment',
        'rank2_employment',
        'rank3_employment'
    ];
    public function barangay()
    {
        return $this->belongsTo('App\Barangay');
    }
}
