<?php

namespace App\Http\Controllers;

use App\HealthFacilities;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use DB;

class HealthFacilityController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:api');
    }

    public function index()
    {
        return DB::table('health_facilities')
            ->leftJoin('users','health_facilities.barangay_id','=','users.id')
            ->select('health_facilities.*')
            ->where('users.id', Auth::user()->id)
            ->get();
    }

    public function HealthFacility()
    {
        //Public Hospital
        $query = HealthFacilities::leftJoin('users','health_facilities.barangay_id','=','users.id')
        ->selectRaw('"Public Hospital" as "healthfacility_type", pubhos_num as "healthfacility_number", pubhos_numpatients as "numpatients"', [Auth::user()->id]
        )
        ->where('users.id',Auth::user()->id);
        //Private Hospital
        $querytwo = HealthFacilities::leftJoin('users','health_facilities.barangay_id','=','users.id')
        ->selectRaw('"Private Hospital" as "healthfacility_type", prihos_num as "healthfacility_number", prihos_numpatients as "numpatients"', [Auth::user()->id]
        )
        ->where('users.id',Auth::user()->id);
        //Health Center
        $querythree = HealthFacilities::leftJoin('users','health_facilities.barangay_id','=','users.id')
        ->selectRaw('"Health Center" as "healthfacility_type", healthcenter_num as "healthfacility_number", healthcenter_numpatients as "numpatients"', [Auth::user()->id]
        )
        ->where('users.id',Auth::user()->id);
        //Clinic
        $queryfour = HealthFacilities::leftJoin('users','health_facilities.barangay_id','=','users.id')
        ->selectRaw('"Clinic" as "healthfacility_type", clinic_num as "healthfacility_number", clinic_numpatients as "numpatients"', [Auth::user()->id]
        )
        ->where('users.id',Auth::user()->id);
        //Self-medication
        $queryfive = HealthFacilities::leftJoin('users','health_facilities.barangay_id','=','users.id')
        ->selectRaw('"Self-medication" as "healthfacility_type", self_medication_num as "healthfacility_number", self_medication_numpatients as "numpatients"', [Auth::user()->id]
        )
        ->where('users.id',Auth::user()->id);
        $query->union($querytwo)->union($querythree)->union($queryfour)->union($queryfive);

        $query=$query->get();
        return $query;
    }

    public function updateHealthFacility(Request $request, $id)
    {
        $health_facility = HealthFacilities::findOrFail($id);
        $health_facility->update($request->all());

        $name=User::findOrFail(Auth::user()->id);
        $logs= new activitylogs;
        $logs->log="Updated Health Facility Table, ".$name->name;
        $logs->user_id=Auth::user()->id;
        $logs->save();
    }
}
