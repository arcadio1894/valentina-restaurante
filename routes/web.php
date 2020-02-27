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

Route::group(['middleware' => 'auth'], function() {
	Route::prefix('admins')->group(function() {
		Route::name('admins.')->group(function() {
    		Route::get('/', function () {
    			return view('homeAdmin');
			})->name('dashboard');

    		Route::prefix('zone')->group(function() {
    			Route::name('zone.')->group(function() {
                    Route::namespace('Admin')->group(function() {
		    		    Route::get('/','ZoneController@index')->name('index');
                        Route::get('/create','ZoneController@create')->name('create');
                        Route::post('/store','ZoneController@store')->name('store');
                        Route::get('/update/{id}','ZoneController@update')->name('update');
                        Route::post('/edit','ZoneController@edit')->name('edit');
                        Route::get('/delete/{id}','ZoneController@delete')->name('delete');
                        Route::get('/maps','ZoneController@maps')->name('maps');
                    });
		    	});
    		});
    	});
    });
});
