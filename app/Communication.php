<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Communication extends Model
{
    protected $fillable = [
        'communication_type', 
        'totalProvider',
        'name_company', 
        'no_hhold_served'
    ];
    public function barangay()
    {
        return $this->belongsTo('App\Barangay');
    }
}

