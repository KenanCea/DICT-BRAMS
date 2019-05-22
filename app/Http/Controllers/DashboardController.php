<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Inhabitant;
use App\Household;

class DashboardController extends Controller
{
    public function TotalInhabitants(){
        return Inhabitant::whereRaw("YEAR(CURDATE()) - YEAR(inhabitants.date_of_birth) - IF(STR_TO_DATE(CONCAT(YEAR(CURDATE()),
        '-',
        MONTH(inhabitants.date_of_birth),
        '-',
        DAY(inhabitants.date_of_birth)),
'%Y-%c-%e') > CURDATE(),
1,
0) = 18")
->where("user_id",'=',1)->count('id');
        
        //return Inhabitant::where("user_id", "=", 1)->count("id");
    }
    public function TotalHouseholds() {
        return Household::where("user_id", "=", 1)->count("id");
    }
    public function TotalPuroks() {
        return Household::where("user_id", "=", 1)->distinct()->count("purok");
    }
    public function TotalSeniors() {
        return Inhabitant::where("user_id", "=", 1)->where("age", ">=", 60)->count();
    }
    public function TotalChildren() {
        return Inhabitant::where("user_id", "=", 1)->where("age", "<", 18)->count();
    }
}
