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


Route::get('usuarios','MainController@index');
Route::post('store','MainController@store');
Route::post('login','MainController@login');
Route::post('aceptar','MainController@aceptar');
Route::post('rechazar','MainController@rechazar');