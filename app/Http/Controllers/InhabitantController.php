<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Inhabitant;
use DB;

class InhabitantController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:api');
        $this->authorize('isUser');
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return Inhabitant::leftJoin('users','inhabitants.user_id','=','users.id')
        ->select('inhabitants.*',
                DB::raw("YEAR(CURDATE()) - YEAR(inhabitants.date_of_birth) - IF(STR_TO_DATE(CONCAT(YEAR(CURDATE()),
                '-',
                MONTH(inhabitants.date_of_birth),
                '-',
                DAY(inhabitants.date_of_birth)),
        '%Y-%c-%e') > CURDATE(),
        1,
        0) as age"))
        ->Where('inhabitants.archive',0)
        ->where('users.id',Auth::user()->id)
        ->limit(1000)
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
    }

    public function archived_Inhabitant()
    {
        return Inhabitant::leftJoin('users','inhabitants.user_id','=','users.id')
        ->select('inhabitants.*',
                DB::raw("YEAR(CURDATE()) - YEAR(inhabitants.date_of_birth) - IF(STR_TO_DATE(CONCAT(YEAR(CURDATE()),
                '-',
                MONTH(inhabitants.date_of_birth),
                '-',
                DAY(inhabitants.date_of_birth)),
        '%Y-%c-%e') > CURDATE(),
        1,
        0) as age"))
        ->where('inhabitants.archive',1)
        ->where('users.id',Auth::user()->id)
        ->get();
    }

    public function archive($id)
    {
        $inhabitants = Inhabitant::findOrFail($id);
        $inhabitants->archive = ! $inhabitants->archive;
        $inhabitants->save();
    }
}
