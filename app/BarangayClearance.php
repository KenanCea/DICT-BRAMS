<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class BarangayClearance extends Model
{
    protected $fillable = [
        'control_no',
        'purpose_of_clearance',
        'date_issued',
        'official_receipt_no',
        'ctc_no',
        'ctc_issued_on',
        'ctc_issued_at',
    ];
    public function inhabitant()
    {
        return $this->belongsTo('App\Inhabitant');
    }
}
