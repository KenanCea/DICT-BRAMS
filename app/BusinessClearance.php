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
        'ctc_no',
        'official_receipt_no',
        'date_OfficialReceipt',
        'total_amt_paid',
        'inhabitant_id',
        'last_name',
        'first_name',
        'middle_name',
        'house_no',
        'purok',
        'street'
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
