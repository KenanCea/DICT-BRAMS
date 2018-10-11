<?php
Route::get('/', function () {
    return view('/auth/login');
});
Route::get('{path}',"HomeController@index")->where( 'path', '([A-z\d-\/_.]+)?' );
Auth::routes();