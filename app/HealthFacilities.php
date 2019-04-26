<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class HealthFacilities extends Model
{
    protected $fillable = [
        'pubhos_num',
        'pubhos_numpatients',
        'prihos_num',
        'prihos_numpatients',
        'healthcenter_num',
        'healthcenter_numpatients',
        'clinic_num',
        'clinic_numpatients',
        'self_medication_num',
        'self_medication_numpatients',
        'otherSpecify',
    ];
    public function barangay()
    {
        return $this->belongsTo('App\Barangay');
    }
}
