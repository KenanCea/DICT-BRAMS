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

// Profile
Route::put('/user', 'LoggedUserController@update');

// Household
Route::resources(['household' => 'HouseholdController', 
'inhabitant' => 'InhabitantController']);

// Inhabitant
Route::post('inhabitant/archived/{id}', 'InhabitantController@archive');
Route::get('inhabitant/archived', 'InhabitantController@archived_list');

// Print Document
Route::get('registeredVoters', 'PrintDocumentController@listRegisteredVoters');
Route::get('listOfProspectiveSkVoters', 'PrintDocumentController@ProspectiveSkVoters');
Route::get('listOfSeniorCitizens', 'PrintDocumentController@SeniorCitizens');
Route::get('childrenWithConflicts', 'PrintDocumentController@Conflicts');
Route::get('listOfOutOfSchoolYouth7_14', 'PrintDocumentController@OutOfSchool7_14');
Route::get('listOfOutOfSchoolYouth15_25', 'PrintDocumentController@OutOfSchool15_25');