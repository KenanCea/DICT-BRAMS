<?php

namespace App\Http\Controllers;

use App\Official;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

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
        return Official::leftJoin('users','officials.user_id','=','users.id')
        ->select('officials.*')
        ->orderByRaw("FIELD(position, 'Punong Barangay', 'Barangay Kagawad',
     'Barangay Treasurer', 'Barangay Secretary')")
        ->where('users.id',Auth::user()->id)
        ->get();
    }

    public function update(Request $request, $id)
    {
        $official = Official::findOrFail($id);
        $official->update($request->all());
    }
}
