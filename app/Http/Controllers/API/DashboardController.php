<?php

namespace App\Http\Controllers\API;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Member;

class DashboardController extends Controller
{
    public function TotalInhabitant(){
        return Member::count("id");
    }

    public function TotalHouseholds(){
        return Member::distinct()->count("region_barangay");
    }

    public function TotalPurok(){
    }
}
