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

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

//Auth login dan register
Route::post('login', 'UsersController@log');
Route::post('register', 'UsersController@reg');
Route::post('daftar', 'UsersController@reg_member');
Route::post('logout', 'UsersController@logout');

Route::group(['middleware' => 'auth:api'], function(){
    Route::get('details', 'UsersController@details');
});

//Order
Route::group(['middleware' => 'auth:api'], function(){
    Route::post('order', 'OrdersController@add_order');
    Route::post('order/detail', 'OrdersController@detail_order');
});

//Service
Route::group(['middleware' => 'auth:api'], function(){
    Route::get('service', 'ServicesController@get_service');
});
Route::post('service', 'ServicesController@add_service');
