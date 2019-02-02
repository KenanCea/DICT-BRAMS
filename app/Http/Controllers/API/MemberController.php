<?php

namespace App\Http\Controllers\API;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Member;
use Auth;

class MemberController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function __construct()
    {
        $this->middleware('auth:api');
    }

    public function index()
    {
        return Member::leftJoin('users','members.barangay_id','=','users.id')
        ->select('members.*')
        ->Where('archive',0)
        ->where('users.id',Auth::user()->id)
        ->latest()
        ->paginate(1000);
    }


    public function archive($id)
    {
        $members = Member::findOrFail($id);
        $members->archive = ! $members->archive;
        $members->save();
    }

    public function archived_list()
    {
        return Member::leftJoin('users','members.barangay_id','=','users.id')
        ->select('members.*')
        ->Where('archive',1)
        ->where('users.id',Auth::user()->id)
        ->latest()
        ->paginate(1000);
    }


    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request,[
            'first_name' => 'required|string|max:50',
            'family_name' => 'required|string|max:50',
            'middle_name' => 'required|string|max:50',
            'sex' => 'required|string|max:50'
        ]);
        return Member::create([
            'first_name' => $request['first_name'],
            'family_name' => $request['family_name'],
            'middle_name' => $request['middle_name'],
            'sex' => $request['sex'],
        ]);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $member = Member::findOrFail($id);
        $this->validate($request,[
            'first_name' => 'required|string|max:50',
            'family_name' => 'required|string|max:50',
            'middle_name' => 'required|string|max:50',
            'age' => 'required|integer',
            'sex' => 'required|string|max:50'
        ]);
        $member->update($request->all());
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $member = Member::findOrFail($id);
        $member->delete();
    }
}
