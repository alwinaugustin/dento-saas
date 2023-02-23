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

Route::prefix('pateints')->group(function() {
    Route::get('/', 'PateintsController@index')->name('patients/index');
    Route::get('/create', 'PateintsController@create')->name('patients/create');
    Route::post('/create', 'PateintsController@store')->name('pateints/create');
});
