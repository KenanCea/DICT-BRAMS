<?php

namespace App\Http\Controllers;

use DB;
use Auth;
use Illuminate\Http\Request;
use App\BarangayCertificate;
use App\BarangayClearance;
use App\BusinessClearance;
use App\Filedcase;

class FormController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:api');
    }

    public function index()
    {
        return DB::table('inhabitants')
            ->leftJoin('households', 'inhabitants.household_id', '=', 'households.id')
            ->leftJoin('users', 'households.user_id', '=', 'users.id')
            ->select(
                'inhabitants.first_name',
                'inhabitants.middle_name',
                'inhabitants.last_name',
                'inhabitants.citizenship',
                'inhabitants.placeOfBirth_native',
                'households.house_no',
                'households.purok',
                'households.street',
                'households.barangay',
                DB::raw("YEAR(CURDATE()) - YEAR(inhabitants.date_of_birth) - IF(STR_TO_DATE(CONCAT(YEAR(CURDATE()),
                '-',
                MONTH(inhabitants.date_of_birth),
                 '-',
                DAY(inhabitants.date_of_birth)),
                '%Y-%c-%e') > CURDATE(),
                1,
                0) as age")
            )
            ->where('users.id', Auth::user()->id)
            ->get();
    }
    public function Officials()
    {
        return DB::table('officials')
            ->leftJoin('users', 'officials.user_id', '=', 'users.id')
            ->select('officials.name')
            ->where('users.id', Auth::user()->id)
            ->orderby('officials.position')
            ->get();
    }

    public function showBarangayClearance($id)
    {
        return BarangayClearance::where('inhabitant_id', '=', $id)->latest()->get();
    }
    public function showBarangayCertificate($id)
    {
        return BarangayCertificate::where('inhabitant_id', '=', $id)->latest()->get();
    }
    public function showBusinessClearance($id)
    {
        return BusinessClearance::where('inhabitant_id', '=', $id)->latest()->get();
    }
    public function showFiledCases($id)
    {
        return Filedcase::where('inhabitant_id', '=', $id)->latest()->get();
    }
    
    public function getUnregisteredBarangayClearance()
    {
        return BarangayClearance::whereNull('barangay_clearances.inhabitant_id')
        ->where('user_id',  Auth::user()->id)
        ->latest()
        ->get();
    }
    public function getUnregisteredBarangayCertificate()
    {
        return BarangayCertificate::whereNull('barangay_certificates.inhabitant_id')
        ->where('user_id',  Auth::user()->id)
        ->latest()
        ->get();
    }
    public function getUnregisteredBusinessClearance()
    {
        return BusinessClearance::whereNull('business_clearances.inhabitant_id')
        ->where('user_id',  Auth::user()->id)
        ->latest()
        ->get();
    }
    public function getUnregisteredFiledCases()
    {
        return Filedcase::whereNull('filedcases.inhabitant_id')
        ->where('user_id',  Auth::user()->id)
        ->latest()
        ->get();
    }
    public function createBarangayClearance(Request $request)
    {
        $form = $request->user()->barangayClearance()->create($request->all());
        return new $form;
    }
    public function createBarangayCertificate(Request $request)
    {
        $form = $request->user()->barangayCertificate()->create($request->all());
        return new $form;
    }
    public function createBusinessClearance(Request $request)
    {
        $form = $request->user()->businessClearance()->create($request->all());
        return new $form;
    }
    public function createFiledCases(Request $request)
    {
        $form = $request->user()->filedCase()->create($request->all());
        return new $form;
    }
}
