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

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

Route::group(['prefix' => 'admin', 'middleware' => 'admin'], function () {
    Route::get('/dashboard','DashboardController@index');
    Route::resource('subjects','SubjectController');
//    Route::resource('countries','CountryController');
    Route::resource('divisions','DivisionController');
    Route::resource('cities','CityController');
    Route::get('getData','CountryController@getData');
    Route::get('/countries','CountryController@index');
    Route::POST('/countries/store','CountryController@store');
    Route::POST('/countries/update','CountryController@update');
    Route::POST('/countries/delete','CountryController@destroy');

});