<?php

namespace App\Http\Controllers;

use App\Education;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use DB;

class EducationController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:api');
    }

    public function index()
    {
        return DB::table('education')
            ->leftJoin('users','education.barangay_id','=','users.id')
            ->select('education.*')
            ->where('users.id', Auth::user()->id)
            ->get();
    }

    public function Education()
    {
        //Pre-school
        $query = Education::leftJoin('users','education.barangay_id','=','users.id')
        ->selectRaw('"Pre-school" as "education_type", no_pre_school_building as "education_number"', [Auth::user()->id]
        )
        ->where('users.id',Auth::user()->id);
        //Primary
        $querytwo = Education::leftJoin('users','education.barangay_id','=','users.id')
        ->selectRaw('"Primary" as "education_type", no_primary_building as "education_number"', [Auth::user()->id]
        )
        ->where('users.id',Auth::user()->id);
        //Secondary
        $querythree = Education::leftJoin('users','education.barangay_id','=','users.id')
        ->selectRaw('"Secondary" as "education_type", no_secondary_building as "education_number"', [Auth::user()->id]
        )
        ->where('users.id',Auth::user()->id);
        //Vocational
        $queryfour = Education::leftJoin('users','education.barangay_id','=','users.id')
        ->selectRaw('"Vocational" as "education_type", no_vocational_building as "education_number"', [Auth::user()->id]
        )
        ->where('users.id',Auth::user()->id);
        //College
        $queryfive = Education::leftJoin('users','education.barangay_id','=','users.id')
        ->selectRaw('"College" as "education_type", no_college_building as "education_number"', [Auth::user()->id]
        )
        ->where('users.id',Auth::user()->id);
        //Post-graduate
        $querysix = Education::leftJoin('users','education.barangay_id','=','users.id')
        ->selectRaw('"Post-graduate" as "education_type", no_post_graduate_building as "education_number"', [Auth::user()->id]
        )
        ->where('users.id',Auth::user()->id);
        $query->union($querytwo)->union($querythree)->union($queryfour)->union($queryfive)->union($querysix);

        $query=$query->get();
        return $query;
    }

    public function Sport()
    {
        //Covered Court
        $query = Education::leftJoin('users','education.barangay_id','=','users.id')
        ->selectRaw('"Covered Court" as "sport_type", no_covered_courts as "sport_number"', [Auth::user()->id]
        )
        ->where('users.id',Auth::user()->id);
        //Gymnasium
        $querytwo = Education::leftJoin('users','education.barangay_id','=','users.id')
        ->selectRaw('"Gymnasium" as "sport_type", no_gymnasiums as "sport_number"', [Auth::user()->id]
        )
        ->where('users.id',Auth::user()->id);
        //Park/Plaza
        $querythree = Education::leftJoin('users','education.barangay_id','=','users.id')
        ->selectRaw('"Park/Plaza" as "sport_type", no_parks_plaza as "sport_number"', [Auth::user()->id]
        )
        ->where('users.id',Auth::user()->id);
        //Other sports facilities
        $queryfour = Education::leftJoin('users','education.barangay_id','=','users.id')
        ->selectRaw('"Other sport facilities" as "sport_type", others_sport_facilities as "sport_number"', [Auth::user()->id]
        )
        ->where('users.id',Auth::user()->id);
        //Recreational activities
        $queryfive = Education::leftJoin('users','education.barangay_id','=','users.id')
        ->selectRaw('"Recreational activities" as "sport_type", recreational_activities as "sport_number"', [Auth::user()->id]
        )
        ->where('users.id',Auth::user()->id);
        //Total facilities
        $querysix = Education::leftJoin('users','education.barangay_id','=','users.id')
        ->selectRaw('"Total facilities" as "sport_type", total_facilities as "sport_number"', [Auth::user()->id]
        )
        ->where('users.id',Auth::user()->id);
        $query->union($querytwo)->union($querythree)->union($queryfour)->union($queryfive)->union($querysix);

        $query=$query->get();
        return $query;
    }

    public function updateEducation(Request $request, $id)
    {
        $education = Education::findOrFail($id);
        $education->update($request->all());

        $name=User::findOrFail(Auth::user()->id);
        $logs= new activitylogs;
        $logs->log="Updated Education Table, ".$name->name;
        $logs->user_id=Auth::user()->id;
        $logs->save();
    }

    public function updateSport(Request $request, $id)
    {
        $sport = Education::findOrFail($id);
        $sport->update($request->all());

        $name=User::findOrFail(Auth::user()->id);
        $logs= new activitylogs;
        $logs->log="Updated Sport Table, ".$name->name;
        $logs->user_id=Auth::user()->id;
        $logs->save();
    }
}
