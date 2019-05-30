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
        $users = new User();
        $users->name=request('name');
        $users->email=request('email');
        $users->password=bcrypt("password");
        $users->roles=request('roles');
        $users->logo='profile.png';
        $users->email_verified_at=now();
        $users->remember_token=str_random(10);
        $users->created_at=now();
        $users->updated_at=now();
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
        $account = User::findOrFail($id);
        $account->password = bcrypt("password");
        $account -> save();

    }
}
