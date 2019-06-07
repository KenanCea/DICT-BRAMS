<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use DB;

use Mail;

class BarangayUserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return User::select('*')
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
        
        
        $data = [
            'email' => $users->email,
            'password' => $password,
            'token' => $users->remember_token
        ];

        Mail::send('mailVerification',$data,function($message) use ($users){
            $message->to($users->email)->subject('brams');
        });

        $users->save();
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
        $account = User::findOrFail($id);
        $account->disable = !$account->disable;
        $account -> save();
    }

    public function archive($id)
    {
        $account = User::findOrFail($id);
        $account->delete();
    }

    public function restore($id)
    {
        $account = User::withTrashed()->findOrFail($id)->restore();
    }

    public function resetPassword($id)
    {

        


        $password = str_random(8);
        $account = User::findOrFail($id);
        $account->password = bcrypt($password);

        $data = [
            'email' => $account->email,
            'password' => $password,
        ];

        Mail::send('passwordReset',$data,function($message) use ($account){
            $message->to($account->email)->subject('password reset');
        });

        $account -> save();
    }

    public function userActivation($token){
        $check = DB::table('users')->where('remember_token',$token)->first();    
        $check->update(['email_verified_at' => now()]);
        return redirect()->to('login')->with('success','User activated');
    }

    public function archived_Users()
    {
        return DB::table('users')
            ->select('*')
            ->whereNotNull('deleted_at')
            ->get();
    }
}
