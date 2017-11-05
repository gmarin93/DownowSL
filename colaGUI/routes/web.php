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

Route::get('/', 'DownloadController@showVideos');


Route::post('/down_method','DownloadController@insercion', function () {

});

Auth::routes();

Route::get('/home', 'DownloadController@showVideos');
