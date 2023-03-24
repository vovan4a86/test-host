<?php

use Illuminate\Support\Facades\Route;

Route::get('/', 'PageController@showIndex')->name('main');

Route::get('/ytdlp', 'PageController@showYtdlp')->name('ytdlp');

Route::post('/get-file', 'PageController@getFile');

Route::post('/delete-files', 'PageController@deleteFiles');

Route::post('/get-name', 'PageController@getName');



Route::get('/google-api', 'PageController@showGoogleApi')->name('google-api');

Route::get('/start-api', 'PageController@startApi')->name('start-api');

Route::get('/test2', 'PageController@showTest2')->name('test2');

Route::post('/send-index-now', 'PageController@sendIndexNow');
