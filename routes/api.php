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

// Route::middleware('auth:api')->get('/user', function (Request $request) {
//     return $request->user();
// });


Route::resources([
    'household' => 'HouseholdController',
    'inhabitant' => 'InhabitantController',
    'user' => 'UserController',
    'barangay' => 'BarangayUserController'
]);
Route::put('user', 'UserController@update');

//Barangay users
Route::post('barangay/disable/{id}', 'BarangayUserController@disableUser');
Route::post('barangay/archived/{id}', 'BarangayUserController@archive');
Route::post('barangay/restore/{id}', 'BarangayUserController@restore');

//inhabitants
Route::post('inhabitant/archived/{id}', 'InhabitantController@archive');
Route::post('inhabitant/restore/{id}', 'InhabitantController@restore');
Route::get('archivedInhabitant', 'InhabitantController@archived_Inhabitant');

//households
Route::post('households/archived/{id}', 'HouseholdController@archive');
Route::post('households/restore/{id}', 'HouseholdController@restore');
Route::post('createInhabitant/{id}', 'HouseholdController@create_Inhabitant');
Route::get('archivedHousehold', 'HouseholdController@archived_Household');

// Print Document
Route::get('monthlyMonitoring', 'PrintDocumentController@monthlyMonitoring');
Route::get('VitaminAMonitoring', 'PrintDocumentController@vitaminAMonitoring');
Route::get('DewormMonitoring', 'PrintDocumentController@DewormMonitoring');
Route::get('QuarterlyMonitoring', 'PrintDocumentController@QuarterlyMonitoring');
Route::get('registeredVoters', 'PrintDocumentController@listRegisteredVoters');
Route::get('listOfProspectiveSkVoters', 'PrintDocumentController@ProspectiveSkVoters');
Route::get('listOfSeniorCitizens', 'PrintDocumentController@SeniorCitizens');
Route::get('childrenWithConflicts', 'PrintDocumentController@Conflicts');
Route::get('listOfOutOfSchoolYouth7_14', 'PrintDocumentController@OutOfSchool7_14');
Route::get('listOfOutOfSchoolYouth15_25', 'PrintDocumentController@OutOfSchool15_25');
Route::get('header', 'PrintDocumentController@location');

// Forms
Route::get('form', 'FormController@index')->name('form.index');

// Dashboard
Route::post('Inhabitants', 'DashboardController@TotalInhabitants');
Route::post('Households', 'DashboardController@TotalHouseholds');
Route::post('Puroks', 'DashboardController@TotalPuroks');
Route::post('Seniors', 'DashboardController@TotalSeniors');
Route::post('Children', 'DashboardController@TotalChildren');

// Address
Route::get('address', 'AddressController@index')->name('address.index');
