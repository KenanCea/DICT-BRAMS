<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Household extends Model
{
    protected $fillable = [
        'familyName',
        'firstName',
        'middleName',
        'solo_parent',
        'solo_parent_others',
        'dateOfSurvey',
        'familysize',
        'house_no',
        'purok',
        'street',
        'barangay',
        'placeOfOrigin',
        'ethnic_group',
        'email_address',
        'mobile_no',
        'telephone_no',
        'dialects',
        'status_of_ownership-house',
        'status_of_ownership-house_others',
        'status_of_ownership-lot',
        'status_of_ownership-lot_others',
        'type_of_dwelling',
        'lighting source',
        'sources_of_info',
        'sources_of_info_others',
        'communication_services',
        'communication_services_others',
        'means of transportation',
        'means of transportation_others'
    ];

    public function user()
    {
        return $this->belongsTo('App\User');
    }
    /**
     * Get the inhabitants for the household.
     */
    public function inhabitants()
    {
        return $this->hasMany('App\Inhabitant');
    }
    public function educationalInfo()
    {
        return $this->hasOne('App\EducationalInfo');
    }
    public function healthInfo()
    {
        return $this->hasOne('App\HealthInfo');
    }
    public function environmentInfo()
    {
        return $this->hasOne('App\EnvironmentInfo');
    }
}
