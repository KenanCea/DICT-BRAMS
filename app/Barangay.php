<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Barangay extends Model
{
    protected $fillable = [
        'municipality',
        'province',
        'region',
        'zip_code',
        'mother_barangay',
        'old_name',
        'legal_basis',
        'date_legal_basis',
        'date_ratification',    
        'type_barangay',
        'boundaries_north',
        'boundaries_east',
        'boundaries_west',
        'boundaries_south',
        'totalland_area_hec',
        'totalland_area_sqkm',
        'distance_municipal_city',
        'province_capitol',
        'national_highway'
    ];
    public function user()
    {
        return $this->belongsTo('App\User');
    }
    public function communication()
    {
        return $this->hasOne('App\Communication');
    }
    public function education()
    {
        return $this->hasOne('App\Education');
    }
    public function landuse()
    {
        return $this->hasOne('App\Landuse');
    }
    public function health_facilities()
    {
        return $this->hasOne('App\HealthFacilities');
    }
    public function infrastructure()
    {
        return $this->hasOne('App\Infrastructure');
    }
}
