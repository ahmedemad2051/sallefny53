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

Route::get('test',function(){
    return response([1,2,3,4],200);
});

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:api');

Route::group(['middleware'=>'auth:api'],function(){

    Route::get('/home', 'HomeController@index');
    Route::post('/home/add','HomeController@add');
    Route::get('/home/getProduct','HomeController@getProduct');
    Route::post('/home/edit/{id}','HomeController@update');
    Route::get('/home/delete','HomeController@delete');
    Route::resource('/categories','CategoryController');
    Route::resource('/geolocations','GeolocationController');

});

Route::get('/sallefny/products','ApiController@index');