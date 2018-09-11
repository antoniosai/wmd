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
    // return view('welcome');
    return view('admin.layouts.app');
});



Route::group(['prefix' => 'auth'], function(){
    Route::get('dashboard', 'Admin\DashboardController@index')->name('admin.dashboard');
    Route::post('data_dashboard', 'Admin\DashboardController@data');


    Route::group(['prefix' => 'menu'], function(){
        Route::get('/', 'Admin\MenuController@index')->name('admin.menu.index');
        Route::get('data', 'Admin\MenuController@data')->name('admin.menu.data');

        Route::get('edit/{id}', 'Admin\MenuController@edit')->name('admin.menu.edit');
        Route::get('detail/{id}', 'Admin\MenuController@detail')->name('admin.menu.detail');

        Route::post('save', 'Admin\MenuController@save')->name('admin.menu.save');
        Route::post('update', 'Admin\MenuController@update')->name('admin.menu.update');

        Route::get('delete_image/{id}', 'Admin\MenuController@delete_image')->name('admin.menu.delete_image');
        Route::get('delete/{id}', 'Admin\MenuController@delete')->name('admin.menu.delete');
    });
});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
