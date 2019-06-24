<?php

namespace App\Http\Controllers;

use App\Communication;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use DB;

class CommunicationController extends Controller
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
        return DB::table('communications')
            ->leftJoin('users','communications.barangay_id','=','users.id')
            ->select('communications.*')
            ->where('users.id', Auth::user()->id)
            ->get();
    }

    public function Communication()
    {
        //Telephone
        $query = Communication::leftJoin('users','communications.barangay_id','=','users.id')
        ->selectRaw('"Telephone" as "communication_type", telephone_totalProvider as "totalProvider", telephone_name_company as "name_company", telephone_no_hhold_served as "households_served"', [Auth::user()->id]
        )
        ->where('users.id',Auth::user()->id);
        //Cellular
        $querytwo = Communication::leftJoin('users','communications.barangay_id','=','users.id')
        ->selectRaw('"Cellular" as "communication_type", cellular_totalProvider as "totalProvider", cellular_name_company as "name_company", cellular_no_hhold_served as "households_served"', [Auth::user()->id]
        )
        ->where('users.id',Auth::user()->id);
        //Internet
        $querythree = Communication::leftJoin('users','communications.barangay_id','=','users.id')
        ->selectRaw('"Internet" as "communication_type", internet_totalProvider as "totalProvider", internet_name_company as "name_company", internet_no_hhold_served as "households_served"', [Auth::user()->id]
        )
        ->where('users.id',Auth::user()->id);
        //Postal service
        $queryfour = Communication::leftJoin('users','communications.barangay_id','=','users.id')
        ->selectRaw('"Postal service" as "communication_type", postalservive_totalProvider as "totalProvider", postalservive_name_company as "name_company", postalservive_no_hhold_served as "households_served"', [Auth::user()->id]
        )
        ->where('users.id',Auth::user()->id);
        //Delivery service
        $queryfive = Communication::leftJoin('users','communications.barangay_id','=','users.id')
        ->selectRaw('"Delivery service" as "communication_type", deliveryservice_totalProvider as "totalProvider", deliveryservice_name_company as "name_company", deliveryservice_no_hhold_served as "households_served"', [Auth::user()->id]
        )
        ->where('users.id',Auth::user()->id);
        $query->union($querytwo)->union($querythree)->union($queryfour)->union($queryfive);

        $query=$query->get();
        return $query;
    }

    public function updateCommunication(Request $request, $id)
    {
        $communication = Communication::findOrFail($id);
        $communication->update($request->all());

        $name=User::findOrFail(Auth::user()->id);
        $logs= new activitylogs;
        $logs->log="Updated Communication Table, ".$name->name;
        $logs->user_id=Auth::user()->id;
        $logs->save();
    }
}
