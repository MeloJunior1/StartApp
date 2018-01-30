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

Route::group(['prefix' => 'admin',], function () {
    Route::get('/', 'AdminController@adminHome');

    Route::get('/register', 'Auth\RegisterController@showRegistrationForm')->name('registerAdmin');
    Route::post('/register', 'Auth\RegisterController@adminRegister');

    Route::group(['prefix' => '/restaurants', 'middleware' => ['auth', 'onlyAdmin']], function () {
        Route::get('/add', 'RestaurantsController@add')->name('rest.add');
        Route::post('/store', 'RestaurantsController@store')->name('rest.store');

        Route::put('/edit', 'RestaurantsController@update')->name('rest.update');
        Route::get('/edit/{id}', 'RestaurantsController@edit')->name('rest.edit');

        Route::post('/send/image', 'RestaurantsController@imageUpload')->name('rest.send.img');

        Route::group(['prefix' => '{restaurant_id}/dishes'], function () {
            Route::get('/', 'DishesController@index')->name('rest.dishes');

            Route::get('/new', 'DishesController@new')->name('rest.new.dishes');
            Route::post('/store', 'DishesController@store')->name('rest.store.dishes');
        });

        Route::group(['prefix' => '{restaurant_id}/settings'], function(){
            Route::get('/', 'SettingsController@index')->name('settings');

            Route::post('/save/category', 'SettingsController@saveDefinition')->name('settings.save.category');
            Route::post('/save/grade', 'SettingsController@saveDefinition')->name('settings.save.grade');
            
            Route::put('/edit/definition', 'SettingsController@editDefinition')->name('settings.edit.definition');
            Route::delete('/remove/definition', 'SettingsController@removeDefinition')->name('setting.remove.definition');

        });

        /*Exibe as informacoes do restaurante */
        Route::get('/{id}', 'RestaurantsController@get')->name('rest.get');
    });
});

Route::group(['prefix'=>'local'], function () {
    Route::get('/brazil', 'LocalizationController@getAll');
    Route::get('/brazil/{estado}', 'LocalizationController@getCidadesFrom');
});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');


