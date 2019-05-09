<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Communication extends Model
{
    protected $fillable = [
        'telephone_totalProvider',
        'telephone_name_company',
        'telephone_no_hhold_served',
        'cellular_totalProvider',
        'cellular_name_company',
        'cellular_no_hhold_served',
        'internet_totalProvider',
        'internet_name_company',
        'internet_no_hhold_served',
        'postalservive_totalProvider',
        'postalservive_name_company',
        'postalservive_no_hhold_served',
        'deliveryservice_totalProvider',
        'deliveryservice_name_company',
        'deliveryservice_no_hhold_served'
    ];
    public function barangay()
    {
        return $this->belongsTo('App\Barangay');
    }
}
