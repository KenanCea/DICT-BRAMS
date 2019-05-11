<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class EnvironmentInfo extends Model
{
    protected $fillable = [
            'Level1',
            'Level2',
            'Level3',
            'tank',
            'elevated_tank',
            'jars',
            'drums/cans',
            'plastic_conatainers',
            'others_water_storage',
            'market',
            'sarisaristore',
            'ambulant_vendor',
            'others_food_service',
            'refrigerator',
            'cabinet/shelves',
            'others_hhold_storage',
            'fresh',
            'dried',
            'processed',
            'others_kind_of_foodstorage',
            'with',
            'drainage',
            'city/mun_collection',
            'communal_pit',
            'backyard_pit',
            'open_dump',
            'composting',
            'burning',
            'others_garbage_disposal',
    ];
    public function household()
    {
        return $this->belongsTo('App\Household');
    }
}
