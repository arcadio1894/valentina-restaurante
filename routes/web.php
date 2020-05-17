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

Route::get('/locals','Admin\StoreController@locals')->name('locals');
Route::get('/address_locals','Admin\StoreController@addressLocals');


Auth::routes();

Route::group(['middleware' => 'auth'], function() {
	Route::prefix('admins')->group(function() {
		Route::name('admins.')->group(function() {

			Route::post('/logout', 'Auth\LoginController@logoutAdmin')->name('logout');

			Route::namespace('Admin')->group(function() {
    			Route::get('/','HomeController@index')->name('dashboard');
    		});

    		Route::prefix('zone')->group(function() {
    			Route::name('zone.')->group(function() {
                    Route::namespace('Admin')->group(function() {
		    		    Route::get('/','ZoneController@index')->name('index');
                        Route::get('/create','ZoneController@create')->name('create');
                        Route::post('/store','ZoneController@store')->name('store');
                        Route::get('/edit/{id}','ZoneController@edit')->name('edit');
                        Route::post('/update','ZoneController@update')->name('update');
                        Route::post('/delete','ZoneController@delete')->name('delete');
                        Route::get('/maps','ZoneController@maps')->name('maps');
                    });
		    	});
    		});

			Route::prefix('store')->group(function() {
				Route::name('store.')->group(function() {
					Route::namespace('Admin')->group(function() {
						Route::get('/','StoreController@index')->name('index');
						Route::get('/create','StoreController@create')->name('create');
						Route::post('/store','StoreController@store')->name('store');
						Route::get('/edit/{id}','StoreController@edit')->name('edit');
						Route::post('/update','StoreController@update')->name('update');
						Route::post('/delete','StoreController@delete')->name('delete');
						Route::post('/session','StoreController@change_session')->name('session');
					});
				});
			});

			Route::prefix('category')->group(function() {
				Route::name('category.')->group(function() {
					Route::namespace('Admin')->group(function() {
						Route::get('/','CategoryController@index')->name('index');
						Route::get('/create/{id?}','CategoryController@create')->name('create');
						Route::post('/store','CategoryController@store')->name('store');
						Route::get('/edit/{id}','CategoryController@edit')->name('edit');
						Route::post('/update','CategoryController@update')->name('update');
						Route::get('/delete/{id}','CategoryController@delete')->name('delete');
					});
				});
			});

			Route::prefix('product')->group(function(){
				Route::name('product.')->group(function(){
					Route::namespace('Admin')->group(function() {
						Route::get('/','ProductController@index')->name('index');
						Route::get('/create','ProductController@create')->name('create');
						Route::post('/store','ProductController@store')->name('store');
						Route::get('/edit/{id}','ProductController@edit')->name('edit');
						Route::post('/delete','ProductController@delete')->name('delete');
						Route::post('/filterable','ProductController@filterableProducts')->name('filterable');
					});
				});
			});
    	});
    });
});

Route::group(['middleware' => 'web'], function() {
	Route::namespace('Web')->group(function(){
		Route::get('/', 'HomeController@index')->name('web.home');
		Route::prefix('web')->group(function(){
			Route::name('web.')->group(function(){
				Route::get('/login','LoginController@showLoginForm')->name('login.form');
				Route::post('/login','LoginController@login')->name('login');
				Route::post('/logout','LoginController@logout')->name('logout');

                Route::get('/register','RegisterController@showRegisterForm')->name('register.form');
                Route::post('/register','RegisterController@create')->name('register');

                Route::get('/account/user','CustomerController@account')->name('account.user');
                Route::get('/account/location','CustomerController@location')->name('account.location');
                Route::get('/account/orders','CustomerController@orders')->name('account.orders');

                Route::post('/account/user','CustomerController@update')->name('customer.update');
                Route::post('/account/location/delete','CustomerController@locationDelete')->name('account.location.delete');

                Route::get('/account/location/edit/{id}','CustomerController@locationEdit')->name('account.location.edit');
                Route::post('/account/location/update','CustomerController@locationUpdate')->name('account.location.update');

			});
		});
	});
});