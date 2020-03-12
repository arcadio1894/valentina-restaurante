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
	Route::get('/home', 'HomeController@index')->name('home');

	Route::prefix('admins')->group(function() {
		Route::name('admins.')->group(function() {
    		Route::get('/', function () {
    			$stores = \App\Models\Store::where('status','enabled')->orderBy('id','desc')->select(['id','name'])->get();
				return view('homeAdmin')->with(compact('stores'));
			})->name('dashboard');

    		Route::prefix('zone')->group(function() {
    			Route::name('zone.')->group(function() {
                    Route::namespace('Admin')->group(function() {
		    		    Route::get('/','ZoneController@index')->name('index');
                        Route::get('/create','ZoneController@create')->name('create');
                        Route::post('/store','ZoneController@store')->name('store');
                        Route::get('/edit/{id}','ZoneController@edit')->name('edit');
                        Route::post('/update','ZoneController@update')->name('update');
                        Route::get('/delete/{id}','ZoneController@delete')->name('delete');
                        Route::get('/maps','ZoneController@maps')->name('maps');
                    });
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
					Route::post('/session','Admin\StoreController@change_session')->name('session');
				});
			});

			Route::prefix('category')->group(function() {
				Route::name('category.')->group(function() {
					Route::get('/','Admin\CategoryController@index')->name('index');
					Route::get('/create','Admin\CategoryController@create')->name('create');
					Route::post('/store','Admin\CategoryController@store')->name('store');
					Route::get('/edit/{id}','Admin\CategoryController@edit')->name('edit');
					Route::post('/update','Admin\CategoryController@update')->name('update');
					Route::get('/delete/{id}','Admin\CategoryController@delete')->name('delete');
				});
			});
    	});
    });
});

Route::get('/locals','Admin\StoreController@locals')->name('locals');
Route::get('/address_locals','Admin\StoreController@addressLocals');