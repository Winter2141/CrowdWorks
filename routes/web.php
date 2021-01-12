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


Route::get('/', 'HomeController@index')->name('user.home.index');

Auth::routes();

Route::group(['middleware' => 'auth:web', 'as' => 'user.'], function () {

    Route::get('/first', 'HomeController@first')->name('home.first');

});
