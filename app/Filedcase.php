<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Filedcase extends Model
{
    protected $fillable = [
        'control_no',
        'respondent',
        'case',
        'type_of_case',
        'complainant',
        'co_complainant',
        'action_taken_on_settled',
        'action_taken_on_unsettled' ,
        'remarks',
        'inhabitant_id',
    ];
    public function inhabitant()
    {
        return $this->belongsTo('App\Inhabitant');
    }
    public function user()
    {
        return $this->belongsTo('App\User');
    }
    protected $casts = [
        'created_at' => 'date:Y-m-d',
    ];
}
