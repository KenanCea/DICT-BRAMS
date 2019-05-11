<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Official extends Model
{
    protected $fillable = [
        'position', 
        'name',
        'start_term',
        'end_term'
    ];
    
    public function user()
    {
        return $this->belongsTo('App\User');
    }
}
