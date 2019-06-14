<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use App\activitylogs;
use Illuminate\Support\Facades\Auth;

class LogsController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:api');
    }
    public function Logs(){
        return activitylogs::select(
            DB::raw("date(created_at) as date"),
            DB::raw("time(created_at) as time"),
        'log')
        ->where('user_id',Auth::user()->id)
        ->get();
    }
}
