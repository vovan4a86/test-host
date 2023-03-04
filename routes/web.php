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

Route::get('google-api', function () {
    return view('google-api-view');
})->name('google-api');

Route::get('/test1', function () {
    return 'Test 1 show';
})->name('test1');

Route::get('/test2', function () {
    return 'Test 2 show';
})->name('test2');
