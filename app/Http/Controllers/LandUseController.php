<?php

namespace App\Http\Controllers;

use App\Landuse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use DB;

class LandUseController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:api');
    }

    public function index()
    {
        return DB::table('landuses')
            ->leftJoin('users','landuses.barangay_id','=','users.id')
            ->select('landuses.*')
            ->where('users.id', Auth::user()->id)
            ->get();
    }

    public function LandUse()
    {
        //Residential
        $query = Landuse::leftJoin('users','landuses.barangay_id','=','users.id')
        ->selectRaw('"Residential" as "landuse_type", residential_land_area_sqm as "squarekilometers", residential_land_area_hec as "hectares", residential_totalpop as "totalpopulation"', [Auth::user()->id]
        )
        ->where('users.id',Auth::user()->id);
        //Commercial
        $querytwo = Landuse::leftJoin('users','landuses.barangay_id','=','users.id')
        ->selectRaw('"Commercial" as "landuse_type", commercial_land_area_sqm as "squarekilometers", commercial_land_area_hec as "hectares", commercial_totalpop as "totalpopulation"', [Auth::user()->id]
        )
        ->where('users.id',Auth::user()->id);
        //Industrial
        $querythree = Landuse::leftJoin('users','landuses.barangay_id','=','users.id')
        ->selectRaw('"Industrial" as "landuse_type", industrial_land_area_sqm as "squarekilometers", industrial_land_area_hec as "hectares", industrial_totalpop as "totalpopulation"', [Auth::user()->id]
        )
        ->where('users.id',Auth::user()->id);
        //Agricultural
        $queryfour = Landuse::leftJoin('users','landuses.barangay_id','=','users.id')
        ->selectRaw('"Agricultural" as "landuse_type", agricultural_land_area_sqm as "squarekilometers", agricultural_land_area_hec as "hectares", agricultural_totalpop as "totalpopulation"', [Auth::user()->id]
        )
        ->where('users.id',Auth::user()->id);
        //Aquatic
        $queryfive = Landuse::leftJoin('users','landuses.barangay_id','=','users.id')
        ->selectRaw('"Aquatic" as "landuse_type", aquatic_land_area_sqm as "squarekilometers", aquatic_land_area_hec as "hectares", aquatic_totalpop as "totalpopulation"', [Auth::user()->id]
        )
        ->where('users.id',Auth::user()->id);
        //Forest
        $querysix = Landuse::leftJoin('users','landuses.barangay_id','=','users.id')
        ->selectRaw('"Forest" as "landuse_type", forest_land_area_sqm as "squarekilometers", forest_land_area_hec as "hectares", forest_totalpop as "totalpopulation"', [Auth::user()->id]
        )
        ->where('users.id',Auth::user()->id);
        //Idle
        $queryseven = Landuse::leftJoin('users','landuses.barangay_id','=','users.id')
        ->selectRaw('"Idle" as "landuse_type", idle_land_area_sqm as "squarekilometers", idle_land_area_hec as "hectares", idle_land_area_totalpop as "totalpopulation"', [Auth::user()->id]
        )
        ->where('users.id',Auth::user()->id);
        $query->union($querytwo)->union($querythree)->union($queryfour)->union($queryfive)->union($querysix)->union($queryseven);

        $query=$query->get();
        return $query;
    }

    public function updateLandUse(Request $request, $id)
    {
        $landuse = Landuse::findOrFail($id);
        $landuse->update($request->all());

        $name=User::findOrFail(Auth::user()->id);
        $logs= new activitylogs;
        $logs->log="Updated Land Use Table, ".$name->name;
        $logs->user_id=Auth::user()->id;
        $logs->save();
    }

    public function updateLandUseForm(Request $request)
    {
        $user = auth('api')->user();
        $landuse->update($request->all());
        return ['message' => "Success"];
    }

    public function landuses()
    {
        return Landuse::where("barangay_id", "=", Auth::user()->id)->count("id");
    }
}
