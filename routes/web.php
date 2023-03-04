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

Route::get('/', 'PageController@showIndex')->name('main');

Route::get('/google-api', 'PageController@showGoogleApi')->name('google-api');

Route::get('/start-api', 'PageController@startApi')->name('start-api');

Route::get('/test1', 'PageController@showTest1')->name('test1');

Route::get('/test2', 'PageController@showTest2')->name('test2');
