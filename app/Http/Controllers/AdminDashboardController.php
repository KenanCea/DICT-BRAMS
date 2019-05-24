<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Inhabitant;
use App\Household;
use App\Barangay;
use DB;
use Auth;

class AdminDashboardController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:api');
    }
    public function TotalBarangays(){
        return Barangay::count("id");
    }
    public function TotalInhabitants(){
        return Inhabitant::count("id");
    }
    public function TotalHouseholds() {
        return Household::count("id");
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
        ->count('id');
    }
}
