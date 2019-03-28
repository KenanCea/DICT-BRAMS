<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Filecase extends Model
{
    protected $fillable = [
        'id_serial_case_num',
        'control_no_case',
        'respondent_case',
        'nature_of_case',
        'complainant_case',
        'date_filed_case',
        'action_taken_on_settled_case',
        'action_taken_on_unsettled_case', 
        'remarks_case',
        //'form_id',
        //'mem_id',
];
}
