<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class LandForm extends Model
{
    protected $fillable = [
        'type',
        'percent'
    ];
    public function barangay()
    {
        return $this->belongsTo('App\Barangay');
    }
}
