<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Official;
use App\Barangay;
use App\Household;
use App\Inhabitant;
use DB;
use Auth;

class BarangaySummaryController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:api');
    }
    public function PunongBarangay(){
        return DB::table('officials')
            ->leftJoin('users', 'officials.user_id', '=', 'users.id')
            ->leftJoin('barangays', 'barangays.user_id', '=', 'officials.user_id')
            ->select('officials.name' , 'officials.position')
            ->where('officials.position', '=', 'Punong Barangay')
            ->where('users.id', Auth::user()->id)
            ->get();
    }
    public function BarangaySecretary(){
        return DB::table('officials')
            ->leftJoin('users', 'officials.user_id', '=', 'users.id')
            ->leftJoin('barangays', 'barangays.user_id', '=', 'officials.user_id')
            ->select('officials.name' , 'officials.position')
            ->where('officials.position', '=', 'Barangay Secretary')
            ->where('users.id', Auth::user()->id)
            ->get();
    }
    public function TotalSeniors() {
        return Inhabitant::whereRaw("YEAR(CURDATE()) - YEAR(inhabitants.date_of_birth) - IF(STR_TO_DATE(CONCAT(YEAR(CURDATE()),
        '-',
        MONTH(inhabitants.date_of_birth),
        '-',
        DAY(inhabitants.date_of_birth)),
        '%Y-%c-%e') > CURDATE(),
        1,
        0) >= 60")
        ->where('user_id', '=', Auth::user()->id)
        ->count('id');
    }
    public function TotalLandArea(){
        return DB::table('barangays')
        ->leftJoin('users', 'barangays.user_id', '=', 'users.id')
        ->select('barangays.totalland_area_sqkm')
        ->where('users.id', Auth::user()->id)
        ->get();
    }
    public function TotalMale()
    {
        return Inhabitant::whereRaw('inhabitants.sex')
            ->where('sex','=','male')
            ->whereNull('inhabitants.deleted_at')
            ->where('user_id', '=', Auth::user()->id)
            ->count('id');

    }
    public function TotalFemale()
    {
        return Inhabitant::whereRaw('inhabitants.sex')
            ->where('sex','=','female')
            ->whereNull('inhabitants.deleted_at')
            ->where('user_id', '=', Auth::user()->id)
            ->count('id');

    }
    public function TotalPermanentInhabitants()
    {
        return Inhabitant::whereRaw('inhabitants.status_of_residency')
            ->where('status_of_residency','=','permanent')
            ->whereNull('inhabitants.deleted_at')
            ->where('user_id', '=', Auth::user()->id)
            ->count('id');

    }
    public function TotalRegisteredVoters()
    {
        return Inhabitant::whereRaw('inhabitants.registeredVoterOfTheBrgy')
            ->where('registeredVoterOfTheBrgy','=','yes')
            ->whereNull('inhabitants.deleted_at')
            ->where('user_id', '=', Auth::user()->id)
            ->count('id');
    }
    public function TotalChildren() {
        return Inhabitant::whereRaw("YEAR(CURDATE()) - YEAR(inhabitants.date_of_birth) - IF(STR_TO_DATE(CONCAT(YEAR(CURDATE()),
        '-',
        MONTH(inhabitants.date_of_birth),
        '-',
        DAY(inhabitants.date_of_birth)),
        '%Y-%c-%e') > CURDATE(),
        1,
        0) >= 6")
        ->where('user_id', '=', Auth::user()->id)
        ->count('id');
    }
    public function TotalOutOfSchoolYouth(){
        return Inhabitant::whereRaw('schooling')
        ->where('schooling', '=', 'Out Of School')
        ->whereNull('inhabitants.deleted_at')
            ->where('user_id', '=', Auth::user()->id)
            ->count('id');
    }
    public function TotalSoloParent(){
        return Household::whereRaw('households.solo_parent')
        ->where('households.solo_parent','!=', 'no')
        ->whereNull('households.deleted_at')
            ->where('user_id', '=', Auth::user()->id)
            ->count('id');
    }

}
