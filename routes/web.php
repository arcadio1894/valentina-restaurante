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
		    		Route::get('/','Admin\ZoneController@index')->name('index');
                    Route::get('/create','Admin\ZoneController@create')->name('create');
                    Route::post('/store','Admin\ZoneController@store')->name('store');
                    Route::get('/update/{id}','Admin\ZoneController@update')->name('update');
                    Route::post('/edit','Admin\ZoneController@edit')->name('edit');
                    Route::get('/delete/{id}','Admin\ZoneController@delete')->name('delete');
		    	});
    		});

			Route::prefix('store')->group(function() {
				Route::name('store.')->group(function() {
					Route::get('/','Admin\StoreController@index')->name('index');
					Route::get('/create','Admin\StoreController@create')->name('create');
					Route::post('/store','Admin\StoreController@store')->name('store');
					Route::get('/edit/{id}','Admin\StoreController@edit')->name('edit');
					Route::post('/update','Admin\StoreController@update')->name('update');
					Route::post('/delete','Admin\StoreController@delete')->name('delete');
				});
			});
    	});
    });
});
