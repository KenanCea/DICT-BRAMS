<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Inhabitant extends Model
{
    protected $fillable = [
        'household_id',
        'first_name',
        'middle_name',
        'last_name',
        'relation_to_the_head',
        'employment_category',
        'sex',
        'est_monthly_income_cash',
        'date_of_birth',
        'est_monthly_income_kind',
        'total_family_income',
        'civil_status',
        'final_family_income',
        'religion',
        'status_of_residency',
        'schooling',
        'no_of_years_in_barangay',
        'highest_educ_attainment',
        'date_settled_in_the_barangay',
        'specific_job_description',
        'citizenship',
        'gen_job_description',
        'employment_status',
        'ethnic_group',
        'job_category',
        'place_of_birth',
        'registered_voter',
        'child_parent',
        'weight',
        'height'];
    public function household()
    {
        return $this->belongsTo('App\Household');
    }
}
