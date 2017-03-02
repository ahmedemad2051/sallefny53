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

Auth::routes();


Route::group(['middleware'=>'auth'],function(){

    Route::get('/home', 'HomeController@index');
    Route::post('/home/add','HomeController@add');
    Route::get('/home/getProduct','HomeController@getProduct');
    Route::post('/home/edit/{id}','HomeController@update');
    Route::get('/home/delete','HomeController@delete');
    Route::resource('/categories','CategoryController');
    Route::resource('/geolocations','GeolocationController');

});

Route::get('/sallefny/products','ApiController@index');