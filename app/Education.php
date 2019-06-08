<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Education extends Model
{
    protected $fillable = [
        'education_type',
        'education_number',
        'sports_type',
        'sports_number',
        'total_facilities'
    ];
    public function barangay()
    {
        return $this->belongsTo('App\Barangay');
    }
}

