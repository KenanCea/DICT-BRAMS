<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class BarangayCertificate extends Model
{
    protected $fillable = [
        'control_no',
        'purpose_certification',
        'date_issued',
        'ctc_no',
        'ctc_issued_at',
        'ctc_issued_on',
        'official_receipt_no',
        'amount_paid',
    ];
    public function inhabitant()
    {
        return $this->belongsTo('App\Inhabitant');
    }
}
