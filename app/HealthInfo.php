<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class HealthInfo extends Model
{
    protected $fillable = [
            'born_alived_reg',
            'born_dead_reg',
            'still_birth_reg',
            'born_alived_ureg',
            'born_dead_ureg',
            'still_birth_ureg',
            'date_still_birth',
            'dead_children_afterbirth',
            'dead-adults',
            'cause/s',
            'date_dead',
            'uri',
            'diarrhea',
            'weakness',
            'underweight',
            'passing_of_worms',
            'others_common_illness',
            'government_hospital',
            'private_hospital',
            'health_center',
            'private_doctor',
            'hilot',
            'others_health_services',
            'acceptor',
            'family_planning_yes',
            'go/ngo',
    ];
    public function household()
    {
        return $this->belongsTo('App\Household');
    }
}
