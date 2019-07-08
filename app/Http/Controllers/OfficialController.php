<?php

namespace App\Http\Controllers;

use App\Official;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\activitylogs;
use App\User;
use DB;

class OfficialController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:api');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return DB::table('officials')
        ->leftJoin('users','officials.user_id','=','users.id')
        ->select('officials.*')
        ->orderByRaw("FIELD(position, 'Punong Barangay', 'Barangay Kagawad',
     'Barangay Treasurer', 'Barangay Secretary')")
        ->where('users.id',Auth::user()->id)
        ->limit(10)
        ->get();
    }

    public function store(Request $request)
    {
        $official = $request->user()->officials()->create($request->all());

        //start log
        $name=User::findOrFail(Auth::user()->id);
        $logs= new activitylogs;
        $logs->log="Added official ".$official->name." to the position ".$official->position.", ".$name->name;
        $logs->user_id=Auth::user()->id;
        $logs->save();
        //end log
        
        return new $official;
        
    }

    public function update(Request $request, $id)
    {
        $official = Official::findOrFail($id);
        $official->update($request->all());

        $name=User::findOrFail(Auth::user()->id);
        $logs= new activitylogs;
        $logs->log="Updated official ".$official->name." Position: ".$official->position.", ".$name->name;
        $logs->user_id=Auth::user()->id;
        $logs->save();
    }
    public function destroy($id)
    {
        $official = Official::findOrFail($id);
        $official->delete();
    }
}
