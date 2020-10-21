<?php

use Illuminate\Support\Facades\Route;

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

Route::middleware('guest:web')->group(function() {
Auth::routes(['register' => false]);
});

Route::middleware('auth:web')->group(function() {
    Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

    Route::get('password/change', 'App\Http\Controllers\ProfileController@showChangePassword')->name('password.change');
    Route::post('password/change', 'App\Http\Controllers\ProfileController@changePassword')->name('password.save');
});

Route::prefix('admin')->group(function(){
    Route::namespace('App\Http\Controllers\Admin')->middleware(['guest:admin'])->group(function() {
        // Authentication Routes...
        Route::get('login', 'Auth\LoginController@showLoginForm')->name('admin.login');
        Route::post('login', 'Auth\LoginController@login')->name('admin.login.submit');

        Route::post('password/email', 'Auth\ForgotPasswordController@sendResetLinkEmail')->name('admin.password.email');
        Route::get('password/reset', 'Auth\ForgotPasswordController@showLinkRequestForm')->name('admin.password.request');
        Route::post('password/reset', 'Auth\ResetPasswordController@reset')->name('admin.password.update');
        Route::get('password/reset/{token}', 'Auth\ResetPasswordController@showResetForm')->name('admin.password.reset');
    });

    Route::middleware('auth:admin')->group(function() {
        Route::namespace('App\Http\Controllers\Admin')->group(function() {
            Route::post('logout', 'Auth\LoginController@logout')->name('admin.logout');
            Route::get('/', "HomeController@index")->name('admin.index');

            Route::get('password/change', 'ProfileController@showChangePassword')->name('admin.password.change');
            Route::post('password/change', 'ProfileController@changePassword')->name('admin.password.save');
        });
    });
});
