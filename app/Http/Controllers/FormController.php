<?php

namespace App\Http\Controllers;

use DB;
use Auth;
use Illuminate\Http\Request;
use App\BarangayCertificate;
use App\BarangayClearance;
use App\BusinessClearance;

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

    public function createBarangayClearance(Request $request)
    {
        $request->validate([
            'control_no' => 'required',
            'ctc_no' => 'required',
            'purpose_of_clearance' => 'required',
            'official_receipt_no' => 'required',
        ]);
        $form = BarangayClearance::create($request->all());
        return new $form;
    }
    public function createBarangayCertificate(Request $request)
    {
        $request->validate([
            'control_no' => 'required',
            'purpose_certification' => 'required',
            'ctc_no' => 'required',
            'official_receipt_no' => 'required',
            'amount_paid' => 'required',
        ]);
        $form = BarangayCertificate::create($request->all());
        return new $form;
    }
    public function createBusinessClearance(Request $request)
    {
        $form = BusinessClearance::create($request->all());
        return new $form;
    }
}
