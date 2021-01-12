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

use App\Http\Controllers\Admin\DashboardController;

Route::get('login', 'Auth\LoginController@showLoginForm')->name('admin.login');

Route::post('login', 'Auth\LoginController@login');

Route::group(['middleware' => 'auth:admin'], function () {
    //default admin routing
    Route::get('/', 'DashboardController@index')->name('admin.dashboard.index');
    Route::post('logout', 'Auth\LoginController@logout')->name('admin.logout');

});
