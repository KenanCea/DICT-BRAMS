<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Barangay extends Model
{
    protected $fillable = [
        'name',
        'province',
        'muni_city',
        'zip_code',
        'region',
        'legal_basis',
        'date_legal_basis',
        'date_ratification',
        'mother_barangay',
        'old_name',
        'type_barangay',
        'boundaries_north',
        'boundaries_east',
        'boundaries_west',
        'boundaries_south',
        'totalland_area_sqkm',
        'totalland_area_hec',
        'distance_municipal_city',
        'province_capitol',
        'national_highway',
        'mountainous',
        'plain',
        'valley'
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
