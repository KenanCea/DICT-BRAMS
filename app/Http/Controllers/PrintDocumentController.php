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
        ->leftJoin('users','users.id','=','inhabitants.user_id')
        ->join('households','inhabitants.household_id','=','households.id')
        ->join('barangays','barangays.id','=','users.id')
        ->select(DB::raw('CONCAT(inhabitants.last_name,", ", inhabitants.first_name," ",inhabitants.middle_name) AS fullname'),
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
        DB::raw('CONCAT(households.house_no," purok ",households.purok," ",households.street,", ",barangays.name) AS address'),
        'inhabitants.citizenship')
        ->where('inhabitants.registeredVoterOfTheBrgy','yes')
        ->Where('inhabitants.archive',0)
        ->where('users.id',Auth::user()->id)
        ->get();
    }


    public function ProspectiveSkVoters(){
        return DB::table('inhabitants')
        ->leftJoin('users','users.id','=','inhabitants.user_id')
        ->join('households','inhabitants.household_id','=','households.id')
        ->join('barangays','barangays.id','=','users.id')
        ->select(DB::raw('CONCAT(inhabitants.last_name,", ", inhabitants.first_name," ",inhabitants.middle_name) AS fullname'),
        
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
        DB::raw('CONCAT(households.house_no," purok ",households.purok," ",households.street,", ",barangays.name) AS address'),
        'inhabitants.status_of_residency')
        ->where('users.id',Auth::user()->id)
        ->Where('inhabitants.archive',0)
        ->having('age','>=','15')
        ->having('age','<=','17')
        ->get();
    }



    public function SeniorCitizens(){
        return DB::table('inhabitants')
        ->leftJoin('users','users.id','=','inhabitants.user_id')
        ->join('households','inhabitants.household_id','=','households.id')
        ->join('barangays','barangays.id','=','users.id')
        ->select(DB::raw('CONCAT(inhabitants.last_name,", ", inhabitants.first_name," ",inhabitants.middle_name) AS fullname'),
        
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
        DB::raw('CONCAT(households.house_no," purok ",households.purok," ",households.street,", ",barangays.name) AS address'),
        'inhabitants.religion',
        'inhabitants.citizenship'
        )
        ->where('users.id',Auth::user()->id)
        ->Where('inhabitants.archive',0)
        ->having('age','>=','60')
        ->get();
    }


    public function Conflicts(){
        return DB::table('inhabitants')
        ->leftJoin('users','users.id','=','inhabitants.user_id')
        ->join('households','inhabitants.household_id','=','households.id')
        ->join('barangays','barangays.id','=','users.id')
        ->join('filedcases','filedcases.inhabitant_id','=','inhabitants.id')
        ->select(DB::raw('CONCAT(inhabitants.last_name,", ", inhabitants.first_name," ",inhabitants.middle_name) AS fullname'),
        
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
        DB::raw('CONCAT(households.house_no," purok ",households.purok," ",households.street,", ",barangays.name) AS address'),
        'filedcases.case',
        'filedcases.date_filed',
        'filedcases.remarks'
        )
        ->where('users.id',Auth::user()->id)
        ->Where('inhabitants.archive',0)
        ->having('age','>=','9')
        ->having('age','<=','14')
        ->get();
    }

    public function OutOfSchool7_14(){
        return DB::table('inhabitants')
        ->leftJoin('users','users.id','=','inhabitants.user_id')
        ->join('households','inhabitants.household_id','=','households.id')
        ->join('barangays','barangays.id','=','users.id')
        ->select(DB::raw('CONCAT(inhabitants.last_name,", ", inhabitants.first_name," ",inhabitants.middle_name) AS fullname'),
        
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
        DB::raw('CONCAT(households.house_no," purok ",households.purok," ",households.street,", ",barangays.name) AS address'),
        'inhabitants.highest_educational_attainment'
        )
        ->where('users.id',Auth::user()->id)
        ->Where('inhabitants.archive',0)
        ->where('highest_educational_attainment','like','%undergraduat%')
        ->having('age','>=','7')
        ->having('age','<=','14')
        ->get();
    }

    public function OutOfSchool15_25(){
        return DB::table('inhabitants')
        ->leftJoin('users','users.id','=','inhabitants.user_id')
        ->join('households','inhabitants.household_id','=','households.id')
        ->join('barangays','barangays.id','=','users.id')
        ->select(DB::raw('CONCAT(inhabitants.last_name,", ", inhabitants.first_name," ",inhabitants.middle_name) AS fullname'),
        
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
        DB::raw('CONCAT(households.house_no," purok ",households.purok," ",households.street,", ",barangays.name) AS address'),
        'inhabitants.highest_educational_attainment',
        DB::raw('ifnull(inhabitants.gen_job_description,"none") as gen_job_description')
        )
        ->where('users.id',Auth::user()->id)
        ->Where('inhabitants.archive',0)
        ->where('highest_educational_attainment','like','%undergraduat%')
        ->having('age','>=','15')
        ->having('age','<=','25')
        ->get();
    }

    public function monthlyMonitoring(){
        return DB::table('inhabitants')
        ->leftJoin('users','users.id','=','inhabitants.user_id')
        ->select('inhabitants.childs_parent_guardian',
        DB::raw('CONCAT(inhabitants.last_name,", ", inhabitants.first_name," ",inhabitants.middle_name) AS fullname'),
        'inhabitants.sex',
        'inhabitants.date_of_birth',
        //age
        'inhabitants.bcg',
        'inhabitants.dpi1',
        'inhabitants.dpi2',
        'inhabitants.dpi3',
        'inhabitants.opd3',
        'inhabitants.dpi3',
        'inhabitants.others1'
        )
        ->where('users.id',Auth::user()->id)
        ->Where('inhabitants.archive',0)
        ->get();
    }

    public function vitaminAMonitoring(){
        return DB::table('inhabitants')
        ->leftJoin('users','users.id','=','inhabitants.user_id')
        ->select('inhabitants.childs_parent_guardian',
        DB::raw('CONCAT(inhabitants.last_name,", ", inhabitants.first_name," ",inhabitants.middle_name) AS fullname'),
        'inhabitants.sex',
        'inhabitants.date_of_birth',
        //age
        'inhabitants.weight',
        'inhabitants.height',
        'inhabitants.received_vitaminA'
        )
        ->where('users.id',Auth::user()->id)
        ->Where('inhabitants.archive',0)
        ->get();
    }

    public function DewormMonitoring(){
        return DB::table('inhabitants')
        ->leftJoin('users','users.id','=','inhabitants.user_id')
        ->select('inhabitants.childs_parent_guardian',
        DB::raw('CONCAT(inhabitants.last_name,", ", inhabitants.first_name," ",inhabitants.middle_name) AS fullname'),
        'inhabitants.sex',
        'inhabitants.date_of_birth',
        //age
        'inhabitants.weight',
        'inhabitants.height',
        'inhabitants.dewormed'
        )
        ->where('users.id',Auth::user()->id)
        ->Where('inhabitants.archive',0)
        ->get();
    }

    public function QuarterlyMonitoring(){
        return DB::table('inhabitants')
        ->leftJoin('users','users.id','=','inhabitants.user_id')
        ->select('inhabitants.childs_parent_guardian',
        DB::raw('CONCAT(inhabitants.last_name,", ", inhabitants.first_name," ",inhabitants.middle_name) AS fullname'),
        'inhabitants.sex',
        'inhabitants.date_of_birth',
        //age
        'inhabitants.weight',
        'inhabitants.height',
        'inhabitants.date_measured_height_weight'
        )
        ->where('users.id',Auth::user()->id)
        ->Where('inhabitants.archive',0)
        ->get();
    }

    public function location()
    {
        return DB::table('barangays')
        ->leftJoin('users','users.id','=','barangays.id' )
        ->select('barangays.name',  
        'barangays.province',
        'barangays.region')
        ->where('users.id',Auth::user()->id)
        ->get();
    }

}
