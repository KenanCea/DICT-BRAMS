<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Inhabitant;
use App\Household;
use App\activitylogs;
use App\User;
use DB;

class InhabitantController extends Controller
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
        return DB::table('inhabitants')
            ->leftJoin('users', 'inhabitants.user_id', '=', 'users.id')
            ->leftJoin('households', 'inhabitants.household_id', '=', 'households.id')
            ->select(
                'inhabitants.*',
                'households.house_no',
                'households.purok',
                'households.street',
                DB::raw("YEAR(CURDATE()) - YEAR(inhabitants.date_of_birth) - IF(STR_TO_DATE(CONCAT(YEAR(CURDATE()),
                '-',
                MONTH(inhabitants.date_of_birth),
                '-',
                DAY(inhabitants.date_of_birth)),
                '%Y-%c-%e') > CURDATE(),
                1,
                0) as age")
            )
            ->whereNull('inhabitants.deleted_at')
            ->where('users.id', Auth::user()->id)
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
        $inhabitant = $request->user()->inhabitants()->create($request->all());

        //start of log
        $households = Household::findOrFail($inhabitant->household_id);
        $name=User::findOrFail(Auth::user()->id);
        $logs= new activitylogs;
        $logs->log="Added " .$inhabitant->last_name.", ".$inhabitant->first_name." to #"
        .$households->house_no." ".$households->street.' Purok '.$households->purok.", ".$name->name;
        $logs->user_id=Auth::user()->id;
        $logs->save();
        //end of log

        return new $inhabitant;
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Inhabitant  $inhabitant
     * @return \Illuminate\Http\Response
     */
    public function show()
    {
        $household = Household::select('name')->get();
        return $household;

    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Inhabitant  $inhabitant
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $inhabitants = Inhabitant::findOrFail($id);
        $inhabitants->update($request->all());

        //log
        $households = Household::findOrFail($inhabitants->household_id);
        $name=User::findOrFail(Auth::user()->id);
        $logs= new activitylogs;
        $logs->log="Updated " .$inhabitants->last_name.", ".$inhabitants->first_name." of #"
        .$households->house_no." ".$households->street.' Purok '.$households->purok.", ".$name->name;
        $logs->user_id=Auth::user()->id;
        $logs->save();
    }

    public function archived_Inhabitant()
    {
        return DB::table('inhabitants')
            ->leftJoin('users', 'inhabitants.user_id', '=', 'users.id')
            ->select(
                'inhabitants.*',
                DB::raw("YEAR(CURDATE()) - YEAR(inhabitants.date_of_birth) - IF(STR_TO_DATE(CONCAT(YEAR(CURDATE()),
                '-',
                MONTH(inhabitants.date_of_birth),
                '-',
                DAY(inhabitants.date_of_birth)),
        '%Y-%c-%e') > CURDATE(),
        1,
        0) as age")
            )
            ->whereNotNull('inhabitants.deleted_at')
            ->where('users.id', Auth::user()->id)

            ->get();
    }

    public function archive( Request $request,$id)
    {
        $inhabitant = Inhabitant::find($id);
        $inhabitant->update(['remarks'=>request('remarks')]);
        $inhabitant->delete();

        //start of log
        $households = Household::findOrFail($inhabitant->household_id);
        $name=User::findOrFail(Auth::user()->id);
        $logs= new activitylogs;
        $logs->log="Archived " .$inhabitant->last_name.", ".$inhabitant->first_name." of #"
        .$households->house_no." ".$households->street.' Purok '.$households->purok.", ".$name->name;
        $logs->user_id=Auth::user()->id;
        $logs->save();
        //end of log

    }
    public function restore($id,$houseID)
    {
        $inhabitants = Inhabitant::withTrashed()->findOrFail($id)->restore();
        $inhabitant = Inhabitant::findOrFail($id);
        $inhabitant->update(['household_id'=>$houseID]);

        //log
        $households = Household::findOrFail($inhabitant->household_id);
        $name=User::findOrFail(Auth::user()->id);
        $logs= new activitylogs;
        $logs->log="Restored " .$inhabitant->last_name.", ".$inhabitant->first_name." of #"
        .$households->house_no." ".$households->street.' Purok '.$households->purok.", ".$name->name;
        $logs->user_id=Auth::user()->id;
        $logs->save();
    }
}
