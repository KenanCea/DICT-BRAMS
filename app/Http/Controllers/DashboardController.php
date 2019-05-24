<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
//use Illuminate\Support\Facades\Auth;
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
    public function TotalInhabitants(){
        return Inhabitant::where("user_id", "=", Auth::user()->id)->count("id");
    }
    public function TotalHouseholds() {
        return Household::where("user_id", "=", Auth::user()->id)->count("id");
    }
    public function TotalPuroks() {
        return Household::where("user_id", "=", Auth::user()->id)->distinct()->count("purok");
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
    public function TotalChildren() {
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
}
