<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Education extends Model
{
    protected $fillable = [
        'no_pre_school_building',
        'no_primary_building',
        'no_secondary_building',
        'no_vocational_building',
        'no_college_building',
        'no_post_graduate_building',
        'no_covered_courts',
        'no_gymnasiums',
        'no_parks_plaza',
        'others_sport_facilities',
        'recreational_activities',
        'total_facilities'
    ];
    
    public function barangay()
    {
        return $this->belongsTo('App\Barangay');
    }
}
