<?php

use Illuminate\Support\Facades\Route;

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
})->name('welcome');

Route::get('/cache_clear', function () {
    $exitCode = Artisan::call('cache:clear');
});

Auth::routes(['register' => false]);

Route::get('change-password', 'Auth\ChangePasswordController@index')->name('change-password');;
Route::post('change-password', 'Auth\ChangePasswordController@store')->name('change.password');


Route::get('/home', 'HomeController@index')->name('home');

Route::group(['namespace' => 'Pqrs'], function () {
    Route::resource('pqrs', 'PqrsController');
    Route::resource('adminpqrs', 'AdminpqrsController');
    Route::get('adminpqrs.export', 'AdminpqrsController@export')->name('adminpqrs.export');
});

Route::group(['namespace' => 'Farmacoseguridad'], function () {
    Route::resource('farmacoseguridad', 'FarmacoseguridadController');

    Route::get('farmacoseguridad.export', 'FarmacoseguridadController@export')->name('farmacoseguridad.export');
});

Route::group(['namespace' => 'Covid'], function () {
    Route::resource('encuestacovid', 'EncuestacovidController');
    Route::resource('admincovid', 'AdmincovidController');
    Route::resource('covidrelated', 'CovidRelatedController');
    Route::get('covidrelated.related', 'CovidRelatedController@related');
    Route::get('admincovid.export', 'AdmincovidController@export')->name('admincovid.export');
});
