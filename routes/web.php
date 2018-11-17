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
    return view('auth.login');
});

Route::group(['prefix' => 'auth', 'middleware' => 'auth'], function(){
    Route::get('dashboard', 'Admin\DashboardController@index')->name('admin.dashboard');

    Route::get('data_graf', 'Admin\DashboardController@data_graf')->name('admin.data_graf');
    Route::post('data_dashboard', 'Admin\DashboardController@data');

    Route::group(['prefix' => 'profile'], function(){
        Route::get('/', 'ProfileController@index')->name('admin.profile.index');
        Route::post('save', 'ProfileController@save')->name('admin.profile.save');
    });


    Route::group(['prefix' => 'kasir'], function(){
        Route::get('/', 'KasirController@index')->name('kasir.index');
        Route::get('data', 'KasirController@data')->name('kasir.data');

        Route::get('ready_to_pay/{order_id}', 'KasirController@ready_to_pay')->name('ready_to_pay');

        Route::get('create_pos', 'KasirController@pos')->name('kasir.create_pos');
        Route::get('create_pos/detail/{order_id}', 'KasirController@pos_detail')->name('kasir.create_pos.detail');

        Route::post('finish_order', 'KasirController@finish_order')->name('kasir.finish_order');
        
    });

    Route::group(['prefix' => 'dapur'], function(){
        Route::get('/', 'DapurController@index')->name('dapur.index');
        Route::get('data/{status}', 'DapurController@data')->name('dapur.data');

        Route::get('order_list', 'DapurController@order_list')->name('dapur.order_list');
        Route::get('order_detail', 'DapurController@order_detail')->name('dapur.order_detail');

        Route::get('check_notif', 'DapurController@check_notif')->name('dapur.check_notiif');

        Route::get('kerjakan/{id}', 'DapurController@kerjakan')->name('dapur.kerjakan');
        Route::get('memasak/{id}', 'DapurController@memasak')->name('dapur.memasak');
        Route::get('selesai/{id}', 'DapurController@selesai')->name('dapur.selesai');
    }); 

    Route::group(['prefix' => 'kepegawaian'], function(){
        Route::get('/', 'Admin\KepegawaianController@index')->name('admin.kepegawaian.index');
        Route::get('data', 'Admin\KepegawaianController@data')->name('admin.kepegawaian.data');
        Route::get('add', 'Admin\KepegawaianController@add')->name('admin.kepegawaian.add');
        Route::post('save', 'Admin\KepegawaianController@save')->name('admin.kepegawaian.save');
        Route::get('edit/{id}', 'Admin\KepegawaianController@edit')->name('admin.kepegawaian.edit');
        Route::post('update', 'Admin\KepegawaianController@update')->name('admin.kepegawaian.update');
        Route::get('delete_image/{id}', 'Admin\KepegawaianController@delete_image')->name('admin.kepegawaian.delete_image');
        Route::get('delete/{id}', 'Admin\KepegawaianController@delete')->name('admin.kepegawaian.delete');
    });

    Route::group(['prefix' => 'informasi_restaurant'], function(){
        Route::get('/', 'Admin\InfoController@index')->name('admin.info.index');
        Route::post('save', 'Admin\InfoController@save')->name('admin.info.save');
    });

    Route::group(['prefix' => 'bahan_baku'], function(){
        Route::get('/', 'Admin\BahanBakuController@index')->name('admin.bahan_baku.index');
        Route::get('data', 'Admin\BahanBakuController@data')->name('admin.bahan_baku.data');

        Route::get('show_single_data/{id}', 'Admin\BahanBakuController@show_single_data')->name('admin.bahan_baku.show_single_data');

        Route::get('detail/{id}', 'Admin\BahanBakuController@detail')->name('admin.bahan_baku.detail');

        Route::post('reduce_stock', 'Admin\BahanBakuController@reduce_stock')->name('admin.bahan_baku.reduce_stock');
        Route::post('add_stock', 'Admin\BahanBakuController@add_stock')->name('admin.bahan_baku.add_stock');

        Route::get('add', 'Admin\BahanBakuController@add')->name('admin.bahan_baku.add');
        Route::post('save', 'Admin\BahanBakuController@save')->name('admin.bahan_baku.save');

        Route::get('edit/{id}', 'Admin\BahanBakuController@edit')->name('admin.bahan_baku.edit');
        Route::post('update', 'Admin\BahanBakuController@update')->name('admin.bahan_baku.update');

        Route::get('delete/{id}', 'Admin\BahanBakuController@delete')->name('admin.bahan_baku.delete');
        
    });

    Route::group(['prefix' => 'menu'], function(){
        Route::get('/', 'Admin\MenuController@index')->name('admin.menu.index');
        Route::get('data', 'Admin\MenuController@data')->name('admin.menu.data');

        Route::get('detail/{id}', 'Admin\MenuController@detail')->name('admin.menu.detail');

        Route::get('edit/{id}', 'Admin\MenuController@edit')->name('admin.menu.edit');
        Route::post('save', 'Admin\MenuController@save')->name('admin.menu.save');

        Route::get('get_bahan_baku/{menu_id}', 'Admin\MenuController@get_bahan_baku')->name('admin.menu.get_bahan_baku');
        Route::post('add_bahan_baku', 'Admin\MenuController@add_bahan_baku')->name('admin.menu.add_bahan_baku');

        Route::get('add', 'Admin\MenuController@add')->name('admin.menu.add');
        Route::post('update', 'Admin\MenuController@update')->name('admin.menu.update');

        Route::get('delete_image/{id}', 'Admin\MenuController@delete_image')->name('admin.menu.delete_image');
        Route::get('delete/{id}', 'Admin\MenuController@delete')->name('admin.menu.delete');
    });

    Route::group(['prefix' => 'report'], function(){
        Route::group(['prefix' => 'laba_rugi'], function(){
            Route::get('keluar', 'Report\LabaRugiController@keluar')->name('report.laba_rugi.keluar');
        });

        Route::group(['prefix' => 'bahan_baku'], function(){
            Route::get('masuk', 'Report\BahanBakuController@masuk')->name('report.bahan_baku.masuk');
            Route::get('keluar', 'Report\BahanBakuController@keluar')->name('report.bahan_baku.keluar');
        });

        Route::group(['prefix' => 'penjualan'], function(){
            Route::get('/', 'Report\PenjualanController@index')->name('report.penjualan.index');
        });

    });
});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
