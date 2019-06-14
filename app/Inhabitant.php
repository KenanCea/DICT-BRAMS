<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Inhabitant extends Model
{
    use SoftDeletes;
    protected $fillable = [
        'household_id',
        'last_name',
        'first_name',
        'middle_name',
        'relation_to_the_head',
        'sex',
        'date_of_birth',
        'placeOfBirth_native',
        'civil_status',
        'religion',
        'schooling',
        'Highest_educational_attainment',
        'Final_family_income',
        'Total_family_income',
        'status_of_residency',
        'no_of_years_in_barangay',
        'date_settled_in_barangay',
        'citizenship',
        'ethnicGroup',
        'registeredVoterOfTheBrgy',
        'blood_type',
        'disability',
        'dissability_others',
        'remarks',
        'specific_job_description',
        'gen_job_description',
        'employment_status',
        'job_category',
        'employment_category',
        'estimated_monthly_income_cash',
        'estimated_monthly_income_kind',
        'inhabitant_id',
        'childs_parent/guardian',
        'bcg',
        'dpi1',
        'dpi2',
        'dpi3',
        'opd1',
        'opd2',
        'opd3',
        'measles',
        'others1',
        'others2',
        'others3',
        'weight',
        'height',
        'date_measured_height_weight',
        'dewormed',
        'received_vitaminA',
        'ip'
    ];
    public function user()
    {
        return $this->belongsTo('App\User');
    }
    public function household()
    {
        return $this->belongsTo('App\Household');
    }
    public function barangayCertificate()
    {
        return $this->hasMany('App\BarangayCertificate');
    }
    public function barangayClearance()
    {
        return $this->hasMany('App\BarangayClearance');
    }
    public function businessClearance()
    {
        return $this->hasMany('App\BusinessClearance');
    }
    public function filedCase()
    {
        return $this->hasMany('App\Filecase');
    }
}
