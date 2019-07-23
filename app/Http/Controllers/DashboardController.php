<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Inhabitant;
use App\Household;
use App\Barangay;
use DB;
use Auth;

class DashboardController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:api');
    }
    public function TotalInhabitants()
    {
        return Inhabitant::where("user_id", "=", Auth::user()->id)->count("id");
    }
    public function TotalHouseholds()
    {
        return Household::where("user_id", "=", Auth::user()->id)->count("id");
    }
    public function TotalPuroks()
    {
        return Household::where("user_id", "=", Auth::user()->id)->distinct()->count("purok");
    }

    public function TotalHouseholdsPurok()
    {
        return DB::table('households')
            ->leftJoin('users', 'households.user_id', '=', 'users.id')
            ->leftJoin('inhabitants', 'households.id', '=', 'inhabitants.household_id')
            ->select('households.purok as Purok', DB::raw('count(inhabitants.id) AS Inhabitants'), DB::raw('count(distinct households.id) AS Households'))
            ->where('users.id', Auth::user()->id)
            ->whereNull('households.deleted_at')
            ->whereNull('inhabitants.deleted_at')
            ->groupBy('households.purok')
            ->get();
    }
    public function TotalRegisteredVoters()
    {
        return DB::table('inhabitants')
            ->leftJoin('users', 'inhabitants.user_id', '=', 'users.id')
            ->select('inhabitants.registeredVoterOfTheBrgy as RegisteredVoter', DB::raw('count(*) as Total'))
            ->where('users.id', Auth::user()->id)
            ->whereNull('inhabitants.deleted_at')
            ->whereNotNull('registeredVoterOfTheBrgy')
            ->groupby('registeredVoterOfTheBrgy')
            ->get();
    }
    public function TotalDialects()
    {
        return DB::table('households')
            ->leftJoin('users', 'households.user_id', '=', 'users.id')
            ->select('households.dialects as Dialects', DB::raw('count(*) as Total'))
            ->where('users.id', Auth::user()->id)
            ->whereNull('households.deleted_at')
            ->groupby('dialects')
            ->get();
    }
    public function TotalGender()
    {
        return DB::table('inhabitants')
            ->leftJoin('users', 'inhabitants.user_id', '=', 'users.id')
            ->select('inhabitants.sex as Gender', DB::raw('count(*) as Total'))
            ->where('users.id', Auth::user()->id)
            ->whereNull('inhabitants.deleted_at')
            ->groupby('sex')
            ->get();
    }
    public function TotalRel()
    {
        return DB::table('inhabitants')
            ->leftJoin('users', 'inhabitants.user_id', '=', 'users.id')
            ->select('inhabitants.religion as Religion', DB::raw('count(*) as Total'))
            ->where('users.id', Auth::user()->id)
            ->whereNull('inhabitants.deleted_at')
            ->whereNotNull('inhabitants.religion')
            ->groupby('religion')
            ->get();
    }
    public function TotalEthnicGroups()
    {
        return DB::table('inhabitants')
            ->leftJoin('users', 'inhabitants.user_id', '=', 'users.id')
            ->select('inhabitants.ethnicGroup as EthnicGroup', DB::raw('count(*) as Total'))
            ->where('users.id', Auth::user()->id)
            ->whereNull('inhabitants.deleted_at')
            ->whereNotNull('inhabitants.ethnicGroup')
            ->groupby('ethnicGroup')
            ->get();
    }
    public function TotalBarangay(){
        return Barangay::count("id");
    }
    public function TotalCityInhabitants(){
        return Inhabitant::count("id");
    }
    public function TotalCityHouseholds(){
        return Household::count("id");
    }
    public function TotalBarangayPopulous(){
        return DB::table('households')
            ->leftJoin('users', 'households.user_id', '=', 'users.id')
            ->leftJoin('inhabitants', 'households.id', '=', 'inhabitants.household_id')
            ->select('users.name as Barangay', DB::raw('count(*) AS Inhabitants'), DB::raw('count(distinct households.id) AS Households'))
            ->whereNull('households.deleted_at')
            ->whereNull('inhabitants.deleted_at')
            ->groupBy('users.name')
            ->orderBy('Inhabitants', 'desc')
            ->limit(10)
            ->get();
    }
    public function ListAllBarangay(){
        return DB::table('households')
            ->leftJoin('users', 'households.user_id', '=', 'users.id')
            ->leftJoin('inhabitants', 'households.id', '=', 'inhabitants.household_id')
            ->leftjoin('barangays', 'barangays.user_id', '=', 'households.user_id')
            ->select('users.name as Barangay', 'barangays.type_barangay as type', DB::raw('count(inhabitants.id) AS Inhabitants'), DB::raw('count(distinct households.id) AS Households'))
            ->whereNull('households.deleted_at')
            ->whereNull('inhabitants.deleted_at')
            ->groupBy('users.name', 'barangays.type_barangay')
            ->orderBy('Inhabitants', 'desc')
            ->get();
    }
}
