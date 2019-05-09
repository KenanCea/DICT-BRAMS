<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class BusinessClearance extends Model
{
    protected $fillable = [
        'control_no',
        'business_address', 
        'business_trade_name',
        'business_application', 
        'kind_business',
        'line_of_business',
        'action_taken',
        'reasons_approv_disapprove',
        'date_issued',
        'ctc_no',
        'ctc_issued_on',
        'ctc_issued_at',
        'official_receipt_no',
        'date_OfficialReceipt',
        'total_amt_paid',
    ];
    public function inhabitant()
    {
        return $this->belongsTo('App\Inhabitant');
    }
}
