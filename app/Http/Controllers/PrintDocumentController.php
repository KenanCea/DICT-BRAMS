<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use Auth;

class PrintDocumentController extends Controller
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

    public function listRegisteredVoters()
    {
        return DB::table('inhabitants')
        ->leftJoin('households','inhabitants.household_id','=','households.id')
        ->leftJoin('users','households.user_id','=','users.id')
        ->select(DB::raw('CONCAT(inhabitants.last_name," ", inhabitants.first_name," ",inhabitants.middle_name) AS fullname'),
        
        DB::raw("YEAR(CURDATE()) - YEAR(inhabitants.date_of_birth) - IF(STR_TO_DATE(CONCAT(YEAR(CURDATE()),
                        '-',
                        MONTH(inhabitants.date_of_birth),
                        '-',
                        DAY(inhabitants.date_of_birth)),
                '%Y-%c-%e') > CURDATE(),
        1,
        0) as age"),

        'inhabitants.sex',
        'inhabitants.date_of_birth',
        'inhabitants.civil_status',
        'inhabitants.religion',
        'inhabitants.citizenship')
        ->where('inhabitants.registered_voter','yes')
        ->where('users.id',Auth::user()->id)
        ->get();
    }


    public function ProspectiveSkVoters(){
        return DB::table('inhabitants')
        ->leftJoin('households','inhabitants.household_id','=','households.id')
        ->leftJoin('users','households.user_id','=','users.id')
        ->select(DB::raw('CONCAT(inhabitants.last_name," ", inhabitants.first_name," ",inhabitants.middle_name) AS fullname'),
        
        DB::raw("YEAR(CURDATE()) - YEAR(inhabitants.date_of_birth) - IF(STR_TO_DATE(CONCAT(YEAR(CURDATE()),
                        '-',
                        MONTH(inhabitants.date_of_birth),
                        '-',
                        DAY(inhabitants.date_of_birth)),
                '%Y-%c-%e') > CURDATE(),
        1,
        0) as age"),

        'inhabitants.sex',
        'inhabitants.date_of_birth',
        'inhabitants.religion',
        'inhabitants.citizenship',
        'inhabitants.status_of_residency')
        ->where('users.id',Auth::user()->id)
        ->having('age','>=','15')
        ->having('age','<=','17')
        ->get();
    }



    public function SeniorCitizens(){
        return DB::table('inhabitants')
        ->leftJoin('households','inhabitants.household_id','=','households.id')
        ->leftJoin('users','households.user_id','=','users.id')
        ->select(DB::raw('CONCAT(inhabitants.last_name," ", inhabitants.first_name," ",inhabitants.middle_name) AS fullname'),
        
        DB::raw("YEAR(CURDATE()) - YEAR(inhabitants.date_of_birth) - IF(STR_TO_DATE(CONCAT(YEAR(CURDATE()),
                        '-',
                        MONTH(inhabitants.date_of_birth),
                        '-',
                        DAY(inhabitants.date_of_birth)),
                '%Y-%c-%e') > CURDATE(),
        1,
        0) as age"),

        'inhabitants.sex',
        'inhabitants.date_of_birth',
        'inhabitants.civil_status',
        'inhabitants.religion',
        'inhabitants.citizenship'
        )
        ->where('users.id',Auth::user()->id)
        ->having('age','>=','65')
        ->get();
    }


    public function Conflicts(){
        return DB::table('inhabitants')
        ->leftJoin('households','inhabitants.household_id','=','households.id')
        ->leftJoin('users','households.user_id','=','users.id')
        ->Join('filecases','inhabitants.id','=','filecases.id_serial_case_num')
        ->select(DB::raw('CONCAT(inhabitants.last_name," ", inhabitants.first_name," ",inhabitants.middle_name) AS fullname'),
        
        DB::raw("YEAR(CURDATE()) - YEAR(inhabitants.date_of_birth) - IF(STR_TO_DATE(CONCAT(YEAR(CURDATE()),
                        '-',
                        MONTH(inhabitants.date_of_birth),
                        '-',
                        DAY(inhabitants.date_of_birth)),
                '%Y-%c-%e') > CURDATE(),
        1,
        0) as age"),

        'inhabitants.date_of_birth',
        'inhabitants.sex',
        'inhabitants.citizenship',
        'filecases.respondent_case',
        'filecases.date_filed_case',
        'filecases.remarks_case'
        )
        ->where('users.id',Auth::user()->id)
        ->having('age','>=','9')
        ->having('age','<=','14')
        ->get();
    }

    public function OutOfSchool7_14(){
        return DB::table('inhabitants')
        ->leftJoin('households','inhabitants.household_id','=','households.id')
        ->leftJoin('users','households.user_id','=','users.id')
        ->select(DB::raw('CONCAT(inhabitants.last_name," ", inhabitants.first_name," ",inhabitants.middle_name) AS fullname'),
        
        DB::raw("YEAR(CURDATE()) - YEAR(inhabitants.date_of_birth) - IF(STR_TO_DATE(CONCAT(YEAR(CURDATE()),
                        '-',
                        MONTH(inhabitants.date_of_birth),
                        '-',
                        DAY(inhabitants.date_of_birth)),
                '%Y-%c-%e') > CURDATE(),
        1,
        0) as age"),

        'inhabitants.sex',
        'inhabitants.date_of_birth',
        'inhabitants.civil_status',
        'inhabitants.religion',
        'inhabitants.citizenship',
        /*,address,*/ 
        'inhabitants.highest_educ_attainment'
        )
        ->where('users.id',Auth::user()->id)
        ->where('highest_educ_attainment','like','%undergraduat%')
        ->having('age','>=','7')
        ->having('age','<=','14')
        ->get();
    }

    public function OutOfSchool15_25(){
        return DB::table('inhabitants')
        ->leftJoin('households','inhabitants.household_id','=','households.id')
        ->leftJoin('users','households.user_id','=','users.id')
        ->select(DB::raw('CONCAT(inhabitants.last_name," ", inhabitants.first_name," ",inhabitants.middle_name) AS fullname'),
        
        DB::raw("YEAR(CURDATE()) - YEAR(inhabitants.date_of_birth) - IF(STR_TO_DATE(CONCAT(YEAR(CURDATE()),
                        '-',
                        MONTH(inhabitants.date_of_birth),
                        '-',
                        DAY(inhabitants.date_of_birth)),
                '%Y-%c-%e') > CURDATE(),
        1,
        0) as age"),

        'inhabitants.sex',
        'inhabitants.date_of_birth',
        'inhabitants.civil_status',
        'inhabitants.religion',
        'inhabitants.citizenship',
        /*,address,*/ 
        'inhabitants.highest_educ_attainment'
        )
        ->where('users.id',Auth::user()->id)
        ->where('highest_educ_attainment','like','%undergraduat%')
        ->having('age','>=','15')
        ->having('age','<=','25')
        ->get();
    }

}
