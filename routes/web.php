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

Route::namespace('Backend')->group(function() {
    Route::prefix('admin')->name('admin.')->group(function() {
        Route::prefix('category')->name('category.')->group(function() {
            Route::get('index','CategoryController@index')->name('index');
            Route::get('create','CategoryController@create')->name('create');
            Route::post('store','CategoryController@store')->name('store');
            Route::get('edit/{id}','CategoryController@edit')->name('edit');
            Route::post('update/{id}','CategoryController@update')->name('update');
            Route::get('destroy/{id}','CategoryController@destroy')->name('destroy');
        });

        Route::prefix('product')->name('product.')->group(function() {
            Route::get('index','ProductController@index')->name('index');
            Route::get('create','ProductController@create')->name('create');
            Route::post('store','ProductController@store')->name('store');
            Route::get('edit/{id}','ProductController@edit')->name('edit');
            Route::post('update/{id}','ProductController@update')->name('update');
            Route::get('destroy/{id}','ProductController@destroy')->name('destroy');
        });

        Route::prefix('ghtk')->name('ghtk.')->group(function() {
            Route::get('dang-don-hang','GHTKController@dangdonhang')->name('dangdonhang');
            Route::get('tinh-phi-van-chuyen','GHTKController@tinhphivanchuyen')->name('tinhphivanchuyen');
            Route::get('trang-thai-don-hang','GHTKController@trangthaidonhang')->name('trangthaidonhang');
        });
    });
});
