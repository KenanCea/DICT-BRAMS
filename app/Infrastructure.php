<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Infrastructure extends Model
{
    protected $fillable = [
    'national_m_concrete',
    'provincial_m_concrete',
    'city_m_concrete',
    'barangay_m_concrete',
    'total_m_concrete',
    'operational_m_concrete',
    'national_m_steel',
    'provincial_m_steel',
    'city_m_steel',
    'barangay_m_steel',
    'total_m_steel',
    'operational_m_steel',
    'national_m_wooden',
    'provincial_m_wooden',
    'city_m_wooden',
    'barangay_m_wooden',
    'total_m_wooden',
    'operational_m_wooden',
    'national_m_total',
    'provincial_m_total',
    'city_m_total',
    'barangay_m_total',
    'total_m_total',
    'operational_m_total',
    'national_km_concrete',
    'provincial_km_concrete',
    'city_km_concrete',
    'barangay_km_concrete',
    'total_km_concrete',
    'operational_km_concrete',
    'national_km_asphalt',
    'provincial_km_asphalt',
    'city_km_asphalt',
    'barangay_km_asphalt',
    'total_km_asphalt',
    'operational_km_asphalt',
    'national_km_gravel',
    'provincial_km_gravel',
    'city_km_gravel',
    'barangay_km_gravel',
    'total_km_gravel',
    'operational_km_gravel',
    'national_km_earthfill',
    'provincial_km_earthfill',
    'city_km_earthfill',
    'barangay_km_earthfill',
    'total_km_earthfill',
    'operational_km_earthfill',
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
