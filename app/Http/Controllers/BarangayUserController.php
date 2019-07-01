<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\User;
use DB;
use App\activitylogs;
use App\Barangay;

use Mail;

class BarangayUserController extends Controller
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
    
    public function index()
    {
        return User::select('*',DB::raw('case when disable = 0 then "enabled" else "disabled" end as state'))
        ->where('roles','user')
        ->get();
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $password=str_random(8);
        $users = new User();
        $users->name=request('name');
        $users->email=request('email');
        $users->password=bcrypt($password);
        $users->roles='user';
        $users->remember_token=str_random(60);
        $users->logo='profile.png';
        $users->created_at=now();
        $users->updated_at=now();
        
        if($users -> save()){
            $data = [
                'email' => $users->email,
                'password' => $password,
                'token' => $users->remember_token
            ];
                
            Mail::send('mailVerification',$data,function($message) use ($users){
                $message->to($users->email)->subject('brams');
            });

            $users->save();
        }else{}



        //Barangay Details
        $barangay = new Barangay();
        $barangay->user_id=$users->id;
        $barangay->municipality=request('municipality');
        $barangay->province=request('province');
        $barangay->region=request('region');
        $barangay->zip_code=request('zip_code');
        $barangay->type_barangay=request('type_barangay');
        $barangay->save();

        //start of log
        $logs= new activitylogs;
        $logs->log="Created new accounct " .$users->name;
        $logs->user_id=Auth::user()->id;
        $logs->save();
        //end of log
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

    public function disableUser($id)
    {   
        $account = User::whereNotNull('email_verified_at')->findOrFail($id);
        $account->disable = !$account->disable;
        $account -> save();

        //start of log
        $logs= new activitylogs;
        if($account->disable==0){
            $logs->log="account ".$account->name." has been enabled";
        }
        else{
            $logs->log="account ".$account->name." has been disabled";
        }
        $logs->user_id=Auth::user()->id;
        $logs->save();
        //end of log
    }

    public function archive($id)
    {
        $account = User::findOrFail($id);

        //start of log
        $logs= new activitylogs;
        $logs->log="Archived accounct " .$account->name;
        $logs->user_id=Auth::user()->id;
        $logs->save();
        //end of log

        $account->delete();
    }

    public function restore($id)
    {
        $account = User::withTrashed()->findOrFail($id)->restore();

        $name=User::findOrFail($id);
        //start of log
        $logs= new activitylogs;
        $logs->log="Restore accounct " .$name->name;
        $logs->user_id=Auth::user()->id;
        $logs->save();
        //end of log
    }

    public function resetPassword($id)
    {
        $password = str_random(8);
        $account = User::findOrFail($id);
        $account->password = bcrypt($password);
        if($account -> save()){
            $data = [
                'email' => $account->email,
                'password' => $password,
            ];

            Mail::send('passwordReset',$data,function($message) use ($account){
                $message->to($account->email)->subject('password reset');
            });
            $account -> save();
        }else{}

        //start of log
        $logs= new activitylogs;
        $logs->log="Reset Password of " .$account->name;
        $logs->user_id=Auth::user()->id;
        $logs->save();
        //end of log
    }

    public function archived_Users()
    {
        return DB::table('users')
            ->select('*')
            ->whereNotNull('deleted_at')
            ->get();
    }
}
