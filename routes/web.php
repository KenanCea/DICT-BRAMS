<?php
/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/
use App\User;
use App\activitylogs;
Route::get('user/activation/{token}', function ($token) {
	$check = User::where('remember_token',$token)->first();
        if(!is_null($check)){
            if(is_null($check->email_verified_at)){
                $check->email_verified_at=now();
                $check->save();

                //start of log
                $logs= new activitylogs;
                $logs->log=$check->name." has been activated";
                $logs->user_id=$check->id;
                $logs->save();
                //end of log

                return redirect()->to('login')->with('success','User activated');
            }
            return redirect()->to('login')->with('success','User already activated');
        }
        return redirect()->to('login')->with('warning','your token is invalid');
});


Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/{any}', 'SpaController@index')->where('any', '.*');
