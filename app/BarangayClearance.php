<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class BarangayClearance extends Model
{
    protected $fillable = [
        'control_no',
        'purpose_of_clearance',
        'official_receipt_no',
        'ctc_no',
        'inhabitant_id',
        'last_name',
        'first_name',
        'middle_name',
        'house_no',
        'purok',
        'street',
        'date_of_birth',
        'citizenship',
        'placeOfBirth_native'
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
