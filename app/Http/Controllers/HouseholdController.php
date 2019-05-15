<?php

namespace App\Http\Controllers;

use App\Inhabitant;
use App\Household;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
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
        return Household::leftJoin('users','households.user_id','=','users.id')
        ->select('households.*')
        ->where('users.id',Auth::user()->id)
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
        $inhabitant = Inhabitant::where('household_id','=', $id)->get();
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
    }

    public function archive($id)
    {
        $household = Household::findOrFail($id);
        $household->delete();
    }

    public function restore($id)
    {
        $household = Household::withTrashed()->findOrFail($id)->restore();
    }

    public function archived_Household()
    {
        return DB::table('households')
        ->leftJoin('users','households.user_id','=','users.id')
        ->select('households.*')
        ->whereNotNull('deleted_at')
        ->where('users.id',Auth::user()->id)
        ->get();
    }
}
