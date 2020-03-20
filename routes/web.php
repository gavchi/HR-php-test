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

Route::get('/weather/{id}', 'WeatherController@weather');
Route::get('/orders', 'OrderController@index');
Route::get('/orders/{id}', 'OrderController@edit');
Route::post('/orders/{id}', 'OrderController@save');
Route::get('/products', 'ProductController@index');
Route::post('/products/{id}', 'ProductController@save');
