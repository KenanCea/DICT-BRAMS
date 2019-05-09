<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class EducationalInfo extends Model
{
    protected $fillable = [
        'preschool_grad',
        'preschool_ugrad',
        'preschool_currently_enrolled',
        'prielem_grad',
        'prielem_ugrad',
        'prielem_currently_enrolled',
        'secondary_grad',
        'secondary_ugrad',
        'secondary_currently_enrolled',
        'vocational_grad',
        'vocational_ugrad',
        'vocational_currently_enrolled',
        'college_grad',
        'college_ugrad',
        'college_currently_enrolled',
        'postgrad_grad',
        'postgrad_ugrad',
        'postgrad_currently_enrolled',
        'zero_eleven_1degree',
        'zero_eleven_2degree',
        'zero_eleven_3degree',
        'one_four_1degree',
        'one_four_2degree',
        'one_four_3degree',
        'five_seven_1degree',
        'five_seven_2degree',
        'five_seven_3degree',
    ];
    public function household()
    {
        return $this->belongsTo('App\Household');
    }
}
