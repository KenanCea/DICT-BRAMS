<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Infrastructure extends Model
{
    protected $fillable = [
    'meter_type',
    'national_m',
    'provincial_m',
    'city_m',
    'barangay_m',
    'total_m',
    'operational_m',
    'national_m_total',
    'provincial_m_total',
    'city_m_total',
    'barangay_m_total',
    'total_m_total',
    'operational_m_total',
    'kilometer_type',
    'national_km',
    'provincial_km',
    'city_km',
    'barangay_km',
    'total_km',
    'operational_km',
    'national_km_total',
    'provincial_km_total',
    'city_km_total',
    'barangay_km_total',
    'total_km_total',
    'operational_km_total'
    ];
    public function barangay()
    {
        return $this->belongsTo('App\Barangay');
    }
}
