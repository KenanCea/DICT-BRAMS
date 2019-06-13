<?php

namespace App\Http\Controllers;

use App\HealthFacilities;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class HealthFacilityController extends Controller
{
    public function index()
    {
        return HealthFacilities::leftJoin('barangays','health_facilities.barangay_id','=','barangays.id')
        ->select('health_facilities.*')
        ->get();
    }

    public function update(Request $request, $id)
    {
        $health_facility = HealthFacilities::findOrFail($id);
        $health_facility->update($request->all());
    }
}

