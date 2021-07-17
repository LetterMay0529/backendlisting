<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

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

Route::post('/login',  'App\Http\Controllers\AuthController@login');
Route::post('/register', 'App\Http\Controllers\AuthController@register');

Route::group(['middleware'=>'auth:api'], function() {
    Route::get('/user', 'App\Http\Controllers\AuthController@me');
    Route::post('/logout', 'App\Http\Controllers\AuthController@logout');

    Route::post('/listings/search','App\Http\Controllers\ListController@search');
    Route::post('/listings', 'App\Http\Controllers\ListController@store');
    Route::get('/listings', 'App\Http\Controllers\ListController@index');
    Route::get('/listings/{listing}','App\Http\Controllers\ListController@show');
    Route::put('/listings/{listing}','App\Http\Controllers\ListController@update');
    Route::delete('/listings/{listing}','App\Http\Controllers\ListController@destroy');


});
