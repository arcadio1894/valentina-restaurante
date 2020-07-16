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

			Route::prefix('paymentmethod')->group(function(){
				Route::name('paymentmethod.')->group(function(){
					Route::namespace('Admin')->group(function() {
						Route::get('/','PaymentMethodController@index')->name('index');
						Route::get('/create','PaymentMethodController@create')->name('create');
						Route::post('/store','PaymentMethodController@store')->name('store');
						Route::get('/edit/{id}','PaymentMethodController@edit')->name('edit');
						Route::post('/delete','PaymentMethodController@delete')->name('delete');
					});
				});
			});

			Route::prefix('shippingmethod')->group(function(){
				Route::name('shippingmethod.')->group(function(){
					Route::namespace('Admin')->group(function() {
						Route::get('/','ShippingMethodController@index')->name('index');
						Route::get('/create','ShippingMethodController@create')->name('create');
						Route::post('/store','ShippingMethodController@store')->name('store');
						Route::get('/edit/{id}','ShippingMethodController@edit')->name('edit');
						Route::post('/delete','ShippingMethodController@delete')->name('delete');
					});
				});
			});

            Route::prefix('customer')->group(function() {
                Route::name('customer.')->group(function() {
                    Route::namespace('Admin')->group(function() {
                        Route::get('/','CustomerController@index')->name('index');
                        Route::get('/create','CustomerController@create')->name('create');
                        Route::post('/store','CustomerController@store')->name('store');
                        Route::get('/edit/{id}','CustomerController@edit')->name('edit');
                        Route::post('/update','CustomerController@update')->name('update');
                        Route::post('/delete','CustomerController@delete')->name('delete');
                        Route::post('/location/update/{id}','CustomerController@update')->name('location.edit');
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

                Route::get('/account/location/create','CustomerController@locationCreate')->name('account.location.create');
                Route::post('/account/location/store','CustomerController@locationStore')->name('account.location.store');

            });

		});

		Route::name('web.')->group(function(){
	    	Route::get('/menu','MenuController@index')->name('menu');
	    	Route::get('/menu/{categorySlug}','MenuController@index')->name('menu.category.products');
	    	Route::get('/menu/{categorySlug}/{productSlug}','MenuController@productDetail')->name('menu.productdetail');
	    });
	});
});