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

Route::middleware('auth')->group(function () {
    Route::prefix('appointments')->group(function() {
        Route::get('/', 'AppointmentsController@index')->name('appointments/index');
        Route::get('/create', 'AppointmentsController@create')->name('appointments/create');
        Route::post('/create', 'AppointmentsController@store')->name('appointments/create');
        Route::get('/edit/{id}', 'AppointmentsController@create')->name('appointments/edit');
        Route::post('/update', 'AppointmentsController@update')->name('appointments/update');
    });
});
