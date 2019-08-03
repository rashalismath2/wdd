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


Route::group(['prefix' => 'admin'], function () {
    Route::post('user','AdminController@createuser');
    Route::get('query','AdminController@getuser');
    Route::post('deleteuser','AdminController@deleteuser');
    Route::get('getlecturer','AdminController@getlecturer');
    Route::post('getbatches','BatchController@getbatchespost');
    Route::post('getbatchesforreports','BatchController@getbatchesforreports');
    Route::post('getbatchreport','BatchController@getbatchreport');
    Route::post('getdepartmentreport','BatchController@getdepartmentreport');
    Route::get('getdepartments','BatchController@getdepartmentsget');
    Route::post('savedata','BatchController@savedata');
    Route::post('savedepartmentdata','BatchController@savedepartmentdata');
    Route::post('savelecturerdata','AdminController@savelecturerdata');

    Route::post('getscheduleforlecturer','AdminController@getscheduleforlecturer');
   
    Route::post('bookhall','AdminController@bookhall');
    Route::post('edithall','AdminController@edithall');
    Route::post('getdata','getData@index')->name('seeschedule');
    Route::get('clearschedule','AdminController@clearschedule');
});
 
Route::group(['prefix' => 'operator'], function () {
    Route::post('user','AdminController@createuser');
    Route::get('query','AdminController@getuser');
    Route::get('getlecturer','AdminController@getlecturer');
    Route::post('getBatches','BatchController@getBatches');
    Route::post('bookhall','AdminController@bookhall');
    Route::post('edithall','AdminController@edithall');
    Route::post('getdata','getData@index');
});
 
Route::group(['prefix' => 'lecturer'], function () {
    Route::post('getdata','Lecturer\getData@index');
});

// Route::prefix('user')->group(function(){
//     // Route::get('login','Auth\LoginController@show');
// });