<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Inhabitant;
use DB;

class KioskController extends Controller
{
    public function listRegisteredVoters()
    {
        //$agerange=array(array(1,4),array(5,9),array(10,14),array(15,19),array(20,24),
        //array(25,29),array(30,34),array(35,39),array(40,44),array(45,49),array(50,54),
        //array(55,59),array(60,64),array(65,69),array(70,74),array(75,79))

        //$query = Inhabitant::leftJoin('users','users.id','=','inhabitants.user_id')
        //->select(DB::raw('count(*) as male'))

        //for($ctr = 0; $ctr <= $array; $ctr++){
        //    ->union()
        //}
    }
}
