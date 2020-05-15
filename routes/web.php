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

Auth::routes(['verify' => true]);



Route::get('/home', 'HomeController@index')->name('home');
Route::get('/password/change', 'HomeController@passwordChange')->name('password.change');
Route::post('/old/password', 'HomeController@oldPassword')->name('old.password');
Route::post('/new/password', 'HomeController@newPassword')->name('new.password');

