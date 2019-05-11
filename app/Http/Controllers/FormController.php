<?php

namespace App\Http\Controllers;

use DB;
use Auth;

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
<<<<<<< HEAD
<<<<<<< HEAD
<<<<<<< HEAD
<<<<<<< HEAD
            ->leftJoin('users', 'households.user_id', '=', 'users.id')
=======
            ->leftJoin('users','households.user_id','=','users.id')
>>>>>>> c23e70b3992b1b81ab0a08ad3ead82358b36d6fe
=======
            ->leftJoin('users','households.user_id','=','users.id')
>>>>>>> parent of a43aa4b... added dashboard and fix Barangay Clearance
=======
            ->leftJoin('users','households.user_id','=','users.id')
>>>>>>> parent of a43aa4b... added dashboard and fix Barangay Clearance
=======
            ->leftJoin('users','households.user_id','=','users.id')
>>>>>>> parent of a43aa4b... added dashboard and fix Barangay Clearance
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
<<<<<<< HEAD
<<<<<<< HEAD
<<<<<<< HEAD
<<<<<<< HEAD
0) as age")
            )
            ->where('users.id', Auth::user()->id)
=======
0) as age"),
            )
            ->where('users.id',Auth::user()->id)
>>>>>>> c23e70b3992b1b81ab0a08ad3ead82358b36d6fe
=======
0) as age"),
            )
            ->where('users.id',Auth::user()->id)
>>>>>>> parent of a43aa4b... added dashboard and fix Barangay Clearance
=======
0) as age"),
            )
            ->where('users.id',Auth::user()->id)
>>>>>>> parent of a43aa4b... added dashboard and fix Barangay Clearance
=======
0) as age"),
            )
            ->where('users.id',Auth::user()->id)
>>>>>>> parent of a43aa4b... added dashboard and fix Barangay Clearance
            ->get();
    }
}
