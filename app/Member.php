<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;
use Laravel\Passport\HasApiTokens;

class Member extends Model
{
    use Notifiable, HasApiTokens;
    protected $fillable = [
    'first_name', 'family_name', 'middle_name', 'age','sex','region_barangay','relation_to_head',
    'placeOfBirth','dateOfBirth','email_add','mobile_no','telephone_no','civilStatus','citizenship','religion','schooling','Highest_educational_attainment','familyIncome','statusOfResidency','ethnicGroup','height','weight','bloodType','registeredVoterOfTheBrgy','mem_pic',
    'previousResidence','no_of_months_and_year_living_in_this_brgy','reason_you_left_in_previous_brgy','reason_you_came_in_this_brgy','until_when_you_stay_in_this_brgy','who_accompanied_you_to_transfer_here'
    ];

}
