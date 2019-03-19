<?php

use Illuminate\Http\Request;

Route::get('/', function () {
    return view('/auth/login');
});
Auth::routes();
Route::get('{path}',"HomeController@index")->where( 'path', '([A-z\d-\/_.]+)?' );

Route::post('/upload',function(Request $request){

    $uploadedFiles=$request->pics;

    foreach ($uploadedFiles as $file){
        $file->store('Documents');

    }
    return response(['status'=>'success'],200);

});

Route::get('/home', 'HomeController@index')->name('home');

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
