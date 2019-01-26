<?php

use Illuminate\Http\Request;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
 */

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});
Route::post('member/archived/{id}', 'API\MemberController@archive');
Route::get('member/archived', 'API\MemberController@archived_list');
Route::resources(['user' => 'API\UserController', 
                'member' => 'API\MemberController',
                'profile' => 'API\ProfileController']);
Route::put('profile', 'API\ProfileController@update');
Route::post('Inhabitants', 'API\DashboardController@TotalInhabitant');
Route::post('Households', 'API\DashboardController@TotalHouseholds');
Route::get('Purok', 'API\DashboardController@TotalPurok');