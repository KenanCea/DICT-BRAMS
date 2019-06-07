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
        'inhabitant_id'
    ];
    public function inhabitant()
    {
        return $this->belongsTo('App\Inhabitant');
    }
}
