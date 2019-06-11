<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class BarangayCertificate extends Model
{
    protected $fillable = [
        'control_no',
        'purpose_certification',
        'ctc_no',
        'official_receipt_no',
        'amount_paid',
        'inhabitant_id'
    ];
    public function inhabitant()
    {
        return $this->belongsTo('App\Inhabitant');
    }
}
