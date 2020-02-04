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

// Route::get('/', function () {
//     return view('welcome');
// });

//Auth login & register
Auth::routes();
Route::get('/', 'UsersController@index');
Route::post('/login', 'UsersController@submit');
Route::get('/register', 'UsersController@register');

//Dashboard
Route::get('/dashboard', 'DashboardsController@index');

//Service
Route::get('/service', 'ServicesController@index');
Route::get('/service/create', 'ServicesController@create');
Route::get('/service/{service}', 'ServicesController@show');
Route::post('/service', 'ServicesController@store');
Route::delete('/service/{service}', 'ServicesController@destroy');
Route::get('/service/{service}/edit', 'ServicesController@edit');
Route::put('/service/{service}', 'ServicesController@update');

//Member
Route::get('member', 'MembersController@index');
Route::get('member/{member}', 'MembersController@show');
Route::get('member/{member}/edit', 'MembersController@edit');
Route::put('member/{member}', 'MembersController@update');

//Order
Route::get('order', 'OrdersController@index');
Route::get('order/{order}', 'OrdersController@show');