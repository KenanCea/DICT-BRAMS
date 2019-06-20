<?php

namespace App\Http\Controllers;

use App\Inhabitant;
use App\Household;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\activitylogs;
use App\User;
use DB;

class HouseholdController extends Controller
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
        return DB::table('households')
            ->leftJoin('users', 'households.user_id', '=', 'users.id')
            ->leftJoin('inhabitants', 'households.id', '=', 'inhabitants.household_id')
            ->select(
                'households.*',
                DB::raw('COUNT(CASE WHEN inhabitants.deleted_at IS NULL && inhabitants.id is not null THEN 1 END) AS familysize')
            )
            ->where('users.id', Auth::user()->id)
            ->whereNull('households.deleted_at')
            ->groupBy('households.id')
            ->orderBy('households.id')
            ->get();
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        $household = $request->user()->households()->create($request->all());

        //start log
        $name=User::findOrFail(Auth::user()->id);
        $logs= new activitylogs;
        $logs->log="Added #".$household->house_no." ".$household->street.' Purok '.$household->purok.", ".$name->name;
        $logs->user_id=Auth::user()->id;
        $logs->save();
        //end log

        return new $household;

        
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Household  $household
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $inhabitant = Inhabitant::where('household_id', '=', $id)->latest()->get();
        return $inhabitant;
    }


    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Household  $household
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $household = Household::findOrFail($id);
        $household->update($request->all());

        $name=User::findOrFail(Auth::user()->id);
        $logs= new activitylogs;
        $logs->log="Updated #".$household->house_no." ".$household->street.' Purok '.$household->purok.", ".$name->name;
        $logs->user_id=Auth::user()->id;
        $logs->save();
    }

    public function create_Inhabitant($id)
    {
        $household = Household::findOrFail($id);
    }

    public function archive(Request $request,$id)
    {
        $household = Household::findOrFail($id);
        $household->update(['remarks'=>request('remarks')]);
        $household->delete();


        $inhabitants = Inhabitant::where('household_id', $id);
        $inhabitants->update(['remarks'=>"household has been ".request('remarks')]);
        $inhabitants->delete();

        
        $name=User::findOrFail(Auth::user()->id);
        $logs= new activitylogs;
        $logs->log="Archived #".$household->house_no." ".$household->street.' Purok '.$household->purok.", ".$name->name." and the Inhabitants residing in";
        $logs->user_id=Auth::user()->id;
        $logs->save();
    }

    public function restore($id)
    {
        $household = Household::withTrashed()->findOrFail($id);
        $household->restore();

        $name=User::findOrFail(Auth::user()->id);
        $logs= new activitylogs;
        $logs->log="Restored #".$household->house_no." ".$household->street.' Purok '.$household->purok.", ".$name->name;
        $logs->user_id=Auth::user()->id;
        $logs->save();
    }

    public function archived_Household()
    {
        return DB::table('households')
            ->leftJoin('users', 'households.user_id', '=', 'users.id')
            ->select('households.*')
            ->whereNotNull('households.deleted_at')
            ->where('users.id', Auth::user()->id)
            ->get();
    }
}
