<?php
Route::get('/', function () {
    return view('/auth/login');
});
Auth::routes();
Route::get('{path}',"HomeController@index")->where( 'path', '([A-z\d-\/_.]+)?' );