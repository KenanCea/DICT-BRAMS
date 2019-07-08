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
    public function barangay()
    {
        return Barangay::where("user_id", "=", Auth::user()->id)->first();
    }
}
