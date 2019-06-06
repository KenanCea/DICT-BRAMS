<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class HouseholdDistribution extends Model
{
    protected $fillable = [
        'total_no_hhold',
        'ave_persons_hhold',
        'ave_income_hhold',
        'rank1_employment',
        'rank2_employment',
        'rank3_employment',
    ];
    public function landuse()
    {
        return $this->belongsTo('App\Landuse');
    }
}
