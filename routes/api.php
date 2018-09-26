<?php

use Illuminate\Http\Request;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::group(['prefix' => 'menu'], function(){
    Route::get('show_menu/{data}', 'API\MenuController@show_menu');
    Route::get('search/{query}', 'API\MenuController@search');
    Route::get('detail/{id}', 'API\MenuController@detail');
    Route::get('order_list/{id}', 'API\MenuController@order_list');

    Route::post('add_menu', 'API\MenuController@add_menu');
    
    Route::post('add_item', 'API\MenuController@add_item');
    Route::post('remove_item', 'API\MenuController@remove_item');
    Route::post('delete_item', 'API\MenuController@delete_item');
});

Route::post('login', 'API\UserController@login');
Route::post('register', 'API\UserController@register');

Route::group(['middleware' => 'auth:api'], function(){
	Route::post('details', 'API\UserController@details');
});

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});
