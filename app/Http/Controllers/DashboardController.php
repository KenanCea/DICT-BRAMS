<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Inhabitant;
use App\Household;
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
    public function TotalReligion()
    {
        return DB::table('inhabitants')
            ->leftJoin('users', 'inhabitants.user_id', '=', 'users.id')
            ->select('inhabitants.religion as Religion', DB::raw('count(*) as Total'))
            ->where('users.id', Auth::user()->id)
            ->whereNull('inhabitants.deleted_at')
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
            ->groupby('ethnicGroup')
            ->get();
    }
}
