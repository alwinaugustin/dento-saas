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

Route::prefix('doctors')->group(function() {
    Route::get('/', 'DoctorsController@index')->name('doctors/index');
    Route::get('/get', 'DoctorsController@get')->name('doctors/get');
    Route::get('/create', 'DoctorsController@create')->name('doctors/create');
    Route::post('/create', 'DoctorsController@store')->name('doctors/create');
    Route::get('/edit/{id}', 'DoctorsController@create')->name('doctors/edit');
});
