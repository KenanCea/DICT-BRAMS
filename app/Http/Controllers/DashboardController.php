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
    public function TotalSeniors()
    {
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
    public function TotalChildren()
    {
        return Inhabitant::whereRaw("YEAR(CURDATE()) - YEAR(inhabitants.date_of_birth) - IF(STR_TO_DATE(CONCAT(YEAR(CURDATE()),
        '-',
        MONTH(inhabitants.date_of_birth),
        '-',
        DAY(inhabitants.date_of_birth)),
        '%Y-%c-%e') > CURDATE(),
        1,
        0) <= 12")
            ->where('user_id', '=', Auth::user()->id)
            ->count('id');
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
}
