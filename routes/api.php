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
    'barangay' => 'BarangayUserController',
    'barangayForm' => 'BarangayController',
    'official' => 'OfficialController',
    'landForm' => 'LandFormController', 
    'landUse' => 'LandUseController', 
    'householdDistribution' => 'HouseholdDistributionController'
]);
Route::get('profile', 'UserController@profile');
Route::put('updateProfile', 'UserController@updateProfile');


//Barangay users
Route::post('barangay/disable/{id}', 'BarangayUserController@disableUser');
Route::post('barangay/archived/{id}', 'BarangayUserController@archive');
Route::post('barangay/restore/{id}', 'BarangayUserController@restore');
Route::post('barangay/reset/{id}', 'BarangayUserController@resetPassword');
Route::get('archivedUsers', 'BarangayUserController@archived_Users');
Route::post('user/activation/{token}','BarangayUserController@userActivation');

//inhabitants
Route::post('inhabitants/archived/{id}', 'InhabitantController@archive');
Route::post('inhabitants/restore/{id}/{houseID}', 'InhabitantController@restore');
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
Route::get('officials', 'FormController@Officials');

// Dashboard
Route::get('Inhabitants', 'DashboardController@TotalInhabitants');
Route::get('Households', 'DashboardController@TotalHouseholds');
Route::get('Puroks', 'DashboardController@TotalPuroks');
Route::get('Seniors', 'DashboardController@TotalSeniors');
Route::get('Children', 'DashboardController@TotalChildren');
Route::get('HouseholdsPurok', 'DashboardController@TotalHouseholdsPurok');
Route::get('RegisteredVoter', 'DashboardController@TotalRegisteredVoters');
Route::get('Dialects', 'DashboardController@TotalDialects');
Route::get('Gender', 'DashboardController@TotalGender');
Route::get('Religion', 'DashboardController@TotalReligion');
Route::get('EthnicGroup', 'DashboardController@TotalEthnicGroups');

// Address
Route::get('address', 'AddressController@index')->name('address.index');

// Kiosk
Route::get('ageGroup', 'KioskController@AgeGroup');
Route::get('barangayInfo', 'KioskController@BarangayInfo');
Route::get('householdsInfo', 'KioskController@HouseholdsInfo');
Route::get('civilStatus', 'KioskController@CivilStatus');
Route::get('ethnicGroup', 'KioskController@EthnicGroup');

//Admin Dashboard
Route::get('Barangay', 'DashboardController@TotalBarangay');
Route::get('InhabitantPop', 'DashboardController@TotalCityInhabitants');
Route::get('HouseholdPop', 'DashboardController@TotalCityHouseholds');
Route::get('TotalPopBarangay', 'DashboardController@TotalBarangayPopulous');
Route::get('AllBarangay', 'DashboardController@ListAllBarangay');

//Barangay Summary
Route::get('BrgyCaptain','BarangaySummaryController@PunongBarangay');
Route::get('BrgySecretary', 'BarangaySummaryController@BarangaySecretary');
Route::get('Seniors', 'BarangaySummaryController@TotalSeniors');
Route::get('LandArea', 'BarangaySummaryController@TotalLandArea');
Route::get('Male', 'BarangaySummaryController@TotalMale');
Route::get('Female', 'BarangaySummaryController@TotalFemale');
Route::get('StatusResidency', 'BarangaySummaryController@TotalPermanentInhabitants');
Route::get('RegVoter', 'BarangaySummaryController@TotalRegisteredVoters');
Route::get('Children', 'BarangaySummaryController@TotalChildren');
Route::get('OutOfSchool', 'BarangaySummaryController@TotalOutOfSchoolYouth');
Route::get('SoloParent', 'BarangaySummaryController@TotalSoloParent');