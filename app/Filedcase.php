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
        'date_filed',
        'action_taken_on_settled',
        'action_taken_on_unsettled' ,
        'remarks'
    ];
    public function inhabitant()
    {
        return $this->belongsTo('App\Inhabitant');
    }
}
