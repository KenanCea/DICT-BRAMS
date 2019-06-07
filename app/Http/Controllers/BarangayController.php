<?php

namespace App\Http\Controllers;

use App\Barangay;
use DB;
use Auth;

class BarangayController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:api');
    }

    public function index()
    {
        return Barangay::leftJoin('users', 'barangays.user_id', '=', 'users.id')
            ->select('barangays.*')
            ->where('users.id', Auth::user()->id)
            ->get();
    }

    public function update(Request $request, $id)
    {
        $barangay = Barangay::findOrFail($id);
        $barangay->update($request->all());
    }
}