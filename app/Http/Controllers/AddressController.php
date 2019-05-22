<?php

namespace App\Http\Controllers;

use DB;
use Auth;

class AddressController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:api');
    }

    public function index()
    {
        return DB::table('barangays')
            ->leftJoin('users', 'barangays.user_id', '=', 'users.id')
            ->select(
                'barangays.province',
                'barangays.municipality',
                'users.name'
            )
            ->where('users.id', Auth::user()->id)
            ->get();
    }
}
