<?php

namespace App\Http\Controllers;

use App\Barangay;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use DB;

class BarangayController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:api');
    }

    public function index()
    {
        return DB::table('barangays')
            ->leftJoin('users', 'barangays.user_id', '=', 'users.id')
            ->select('barangays.*')
            ->where('users.id', Auth::user()->id)
            ->get();
    }

    public function LandForm()
    {
        //Mountainous
        $query = Barangay::leftJoin('users', 'barangays.user_id', '=', 'users.id')
        ->selectRaw('"Mountainous" as "landform_type", mountainous as "landform_percent"', [Auth::user()->id]
        )
        ->where('users.id',Auth::user()->id);
        //Plain
        $querytwo = Barangay::leftJoin('users', 'barangays.user_id', '=', 'users.id')
        ->selectRaw('"Plain" as "landform_type", plain as "landform_percent"', [Auth::user()->id]
        )
        ->where('users.id',Auth::user()->id);
        //Valley
        $querythree = Barangay::leftJoin('users', 'barangays.user_id', '=', 'users.id')
        ->selectRaw('"Valley" as "landform_type", valley as "landform_percent"', [Auth::user()->id]
        )
        ->where('users.id',Auth::user()->id);
        $query->union($querytwo)->union($querythree);

        $query=$query->get();
        return $query;
    }

    public function updateBarangay(Request $request)
    {
        $user = auth('api')->user();
        $barangay->update($request->all());
        return ['message' => "Success"];
    }

    public function updateLandForm(Request $request, $id)
    {
        $landForm = Barangay::findOrFail($id);
        $landForm->update($request->all());

        $name=User::findOrFail(Auth::user()->id);
        $logs= new activitylogs;
        $logs->log="Updated percentage of  Land Forms ".$landForm->mountainous.", ".$landForm->plain.",  ".$landForm->valley.", ".$name->name;
        $logs->user_id=Auth::user()->id;
        $logs->save();
    }

    public function barangay()
    {
        return Barangay::where("user_id", "=", Auth::user()->id)->count("id");
    }
}
