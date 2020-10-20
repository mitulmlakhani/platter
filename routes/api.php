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

Route::group(['prefix' => 'admin'], function() {
    Route::namespace('\App\Http\Controllers\Admin\Api')->group(function(){
            Route::post('login', 'AuthController@login');
            Route::post('reset', 'ResetPasswordController@sendResetLinkEmail');

        Route::middleware('auth:admin_api')->group(function(){
            Route::post('password/change', 'AuthController@changePassword');
        });
    });
});

Route::namespace('\App\Http\Controllers\Api')->group(function(){
    Route::post('login', 'AuthController@login');
    Route::post('reset', 'ResetPasswordController@sendResetLinkEmail');
    Route::middleware('auth:api')->group(function(){
        Route::post('password/change', 'AuthController@changePassword');
    });
});
