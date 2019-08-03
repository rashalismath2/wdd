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




Route::prefix('admin')->group(function(){
    Route::get('login','Auth\AdminLoginController@index')->middleware('loginNavigate')->name('admin-login-show');
    Route::post('login','Auth\AdminLoginController@login')->name('admin-login');
    Route::get('/','AdminController@index')->name('admin-dashboard');
    Route::get('/logout','Auth\AdminLoginController@logout')->name('admin-logout');
    Route::get('/getsavedata','BatchController@getsavedata');
    Route::get('/getdepartmentsavedata','BatchController@getdepartmentsavedata');
    Route::post('/getsavedlecturerdata','AdminController@getsavedlecturerdata');

});

Route::prefix('operator')->group(function(){
    Route::get('login','Auth\OperatorLoginController@index')->middleware('loginNavigate')->name('operator-login-show');
    Route::post('login','Auth\OperatorLoginController@login')->name('operator-login');
    Route::get('/','OperatorController@index')->name('operator-dashboard');
    Route::get('/logout','Auth\OperatorLoginController@logout')->name('operator-logout');
    Route::get('/getsavedata','BatchController@getsavedata');

});


Route::prefix('lecturer')->group(function(){
  
    Route::get('login','Auth\LecturerLoginController@index')->middleware('loginNavigate')->name('lecturer-login-show');
    Route::post('login','Auth\LecturerLoginController@login')->name('lecturer-login');
    Route::get('/','LecturerController@index')->name('lecturer-dashboard');
    Route::get('/logout','Auth\LecturerLoginController@logout')->name('lecturer-logout');
    
});



// Route::get('{any}', function () { 
//     return view('welcome');
// })->middleware('loginNavigate')->name('login-navigate')->where('any','.*');

Route::get('/admin/{any}','AdminController@index')->where('any','.*');
Route::get('/operator/{any}','OperatorController@index')->where('any','.*');
Route::get('/lecturer/{any}','OperatorController@index')->where('any','.*');
// Route::get('/admin/allocate/floor/1','AdminController@index');



Route::get('/', function () { 
    return view('welcome');
})->middleware('loginNavigate')->name('login-navigate');
