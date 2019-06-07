<?php

namespace App\Http\Controllers;

use App\HouseholdDistribution;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class HouseholdDistributionController extends Controller
{
    public function index()
    {
        return HouseholdDistribution::leftJoin('landuses','household_distribution.landuse_id','=','landuses.id')
        ->select('household_distribution.*')
        ->get();
    }

    public function update(Request $request, $id)
    {
        $household_distribution = HouseholdDistribution::findOrFail($id);
        $household_distribution->update($request->all());
    }
}
